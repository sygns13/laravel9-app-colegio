<x-guest-layout>
    <style>
        @keyframes slide {
            0% { transform: translateX(0); }
            10% { transform: translateX(0); }

            15% { transform: translateX(-100%); }
            30% { transform: translateX(-100%); }

            35% { transform: translateX(-200%); }
            50% { transform: translateX(-200%); }

            55% { transform: translateX(-300%); }
            70% { transform: translateX(-300%); }

            75% { transform: translateX(-400%); }
            90% { transform: translateX(-400%); }

            95% { transform: translateX(-500%); }
            100% { transform: translateX(-500%); }
        }

        * { box-sizing: border-box; }

        html { scroll-behavior: smooth; }

        body {
            font-family: sans-serif;
        }

        .wrapper {
            max-width: 1200px;
            /* margin-top: 1.5rem; */
            /* margin: 0 auto; */
        }

        .slider {
            position: relative;
        }

        .slides {
            position: relative;
            display: flex;
            overflow: hidden;
        }

        .slide {
            width: 100vw;
            flex-shrink: 0;
            animation-name: slide;
            animation-duration: 20s;
            animation-iteration-count: infinite;
            animation-timing-function: linear;
        }

        .slides:hover .slide {
            animation-play-state: paused;
        }

        .slide img {
            width: 100%;
            vertical-align: top;
        }

        .slide a {
            width: 100%;
            display: inline-block;
            position: relative;
        }

        .caption {
            color: white;
            text-shadow: 1px 1px black;
            font-size: 8vw;
            position: absolute;
            bottom: 8vw;
            right: 4vw;
        }

        .slide:target {
            animation-name: none;
            position: absolute;
            left: 0;
            top: 0;
            right: 0;
            bottom: 0;
            z-index: 50;
        }

        .slider-controler {
            position: absolute;
            left: 0;
            right: 0;
            bottom: 0;
            text-align: center;
            padding: 5px;
            background-color: rgba(0,0,0,0.5);
            z-index: 100;
        }

        .slider-controler li {
            margin: 0 0.5rem;
            display: inline-block;
            vertical-align: top;
        }

        .slider-controler a {
            display: inline-block;
            vertical-align: top;
            text-decoration: none;
            color: white;
            font-size: 1.5rem;
        }

        @media only screen and (min-width: 1200px) {
            .slide {
                width: 1200px;
            }

            .caption {
                font-size: 96px;
                bottom: 96px;
                right: 50px;
            }
        }
    </style>

    <div class="grid" style=" background-image: url('{{ asset('/images/fondob.jpg') }}');    background-size: cover; /* background-color: #f0f0f0; */
    background-repeat: no-repeat;
    height: 100%;">

    <div style="display:flex;">
        <div class="p-0" style="display:inline-block; width:75%;">
            
            <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
                <div class="wrapper">
                    <div class="slider" id="slider">
                    <ul class="slides">
                        <li class="slide" id="slide1">
                        <a href="#">
                            <img src="{{ asset('/images/img1.jpg') }}" alt="photo 1">
                        </a>
                        </li>
                        <li class="slide" id="slide2">
                        <a href="#">
                            <img src="{{ asset('/images/img2.jpg') }}" alt="photo 2">
                        </a>
                        </li>
                        <li class="slide" id="slide3">
                        <a href="#">
                            <img src="{{ asset('/images/img3.jpg') }}" alt="photo 3">
                        </a>
                        </li>
                        <li class="slide" id="slide4">
                        <a href="#">
                            <img src="{{ asset('/images/img4.jpg') }}" alt="photo 4">
                        </a>
                        </li>
                        <li class="slide" id="slide5">
                        <a href="#">

                            <img src="{{ asset('/images/img5.jpg') }}" alt="photo 5">
                        </a>
                        </li>
                        <li class="slide">
                        <a href="#">
                            <img src="{{ asset('/images/img1.jpg') }}" alt="photo 1">
                        </a>
                        </li>
                    </ul>
                    <ul class="slider-controler">
                        <li><a href="#slide1">&bullet;</a></li>
                        <li><a href="#slide2">&bullet;</a></li>
                        <li><a href="#slide3">&bullet;</a></li>
                        <li><a href="#slide4">&bullet;</a></li>
                        <li><a href="#slide5">&bullet;</a></li>
                    </ul>
                    </div>
                </div>
                </div>

        </div>
        <div class="p-0" style="display:inline-block; width:20%;">
            <x-jet-authentication-card>
                <x-slot name="logo">
                    {{-- <x-jet-authentication-card-logo /> --}}
                    {{-- <img src="{{ asset('/images/logo2.png') }}" alt="" style="padding:10px; width: 200px; display:inline-block;"> --}}
                </x-slot>

                <x-jet-validation-errors class="mb-4" />

                @if (session('status'))
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div>
                        <x-jet-label for="perfil" value="{{ __('Perfil') }}" />
                        {{-- <x-jet-input id="identity" class="block mt-1 w-full" type="text" name="identity" :value="old('email')" required autofocus /> --}}
                        <select id="perfil" class="block mt-1 w-full" name="perfil" :value="old('perfil')">
                            <option value="1">
                                Director
                            </option>
                            <option value="2">
                                Administrativo
                            </option>
                            <option value="3">
                                Docente
                            </option>
                            {{-- <option value="6">
                                Tutor
                            </option> --}}
                            <option value="5">
                                Padre de Familia
                            </option>
                            <option value="4">
                                Alumno
                            </option>
                        </select>
                    </div>

                    <div>
                        <x-jet-label for="identity" value="{{ __('Username/Email') }}" />
                        <x-jet-input id="identity" class="block mt-1 w-full" type="text" name="identity" :value="old('email')" required autofocus />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="password" value="{{ __('Password') }}" />
                        <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                    </div>

                    <div class="block mt-4">
                        <label for="remember_me" class="flex items-center">
                            <x-jet-checkbox id="remember_me" name="remember" />
                            <span class="ml-2 text-sm text-gray-600">{{ __('Recuerdame') }}</span>
                        </label>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        @if (Route::has('password.request'))
                            <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                                {{ __('¿Olvidó su contraseña?') }}
                            </a>
                        @endif

                        <x-jet-button class="ml-4">
                            {{ __('Iniciar Sesión') }}
                        </x-jet-button>
                    </div>
                </form>
            </x-jet-authentication-card>
        </div>
    </div>
</x-guest-layout>
