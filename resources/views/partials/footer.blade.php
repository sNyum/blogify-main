<!-- Enhanced Footer -->
<footer class="relative overflow-hidden" style="background: linear-gradient(135deg, #003B6F 0%, #002A52 100%);">
    <!-- Decorative Background Pattern -->
    <div class="absolute inset-0 opacity-5">
        <div class="absolute inset-0" style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 40px 40px;"></div>
    </div>
    
    <!-- Colored Border Line with Gradient -->
    <div class="flex h-2 w-full">
        <div class="flex-1 transition-all duration-300 hover:h-3" style="background: linear-gradient(90deg, #0099FF 0%, #00B8FF 100%);"></div>
        <div class="flex-1 transition-all duration-300 hover:h-3" style="background: linear-gradient(90deg, #33CC33 0%, #44DD44 100%);"></div>
        <div class="flex-1 transition-all duration-300 hover:h-3" style="background: linear-gradient(90deg, #FF9900 0%, #FFAA00 100%);"></div>
    </div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 py-8 sm:py-10">
            <div class="flex flex-col md:flex-row justify-between items-center md:items-start gap-8 md:gap-12">
                <!-- Left Content: Logo & Contact Info -->
                <div class="flex-1 space-y-4 sm:space-y-6 text-center md:text-left w-full">
                    <!-- BPS Logo -->
                    <div class="flex justify-center md:justify-start">
                        <img class="h-14 sm:h-16 w-auto transform hover:scale-105 transition-transform duration-300 filter drop-shadow-lg" 
                             src="{{ asset('images/bps-logo-footer.png') }}" 
                             alt="Badan Pusat Statistik Kabupaten Batanghari">
                    </div>

                    <!-- Contact Information -->
                    <div class="space-y-3 sm:space-y-4 text-white/90">
                        <!-- Address -->
                        <div class="flex items-start justify-center md:justify-start gap-3 group">
                            <svg class="w-5 h-5 mt-0.5 text-blue-300 flex-shrink-0 group-hover:scale-110 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <p class="text-xs sm:text-sm leading-relaxed max-w-md">
                                Jl. Jenderal Sudirman Muara Bulian - Jambi, Indonesia, 36613
                            </p>
                        </div>
                        
                        <!-- Phone & Fax -->
                        <div class="flex flex-col sm:flex-row items-center justify-center md:justify-start gap-2 sm:gap-3 group">
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-blue-300 flex-shrink-0 group-hover:scale-110 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                                <p class="text-xs sm:text-sm">
                                    Telp: <span class="font-medium text-white">(0743) 21008</span>
                                </p>
                            </div>
                            <span class="hidden sm:inline text-blue-300">|</span>
                            <p class="text-xs sm:text-sm">
                                Fax: <span class="font-medium text-white">(0743) 21008</span>
                            </p>
                        </div>
                        
                        <!-- Email -->
                        <div class="flex items-center justify-center md:justify-start gap-3 group">
                            <svg class="w-5 h-5 text-blue-300 flex-shrink-0 group-hover:scale-110 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <a href="mailto:bps1504@bps.go.id" class="text-xs sm:text-sm font-medium text-blue-300 hover:text-blue-200 transition-colors duration-300 hover:underline">
                                bps1504@bps.go.id
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Right Content: BerAKHLAK Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <img class="h-12 sm:h-16 w-auto transform hover:scale-105 transition-transform duration-300 filter drop-shadow-md" 
                         src="{{ asset('images/berakhlak-logo-new.png') }}" 
                         alt="BerAKHLAK">
                </div>
            </div>
            
            <!-- Copyright -->
            <div class="mt-6 sm:mt-8 pt-4 sm:pt-6 border-t border-white/10 text-center">
                <p class="text-xs sm:text-sm text-white/70">
                    © {{ date('Y') }} Badan Pusat Statistik Kabupaten Batanghari. All rights reserved.
                </p>
            </div>
        </div>
</footer>

<!-- Chatbot Integration -->
@include('partials.chatbot')
