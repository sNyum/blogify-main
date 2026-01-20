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
        <div class="bg-gradient-to-r from-orange-500 to-orange-600 p-4 flex items-center justify-between shrink-0">
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
                        <p class="text-orange-100 text-xs">Online • BPS Batanghari</p>
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
                <div class="w-8 h-8 rounded-full bg-orange-100 flex items-center justify-center shrink-0 border border-orange-200">
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
                         :class="msg.isUser ? 'bg-orange-50 border-orange-100' : 'bg-orange-100 border-orange-200'">
                         <template x-if="msg.isUser">
                            <svg class="w-4 h-4 text-orange-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
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
                             :class="msg.isUser ? 'bg-orange-500 text-white rounded-tr-none border-orange-500' : 'bg-white text-gray-700 rounded-tl-none border-gray-100'">
                             
                             <!-- Text Content -->
                             <span x-html="msg.text"></span>

                             <!-- Charts Container -->
                             <template x-if="!msg.isUser && msg.charts && msg.charts.length > 0">
                                 <div class="space-y-3 mt-3">
                                     <template x-for="(chart, cIndex) in msg.charts" :key="cIndex">
                                        <div class="bg-white p-2 rounded-lg border border-gray-100 shadow-sm">
                                            <canvas :id="'chart-' + index + '-' + cIndex" class="w-full h-48"></canvas>
                                        </div>
                                     </template>
                                 </div>
                             </template>

                             <!-- Tables & Download -->
                             <template x-if="!msg.isUser && msg.tables && msg.tables.length > 0">
                                 <div class="space-y-3 mt-3">
                                     <template x-for="(table, tIndex) in msg.tables" :key="tIndex">
                                        <div class="bg-white rounded-lg border border-gray-100 shadow-sm overflow-hidden">
                                            <!-- Download Button -->
                                            <button @click="downloadExcel(table)" 
                                                    class="flex items-center gap-2 bg-green-50 hover:bg-green-100 text-green-700 w-full px-3 py-2 text-xs font-medium transition-colors border-b border-green-100">
                                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                                </svg>
                                                <span x-text="'Download Excel: ' + (table.title || 'Data')"></span>
                                            </button>

                                            <!-- Preview Table -->
                                            <div class="overflow-x-auto max-h-40 overflow-y-auto p-2 scrollbar-thin">
                                                <table class="w-full text-xs text-left text-gray-600">
                                                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 sticky top-0">
                                                        <tr>
                                                            <template x-for="col in table.columns">
                                                                <th scope="col" class="px-2 py-1.5" x-text="col"></th>
                                                            </template>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <template x-for="row in table.rows">
                                                            <tr class="bg-white border-b hover:bg-gray-50">
                                                                <template x-for="cell in row">
                                                                    <td class="px-2 py-1.5 whitespace-nowrap" x-text="cell"></td>
                                                                </template>
                                                            </tr>
                                                        </template>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                     </template>
                                 </div>
                             </template>

                        </div>
                        
                        <!-- Feedback UI Code -->
                        <div x-show="!msg.isUser && !msg.feedbackGiven && !isLoading" class="flex items-center gap-2 mt-1 ml-1">
                            <p class="text-[10px] text-gray-400">Membantu?</p>
                            <button @click="submitFeedback(index, 'up', msg)" class="p-1 hover:bg-green-50 rounded-full transition-colors text-gray-400 hover:text-green-600" title="Ya">
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                                </svg>
                            </button>
                            <button @click="submitFeedback(index, 'down', msg)" class="p-1 hover:bg-red-50 rounded-full transition-colors text-gray-400 hover:text-red-600" title="Tidak">
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14H5.236a2 2 0 01-1.789-2.894l3.5-7A2 2 0 018.736 3h4.018a2 2 0 01.485.06l3.76.94m-7 10v5a2 2 0 002 2h.095c.5 0 .905-.405.905-.905 0-.714.211-1.412.608-2.006L17 13V4m-7 10h2m5-10h2a2 2 0 012 2v6a2 2 0 01-2 2h-2.5" />
                                </svg>
                            </button>
                        </div>
                        
                        <!-- Feedback Thank You -->
                        <div x-show="msg.feedbackGiven" class="text-[10px] text-gray-400 mt-1 ml-1 italic animate-fade-in">
                            Terima kasih!
                        </div>
                    </div>
                </div>
            </template>

            <!-- Loading Indicator -->
            <div x-show="isLoading" class="flex gap-3 mt-4">
                <div class="w-8 h-8 rounded-full bg-orange-100 flex items-center justify-center shrink-0 border border-orange-200">
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
                <button @click="sendMessage('Bagaimana cara download data?')" class="text-left p-3 rounded-xl border border-orange-100 bg-orange-50 hover:bg-orange-100 hover:border-orange-200 transition-colors text-xs text-orange-800 font-medium">
                    📚 Cara download data?
                </button>
                <button @click="sendMessage('Data inflasi terbaru')" class="text-left p-3 rounded-xl border border-orange-100 bg-orange-50 hover:bg-orange-100 hover:border-orange-200 transition-colors text-xs text-orange-800 font-medium">
                    📈 Data inflasi terbaru
                </button>
                <button @click="sendMessage('Jadwal pelayanan BPS')" class="text-left p-3 rounded-xl border border-orange-100 bg-orange-50 hover:bg-orange-100 hover:border-orange-200 transition-colors text-xs text-orange-800 font-medium">
                    ⏰ Jadwal pelayanan
                </button>
                <button @click="sendMessage('Kontak WhatsApp BPS')" class="text-left p-3 rounded-xl border border-orange-100 bg-orange-50 hover:bg-orange-100 hover:border-orange-200 transition-colors text-xs text-orange-800 font-medium">
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
                       class="w-full pl-4 pr-12 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent text-sm transition-all shadow-sm"
                       :disabled="isLoading">
                
                <button type="submit" 
                        class="absolute right-2 top-1/2 -translate-y-1/2 p-2 bg-orange-600 text-white rounded-lg hover:bg-orange-700 disabled:opacity-50 disabled:cursor-not-allowed transition-colors shadow-md"
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
            class="group relative w-14 h-14 sm:w-16 sm:h-16 bg-gradient-to-br from-orange-500 to-orange-600 rounded-full shadow-lg hover:shadow-2xl hover:scale-105 transition-all duration-300 flex items-center justify-center text-white overflow-hidden">
        
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

