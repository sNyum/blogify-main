@extends('layouts.user')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-orange-50/50 via-white to-purple-50/50 pt-24 pb-8 px-4" x-data="chatApp()">
    <div class="max-w-7xl mx-auto h-[calc(100vh-140px)] bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 flex">
        
        <!-- Sidebar: Conversations List -->
        <div class="w-full md:w-80 lg:w-96 border-r border-gray-100 bg-gray-50/50 flex flex-col transition-all duration-300"
             :class="{'hidden md:flex': currentConversation, 'flex': !currentConversation}">
            <!-- Sidebar Header -->
            <div class="p-6 border-b border-gray-100 bg-white/80 backdrop-blur-sm sticky top-0 z-10">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-bold text-gray-800 tracking-tight">Pesan</h2>
                    <button @click="showNewConversationModal = true" 
                            class="bg-orange-600 hover:bg-orange-700 text-white text-sm px-4 py-2 rounded-xl shadow-lg shadow-orange-500/20 transform hover:-translate-y-0.5 transition-all duration-200 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        Baru
                    </button>
                </div>
                <!-- Search (Visual Only) -->
                <div class="relative">
                    <input type="text" placeholder="Cari percakapan..." class="w-full bg-gray-100 border-none rounded-xl py-2.5 pl-10 pr-4 text-sm text-gray-600 focus:ring-2 focus:ring-orange-500 focus:bg-white transition-all">
                    <svg class="w-4 h-4 text-gray-400 absolute left-3.5 top-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
            </div>

            <!-- Conversation List -->
            <div class="flex-1 overflow-y-auto custom-scrollbar p-3 space-y-2">
                <template x-if="loadingConversations">
                    <div class="space-y-3 p-2">
                        <template x-for="i in 3">
                            <div class="animate-pulse flex space-x-4 p-3 rounded-xl bg-white">
                                <div class="rounded-full bg-gray-200 h-10 w-10"></div>
                                <div class="flex-1 space-y-2 py-1">
                                    <div class="h-4 bg-gray-200 rounded w-3/4"></div>
                                    <div class="h-3 bg-gray-200 rounded w-1/2"></div>
                                </div>
                            </div>
                        </template>
                    </div>
                </template>

                <template x-for="conversation in conversations" :key="conversation.id">
                    <div @click="selectConversation(conversation)" 
                         class="group p-4 rounded-xl cursor-pointer transition-all duration-200 border border-transparent"
                         :class="currentConversation && currentConversation.id === conversation.id ? 'bg-white shadow-md border-orange-100 ring-1 ring-orange-50' : 'hover:bg-white hover:shadow-sm'">
                        
                        <div class="flex justify-between items-start mb-2">
                            <div class="flex items-center gap-3 overflow-hidden">
                                <!-- Avatar Placeholder -->
                                <div class="w-10 h-10 rounded-full flex-shrink-0 flex items-center justify-center text-sm font-bold"
                                     :class="currentConversation && currentConversation.id === conversation.id ? 'bg-orange-100 text-orange-600' : 'bg-gray-200 text-gray-500'">
                                    <span x-text="conversation.subject.substring(0, 2).toUpperCase()"></span>
                                </div>
                                <div class="min-w-0">
                                    <h3 class="font-semibold text-gray-900 truncate text-sm" x-text="conversation.subject"></h3>
                                    <p class="text-xs text-gray-500 truncate" x-text="conversation.latest_message || 'Belum ada pesan'"></p>
                                </div>
                            </div>
                            <div class="flex flex-col items-end gap-1">
                                <span class="text-[10px] font-medium text-gray-400" x-text="formatDate(conversation.updated_at)"></span>
                                <template x-if="conversation.unread_count > 0">
                                    <span class="bg-orange-600 text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full min-w-[18px] text-center shadow-sm shadow-orange-500/30" x-text="conversation.unread_count"></span>
                                </template>
                            </div>
                        </div>
                        
                        <div class="flex items-center justify-between mt-2 pl-[52px]">
                            <span class="px-2.5 py-1 text-[10px] font-medium rounded-full border"
                                  :class="{
                                      'bg-green-50 text-green-700 border-green-100': conversation.status === 'open',
                                      'bg-yellow-50 text-yellow-700 border-yellow-100': conversation.status === 'assigned',
                                      'bg-gray-50 text-gray-600 border-gray-100': conversation.status === 'closed'
                                  }">
                                <span class="w-1.5 h-1.5 rounded-full inline-block mr-1" 
                                      :class="{
                                          'bg-green-500': conversation.status === 'open',
                                          'bg-yellow-500': conversation.status === 'assigned',
                                          'bg-gray-500': conversation.status === 'closed'
                                      }"></span>
                                <span x-text="conversation.status === 'open' ? 'Terbuka' : (conversation.status === 'assigned' ? 'Diproses' : 'Selesai')"></span>
                            </span>
                        </div>
                    </div>
                </template>

                <template x-if="conversations.length === 0 && !loadingConversations">
                    <div class="flex flex-col items-center justify-center h-64 text-center p-6 bg-white rounded-xl mx-2">
                        <div class="w-16 h-16 bg-orange-50 rounded-full flex items-center justify-center mb-4">
                            <svg class="w-8 h-8 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                            </svg>
                        </div>
                        <h4 class="text-gray-900 font-medium mb-1">Belum ada percakapan</h4>
                        <p class="text-gray-500 text-sm mb-4">Mulai konsultasi dengan admin kami sekarang.</p>
                        <button @click="showNewConversationModal = true" class="text-orange-600 font-medium text-sm hover:underline">Mulai Percakapan Baru</button>
                    </div>
                </template>
            </div>
        </div>

        <!-- Main Chat Area -->
        <div class="flex-1 flex-col bg-white relative" 
             :class="{'flex': currentConversation, 'hidden md:flex': !currentConversation}">
            <!-- Empty State -->
            <template x-if="!currentConversation">
                <div class="absolute inset-0 flex flex-col items-center justify-center bg-gray-50/30">
                    <div class="w-32 h-32 bg-gradient-to-br from-orange-100 to-purple-100 rounded-full flex items-center justify-center mb-6 shadow-inner">
                        <svg class="w-16 h-16 text-orange-500 opacity-80" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Selamat Datang di Live Chat</h3>
                    <p class="text-gray-500 max-w-sm text-center">Pilih percakapan dari daftar di sebelah kiri atau mulai percakapan baru untuk menghubungi admin.</p>
                </div>
            </template>

            <!-- Active Conversation -->
            <template x-if="currentConversation">
                <div class="flex flex-col h-full">
                    <!-- Chat Header -->
                    <div class="px-6 py-4 border-b border-gray-100 bg-white/80 backdrop-blur-sm sticky top-0 z-10 flex justify-between items-center shadow-sm">
                        <div class="flex items-center gap-4">
                            <!-- Back Button for Mobile -->
                            <button @click="currentConversation = null" class="md:hidden p-1 mr-[-8px] text-gray-500 hover:text-orange-600">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                            </button>
                            
                            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-orange-500 to-orange-600 text-white flex items-center justify-center font-bold text-lg shadow-lg shadow-orange-500/20">
                                <span x-text="currentConversation.subject.substring(0, 1).toUpperCase()"></span>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900" x-text="currentConversation.subject"></h3>
                                <div class="flex items-center gap-2 text-xs">
                                    <span class="flex items-center gap-1" :class="{
                                        'text-green-600': currentConversation.status === 'open',
                                        'text-yellow-600': currentConversation.status === 'assigned',
                                        'text-gray-500': currentConversation.status === 'closed'
                                    }">
                                        <span class="w-1.5 h-1.5 rounded-full" :class="{
                                            'bg-green-500': currentConversation.status === 'open',
                                            'bg-yellow-500': currentConversation.status === 'assigned',
                                            'bg-gray-500': currentConversation.status === 'closed'
                                        }"></span>
                                        <span x-text="currentConversation.status === 'open' ? 'Terbuka' : (currentConversation.status === 'assigned' ? 'Diproses' : 'Selesai')"></span>
                                    </span>
                                    <template x-if="currentConversation.assigned_admin">
                                        <span class="text-gray-400">• Dilayani oleh: <span class="font-medium text-gray-600" x-text="currentConversation.assigned_admin"></span></span>
                                    </template>
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex items-center gap-2">
                             <template x-if="currentConversation.status === 'closed'">
                                <span class="bg-gray-100 text-gray-600 px-3 py-1 rounded-full text-xs font-medium border border-gray-200">
                                    <svg class="w-3 h-3 inline-block mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                                    Ditutup
                                </span>
                             </template>
                        </div>
                    </div>

                    <!-- Messages Area -->
                    <div class="flex-1 overflow-y-auto p-6 space-y-6 bg-gray-50/30" id="messages-container">
                        <template x-for="message in messages" :key="message.id">
                            <div class="flex flex-col group animate-fade-in-up" 
                                 :class="{'items-end': message.sender_type === 'user', 'items-start': message.sender_type !== 'user'}">
                                
                                <div class="flex items-end gap-2 max-w-[80%] lg:max-w-[70%]">
                                    <!-- Admin Avatar -->
                                    <template x-if="message.sender_type !== 'user' && message.sender_type !== 'system'">
                                        <div class="w-8 h-8 rounded-full bg-gray-200 flex-shrink-0 flex items-center justify-center text-xs font-bold text-gray-600 mb-1">
                                            A
                                        </div>
                                    </template>

                                    <!-- Message Bubble -->
                                    <div class="relative px-5 py-3.5 shadow-sm text-sm leading-relaxed"
                                         :class="{
                                             'bg-gradient-to-br from-orange-600 to-orange-700 text-white rounded-2xl rounded-tr-sm': message.sender_type === 'user',
                                             'bg-white border border-gray-100 text-gray-800 rounded-2xl rounded-tl-sm shadow-sm': message.sender_type !== 'user' && message.message_type !== 'system',
                                             'bg-yellow-50 text-yellow-800 border border-yellow-200 text-center w-full max-w-lg mx-auto rounded-xl py-2': message.message_type === 'system'
                                         }">
                                        
                                        <!-- System Message Content -->
                                        <template x-if="message.message_type === 'system'">
                                             <div class="flex items-center justify-center gap-2">
                                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                                <p class="font-medium text-xs" x-text="message.content"></p>
                                             </div>
                                        </template>

                                        <!-- Regular Message Content -->
                                        <template x-if="message.message_type !== 'system'">
                                            <div>
                                                <!-- Sender Name for Admin -->
                                                <template x-if="message.sender_type === 'admin'">
                                                    <p class="text-xs font-bold text-orange-600 mb-1">Admin</p>
                                                </template>

                                                <p x-text="message.content" class="whitespace-pre-wrap"></p>
                                                
                                                <!-- File Attachment -->
                                                <template x-if="message.file_path">
                                                    <div class="mt-3 p-2 bg-black/5 rounded-lg overflow-hidden border border-black/5">
                                                        <template x-if="message.message_type === 'image'">
                                                            <a :href="message.file_url" target="_blank" class="block group relative">
                                                                <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-colors rounded-lg"></div>
                                                                <img :src="message.file_url" class="max-w-full h-auto rounded-lg max-h-48 object-cover shadow-sm">
                                                            </a>
                                                        </template>
                                                        <template x-if="message.message_type === 'file'">
                                                            <a :href="message.file_url" target="_blank" class="flex items-center gap-3 p-1 hover:bg-black/5 rounded transition-colors group">
                                                                <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center shadow-sm">
                                                                    <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                                                </div>
                                                                <div class="flex-1 min-w-0">
                                                                    <p class="text-xs font-medium truncate" x-text="message.file_name || 'Lampiran'"></p>
                                                                    <p class="text-[10px] opacity-70">Klik untuk unduh</p>
                                                                </div>
                                                            </a>
                                                        </template>
                                                    </div>
                                                </template>
                                            </div>
                                        </template>

                                        <!-- Timestamp -->
                                        <div class="mt-1 flex justify-end items-center gap-1 select-none" 
                                             :class="{'text-orange-100': message.sender_type === 'user', 'text-gray-400': message.sender_type !== 'user'}">
                                            <span class="text-[10px]" x-text="formatTime(message.created_at)"></span>
                                            <template x-if="message.sender_type === 'user'">
                                                <span>
                                                    <template x-if="message.is_read">
                                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"></path></svg>
                                                    </template>
                                                    <template x-if="!message.is_read">
                                                        <svg class="w-3 h-3 text-orange-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                                    </template>
                                                </span>
                                            </template>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>

                    <!-- Input Area -->
                    <div class="p-6 bg-white border-t border-gray-100 z-10">
                        <template x-if="currentConversation.status !== 'closed'">
                            <div class="max-w-4xl mx-auto">
                                <form @submit.prevent="sendMessage" class="relative flex items-end gap-2 bg-gray-50 p-2 rounded-2xl border border-gray-200 focus-within:ring-2 focus-within:ring-orange-500/20 focus-within:border-orange-500 transition-all shadow-sm">
                                    <!-- File Upload Button -->
                                    <button type="button" @click="$refs.fileInput.click()" 
                                            class="p-3 text-gray-400 hover:text-orange-600 hover:bg-white rounded-xl transition-all duration-200"
                                            title="Lampirkan File">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path></svg>
                                    </button>
                                    <input type="file" x-ref="fileInput" class="hidden" @change="uploadFile">
                                    
                                    <!-- Text Input -->
                                    <textarea x-model="newMessage" 
                                            class="flex-1 bg-transparent border-none focus:ring-0 resize-none py-3 text-gray-700 placeholder-gray-400 max-h-32 custom-scrollbar" 
                                            rows="1" 
                                            placeholder="Tulis pesan Anda..."
                                            @keydown.enter.prevent="if(!$event.shiftKey) sendMessage()"
                                            @input="$event.target.style.height = ''; $event.target.style.height = Math.min($event.target.scrollHeight, 128) + 'px'"></textarea>
                                    
                                    <!-- File Preview Bubble -->
                                    <div x-show="file" class="absolute bottom-full left-0 mb-2 ml-2 bg-white shadow-lg rounded-lg border border-gray-100 p-2 flex items-center gap-3 animate-fade-in-up">
                                        <div class="w-8 h-8 bg-orange-50 rounded-lg flex items-center justify-center text-orange-500">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                                        </div>
                                        <div class="text-xs">
                                            <p class="font-medium text-gray-700 truncate max-w-[150px]" x-text="file?.name"></p>
                                            <p class="text-gray-400" x-text="(file?.size / 1024).toFixed(0) + ' KB'"></p>
                                        </div>
                                        <button type="button" @click="file = null; $refs.fileInput.value = ''" class="text-gray-400 hover:text-red-500 p-1">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                        </button>
                                    </div>

                                    <!-- Send Button -->
                                    <button type="submit" 
                                            class="p-3 bg-orange-600 text-white rounded-xl hover:bg-orange-700 transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed shadow-md shadow-orange-500/30 transform hover:scale-105 active:scale-95"
                                            :disabled="!newMessage.trim() && !file">
                                        <svg class="w-5 h-5 transform rotate-90" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                                    </button>
                                </form>
                                <p class="text-center text-[10px] text-gray-400 mt-2">Tekan Enter untuk mengirim, Shift + Enter untuk baris baru</p>
                            </div>
                        </template>
                        
                        <!-- Closed State & Rating -->
                         <template x-if="currentConversation.status === 'closed'">
                            <div class="flex flex-col items-center justify-center p-6 bg-gray-50 rounded-2xl border border-gray-200 border-dashed">
                                <template x-if="!currentConversation.rating">
                                    <div class="text-center w-full max-w-sm">
                                        <h4 class="font-bold text-gray-800 mb-2">Percakapan telah selesai</h4>
                                        <p class="text-sm text-gray-500 mb-4">Bagaimana pengalaman layanan Anda?</p>
                                        <div class="flex justify-center gap-2 mb-4">
                                            <template x-for="star in 5">
                                                <button @click="rating = star" 
                                                        class="text-3xl focus:outline-none transition-transform hover:scale-110 active:scale-95" 
                                                        :class="rating >= star ? 'text-yellow-400' : 'text-gray-300'">★</button>
                                            </template>
                                        </div>
                                        <button @click="submitRating" 
                                                class="w-full bg-orange-600 text-white py-2 rounded-lg hover:bg-orange-700 transition shadow-lg shadow-orange-500/20 font-medium text-sm disabled:opacity-50" 
                                                :disabled="!rating">
                                            Kirim Penilaian
                                        </button>
                                    </div>
                                </template>
                                <template x-if="currentConversation.rating">
                                    <div class="text-center">
                                        <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-3">
                                            <svg class="w-8 h-8 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                        </div>
                                        <h4 class="font-bold text-gray-800">Terima Kasih!</h4>
                                        <p class="text-sm text-gray-500 mt-1">Anda memberikan rating: <span class="font-bold text-yellow-500" x-text="currentConversation.rating + ' Bintang'"></span></p>
                                    </div>
                                </template>
                            </div>
                        </template>
                    </div>
                </div>
            </template>
        </div>
    </div>

    <!-- New Conversation Modal with Modern UI -->
    <div x-show="showNewConversationModal" 
         class="fixed inset-0 z-50 overflow-y-auto" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         style="display: none;">
        
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
            <div class="fixed inset-0 transition-opacity bg-gray-900/60 backdrop-blur-sm" @click="showNewConversationModal = false"></div>

            <div class="inline-block w-full max-w-md p-6 my-8 overflow-hidden text-left align-middle transition-all transform bg-white shadow-2xl rounded-2xl relative"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                
                <h3 class="text-xl font-bold text-gray-900 mb-1">Mulai Konsultasi</h3>
                <p class="text-sm text-gray-500 mb-6">Ceritakan kebutuhan data atau masalah Anda.</p>

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Subjek</label>
                        <input type="text" x-model="newSubject" 
                               class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500 text-sm transition-all"
                               placeholder="Contoh: Permintaan Data Kecamatan">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Pesan Awal</label>
                        <textarea x-model="newInitialMessage" rows="4" 
                                  class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500 text-sm transition-all resize-none"
                                  placeholder="Jelaskan detail yang Anda butuhkan..."></textarea>
                    </div>
                </div>

                <div class="mt-8 flex gap-3">
                    <button type="button" @click="showNewConversationModal = false" 
                            class="flex-1 px-4 py-2.5 bg-gray-100 text-gray-700 font-medium rounded-xl hover:bg-gray-200 transition-colors">
                        Batal
                    </button>
                    <button type="button" @click="startConversation" 
                            class="flex-1 px-4 py-2.5 bg-orange-600 text-white font-medium rounded-xl hover:bg-orange-700 shadow-lg shadow-orange-500/30 transition-all transform hover:-translate-y-0.5">
                        Mulai Chat
                    </button>
                </div>

                <button @click="showNewConversationModal = false" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
        </div>
    </div>
