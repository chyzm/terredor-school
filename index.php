<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terre d'Or - Inspiring Every Child</title>
    <link rel="icon" type="image/png" href="/images/favicon.png" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://unpkg.com/alpinejs@3.9.0/dist/cdn.min.js" defer></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        html {
            scroll-behavior: smooth;
            }

        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Poppins', sans-serif;
            scroll-behavior: smooth;
        }
        
        .bg-primary {
            background-color: #F4A261;
        }
        
        .text-primary {
            color: #F4A261;
        }
        
        .border-primary {
            border-color: #F4A261;
        }
        
        .hero-slide {
            transition: opacity 1s ease-in-out;
        }
        
        .fade-in {
            animation: fadeIn 1s ease-in;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        .hover-scale {
            transition: transform 0.3s ease;
        }
        
        .hover-scale:hover {
            transform: scale(1.03);
        }
        .text-3d-gray {
            text-shadow: 
                2px 2px 4px rgba(0, 0, 0, 0.5), /* Black shadow for better contrast */
                -2px -2px 4px rgba(0, 0, 0, 0.5);
        }
        
        .text-3d-gray-sm {
            text-shadow: 
                1px 1px 3px rgba(128, 128, 128, 0.5),
                -1px -1px 3px rgba(128, 128, 128, 0.5);
        }

        .formatted-notice {
            font-family: 'Poppins', sans-serif;
            line-height: 1.6;
        }
        .formatted-notice p {
            margin-bottom: 1rem;
        }
        .formatted-notice ul,
        .formatted-notice ol {
            margin-bottom: 1rem;
            padding-left: 2rem;
        }
        .formatted-notice ul {
            list-style-type: disc;
        }
        .formatted-notice ol {
            list-style-type: decimal;
        }
        .formatted-notice strong {
            font-weight: bold;
        }
        .formatted-notice em {
            font-style: italic;
        }
        .formatted-notice a {
            color: #F4A261;
            text-decoration: underline;
        }



     
    </style>

</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav x-data="{ open: false }" class="bg-white shadow-md fixed w-full z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <div class="flex items-center">
                    <div class="flex-shrink-0 flex items-center">
                        <a href="index.php"><img class="h-12" src="images/logo.png" alt="Terre d'Or Logo"></a>
                        <span class="ml-2 text-xl font-bold text-gray-800"></span>
                    </div>
                </div>
                
                <!-- Desktop Menu -->
                <div class="hidden md:flex space-x-8">
                    <a href="#home" class="text-gray-800 hover:text-red-700 px-3 py-2 font-medium">Home</a>
                    <a href="#about" class="text-gray-800 hover:text-red-700 px-3 py-2 font-medium">About</a>
                    <a href="#services" class="text-gray-800 hover:text-red-700 px-3 py-2 font-medium">Services</a>
                    <a href="#notice" class="text-gray-800 hover:text-red-700 px-3 py-2 font-medium">Notice Board</a>
                    <a href="#gallery" class="text-gray-800 hover:text-red-700 px-3 py-2 font-medium">Gallery</a>
                    <a href="#faq" class="text-gray-800 hover:text-red-700 px-3 py-2 font-medium">FAQs</a>
                    <a href="#contact" class="text-gray-800 hover:text-red-700 px-3 py-2 font-medium">Contact</a>
                </div>
                
                <!-- Mobile menu button -->
                <div class="md:hidden flex items-center">
                    <button @click="open = !open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-800 hover:text-primary focus:outline-none">
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Mobile Menu -->
        <div x-show="open" @click.away="open = false" class="md:hidden bg-white shadow-lg">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                <a href="#home" class="block px-3 py-2 text-gray-800 hover:text-primary font-medium">Home</a>
                <a href="#about" class="block px-3 py-2 text-gray-800 hover:text-primary font-medium">About</a>
                <a href="#services" class="block px-3 py-2 text-gray-800 hover:text-primary font-medium">Services</a>
                <a href="#notice" class="block px-3 py-2 text-gray-800 hover:text-primary font-medium">Notice Board</a>
                <a href="#gallery" class="block px-3 py-2 text-gray-800 hover:text-primary font-medium">Gallery</a>
                <a href="#faq" class="block px-3 py-2 text-gray-800 hover:text-primary font-medium">FAQ</a>
                <a href="#contact" class="block px-3 py-2 text-gray-800 hover:text-primary font-medium">Contact</a>
            </div>
        </div>
    </nav>

<!-- Hero Section with Image Backgrounds -->
<section id="home" class="pt-20">
<!-- In your hero section, update the x-data -->
<div x-data="{
    currentSlide: 0,
    slides: [
        { 
            title: 'Inspiring Every Child', 
            subtitle: 'Nurturing young minds for a brighter future', 
            bg: 'bg-gradient-to-r from-yellow-100 to-primary',
            image: 'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80'
        },
        { 
            title: 'Quality Education', 
            subtitle: 'Excellence in teaching and learning', 
            bg: 'bg-gradient-to-r from-blue-100 to-primary',
            image: 'images/hero-2.jpg'
        },
        { 
            title: 'Holistic Development', 
            subtitle: 'Balancing academics with extracurricular activities', 
            bg: 'bg-gradient-to-r from-green-100 to-primary',
            image: 'images/hero-3.jpg'
        }
    ],
    interval: null,
    init() {
        this.startAutoRotation();
        // Pause when user hovers over slider
        this.$el.addEventListener('mouseenter', () => clearInterval(this.interval));
        this.$el.addEventListener('mouseleave', () => this.startAutoRotation());
    },
    startAutoRotation() {
        this.interval = setInterval(() => {
            this.currentSlide = (this.currentSlide + 1) % this.slides.length;
        }, 5000);
    }
}" class="relative overflow-hidden">
        <!-- Slides -->
        <div class="relative h-screen">
            <template x-for="(slide, index) in slides" :key="index">
                <div x-show="currentSlide === index" x-transition:enter="transition ease-out duration-1000" 
                     x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                     x-transition:leave="transition ease-in duration-1000" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                     class="absolute inset-0">
                    <!-- Background Image with Overlay -->
                    <div class="absolute inset-0">
                        <img :src="slide.image" alt="" class="w-full h-full object-cover">
                        <div :class="slide.bg" class="absolute inset-0 bg-opacity-70"></div>
                    </div>
                    
                    <!-- Content -->
                    <div class="relative h-full flex items-center justify-center text-center px-4">
                        <div class="max-w-3xl mx-auto fade-in">
                            <h1 class="text-4xl md:text-6xl font-bold text-dark mb-4 text-3d-gray" x-text="slide.title"></h1>
                            <p class="text-xl md:text-2xl text-blue-800 mb-8 text-3d-gray-sm" x-text="slide.subtitle"></p>
                            <div class="space-x-4">
                                <a href="#contact" class="inline-block bg-red-600 text-white px-6 py-3 rounded-lg font-medium shadow-lg hover:bg-blue-500 transition duration-300">Enroll Now</a>
                                <a href="#about" class="inline-block border-2 border-red-600 text-red-600 px-6 py-3 rounded-lg font-medium hover:bg-white hover:text-primary transition duration-300">Learn More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </template>
        </div>
        
        <!-- Slider controls -->
        <button @click="currentSlide = currentSlide === 0 ? slides.length - 1 : currentSlide - 1" 
                class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-white bg-opacity-50 text-gray-800 p-2 rounded-full hover:bg-opacity-75 focus:outline-none z-10">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </button>
        <button @click="currentSlide = currentSlide === slides.length - 1 ? 0 : currentSlide + 1" 
                class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-white bg-opacity-50 text-gray-800 p-2 rounded-full hover:bg-opacity-75 focus:outline-none z-10">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </button>
        
        <!-- Slider indicators -->
        <div class="absolute bottom-8 left-0 right-0 flex justify-center space-x-2 z-10">
            <template x-for="(slide, index) in slides" :key="index">
                <button @click="currentSlide = index" 
                        :class="{ 'bg-white': currentSlide === index, 'bg-white bg-opacity-50': currentSlide !== index }"
                        class="w-3 h-3 rounded-full focus:outline-none"></button>
            </template>
        </div>
    </div>
