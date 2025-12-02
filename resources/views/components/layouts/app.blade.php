<!doctype html>
<html>

<head>
    <meta charset="utf-8" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{ $seo ?? '' }}
</head>


<body class="bg-[#fbf8ef] font-inter">
    <x-partials.header />
    {{ $slot }}
    <x-partials.footer />


    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
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
                        slidesPerView: 5,
                        spaceBetween: 30
                    },
                    1536: {
                        slidesPerView: 5,
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
    </script>
</body>

</html>
