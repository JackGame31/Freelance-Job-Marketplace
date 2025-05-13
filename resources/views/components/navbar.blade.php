@props([
    'title' => 'FreelanceMarket',
])

@php
    $activeClasses =
        'block py-2 px-3 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 dark:text-white md:dark:text-blue-500';
    $notActiveClasses =
        'block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent';
@endphp

<nav class="bg-white border-b border-gray-200 dark:bg-gray-900 dark:border-gray-700">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        {{-- Logo --}}
        <a href="{{ url('/') }}" class="flex items-center space-x-3 rtl:space-x-reverse">
            <img src="https://flowbite.com/docs/images/logo.svg" class="h-8" alt="{{ $title }} Logo">
            <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">{{ $title }}</span>
        </a>

        {{-- Right Side: Auth Buttons or Profile Dropdown --}}
        <div class="flex items-center space-x-4 md:order-2 rtl:space-x-reverse">
            @php
                $user = auth('web')->user();
                $admin = auth('admin')->user();
            @endphp

            @if ($user || $admin)
                <button type="button"
                    class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
                    id="user-menu-button" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
                    <span class="sr-only">Open user menu</span>
                    <img class="w-8 h-8 rounded-full object-cover"
                        src="https://flowbite.com/docs/images/people/profile-picture-3.jpg" alt="user photo">
                </button>

                <!-- Dropdown menu -->
                <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow-sm dark:bg-gray-700 dark:divide-gray-600"
                    id="user-dropdown">
                    <div class="px-4 py-3">
                        <span class="block text-sm text-gray-900 dark:text-white">
                            {{ $admin ? $admin->name : $user->name }}
                        </span>
                        <span class="block text-sm text-gray-500 truncate dark:text-gray-400">
                            {{ $admin ? $admin->email : $user->email }}
                        </span>
                    </div>
                    <ul class="py-2" aria-labelledby="user-menu-button">
                        @if ($admin)
                            <li>
                                <a href="{{ route('admin.dashboard') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                                    Admin Dashboard
                                </a>
                            </li>
                            <li>
                                <form method="POST" action="{{ route('admin.logout') }}">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit"
                                        class="w-full text-left block px-4 py-2 text-sm text-red-600 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-red-600 dark:hover:text-white">
                                        Sign out (Admin)
                                    </button>
                                </form>
                            </li>
                        @else
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit"
                                        class="w-full text-left block px-4 py-2 text-sm text-red-600 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-red-600 dark:hover:text-white">
                                        Sign out
                                    </button>
                                </form>
                            </li>
                        @endif
                    </ul>
                </div>
            @else
                {{-- Show Login / Register CTA only if guest --}}
                <a href="{{ route('login') }}"
                    class="hidden md:inline-block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 {{ request()->is(['login', 'admin.login']) ? 'bg-blue-900 dark:bg-blue-900' : '' }}">
                    Login
                </a>
                <a href="{{ route('register') }}"
                    class="hidden md:inline-block text-blue-700 border border-blue-700 hover:bg-blue-700 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:border-blue-600 dark:text-blue-600 dark:hover:bg-blue-700 dark:hover:text-white dark:focus:ring-blue-800 {{ request()->routeIs(['register', 'admin.register']) ? 'bg-blue-900 text-white dark:bg-blue-900 dark:text-white' : '' }}">
                    Register
                </a>
            @endif

            {{-- Mobile Toggle --}}
            <button data-collapse-toggle="navbar-default" type="button"
                class="inline-flex items-center justify-center w-10 h-10 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                aria-controls="navbar-default" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M3 5h14a1 1 0 100-2H3a1 1 0 100 2zm14 4H3a1 1 0 000 2h14a1 1 0 000-2zm0 6H3a1 1 0 000 2h14a1 1 0 000-2z"
                        clip-rule="evenodd" />
                </svg>
            </button>
        </div>

        {{-- Navbar Links --}}
        <div class="hidden w-full md:block md:w-auto" id="navbar-default">
            <ul
                class="flex flex-col p-4 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 md:mt-0 md:p-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                <li><a href="{{ route('home') }}"
                        class="{{ request()->routeIs('home') ? $activeClasses : $notActiveClasses }}">Home</a></li>
                <li><a href="{{ route('search') }}"
                        class="{{ request()->is('search') || request()->is('search/*') ? $activeClasses : $notActiveClasses }}">Search</a></li>
                <li><a href="{{ route('about') }}"
                        class="{{ request()->routeIs('about') ? $activeClasses : $notActiveClasses }}">About</a></li>

                @auth
                    <li><a href="{{ route('application') }}"
                            class="{{ request()->routeIs('application') ? $activeClasses : $notActiveClasses }}">Your
                            Applications</a></li>
                @endauth

                {{-- Auth Links (Mobile only) --}}
                @php
                    $isGuestWeb = Auth::guard('web')->guest();
                    $isGuestAdmin = Auth::guard('admin')->guest();
                @endphp
                @if ($isGuestWeb && $isGuestAdmin)
                    <li class="md:hidden"><a href="{{ route('login') }}"
                            class="{{ request()->routeIs('login') ? $activeClasses : $notActiveClasses }}">Login</a>
                    </li>
                    <li class="md:hidden"><a href="{{ route('register') }}"
                            class="{{ request()->routeIs('register') ? $activeClasses : $notActiveClasses }}">Register</a>
                    </li>
                @endif

                @auth('web')
                    <li class="md:hidden">
                        <form method="POST" action="{{ route('logout') }}">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="w-full text-left text-red-600 {{ $notActiveClasses }}">
                                Logout
                            </button>
                        </form>
                    </li>
                @endauth

                @auth('admin')
                    <li class="md:hidden"><a href="{{ route('admin.dashboard') }}"
                            class="{{ request()->routeIs('admin.dashboard') ? $activeClasses : $notActiveClasses }}">Admin
                            Dashboard</a></li>
                    <li class="md:hidden">
                        <form method="POST" action="{{ route('admin.logout') }}">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="w-full text-left text-red-600 {{ $notActiveClasses }}">
                                Logout
                            </button>
                        </form>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
