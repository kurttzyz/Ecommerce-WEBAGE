@extends('layouts.layout')

@section('content')
    <section class="relative min-h-screen flex flex-col justify-center items-center bg-gradient-to-br from-gray-900 to-gray-800 py-16 px-4 sm:px-6 lg:px-8">
        <!-- Main Container -->
        <div class="w-full max-w-7xl mx-auto">
            <!-- Section Header -->
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-white sm:text-5xl mb-4">
                    Discover Premium Products at <span class="text-indigo-400">WebAge</span>
                </h2>
                <p class="text-lg text-gray-300 max-w-2xl mx-auto">
                    Explore our curated collection of high-quality items tailored to your needs
                </p>
            </div>

            <!-- Product Carousel -->
            <div class="relative w-full group">
                <!-- Slides Container -->
                <div class="relative h-[32rem] overflow-hidden rounded-3xl shadow-2xl bg-gray-800 border border-gray-700">
                  
                </div>
                
                <!-- Navigation Arrows -->
                <button class="absolute left-6 top-1/2 -translate-y-1/2 bg-gray-700/80 hover:bg-gray-600 p-3 rounded-full shadow-xl hover:shadow-2xl transition-all duration-300 z-10 focus:outline-none opacity-0 group-hover:opacity-100 backdrop-blur-sm border border-gray-600" id="prev-slide">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    <span class="sr-only">Previous</span>
                </button>
                <button class="absolute right-6 top-1/2 -translate-y-1/2 bg-gray-700/80 hover:bg-gray-600 p-3 rounded-full shadow-xl hover:shadow-2xl transition-all duration-300 z-10 focus:outline-none opacity-0 group-hover:opacity-100 backdrop-blur-sm border border-gray-600" id="next-slide">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                    <span class="sr-only">Next</span>
                </button>
                
                <!-- Dots Indicator -->
                <div class="flex justify-center mt-8 gap-2" id="dots-container">
                   
                </div>
            </div>
        </div>

        <!-- JavaScript -->
        <script>
            document.addEventListener("DOMContentLoaded", () => {
                const slides = document.querySelectorAll(".product-slide");
                const prevBtn = document.getElementById("prev-slide");
                const nextBtn = document.getElementById("next-slide");
                const dots = document.querySelectorAll("#dots-container button");
                let currentSlide = 0;
                let autoSlideInterval;
                let touchStartX = 0;
                let touchEndX = 0;

                function showSlide(index) {
                    // Hide all slides with animation
                    slides.forEach((slide, i) => {
                        slide.classList.remove("active");
                        slide.style.opacity = "0";
                        slide.style.transform = "scale(0.95)";
                        
                        // Add direction classes for animation
                        slide.classList.remove("slide-in-left", "slide-in-right");
                        if (i < index) {
                            slide.classList.add("slide-out-left");
                        } else if (i > index) {
                            slide.classList.add("slide-out-right");
                        }
                    });
                    
                    // Reset all dots
                    dots.forEach(dot => {
                        dot.classList.remove("!bg-indigo-500", "!w-6");
                        dot.classList.add("bg-gray-600", "w-3");
                    });
                    
                    // Show current slide with animation
                    const currentSlideElement = slides[index];
                    currentSlideElement.classList.add("active");
                    currentSlideElement.style.opacity = "1";
                    currentSlideElement.style.transform = "scale(1)";
                    
                    // Determine slide direction for animation
                    const direction = index > currentSlide ? "slide-in-right" : "slide-in-left";
                    currentSlideElement.classList.add(direction);
                    
                    // Update current dot
                    dots[index].classList.remove("bg-gray-600", "w-3");
                    dots[index].classList.add("!bg-indigo-500", "!w-6");
                    
                    currentSlide = index;
                }

                function nextSlide() {
                    const nextIndex = (currentSlide + 1) % slides.length;
                    showSlide(nextIndex);
                }

                function prevSlide() {
                    const prevIndex = (currentSlide - 1 + slides.length) % slides.length;
                    showSlide(prevIndex);
                }

                function startAutoSlide() {
                    autoSlideInterval = setInterval(nextSlide, 6000);
                }

                function resetAutoSlide() {
                    clearInterval(autoSlideInterval);
                    startAutoSlide();
                }

                // Event Listeners
                nextBtn.addEventListener("click", () => {
                    nextSlide();
                    resetAutoSlide();
                });

                prevBtn.addEventListener("click", () => {
                    prevSlide();
                    resetAutoSlide();
                });

                dots.forEach(dot => {
                    dot.addEventListener("click", () => {
                        showSlide(parseInt(dot.getAttribute("data-index")));
                        resetAutoSlide();
                    });
                });

                // Touch events for mobile swipe
                const carousel = document.querySelector(".relative.w-full");
                carousel.addEventListener("touchstart", (e) => {
                    touchStartX = e.changedTouches[0].screenX;
                    clearInterval(autoSlideInterval);
                });

                carousel.addEventListener("touchend", (e) => {
                    touchEndX = e.changedTouches[0].screenX;
                    handleSwipe();
                    startAutoSlide();
                });

                function handleSwipe() {
                    const threshold = 50;
                    if (touchStartX - touchEndX > threshold) {
                        nextSlide(); // Swipe left
                    } else if (touchEndX - touchStartX > threshold) {
                        prevSlide(); // Swipe right
                    }
                }

                // Keyboard navigation
                document.addEventListener("keydown", (e) => {
                    if (e.key === "ArrowRight") {
                        nextSlide();
                        resetAutoSlide();
                    } else if (e.key === "ArrowLeft") {
                        prevSlide();
                        resetAutoSlide();
                    }
                });

                // Initialize
                showSlide(0);
                startAutoSlide();

                // Pause on hover
                carousel.addEventListener("mouseenter", () => clearInterval(autoSlideInterval));
                carousel.addEventListener("mouseleave", startAutoSlide);
            });
        </script>

        <style>
            .product-slide {
                transition: opacity 0.7s ease, transform 0.7s ease;
            }
            
            .slide-in-left {
                animation: slideInLeft 0.7s ease forwards;
            }
            
            .slide-in-right {
                animation: slideInRight 0.7s ease forwards;
            }
            
            .slide-out-left {
                animation: slideOutLeft 0.7s ease forwards;
            }
            
            .slide-out-right {
                animation: slideOutRight 0.7s ease forwards;
            }
            
            @keyframes slideInLeft {
                from {
                    transform: translateX(-50px);
                    opacity: 0;
                }
                to {
                    transform: translateX(0);
                    opacity: 1;
                }
            }
            
            @keyframes slideInRight {
                from {
                    transform: translateX(50px);
                    opacity: 0;
                }
                to {
                    transform: translateX(0);
                    opacity: 1;
                }
            }
            
            @keyframes slideOutLeft {
                to {
                    transform: translateX(-50px);
                    opacity: 0;
                }
            }
            
            @keyframes slideOutRight {
                to {
                    transform: translateX(50px);
                    opacity: 0;
                }
            }
        </style>
    </section>
@endsection