</section>

    <!-- About Section -->
<section id="about" class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4 text-3d-gray">About Terre d'Or School</h2>
            <div class="w-20 h-1 bg-primary mx-auto"></div>
        </div>
        
        <div class="flex flex-col md:flex-row items-center">
            <div class="md:w-2/2 mb-8 md:mb-0 md:pr-8">
                <img src="images/About.png" alt="School Building" class="rounded-lg shadow-xl hover-scale">
            </div>
            <div class="md:w-1/2">
                <h3 class="text-2xl font-semibold text-gray-800 mb-4">Our Vision</h3>
                <p class="text-gray-600 mb-6">To inspire, train, equip and prepare every child for changes in global development.</p>
                
                <h3 class="text-2xl font-semibold text-gray-800 mb-4">Our Mission</h3>
                <ul class="text-gray-600 mb-6 space-y-3">
                    <li class="flex items-start">
                        <span class="text-primary mr-2">•</span>
                        <span>Offer quality educational services</span>
                    </li>
                    <li class="flex items-start">
                        <span class="text-primary mr-2">•</span>
                        <span>Provide safe, secure and motivating learning environments</span>
                    </li>
                    <li class="flex items-start">
                        <span class="text-primary mr-2">•</span>
                        <span>Build good character and positive habits with robust self-esteem</span>
                    </li>
                    <li class="flex items-start">
                        <span class="text-primary mr-2">•</span>
                        <span>Foster a growth mindset and resilience anchored on solid foundations</span>
                    </li>
                    <li class="flex items-start">
                        <span class="text-primary mr-2">•</span>
                        <span>Nurture children with essential Christian virtues</span>
                    </li>
                    <li class="flex items-start">
                        <span class="text-primary mr-2">•</span>
                        <span>Harness leadership skills grounded in ethical, social and moral values</span>
                    </li>
                    <li class="flex items-start">
                        <span class="text-primary mr-2">•</span>
                        <span>Empower children to make lasting positive impact as future leaders</span>
                    </li>
                </ul>
                
                <h3 class="text-2xl font-semibold text-gray-800 mb-4">Our Core Values</h3>
                <div class="flex flex-wrap gap-3 mb-6">
                    <span class="bg-gray-100 text-gray-800 px-4 py-2 rounded-full font-medium">Transformation</span>
                    <span class="bg-gray-100 text-gray-800 px-4 py-2 rounded-full font-medium">Equity</span>
                    <span class="bg-gray-100 text-gray-800 px-4 py-2 rounded-full font-medium">Resilience</span>
                    <span class="bg-gray-100 text-gray-800 px-4 py-2 rounded-full font-medium">Responsibility</span>
                    <span class="bg-gray-100 text-gray-800 px-4 py-2 rounded-full font-medium">Excellence</span>
                </div>
            </div>
        </div>
    </div>