</div>

<!-- External Libraries -->


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
                        // Render charts after DOM update
                        this.messages.forEach((msg, index) => {
                            if (!msg.isUser && msg.charts && msg.charts.length > 0 && !msg.chartRendered) {
                                msg.charts.forEach((chart, cIndex) => {
                                    this.renderChart(index, cIndex, chart);
                                });
                                msg.chartRendered = true; 
                            }
                        });
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
                        body: JSON.stringify({ message: text, history: this.messages })
                    });
                    
                    const data = await response.json();
                    let rawReply = data.reply;
                    
                    // Parse Special Tags
                    let charts = [];
                    let tables = [];

                    // Detect ALL CHARTS
                    // Regex explain: [[CHART: ... }]] 
                    // We use a loop to find all occurrences
                    const chartRegex = /\[\[CHART:([\s\S]*?)\}\]\]/g;
                    let chartMatch;
                    while ((chartMatch = chartRegex.exec(rawReply)) !== null) {
                        try {
                             // chartMatch[1] is the JSON content inside [[CHART: ... }]]
                             // distinct from the full match chartMatch[0]
                             const jsonStr = chartMatch[1] + '}';
                             const chartObj = JSON.parse(jsonStr);
                             charts.push(chartObj);
                        } catch (e) {
                             console.error('Chart JSON Parse Error', e);
                        }
                    }
                    // Remove all tags from text
                    rawReply = rawReply.replace(chartRegex, '');

                    // Detect ALL TABLES
                    const tableRegex = /\[\[TABLE:([\s\S]*?)\}\]\]/g;
                    let tableMatch;
                    while ((tableMatch = tableRegex.exec(rawReply)) !== null) {
                        try {
                             const jsonStr = tableMatch[1] + '}';
                             const tableObj = JSON.parse(jsonStr);
                             tables.push(tableObj);
                        } catch (e) {
                             console.error('Table JSON Parse Error', e);
                        }
                    }
                    rawReply = rawReply.replace(tableRegex, '');
                    
                    // Format response (simple markdown to HTML conversion)
                    let formattedReply = rawReply
                        .replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>')
                        .replace(/\[([^\]]+)\]\(([^)]+)\)/g, '<a href="$2" target="_blank" class="text-blue-600 hover:underline">$1</a>')
                        .replace(/\n/g, '<br>');

                    // Push Bot Message with structured data
                    this.messages.push({
                        text: formattedReply,
                        isUser: false,
                        charts: charts, // Array of charts
                        tables: tables, // Array of tables
                        chartRendered: false,
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
            },

            renderChart(index, cIndex, data) {
                const canvasId = `chart-${index}-${cIndex}`;
                
                // Wait for element to actually exist in DOM
                this.$nextTick(() => {
                    const ctx = document.getElementById(canvasId);
                    
                    console.log(`Rendering Chart: ${canvasId}`, data); 

                    if (!ctx) {
                        console.error(`Canvas ${canvasId} not found`);
                        return;
                    }

                    if (typeof Chart === 'undefined') {
                        console.error('Chart.js not loaded');
                        return;
                    }

                    // Destroy existing if any (prevent overlap)
                    const existingChart = Chart.getChart(ctx);
                    if (existingChart) {
                        existingChart.destroy();
                    }

                    try {
                        new Chart(ctx, {
                            type: data.type || 'bar',
                            data: {
                                labels: data.labels,
                                datasets: [{
                                    label: data.title || 'Data Statistik',
                                    data: data.data,
                                    backgroundColor: [
                                        'rgba(59, 130, 246, 0.7)',
                                        'rgba(16, 185, 129, 0.7)', 
                                        'rgba(245, 158, 11, 0.7)',
                                        'rgba(239, 68, 68, 0.7)',
                                        'rgba(139, 92, 246, 0.7)'
                                    ],
                                    borderWidth: 1,
                                    borderColor: 'rgba(59, 130, 246, 1)',
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                plugins: {
                                    legend: { display: false },
                                    title: { display: !!data.title, text: data.title }
                                },
                                scales: {
                                    y: { beginAtZero: true }
                                }
                            }
                        });
                        console.log(`Chart ${canvasId} rendered successfully`);
                    } catch (err) {
                        console.error('Chart Render Error:', err);
                    }
                });
            },

            downloadExcel(data) {
                if (!data || !window.XLSX) {
                    console.error('SheetJS library not loaded or data is missing');
                    return;
                }
                
                try {
                    // Create a new workbook
                    const wb = window.XLSX.utils.book_new();
                    
                    // Prepare data array with headers
                    const wsData = [];
                    
                    // Add header row
                    if (data.columns && data.columns.length > 0) {
                        wsData.push(data.columns);
                    }
                    
                    // Add data rows
                    if (data.rows && data.rows.length > 0) {
                        data.rows.forEach(row => {
                            wsData.push(row);
                        });
                    }
                    
                    // Create worksheet from data
                    const ws = window.XLSX.utils.aoa_to_sheet(wsData);
                    
                    // Set column widths for better readability
                    const colWidths = data.columns ? data.columns.map(() => ({ wch: 20 })) : [];
                    ws['!cols'] = colWidths;
                    
                    // Add worksheet to workbook
                    window.XLSX.utils.book_append_sheet(wb, ws, "Data BPS");
                    
                    // Generate filename
                    const filename = (data.title || "data_bps_batanghari") + ".xlsx";
                    
                    // Write and download the file
                    window.XLSX.writeFile(wb, filename);
                    
                } catch (error) {
                    console.error('Error generating Excel file:', error);
                    alert('Maaf, terjadi kesalahan saat membuat file Excel.');
                }
            },

            async submitFeedback(index, rating, msg) {
                try {
                    // Prevent double submission
                    if (this.messages[index].feedbackGiven) return;

                    // Optimistic UI Update
                    msg.feedbackGiven = true; // Use msg object directly for reactivity

                    // Send to Backend
                    await fetch('/chatbot/feedback', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            query: this.messages[index-1] ? this.messages[index-1].text : '',
                            response: msg.text,
                            rating: rating
                        })
                    });
                    
                    console.log('Feedback submitted:', rating);

                } catch (error) {
                    console.error('Feedback Error:', error);
                }
            }
        }
    }
</script>
