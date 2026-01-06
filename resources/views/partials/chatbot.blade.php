<!-- Chatbot Component -->
<div x-data="chatbot()" x-cloak class="fixed bottom-6 right-6 z-[100] font-inter">
    
    <!-- Chat Window -->
    <div x-show="isOpen" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-10 scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 scale-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0 scale-100"
         x-transition:leave-end="opacity-0 translate-y-10 scale-95"
         class="absolute bottom-20 right-0 w-[350px] sm:w-[400px] bg-white rounded-2xl shadow-2xl overflow-hidden border border-gray-100 flex flex-col max-h-[600px] h-[80vh] sm:h-[600px]">
        
        <!-- Header -->
        <div class="bg-gradient-to-r from-blue-600 to-indigo-700 p-4 flex items-center justify-between shrink-0">
            <div class="flex items-center gap-3">
                <div class="bg-white/20 p-2 rounded-full backdrop-blur-sm">
                    <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-white font-bold text-lg leading-tight">Asisten CERDAS</h3>
                    <div class="flex items-center gap-1.5">
                        <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></span>
                        <p class="text-blue-100 text-xs">Online • BPS Batanghari</p>
                    </div>
                </div>
            </div>
            <button @click="toggleChat" class="text-white/80 hover:text-white hover:bg-white/10 p-1 rounded-lg transition-colors">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Messages Area -->
        <div id="chat-messages" class="flex-1 overflow-y-auto p-4 space-y-4 bg-slate-50 relative scroll-smooth">
            <!-- Welcome Message -->
            <div class="flex gap-3">
                <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center shrink-0 border border-blue-200">
                    <img src="{{ asset('images/bps-logo-full.png') }}" class="w-5 h-5 object-contain" alt="Bot">
                </div>
                <div class="space-y-1 max-w-[85%]">
                    <div class="bg-white p-3.5 rounded-2xl rounded-tl-none shadow-sm border border-gray-100 text-sm text-gray-700 leading-relaxed">
                        Halo! 👋 Saya <strong>Asisten CERDAS</strong>.
                        <br><br>
                        Ada yang bisa saya bantu terkait data statistik Kabupaten Batanghari hari ini?
                    </div>
                    <span class="text-[10px] text-gray-400 ml-1">Baru saja</span>
                </div>
            </div>

            <template x-for="(msg, index) in messages" :key="index">
                <div :class="msg.isUser ? 'flex flex-row-reverse gap-3' : 'flex gap-3'">
                    <!-- Avatar -->
                    <div class="w-8 h-8 rounded-full flex items-center justify-center shrink-0 border"
                         :class="msg.isUser ? 'bg-indigo-100 border-indigo-200' : 'bg-blue-100 border-blue-200'">
                         <template x-if="msg.isUser">
                            <svg class="w-4 h-4 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                         </template>
                         <template x-if="!msg.isUser">
                            <img src="{{ asset('images/bps-logo-full.png') }}" class="w-5 h-5 object-contain" alt="Bot">
                         </template>
                    </div>

                    <!-- Bubble -->
                    <div class="space-y-1 max-w-[85%]">
                        <div class="p-3.5 rounded-2xl text-sm leading-relaxed shadow-sm border"
                             :class="msg.isUser ? 'bg-indigo-600 text-white rounded-tr-none border-indigo-600' : 'bg-white text-gray-700 rounded-tl-none border-gray-100'">
                             <span x-html="msg.text"></span>
                        </div>
                    </div>
                </div>
            </template>

            <!-- Loading Indicator -->
            <div x-show="isLoading" class="flex gap-3">
                <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center shrink-0 border border-blue-200">
                    <img src="{{ asset('images/bps-logo-full.png') }}" class="w-5 h-5 object-contain" alt="Bot">
                </div>
                <div class="bg-white p-4 rounded-2xl rounded-tl-none shadow-sm border border-gray-100 w-16 flex items-center justify-center gap-1">
                    <span class="w-1.5 h-1.5 bg-gray-400 rounded-full animate-bounce"></span>
                    <span class="w-1.5 h-1.5 bg-gray-400 rounded-full animate-bounce delay-100"></span>
                    <span class="w-1.5 h-1.5 bg-gray-400 rounded-full animate-bounce delay-200"></span>
                </div>
            </div>
            
            <!-- Quick Replies -->
            <div x-show="messages.length === 0" class="grid grid-cols-2 gap-2 mt-4">
                <button @click="sendMessage('Bagaimana cara download data?')" class="text-left p-3 rounded-xl border border-blue-100 bg-blue-50/50 hover:bg-blue-100 hover:border-blue-200 transition-colors text-xs text-blue-800 font-medium">
                    📚 Cara download data?
                </button>
                <button @click="sendMessage('Data inflasi terbaru')" class="text-left p-3 rounded-xl border border-blue-100 bg-blue-50/50 hover:bg-blue-100 hover:border-blue-200 transition-colors text-xs text-blue-800 font-medium">
                    📈 Data inflasi terbaru
                </button>
                <button @click="sendMessage('Jadwal pelayanan BPS')" class="text-left p-3 rounded-xl border border-blue-100 bg-blue-50/50 hover:bg-blue-100 hover:border-blue-200 transition-colors text-xs text-blue-800 font-medium">
                    ⏰ Jadwal pelayanan
                </button>
                <button @click="sendMessage('Kontak WhatsApp BPS')" class="text-left p-3 rounded-xl border border-blue-100 bg-blue-50/50 hover:bg-blue-100 hover:border-blue-200 transition-colors text-xs text-blue-800 font-medium">
                    📞 Kontak BPS
                </button>
            </div>
        </div>

        <!-- Input Area -->
        <div class="p-3 bg-white border-t border-gray-100 shrink-0">
            <form @submit.prevent="submitMessage" class="relative">
                <input type="text" 
                       x-model="inputText" 
                       placeholder="Ketik pertanyaan Anda..." 
                       class="w-full pl-4 pr-12 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm transition-all shadow-sm"
                       :disabled="isLoading">
                
                <button type="submit" 
                        class="absolute right-2 top-1/2 -translate-y-1/2 p-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 disabled:opacity-50 disabled:cursor-not-allowed transition-colors shadow-md"
                        :disabled="!inputText.trim() || isLoading">
                    <svg class="w-4 h-4 transform rotate-90" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                    </svg>
                </button>
            </form>
            <div class="text-center mt-2">
                <p class="text-[10px] text-gray-400">Powered by <strong>Google Gemini AI</strong> • BPS Batanghari</p>
            </div>
        </div>
    </div>

    <!-- Floating Button -->
    <button @click="toggleChat" 
            class="group relative w-14 h-14 sm:w-16 sm:h-16 bg-gradient-to-br from-blue-600 to-indigo-700 rounded-full shadow-lg hover:shadow-2xl hover:scale-105 transition-all duration-300 flex items-center justify-center text-white overflow-hidden">
        
        <!-- Glow Effect -->
        <div class="absolute inset-0 rounded-full bg-white/20 animate-ping opacity-20"></div>
        <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-700"></div>

        <!-- Icon Opened -->
        <svg x-show="!isOpen" class="w-7 h-7 sm:w-8 sm:h-8 transform transition-transform duration-300 group-hover:rotate-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
        </svg>

        <!-- Icon Closed -->
        <svg x-show="isOpen" x-cloak class="w-7 h-7 sm:w-8 sm:h-8 transform rotate-90" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
        </svg>

        <!-- Notification Badge -->
        <span x-show="!isOpen && messages.length > 0" class="absolute top-0 right-0 w-3.5 h-3.5 bg-red-500 border-2 border-white rounded-full"></span>
    </button>
