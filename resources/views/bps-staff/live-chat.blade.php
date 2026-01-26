@extends('layouts.bps-staff-dashboard')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6">Live Chat (Operator BPS)</h1>
    
    <div x-data="bpsChat()" x-init="init()" class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Conversation List (Left Side) -->
        <div class="lg:col-span-1 bg-white dark:bg-gray-800 rounded-lg shadow p-4">
            <div class="mb-4">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Conversations</h3>
                
                <!-- Status Filter -->
                <select x-model="statusFilter" @change="loadConversations()" class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300">
                    <option value="all">All Status</option>
                    <option value="open">Open</option>
                    <option value="assigned">Assigned</option>
                    <option value="closed">Closed</option>
                </select>
            </div>

            <!-- Conversations List -->
            <div class="space-y-2 max-h-[600px] overflow-y-auto">
                <template x-for="conversation in conversations" :key="conversation.id">
                    <div 
                        @click="selectConversation(conversation.id)"
                        :class="selectedConversationId == conversation.id ? 'bg-blue-100 dark:bg-blue-900' : 'bg-gray-50 dark:bg-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600'"
                        class="p-3 rounded-lg cursor-pointer transition-colors"
                    >
                        <div class="flex items-start justify-between">
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900 dark:text-white truncate" x-text="conversation.user_name || 'Unknown User'"></p>
                                <p class="text-xs text-gray-500 dark:text-gray-400 truncate" x-text="conversation.subject"></p>
                            </div>
                            <div class="ml-2 flex-shrink-0">
                                <span 
                                    x-text="conversation.status"
                                    :class="{
                                        'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200': conversation.status === 'open',
                                        'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200': conversation.status === 'assigned',
                                        'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300': conversation.status === 'closed'
                                    }"
                                    class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium"
                                ></span>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </div>

        <!-- Conversation View (Right Side) -->
        <div class="lg:col-span-2 bg-white dark:bg-gray-800 rounded-lg shadow">
            <template x-if="currentConversation">
                <div>
                    <!-- Header -->
                    <div class="p-4 border-b border-gray-200 dark:border-gray-700">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white" x-text="currentConversation.subject"></h3>
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    <span x-text="currentConversation.user_name"></span>
                                    <span> - </span>
                                    <span x-text="currentConversation.user_organization"></span>
                                </p>
                            </div>
                            <div class="flex gap-2">
                                <template x-if="currentConversation.status !== 'closed'">
                                    <button 
                                        @click="closeConversation()"
                                        class="px-3 py-1.5 text-sm bg-gray-600 text-white rounded-md hover:bg-gray-700"
                                    >
                                        Tutup Percakapan
                                    </button>
                                </template>
                            </div>
                        </div>
                    </div>

                    <!-- Messages -->
                    <div class="p-4 h-[400px] overflow-y-auto space-y-3" x-ref="messagesContainer">
                        <template x-for="message in messages" :key="message.id">
                            <div :class="message.sender_type === 'admin' ? 'flex justify-end' : 'flex justify-start'">
                                <div class="max-w-[70%]">
                                    <div class="text-xs text-gray-500 dark:text-gray-400 mb-1">
                                        <span x-text="message.sender_name"></span>
                                        <span class="ml-1" x-text="new Date(message.created_at).toLocaleTimeString('id-ID', {hour: '2-digit', minute: '2-digit'})"></span>
                                    </div>
                                    <div 
                                        :class="{
                                            'bg-blue-600 text-white': message.sender_type === 'admin',
                                            'bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 italic': message.sender_type === 'system',
                                            'bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white': message.sender_type === 'user'
                                        }"
                                        class="rounded-lg p-3"
                                        x-text="message.content"
                                    ></div>
                                </div>
                            </div>
                        </template>
                    </div>

                    <!-- Input -->
                    <template x-if="currentConversation.status !== 'closed'">
                        <div class="p-4 border-t border-gray-200 dark:border-gray-700">
                            <form @submit.prevent="sendMessage()" class="flex gap-2">
                                <input 
                                    type="text" 
                                    x-model="newMessage"
                                    placeholder="Type your message..."
                                    class="flex-1 rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300"
                                />
                                <button 
                                    type="submit"
                                    class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700"
                                >
                                    Send
                                </button>
                            </form>
                        </div>
                    </template>
                </div>
            </template>

            <template x-if="!currentConversation">
                <div class="flex items-center justify-center h-[600px] text-gray-500 dark:text-gray-400">
                    <div class="text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                        <p class="mt-2">Select a conversation to start chatting</p>
                    </div>
                </div>
            </template>
        </div>
    </div>
</div>

<script>
    function bpsChat() {
        return {
            conversations: [],
            messages: [],
            currentConversation: null,
            selectedConversationId: null,
            statusFilter: 'all',
            newMessage: '',
            
            init() {
                this.loadConversations();
                setInterval(() => {
                    this.loadConversations();
                    if (this.selectedConversationId) {
                        this.loadMessages(); // Basic polling
                    }
                }, 3000);
            },
            
            async loadConversations() {
                try {
                    const response = await fetch(`/bps/chat/conversations?status=${this.statusFilter}`, {
                        headers: {
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        }
                    });
                    const data = await response.json();
                    this.conversations = data.conversations || [];
                } catch (error) {
                    console.error('Error loading conversations:', error);
                }
            },
            
            async selectConversation(id) {
                this.selectedConversationId = id;
                this.currentConversation = this.conversations.find(c => c.id === id);
                await this.loadMessages();
            },
            
            async loadMessages() {
                if (!this.selectedConversationId) return;
                
                try {
                    const response = await fetch(`/bps/chat/conversations/${this.selectedConversationId}/messages`, {
                        headers: {
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        }
                    });
                    const data = await response.json();
                    this.messages = data.messages || [];
                    
                    setTimeout(() => {
                        if (this.$refs.messagesContainer) {
                            this.$refs.messagesContainer.scrollTop = this.$refs.messagesContainer.scrollHeight;
                        }
                    }, 100);
                } catch (error) {
                    console.error('Error loading messages:', error);
                }
            },
            
            async sendMessage() {
                if (!this.newMessage.trim() || !this.selectedConversationId) return;
                
                try {
                    const response = await fetch(`/bps/chat/conversations/${this.selectedConversationId}/messages`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({
                            message: this.newMessage
                        })
                    });
                    
                    if (response.ok) {
                        this.newMessage = '';
                        await this.loadMessages();
                    }
                } catch (error) {
                    console.error('Error sending message:', error);
                }
            },
             
            async closeConversation() {
                if (!this.selectedConversationId) return;
                try {
                    await fetch(`/bps/chat/conversations/${this.selectedConversationId}/close`, {
                         method: 'POST',
                         headers: {
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        }
                    });
                    await this.loadConversations();
                    await this.selectConversation(this.selectedConversationId);
                } catch (error) {
                     console.error('Error closing conversation:', error);
                }
            }
        }
    }
</script>
@endsection