</section>
    <!-- Services Section -->
    <section id="services" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4 text-3d-gray">Our Services</h2>
                <div class="w-20 h-1 bg-primary mx-auto"></div>
                <p class="text-gray-600 max-w-2xl mx-auto mt-4 text-3d-gray-sm">We offer comprehensive educational programs designed to meet the needs of every student</p>
            </div>
            
            <div class="grid md:grid-cols-3 gap-8">
                <!-- Service 1 -->
                <div class="bg-white p-8 rounded-lg shadow-md hover-scale transition-transform duration-300">
                    <div class="text-primary text-4xl mb-4">
                        <i class="fas fa-book-open"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-3">Academic Programs</h3>
                    <p class="text-gray-600">Comprehensive curriculum aligned with national standards, focusing on core subjects and critical thinking skills.</p>
                </div>
                
                <!-- Service 2 -->
                <div class="bg-white p-8 rounded-lg shadow-md hover-scale transition-transform duration-300">
                    <div class="text-primary text-4xl mb-4">
                        <i class="fas fa-paint-brush"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-3">Arts & Creativity</h3>
                    <p class="text-gray-600">Programs in visual arts, music, drama, and dance to foster creativity and self-expression.</p>
                </div>
                
                <!-- Service 3 -->
                <div class="bg-white p-8 rounded-lg shadow-md hover-scale transition-transform duration-300">
                    <div class="text-primary text-4xl mb-4">
                        <i class="fas fa-running"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-3">Sports & Athletics</h3>
                    <p class="text-gray-600">Various sports activities to promote physical health, teamwork, and sportsmanship.</p>
                </div>
                
                <!-- Service 4 -->
                <div class="bg-white p-8 rounded-lg shadow-md hover-scale transition-transform duration-300">
                    <div class="text-primary text-4xl mb-4">
                        <i class="fas fa-laptop-code"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-3">Technology Education</h3>
                    <p class="text-gray-600">STEM programs and computer literacy to prepare students for the digital age.</p>
                </div>
                
                <!-- Service 5 -->
                <div class="bg-white p-8 rounded-lg shadow-md hover-scale transition-transform duration-300">
                    <div class="text-primary text-4xl mb-4">
                        <i class="fas fa-heart"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-3">Counseling Services</h3>
                    <p class="text-gray-600">Professional support for students' emotional well-being and personal development.</p>
                </div>
                
                <!-- Service 6 -->
                <div class="bg-white p-8 rounded-lg shadow-md hover-scale transition-transform duration-300">
                    <div class="text-primary text-4xl mb-4">
                        <i class="fas fa-bus"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-3">Transportation</h3>
                    <p class="text-gray-600">Safe and reliable transportation services for students across the city.</p>
                </div>
            </div>
        </div>
    </section>

    
    <!-- Notice Board Section -->
