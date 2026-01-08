<!-- Chat Widget Component -->
<div x-data="chatWidget()" x-init="init()" class="fixed bottom-6 right-6 z-50">
    <!-- Chat Button -->
    <button @click="toggleChat()" 
            x-show="!isOpen"
            class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-full p-4 shadow-2xl hover:shadow-3xl transition-all duration-300 hover:scale-110">
        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
        </svg>
        <!-- Unread Badge -->
        <span x-show="unreadCount > 0" 
              class="absolute -top-1 -right-1 bg-red-500 text-white text-xs font-bold rounded-full h-6 w-6 flex items-center justify-center"
              x-text="unreadCount"></span>
    </button>

    <!-- Chat Window -->
    <div x-show="isOpen" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 transform scale-90"
         x-transition:enter-end="opacity-100 transform scale-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 transform scale-100"
         x-transition:leave-end="opacity-0 transform scale-90"
         class="bg-white rounded-2xl shadow-2xl w-96 h-[600px] flex flex-col overflow-hidden">
        
        <!-- Header -->
        <div class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white p-4 flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="font-semibold">Live Chat BPS</h3>
                    <p class="text-xs text-indigo-100" x-text="statusText"></p>
                </div>
            </div>
            <button @click="toggleChat()" class="hover:bg-white/20 rounded-full p-1 transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <!-- Messages Area -->
        <div class="flex-1 overflow-y-auto p-4 space-y-4 bg-gray-50" x-ref="messagesContainer">
            <!-- Welcome Message -->
            <div x-show="messages.length === 0" class="text-center py-8">
                <div class="bg-white rounded-lg p-6 shadow-sm">
                    <svg class="w-16 h-16 text-indigo-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                    </svg>
                    <h4 class="font-semibold text-gray-800 mb-2">Selamat Datang!</h4>
                    <p class="text-sm text-gray-600">Mulai percakapan dengan admin BPS Kabupaten Batanghari</p>
                </div>
            </div>

            <!-- Messages -->
            <template x-for="message in messages" :key="message.id">
                <div :class="message.sender_type === 'user' ? 'flex justify-end' : 'flex justify-start'">
                    <div :class="message.sender_type === 'user' ? 'bg-indigo-600 text-white' : 'bg-white text-gray-800'" 
                         class="max-w-[80%] rounded-lg p-3 shadow-sm">
                        <p class="text-sm" x-text="message.content"></p>
                        <p class="text-xs mt-1 opacity-70" x-text="formatTime(message.created_at)"></p>
                    </div>
                </div>
            </template>

            <!-- Typing Indicator -->
            <div x-show="isTyping" class="flex justify-start">
                <div class="bg-white rounded-lg p-3 shadow-sm">
                    <div class="flex space-x-2">
                        <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce"></div>
                        <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0.2s"></div>
                        <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0.4s"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Input Area -->
        <div class="border-t border-gray-200 p-4 bg-white">
            <form @submit.prevent="sendMessage()" class="flex items-center space-x-2">
                <input type="text" 
                       x-model="newMessage" 
                       @input="handleTyping()"
                       placeholder="Ketik pesan..."
                       class="flex-1 border border-gray-300 rounded-full px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                <button type="submit" 
                        :disabled="!newMessage.trim()"
                        class="bg-indigo-600 hover:bg-indigo-700 disabled:bg-gray-300 text-white rounded-full p-2 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                    </svg>
                </button>
            </form>
        </div>
    </div>
</div>

<script>
function chatWidget() {
    return {
        isOpen: false,
        messages: [],
        newMessage: '',
        conversationId: null,
        unreadCount: 0,
        isTyping: false,
        statusText: 'Online',
        typingTimeout: null,

        init() {
            // Load existing conversations
            this.loadConversations();
            
            // Setup WebSocket connection (will be implemented with Laravel Reverb)
            // this.connectWebSocket();
        },

        toggleChat() {
            this.isOpen = !this.isOpen;
            if (this.isOpen && this.conversationId) {
                this.loadMessages();
            }
        },

        async loadConversations() {
            try {
                const response = await fetch('/api/chat/conversations', {
                    headers: {
                        'Authorization': 'Bearer ' + localStorage.getItem('auth_token'),
                        'Accept': 'application/json'
                    }
                });
                const data = await response.json();
                if (data.success && data.conversations.length > 0) {
                    this.conversationId = data.conversations[0].id;
                    this.unreadCount = data.conversations[0].unread_count || 0;
                }
            } catch (error) {
                console.error('Error loading conversations:', error);
            }
        },

        async loadMessages() {
            if (!this.conversationId) return;
            
            try {
                const response = await fetch(`/api/chat/conversations/${this.conversationId}/messages`, {
                    headers: {
                        'Authorization': 'Bearer ' + localStorage.getItem('auth_token'),
                        'Accept': 'application/json'
                    }
                });
                const data = await response.json();
                if (data.success) {
                    this.messages = data.messages;
                    this.unreadCount = 0;
                    this.$nextTick(() => {
                        this.scrollToBottom();
                    });
                }
            } catch (error) {
                console.error('Error loading messages:', error);
            }
        },

        async sendMessage() {
            if (!this.newMessage.trim()) return;

            const messageText = this.newMessage;
            this.newMessage = '';

            // If no conversation exists, create one
            if (!this.conversationId) {
                await this.startConversation(messageText);
                return;
            }

            try {
                const response = await fetch('/api/chat/messages', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': 'Bearer ' + localStorage.getItem('auth_token'),
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        conversation_id: this.conversationId,
                        message: messageText
                    })
                });

                const data = await response.json();
                if (data.success) {
                    this.messages.push(data.message);
                    this.$nextTick(() => {
                        this.scrollToBottom();
                    });
                }
            } catch (error) {
                console.error('Error sending message:', error);
            }
        },

        async startConversation(firstMessage) {
            try {
                const response = await fetch('/api/chat/conversations', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': 'Bearer ' + localStorage.getItem('auth_token'),
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        subject: 'Chat dengan BPS',
                        message: firstMessage
                    })
                });

                const data = await response.json();
                if (data.success) {
                    this.conversationId = data.conversation.id;
                    this.messages.push(data.message);
                    this.$nextTick(() => {
                        this.scrollToBottom();
                    });
                }
            } catch (error) {
                console.error('Error starting conversation:', error);
            }
        },

        handleTyping() {
            clearTimeout(this.typingTimeout);
            this.typingTimeout = setTimeout(() => {
                // Send typing event via WebSocket
            }, 1000);
        },

        scrollToBottom() {
            const container = this.$refs.messagesContainer;
            if (container) {
                container.scrollTop = container.scrollHeight;
            }
        },

        formatTime(timestamp) {
            const date = new Date(timestamp);
            return date.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });
        }
    }
}
</script>
