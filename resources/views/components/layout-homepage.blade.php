<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>
        SiMeja | BMPR
    </title>
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="" />
    <!--Replace with your tailwind.css once created-->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700" rel="stylesheet" />
    <link rel="icon" href="{{ asset('assets/images/logo.png') }}" type="image/png">
    <!-- Define your gradient here - use online tools to find a gradient matching your branding-->
    <style>
        .gradient {
            background: linear-gradient(90deg, #fbd206 0%, #ffd008 100%);
        }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('assets/leaflet.css') }}">
    <script src="{{ asset('assets/leaflet.js') }}"></script>
</head>

<body class="leading-normal tracking-normal text-nord6 gradient" style="font-family: 'Source Sans Pro', sans-serif;">
    <!--Nav-->
    <nav id="header" class="fixed w-full z-30 top-0 text-nord6 py-3">
        <div class="w-full container mx-auto flex flex-wrap items-center justify-between py-2 px-4">
            <div class="pl-4 flex items-center">
                <a class="toggleColour text-nord6 no-underline hover:no-underline font-bold text-2xl lg:text-4xl"
                    href="#">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="" class="w-10">
                </a>
            </div>
            <div class="block lg:hidden pr-4">
                <button id="nav-toggle"
                    class="flex items-center p-1 text-pink-800 hover:text-gray-900 focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out">
                    <svg class="fill-current h-6 w-6" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <title>Menu</title>
                        <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z" />
                    </svg>
                </button>
            </div>
            <div class="toggleColour w-full flex-grow lg:flex lg:items-center lg:w-auto hidden mt-2 lg:mt-0 bg-transparent lg:bg-transparent text-nord6 p-4 lg:p-0 z-20"
                id="nav-content">
                <ul class="list-reset lg:flex justify-end flex-1 items-center mr-8 mb-10 lg:mb-0">
                    <li class="mr-6">
                        <a href="{{ url('/') }}" id="nav-menu1"
                            class="text-nord6 text-lg font-semibold hover:text-blue-300 transition duration-300 ease-in-out no-underline ">
                            Profil
                        </a>
                    </li>
                    <li class="mr-6">
                        <a href="{{ url('/webgis') }}" id="nav-menu2"
                            class="text-nord6 text-lg font-semibold hover:text-blue-300 transition duration-300 ease-in-out no-underline ">
                            Webgis
                        </a>
                    </li>
                    <li class="mr-6">
                        <a href="#" id="nav-menu2"
                            class="text-nord6 text-lg font-semibold hover:text-blue-300 transition duration-300 ease-in-out no-underline ">
                            Kontak
                        </a>
                    </li>


                </ul>
                <ul>
                    @if (Route::has('login'))
                        @auth
                            <a id="navAction" href="{{ url('/dashboard') }}"
                                class="mx-auto lg:mx-0 hover:underline bg-nord6 text-nord0 font-bold rounded-full mt-4  lg:mt-0 py-4 px-8 shadow opacity-75 focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out">
                                Dashboard
                            </a>
                        @else
                            <a id="navAction" href="{{ route('login') }}"
                                class="mx-auto lg:mx-0 hover:underline bg-nord6 text-nord0 font-bold rounded-full mt-4  lg:mt-0 py-4 px-8 shadow opacity-75 focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out">
                                Log in
                            </a>
                        @endauth
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    <main class=""> {{ $slot }}</main>
    <!--Footer-->
    <footer class="bg-nord6">
        <div class="container mx-auto px-8">
            <div class="w-full flex flex-col md:flex-row py-6">
                <div class="flex-1 mb-6 text-black">
                    <a class="text-nord0 no-underline hover:no-underline font-bold text-2xl lg:text-4xl" href="#">
                        SiMeja 💻
                    </a>
                </div>
                <div class="flex-1">
                    <p class="uppercase text-gray-500 md:mb-6">Links</p>
                    <ul class="list-reset mb-6">
                        <li class="mt-2 inline-block mr-2 md:block md:mr-0">
                            <a href="#"
                                class="no-underline hover:underline text-nord0 hover:text-pink-500">FAQ</a>
                        </li>
                        <li class="mt-2 inline-block mr-2 md:block md:mr-0">
                            <a href="#"
                                class="no-underline hover:underline text-nord0 hover:text-pink-500">Help</a>
                        </li>
                        <li class="mt-2 inline-block mr-2 md:block md:mr-0">
                            <a href="#"
                                class="no-underline hover:underline text-nord0 hover:text-pink-500">Support</a>
                        </li>
                    </ul>
                </div>
                <div class="flex-1">
                    <p class="uppercase text-gray-500 md:mb-6">Legal</p>
                    <ul class="list-reset mb-6">
                        <li class="mt-2 inline-block mr-2 md:block md:mr-0">
                            <a href="#"
                                class="no-underline hover:underline text-nord0 hover:text-pink-500">Terms</a>
                        </li>
                        <li class="mt-2 inline-block mr-2 md:block md:mr-0">
                            <a href="#"
                                class="no-underline hover:underline text-nord0 hover:text-pink-500">Privacy</a>
                        </li>
                    </ul>
                </div>
                <div class="flex-1">
                    <p class="uppercase text-gray-500 md:mb-6">Social</p>
                    <ul class="list-reset mb-6">
                        <li class="mt-2 inline-block mr-2 md:block md:mr-0">
                            <a href="#"
                                class="no-underline hover:underline text-nord0 hover:text-pink-500">Facebook</a>
                        </li>
                        <li class="mt-2 inline-block mr-2 md:block md:mr-0">
                            <a href="#"
                                class="no-underline hover:underline text-nord0 hover:text-pink-500">Linkedin</a>
                        </li>
                        <li class="mt-2 inline-block mr-2 md:block md:mr-0">
                            <a href="#"
                                class="no-underline hover:underline text-nord0 hover:text-pink-500">Twitter</a>
                        </li>
                    </ul>
                </div>
                <div class="flex-1">
                    <p class="uppercase text-gray-500 md:mb-6">Company</p>
                    <ul class="list-reset mb-6">
                        <li class="mt-2 inline-block mr-2 md:block md:mr-0">
                            <a href="#"
                                class="no-underline hover:underline text-nord0 hover:text-pink-500">Official
                                Blog</a>
                        </li>
                        <li class="mt-2 inline-block mr-2 md:block md:mr-0">
                            <a href="#"
                                class="no-underline hover:underline text-nord0 hover:text-pink-500">About
                                Us</a>
                        </li>
                        <li class="mt-2 inline-block mr-2 md:block md:mr-0">
                            <a href="#"
                                class="no-underline hover:underline text-nord0 hover:text-pink-500">Contact</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <!-- jQuery if you need it
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  -->

    <script>
        var scrollpos = window.scrollY;
        var header = document.getElementById("header");
        var navcontent = document.getElementById("nav-content");
        var navaction = document.getElementById("navAction");
        var navLinks = document.querySelectorAll("#nav-menu1, #nav-menu2, #nav-menu3, #nav-menu4");
        var toToggle = document.querySelectorAll(".toggleColour");

        document.addEventListener("scroll", function() {
            scrollpos = window.scrollY;

            if (scrollpos > 10) {
                header.classList.add("bg-nord6", "shadow");
                navaction.classList.replace("bg-nord6", "gradient");
                navaction.classList.replace("text-nord0", "text-nord6");

                navLinks.forEach(link => {
                    link.classList.replace("text-nord6", "text-nord0");
                });

                toToggle.forEach(element => {
                    element.classList.replace("text-nord6", "text-nord0");
                });

                navcontent.classList.replace("bg-nord0", "bg-nord6");
            } else {
                header.classList.remove("bg-nord6", "shadow");
                navaction.classList.replace("gradient", "bg-nord6");
                navaction.classList.replace("text-nord6", "text-nord0");

                navLinks.forEach(link => {
                    link.classList.replace("text-nord0", "text-nord6");
                });

                toToggle.forEach(element => {
                    element.classList.replace("text-nord0", "text-nord6");
                });

                navcontent.classList.replace("bg-nord6", "bg-nord0");
            }
        });
    </script>

    <script>
        /*Toggle dropdown list*/
        /*https://gist.github.com/slavapas/593e8e50cf4cc16ac972afcbad4f70c8*/

        var navMenuDiv = document.getElementById("nav-content");
        var navMenu = document.getElementById("nav-toggle");

        document.onclick = check;

        function check(e) {
            var target = (e && e.target) || (event && event.srcElement);

            //Nav Menu
            if (!checkParent(target, navMenuDiv)) {
                // click NOT on the menu
                if (checkParent(target, navMenu)) {
                    // click on the link
                    if (navMenuDiv.classList.contains("hidden")) {
                        navMenuDiv.classList.remove("hidden");
                    } else {
                        navMenuDiv.classList.add("hidden");
                    }
                } else {
                    // click both outside link and outside menu, hide menu
                    navMenuDiv.classList.add("hidden");
                }
            }
        }

        function checkParent(t, elm) {
            while (t.parentNode) {
                if (t == elm) {
                    return true;
                }
                t = t.parentNode;
            }
            return false;
        }
    </script>
</body>

</html>