<section id="notice" class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4 text-3d-gray">Notice Board</h2>
            <div class="w-20 h-1 bg-primary mx-auto"></div>
            <p class="text-gray-600 max-w-2xl mx-auto mt-4 text-3d-gray-sm">Stay updated with our latest announcements and events</p>
        </div>
        
        <div class="grid md:grid-cols-2 gap-8">
            <?php
            // Database connection
            require_once 'config/db.php';
            
            // Get active notices, ordered by date (newest first)
            $stmt = $pdo->query("SELECT * FROM notices WHERE is_active = TRUE ORDER BY notice_date DESC LIMIT 4");
            $notices = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            foreach ($notices as $notice):
                $badge_class = '';
                $badge_text = '';
                
                switch ($notice['notice_type']) {
                    case 'event':
                        $badge_class = 'bg-primary text-white';
                        $badge_text = 'EVENT';
                        break;
                    case 'new':
                        $badge_class = 'bg-blue-500 text-white';
                        $badge_text = 'NEW';
                        break;
                    case 'important':
                        $badge_class = 'bg-red-500 text-white';
                        $badge_text = 'IMPORTANT';
                        break;
                    default:
                        $badge_class = 'bg-gray-500 text-white';
                        $badge_text = 'NOTICE';
                }
            ?>
            <div class="bg-gray-50 p-6 rounded-lg border-l-4 border-primary">
                <div class="flex items-center mb-4">


              
                    <?php if ($notice['notice_type'] !== 'general'): ?>
                    <div class="<?= $badge_class ?> px-3 py-1 rounded mr-4">
                        <span class="font-bold"><?= $badge_text ?></span>
                    </div>
                    <?php endif; ?>
                    <span class="text-sm text-gray-500"><?= date('M j, Y', strtotime($notice['notice_date'])) ?></span>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2"><?= htmlspecialchars($notice['headline']) ?></h3>
                <div class="text-gray-600 mb-4 formatted-notice"><?= nl2br(htmlspecialchars_decode($notice['body'])) ?></div>
                
              

                <!--<a href="#" class="text-primary font-medium hover:underline">Read More →</a>-->
            </div>
            <?php endforeach; ?>
        </div>
        
        <div class="text-center mt-12">
         <!--   <a href="notices.php" class="inline-block bg-primary text-white px-6 py-3 rounded-lg font-medium hover:bg-opacity-90 transition duration-300">View All Notices</a>-->
        </div>
    </div>