</div>

<script>
    function chatbot() {
        return {
            isOpen: false,
            isLoading: false,
            inputText: '',
            messages: [],
            
            init() {
                // Initialize scroll to bottom observer
                this.$watch('messages', () => {
                    this.$nextTick(() => {
                        this.scrollToBottom();
                    });
                });
            },

            toggleChat() {
                this.isOpen = !this.isOpen;
                if (this.isOpen) {
                    this.$nextTick(() => {
                        this.scrollToBottom();
                    });
                }
            },

            scrollToBottom() {
                const container = document.getElementById('chat-messages');
                if (container) {
                    container.scrollTop = container.scrollHeight;
                }
            },

            async submitMessage() {
                if (!this.inputText.trim()) return;
                
                const userMsg = this.inputText;
                this.inputText = ''; // Clear input immediately
                this.sendMessage(userMsg);
            },

            async sendMessage(text) {
                // Add user message
                this.messages.push({
                    text: text,
                    isUser: true,
                    timestamp: new Date()
                });
                
                this.isLoading = true;

                try {
                    const response = await fetch('/chatbot/chat', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({ message: text })
                    });
                    
                    const data = await response.json();
                    
                    // Format response (simple markdown to HTML conversion)
                    let formattedReply = data.reply
                        .replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>') // Bold
                        .replace(/\n/g, '<br>'); // Newlines

                    this.messages.push({
                        text: formattedReply,
                        isUser: false,
                        timestamp: new Date()
                    });

                } catch (error) {
                    console.error('Chatbot Error:', error);
                    this.messages.push({
                        text: "Maaf, terjadi kesalahan koneksi. Silakan coba lagi.",
                        isUser: false,
                        timestamp: new Date()
                    });
                } finally {
                    this.isLoading = false;
                }
            }
        }
    }
</script>