</div>

<style>
    /* Custom Scrollbar for modern look */
    .custom-scrollbar::-webkit-scrollbar {
        width: 6px;
    }
    .custom-scrollbar::-webkit-scrollbar-track {
        background: transparent;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb {
        background-color: #e2e8f0;
        border-radius: 20px;
    }
    .custom-scrollbar:hover::-webkit-scrollbar-thumb {
        background-color: #cbd5e1;
    }
    
    @keyframes fade-in-up {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in-up {
        animation: fade-in-up 0.3s ease-out forwards;
    }
</style>

<script>
    function chatApp() {
        return {
            conversations: [],
            currentConversation: null,
            messages: [],
            newMessage: '',
            loadingConversations: false,
            showNewConversationModal: false,
            newSubject: '',
            newInitialMessage: '',
            file: null,
            rating: 0,
            pollingInterval: null,

            init() {
                this.fetchConversations();
                setInterval(() => { this.fetchConversations(false); }, 10000); // Poll conversations
                setInterval(() => { 
                    if (this.currentConversation && this.currentConversation.status !== 'closed') {
                        this.fetchMessages(this.currentConversation.id, false);
                    }
                }, 3000); // Poll messages
            },

            formatDate(dateString) { return new Date(dateString).toLocaleDateString('id-ID', { day: 'numeric', month: 'short' }); },
            formatTime(dateString) { return new Date(dateString).toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' }); },

            async fetchConversations(showLoading = true) {
                if(showLoading) this.loadingConversations = true;
                try {
                    const response = await axios.get('{{ route("chat.conversations") }}');
                    this.conversations = response.data.conversations;
                } catch (error) { console.error('Error:', error); } 
                finally { this.loadingConversations = false; }
            },

            async selectConversation(conversation) {
                this.currentConversation = conversation;
                this.messages = [];
                await this.fetchMessages(conversation.id);
                this.$nextTick(() => this.scrollToBottom());
            },

            async fetchMessages(conversationId, scrollToBottom = true) {
                try {
                    const response = await axios.get(`/chat/conversations/${conversationId}/messages`);
                    this.messages = response.data.messages;
                    if (this.currentConversation) {
                         this.currentConversation.status = response.data.conversation.status;
                         this.currentConversation.rating = response.data.conversation.rating;
                         this.currentConversation.assigned_admin = response.data.conversation.assigned_admin;
                    }
                    if (scrollToBottom) this.$nextTick(() => this.scrollToBottom());
                } catch (error) { console.error('Error:', error); }
            },

            async sendMessage() {
                if ((!this.newMessage.trim() && !this.file) || !this.currentConversation) return;

                if (this.file) {
                    await this.uploadFileSubmit();
                    return;
                }

                const payload = { conversation_id: this.currentConversation.id, message: this.newMessage };
                
                // Optimistic UI
                this.messages.push({
                    id: Date.now(),
                    sender_type: 'user',
                    content: this.newMessage,
                    created_at: new Date().toISOString(),
                    is_read: false,
                    message_type: 'text'
                });
                this.$nextTick(() => this.scrollToBottom());
                
                const msg = this.newMessage;
                this.newMessage = '';

                try {
                    await axios.post('/chat/send-message', payload);
                    // No need to replace manualy, pulling will fix it or next fetch
                } catch (error) {
                    console.error('Error:', error);
                    alert('Gagal mengirim pesan.');
                    this.newMessage = msg; // Restore on fail
                }
            },

            uploadFile(e) { this.file = e.target.files[0]; },

            async uploadFileSubmit() {
                const formData = new FormData();
                formData.append('conversation_id', this.currentConversation.id);
                formData.append('file', this.file);
                
                this.file = null;
                this.$refs.fileInput.value = '';

                try {
                    const response = await axios.post('/chat/upload-file', formData, {
                        headers: { 'Content-Type': 'multipart/form-data' }
                    });
                    this.messages.push(response.data.message);
                    this.$nextTick(() => this.scrollToBottom());
                } catch (error) {
                    console.error('Upload failed:', error);
                    alert('Upload gagal.');
                }
            },

            async startConversation() {
                if (!this.newSubject || !this.newInitialMessage) return;
                try {
                    const response = await axios.post('/chat/start-conversation', {
                        subject: this.newSubject,
                        message: this.newInitialMessage
                    });
                    this.showNewConversationModal = false;
                    this.newSubject = '';
                    this.newInitialMessage = '';
                    this.fetchConversations();
                    this.selectConversation(response.data.conversation);
                } catch (error) {
                    console.error('Error:', error);
                    alert('Gagal memulai percakapan.');
                }
            },

            async submitRating() {
                 try {
                    await axios.post(`/chat/conversations/${this.currentConversation.id}/rate`, { rating: this.rating });
                     this.currentConversation.rating = this.rating;
                    alert('Terima kasih atas penilaian Anda!');
                 } catch (error) { console.error(error); alert('Gagal mengirim penilaian'); }
            },

            scrollToBottom() {
                const container = document.getElementById('messages-container');
                if (container) container.scrollTop = container.scrollHeight;
            }
        }
    }
</script>
@endsection