</section>

    <!-- Gallery Section -->
    <section id="gallery" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4 text-3d-gray">Our Gallery</h2>
                <div class="w-20 h-1 bg-primary mx-auto"></div>
                <p class="text-gray-600 max-w-2xl mx-auto mt-4 text-3d-gray-sm">Capturing memorable moments from our school life</p>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                <div class="overflow-hidden rounded-lg shadow-md hover-scale">
                    <img src="images/Gallery-2.JPG" alt="Classroom" class="w-full h-48 object-cover transition duration-500 hover:scale-110">
                </div>
                <div class="overflow-hidden rounded-lg shadow-md hover-scale">
                    <img src="images/Gallery-3.jpg" alt="Students learning" class="w-full h-48 object-cover transition duration-500 hover:scale-110">
                </div>
                <div class="overflow-hidden rounded-lg shadow-md hover-scale">
                    <img src="images/Gallery-4.jpg" alt="Science lab" class="w-full h-48 object-cover transition duration-500 hover:scale-110">
                </div>
                <div class="overflow-hidden rounded-lg shadow-md hover-scale">
                    <img src="images/Gallery-5.JPG" alt="Sports day" class="w-full h-48 object-cover transition duration-500 hover:scale-110">
                </div>
                <div class="overflow-hidden rounded-lg shadow-md hover-scale">
                    <img src="images/Gallery-6.JPG" alt="Library" class="w-full h-48 object-cover transition duration-500 hover:scale-110">
                </div>
                <div class="overflow-hidden rounded-lg shadow-md hover-scale">
                    <img src="images/Gallery-7.jpg" alt="Art class" class="w-full h-48 object-cover transition duration-500 hover:scale-110">
                </div>
                <div class="overflow-hidden rounded-lg shadow-md hover-scale">
                    <img src="images/Gallery-8.jpg" alt="Music class" class="w-full h-48 object-cover transition duration-500 hover:scale-110">
                </div>
                <div class="overflow-hidden rounded-lg shadow-md hover-scale">
                    <img src="images/Gallery-9.JPG" alt="School building" class="w-full h-48 object-cover transition duration-500 hover:scale-110">
                </div>
            </div>
            
            <div class="text-center mt-12">
                <a href="https://www.instagram.com/terredorschool/" class="inline-block bg-primary text-white px-6 py-3 rounded-lg font-medium hover:bg-opacity-90 transition duration-300" target="_blank">View More Photos</a>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section id="faq" class="py-20 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4 text-3d-gray">Frequently Asked Questions</h2>
                <div class="w-20 h-1 bg-primary mx-auto"></div>
                <p class="text-gray-600 max-w-2xl mx-auto mt-4 text-3d-gray-sm">Find answers to common questions about our school</p>
            </div>
            
            <div class="space-y-4">
                <div x-data="{ open: false }" class="border border-gray-200 rounded-lg overflow-hidden">
                    <button @click="open = !open" class="w-full flex justify-between items-center p-4 bg-gray-50 hover:bg-gray-100 focus:outline-none">
                        <span class="font-medium text-gray-800">What is the admission process?</span>
                        <svg class="w-5 h-5 text-gray-500 transition-transform duration-300" :class="{ 'transform rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div x-show="open" x-collapse class="p-4 text-gray-600">
                        <p>Our admission process begins with an inquiry form submission, followed by a school tour, assessment test for certain grades, and an interview with the proprietess. Final admission is granted based on availability and the assessment results.</p>
                    </div>
                </div>
                
                <div x-data="{ open: false }" class="border border-gray-200 rounded-lg overflow-hidden">
                    <button @click="open = !open" class="w-full flex justify-between items-center p-4 bg-gray-50 hover:bg-gray-100 focus:outline-none">
                        <span class="font-medium text-gray-800">What are the school timings?</span>
                        <svg class="w-5 h-5 text-gray-500 transition-transform duration-300" :class="{ 'transform rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div x-show="open" x-collapse class="p-4 text-gray-600">
                        <p>The regular school timings are from 8:00 AM to 2:30 PM for all grades, Monday to Friday.</p>
                    </div>
                </div>
                
                <div x-data="{ open: false }" class="border border-gray-200 rounded-lg overflow-hidden">
                    <button @click="open = !open" class="w-full flex justify-between items-center p-4 bg-gray-50 hover:bg-gray-100 focus:outline-none">
                        <span class="font-medium text-gray-800">What curriculum do you follow?</span>
                        <svg class="w-5 h-5 text-gray-500 transition-transform duration-300" :class="{ 'transform rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div x-show="open" x-collapse class="p-4 text-gray-600">
                        <p>We follow a blended curriculum that combines the national educational standards with international best practices. Our approach emphasizes experiential learning, critical thinking, and holistic development.</p>
                    </div>
                </div>
                
                <div x-data="{ open: false }" class="border border-gray-200 rounded-lg overflow-hidden">
                    <button @click="open = !open" class="w-full flex justify-between items-center p-4 bg-gray-50 hover:bg-gray-100 focus:outline-none">
                        <span class="font-medium text-gray-800">Do you provide transportation services?</span>
                        <svg class="w-5 h-5 text-gray-500 transition-transform duration-300" :class="{ 'transform rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div x-show="open" x-collapse class="p-4 text-gray-600">
                        <p>Yes, we do povide school buses that cover some areas of the city. All buses are driven by qualified chaffeurs, seat belts, and are staffed with trained attendants for student safety.</p>
                    </div>
                </div>
                
                <div x-data="{ open: false }" class="border border-gray-200 rounded-lg overflow-hidden">
                    <button @click="open = !open" class="w-full flex justify-between items-center p-4 bg-gray-50 hover:bg-gray-100 focus:outline-none">
                        <span class="font-medium text-gray-800">What extracurricular activities are offered?</span>
                        <svg class="w-5 h-5 text-gray-500 transition-transform duration-300" :class="{ 'transform rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div x-show="open" x-collapse class="p-4 text-gray-600">
                        <p>We offer a wide range of extracurricular activities including sports (soccer, basketball, Tekwando), arts (music, dance, theater), STEM clubs, debate, and community service programs. New activities are added based on student interest.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4 text-3d-gray">Contact Us</h2>
                <div class="w-20 h-1 bg-primary mx-auto"></div>
                <p class="text-gray-600 max-w-2xl mx-auto mt-4">We'd love to hear from you. Reach out for inquiries or to schedule a visit.</p>
            </div>
            
            <div class="flex flex-col md:flex-row gap-12">
                <div class="md:w-1/2">
                    <form class="space-y-6 " id="contactForm" novalidate>
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                            <input type="text" id="name" name="name" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary" placeholder="Your name">
                        </div>
                        
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                            <input type="email" id="email" name="email" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary" placeholder="your@email.com">
                        </div>
                        
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                            <input type="tel" id="phone" name="phone" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary" placeholder="Mobile Number">
                        </div>
                        
                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Your Message</label>
                            <textarea id="message" name="message" rows="5" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary" placeholder="How can we help you?"></textarea>
                        </div>
                       
                       
                        <!-- CSRF -->
                        <input type="hidden" name="csrf_token" id="contactCsrfToken" value="">
                        <div style="position: absolute; left: -9999px;">
                            <label for="website">Leave this field empty</label>
                            <input type="text" id="website" name="website">
                        </div>

                        <div id="formMessage" class="hidden my-4 p-4 rounded"></div>
                        
                        <div>
                            <button type="submit" class="w-full bg-primary text-white px-6 py-3 rounded-lg font-medium hover:bg-opacity-90 transition duration-300">Send Message</button>
                        </div>
                    </form>
                </div>
                
                <div class="md:w-1/2">
                    <div class="bg-white p-8 rounded-lg shadow-md h-full">
                        <h3 class="text-xl font-semibold text-gray-800 mb-6">Contact Information</h3>
                        
                        <div class="space-y-6">
                            <div class="flex items-start">
                                <div class="text-primary text-xl mt-1 mr-4">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div>
                                    <h4 class="font-medium text-gray-800">Address</h4>
                                    <p class="text-gray-600">21 Bamishile Road, Egbeda, Lagos, Nigeria</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start">
                                <div class="text-primary text-xl mt-1 mr-4">
                                    <i class="fas fa-phone-alt"></i>
                                </div>
                                <div>
                                    <h4 class="font-medium text-gray-800">Phone</h4>
                                    <p class="text-gray-600"><a href="tel:+2348106074520" class="hover:text-blue-600 transition-colors">+234 810 607 4520</a></p>
                                   
                                </div>
                            </div>

                            <div class="flex items-start">
                                <div class="text-primary text-xl mt-1 mr-4">
                                    <i class="fab fa-whatsapp mr-1"></i>
                                </div>
                                <div>
                                    <h4 class="font-medium text-gray-800">Whatsapp</h4>
                                    <p class="text-gray-600"> <a href="https://wa.me/2348039809422" class="hover:text-blue-600 transition-colors">+234 803 980 9422</a> </p>
                                </div>
                            </div>
                            
                            <div class="flex items-start">
                                <div class="text-primary text-xl mt-1 mr-4">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div>
                                    <h4 class="font-medium text-gray-800">Email</h4>
                                    <p class="text-gray-600"><a href="mailto:info@terredorschool.com" class="hover:text-blue-600 transition-colors">info@terredorschool.com</a></p>
                                    <!--<p class="text-gray-600">admissions@terredor.edu</p>-->
                                </div>
                            </div>
                            
                            <div class="flex items-start">
                                <div class="text-primary text-xl mt-1 mr-4">
                                    <i class="fas fa-clock"></i>
                                </div>
                                <div>
                                    <h4 class="font-medium text-gray-800">School Hours</h4>
                                    <p class="text-gray-600">Monday - Friday: 8:00 AM - 2:30 PM</p>
                                  
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-8">
                            <h4 class="font-medium text-gray-800 mb-4">Follow Us</h4>
                            <div class="flex space-x-4">
                                <a href="https://web.facebook.com/terredorschool/?_rdc=1&_rdr#" class="text-primary hover:text-opacity-80 text-2xl"><i class="fab fa-facebook"></i></a>
                                <a href="#" class="text-primary hover:text-opacity-80 text-2xl">
                                    <svg viewBox="0 0 24 24" class="w-6 h-6 fill-current mt-1" aria-label="X">
                                      <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                                    </svg>
                                  </a>
                                <a href="https://www.instagram.com/terredorschool/" class="text-primary hover:text-opacity-80 text-2xl"><i class="fab fa-instagram"></i></a>
                                <!--<a href="#" class="text-primary hover:text-opacity-80 text-2xl"><i class="fab fa-linkedin"></i></a>-->
                                <!--<a href="#" class="text-primary hover:text-opacity-80 text-2xl"><i class="fab fa-youtube"></i></a>-->
                                <a href="https://www.tiktok.com/@terre_dor8" class="text-primary hover:text-opacity-80 text-2xl">
                                    <svg viewBox="0 0 24 24" class="w-6 h-6 fill-current mt-1" aria-label="TikTok">
                                      <path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/>
                                    </svg>
                                  </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

      


    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <img class="h-12 mb-4" src="images/logo.png" alt="Terre d'Or Logo">
                    <p class="text-gray-300">Inspiring every child to reach their full potential through quality education and holistic development.</p>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold mb-4">Quick Links</h3>
                    <ul class="space-y-2">
                        <li><a href="#home" class="text-gray-300 hover:text-primary transition">Home</a></li>
                        <li><a href="#about" class="text-gray-300 hover:text-primary transition">About Us</a></li>
                        <li><a href="#services" class="text-gray-300 hover:text-primary transition">Services</a></li>
                        <li><a href="#notice" class="text-gray-300 hover:text-primary transition">Notice Board</a></li>
                        <li><a href="#gallery" class="text-gray-300 hover:text-primary transition">Gallery</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold mb-4">Admissions</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-300 hover:text-primary transition">Admission Process</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-primary transition">Fee Structure</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-primary transition">Scholarships</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-primary transition">School Calendar</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-primary transition">Virtual Tour</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold mb-4">Newsletter</h3>
                    <p class="text-gray-300 mb-4">Subscribe to our newsletter to receive updates and news.</p>
                    <form class="flex">
                        <input type="email" placeholder="Your email" class="px-4 py-2 w-full rounded-l-lg focus:outline-none text-gray-800">
                        <button type="submit" class="bg-primary px-4 py-2 rounded-r-lg hover:bg-opacity-90 transition">Subscribe</button>
                    </form>
                </div>
            </div>
            
            <div class="border-t border-gray-700 mt-12 pt-8 flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-300">© 2025 Terre d'Or School. All rights reserved.</p>
               
                <div class="flex space-x-6 mt-4 md:mt-0">
                    <a href="#" class="text-gray-300 hover:text-primary transition">Privacy Policy</a>
                    <a href="#" class="text-gray-300 hover:text-primary transition">Terms of Service</a>
                    <a href="#" class="text-gray-300 hover:text-primary transition">Sitemap</a>
                </div>
            </div>
            <p class="text-gray-300">Designed by <a href="https://durieltech.vercel.app" target="_blank" class="text-yellow-400">Duriel Tech</a></p>
        </div>
    </footer>

    <!--<div id="testButton" style="position:fixed; bottom:20px; right:20px; width:50px; height:50px; background:red; z-index:9999;"
    >TEST  ↑</div>-->

    <button 
    x-data="{ show: false }"
    x-init="
        window.addEventListener('scroll', () => {
            show = (window.pageYOffset > 300);
            console.log('Scroll position:', window.pageYOffset, 'Show button:', show);
        })
    "
    @click="window.scrollTo({ top: 0, behavior: 'smooth' })"
    :class="{ 
        'opacity-100 visible': show, 
        'opacity-0 invisible': !show 
    }"
    class="fixed bottom-8 right-8 p-3 bg-red-500 text-white rounded-full shadow-lg hover:bg-opacity-90 transition-all duration-300 z-50"
    style="display: block !important;"
