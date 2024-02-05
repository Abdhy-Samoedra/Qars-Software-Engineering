<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Libraries -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script defer src="https://unpkg.com/alpinejs@3.7.0/dist/cdn.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"
        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ url('splide-4.1.3/dist/css/splide.min.css') }}">


    <!-- Scripts -->
    @vite(['resources/css/front.css'])

    <!-- Styles -->
    @livewireStyles

    <style>
        .splide:not(.is-overflow) .splide__arrows {
            display: none;
        }

        #forMobile {
            display: none;
        }

        @media only screen and (max-width: 1020px) {
            .splide__arrows {
                display: none;
            }

            #forMobile {
                display: block;
            }
        }
    </style>
</head>

<body style="background-color:#EDF2F7">
    <main>
        <nav class="container relative my-4 lg:my-10 bg-background">
            <div class="flex flex-col justify-between w-full lg:flex-row lg:items-center">
                <!-- Logo & Toggler Button here -->
                <div class="flex items-center justify-between">
                    <!-- LOGO -->
                    <a href="{{ route('front.index') }}">
                        <img src="/svgs/qars_logo.svg" alt="stream" />
                    </a>
                    <!-- RESPONSIVE NAVBAR BUTTON TOGGLER -->
                    <div class="block lg:hidden">
                        <button class="p-1 outline-none mobileMenuButton" id="navbarToggler" data-target="#navigation">
                            <svg class="text-dark w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 8h16M4 16h16"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Nav Menu -->
                <div class="hidden w-full lg:block" id="navigation">
                    <div
                        class="flex flex-col items-baseline gap-4 mt-6 lg:justify-between lg:flex-row lg:items-center lg:mt-0">
                        <div
                            class="flex flex-col w-full ml-auto lg:w-auto gap-4 lg:gap-[50px] lg:items-center lg:flex-row">
                            <a href="/" class="nav-link-item">Home</a>
                            <a href="{{ route('front.indexCatalogue') }}" class="nav-link-item">Catalog</a>
                            <a href="#!" class="nav-link-item">Booked</a>
                            <a href="#!" class="nav-link-item">Lost & Founds</a>
                            <a href="{{ route('front.voucher') }}" class="nav-link-item">Vouchers</a>
                        </div>
                        @auth
                            <div
                                class="flex flex-col w-full ml-auto lg:w-auto lg:gap-12 lg:items-center lg:flex-row nav-link-item">
                                <x-dropdown align="right" width="100">
                                    <x-slot name="trigger">

                                        @if (Auth::user()->profile_photo_path)
                                            <button
                                                class="flex text-sm transition border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300">
                                                <img class="object-cover w-10 h-10 rounded-full"
                                                    src="{{ Auth::user()->thumbnail }}" alt="{{ Auth::user()->name }}" />
                                            </button>
                                        @else
                                            <span class="inline-flex rounded-md">
                                                <button type="button"
                                                    class="inline-flex items-center px-3 py-2 leading-4 transition duration-150 ease-in-out border border-transparent rounded-md hover:underline focus:outline-none">
                                                    {{ Auth::user()->name }}

                                                    <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                        fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                        stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                                    </svg>
                                                </button>
                                            </span>
                                        @endif
                                    </x-slot>

                                    <x-slot name="content">
                                        <!-- Account Management -->
                                        <div>
                                            <div class="flex px-3 py-2 w-48 leading-5 text-sm text-gray-400">
                                                {{ __('Manage Account') }}
                                            </div>

                                            <x-dropdown-link href="{{ route('front.profile', Auth::user()->id) }}">
                                                {{ __('Profile') }}
                                            </x-dropdown-link>

                                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                                <x-dropdown-link href="{{ route('api-tokens.index') }}">
                                                    {{ __('API Tokens') }}
                                                </x-dropdown-link>
                                            @endif

                                            <div class="border-t border-gray-200"></div>

                                            <!-- Authentication -->
                                            <form method="POST" action="{{ route('logout') }}" x-data>
                                                @csrf

                                                <x-dropdown-link href="{{ route('logout') }}"
                                                    @click.prevent="$root.submit();">
                                                    {{ __('Log Out') }}
                                                </x-dropdown-link>
                                            </form>
                                        </div>
                                    </x-slot>
                                </x-dropdown>
                            </div>
                        @else
                            <div class="flex flex-col w-full ml-auto lg:w-auto lg:gap-12 lg:items-center lg:flex-row">
                                <a href="{{ route('login') }}" class="btn-secondary">
                                    Log In
                                </a>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        {{ $slot }}
    </main>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            once: true,
            duration: 300,
            easing: 'ease-out'
        });
    </script>

    <script src="{{ url('js/script.js') }}"></script>
    <script src="{{ url('js/catalogue.js') }}"></script>

    {{-- <script src="{{ url('js/carousel.js') }}"></script> --}}
    {{-- <script src="path-to-the-file/splide.min.js"></script> --}}
    <script src="{{ url('splide-4.1.3/dist/js/splide.min.js') }}"></script>

    {{-- <script src="{{ url('splide-4.1.3/dist/js//splide-extension-auto-scroll.min.js') }}"></script> --}}
    <script>
        // var splide = new Splide( '.splide', {
        // perPage: 3,
        // gap    : '2rem',
        // breakpoints: {
        //   1300: {
        //     perPage: 2,

        //   },
        //   780: {
        //     perPage: 1,
        //   },
        //   480: {
        //     perPage: 1,
        //     gap    : '.7rem',
        //     height : '6rem',
        //   },
        // },
        // rewind : true,
        // } );

        // splide.mount();

        var elms = document.getElementsByClassName('splide');


        for (var i = 0; i < elms.length; i++) {
            if (i == 0) {

                new Splide(elms[i], {
                    perPage: 3,
                    gap: '2rem',
                    breakpoints: {
                        1300: {
                            perPage: 2,

                        },
                        780: {
                            perPage: 1,
                        },
                        480: {
                            perPage: 1

                        },
                    },
                    rewind: true
                }).mount();
            } else {
                new Splide(elms[i], {
                    perPage: 3,
                    gap: '2rem',
                    breakpoints: {
                        1300: {
                            perPage: 3,

                        },
                        1020: {
                            perPage: 2,
                        },
                        560: {
                            perPage: 1
                        },
                    },
                    rewind: true
                }).mount();
            }
        }

        // splide.mount();
    </script>
</body>

</html>
