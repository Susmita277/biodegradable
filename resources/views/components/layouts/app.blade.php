<!doctype html>
<html>

<head>
    <meta charset="utf-8" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Neonderthaw&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
        
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{ $seo ?? '' }}
</head>


<body class="bg-white font-inter">
    <x-partials.header />
    {{ $slot }}
    <x-partials.footer />


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var swiper = new Swiper(".SliderOne", {
                freeMode: true,
                loop: true,
                autoplay: {
                    delay: 3000, // 3 seconds
                    disableOnInteraction: false,
                },
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },
                breakpoints: {
                    0: {
                        slidesPerView: 1,
                        spaceBetween: 20
                    }, // Mobile
                    640: {
                        slidesPerView: 3,
                        spaceBetween: 20
                    }, // Tablet
                    1024: {
                        slidesPerView: 6,
                        spaceBetween: 16
                    },
                    1536: {
                        slidesPerView: 5,
                        spaceBetween: 30
                    }
                }
            });
        });
        document.addEventListener('DOMContentLoaded', function() {
            var swiper = new Swiper(".SliderThree", {
                freeMode: true,
                loop: true,
                autoplay: {
                    delay: 3000, // 3 seconds
                    disableOnInteraction: false,
                },
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },
                breakpoints: {
                    0: {
                        slidesPerView: 1,
                        spaceBetween: 20
                    }, // Mobile
                    640: {
                        slidesPerView: 2,
                        spaceBetween: 20
                    }, // Tablet
                    1024: {
                        slidesPerView: 3,
                        spaceBetween: 16
                    },
                    1536: {
                        slidesPerView: 3,
                        spaceBetween: 30
                    }
                }
            });
        });
        document.addEventListener('DOMContentLoaded', function() {
            var swiper = new Swiper(".SliderTwo", {
                freeMode: true,
                loop: true,
                autoplay: {
                    delay: 3000, // 3 seconds
                    disableOnInteraction: false,
                },
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },
                breakpoints: {
                    0: {
                        slidesPerView: 1,
                        spaceBetween: 20
                    }, // Mobile
                    640: {
                        slidesPerView: 2,
                        spaceBetween: 20
                    }, // Tablet
                    1024: {
                        slidesPerView: 3,
                        spaceBetween: 30
                    } // Desktop
                }
            });
        });
        document.addEventListener('DOMContentLoaded', function() {
            var swiper = new Swiper(".SliderTwo", {
                freeMode: true,
                loop: true,
                autoplay: {
                    delay: 3000, // 3 seconds
                    disableOnInteraction: false,
                },
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },
                breakpoints: {
                    0: {
                        slidesPerView: 1,
                        spaceBetween: 20
                    }, // Mobile
                    640: {
                        slidesPerView: 2,
                        spaceBetween: 20
                    }, // Tablet
                    1024: {
                        slidesPerView: 3,
                        spaceBetween: 30
                    } // Desktop
                }
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
</body>

</html>