>
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
    </svg>
</button>



 

    <script>
        // Auto-rotate hero slider
        document.addEventListener('DOMContentLoaded', function() {
            const heroSlider = document.querySelector('[x-data*="currentSlide"]');
            if (heroSlider) {
                const sliderData = Alpine.$data(heroSlider);
                setInterval(() => {
                    sliderData.currentSlide = (sliderData.currentSlide + 1) % sliderData.slides.length;
                }, 5000);
            }
            
            // Smooth scrolling for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    document.querySelector(this.getAttribute('href')).scrollIntoView({
                        behavior: 'smooth'
                    });
                });
            });
        });

// Initialize CSRF token management
function generateCsrfToken() {
    return Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15);
}

function initializeCsrf() {
    if (!sessionStorage.getItem('csrfToken')) {
        sessionStorage.setItem('csrfToken', generateCsrfToken());
    }
    
    // Set tokens in forms
    document.getElementById('contactCsrfToken').value = sessionStorage.getItem('csrfToken');
}

// Call this when page loads
initializeCsrf();

// Form submission handler
document.getElementById('contactForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const form = e.target;
    const formData = {
        formType: 'contact',
        name: form.elements['name'].value,
        email: form.elements['email'].value,
        phone: form.elements['phone'].value,
        message: form.elements['message'].value,
        website: form.elements['website'].value, // honeypot field
        csrf_token: form.elements['csrf_token'].value
    };

    fetch('form-handler.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(formData)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Message sent successfully!');
            form.reset();
        } else {
            alert('Error: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while sending the message.');
    });
});

// Add this to the submit handler
if (!formData.name || !formData.email || !formData.message) {
    alert('Please fill in all required fields');
    return;
}

if (!formData.email.includes('@')) {
    alert('Please enter a valid email address');
    return;
}

const submitBtn = form.querySelector('button[type="submit"]');
submitBtn.disabled = true;
submitBtn.textContent = 'Sending...';

// Then in the .finally() of the fetch:
submitBtn.disabled = false;
submitBtn.textContent = 'Send Message';

resetAutoRotation() {
    clearInterval(this.interval);
    this.startAutoRotation();
}


  


    </script>
</body>
</html>