<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>
    <!-- Viewport for responsive design -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Link to compiled Tailwind CSS -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
    >
</head>
<body class="bg-white text-gray-800">
    <!-- Navigation Bar -->
    <nav class="bg-[#4CAF50] text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Logo or Brand Name -->
                <div class="flex-shrink-0">
                    <a href="{{ route('books.index') }}" class="text-xl font-bold">Book Tracker</a>
                </div>
                <!-- Hamburger Menu (Visible on Mobile) -->
                <div class="flex md:hidden">
                    <button id="hamburger" class="text-white focus:outline-none">
                        <div>
                            <i class="fas fa-bars"></i>
                        </div>
                    </button>
                </div>
                <!-- Navigation Links (Visible on Desktop) -->
                <div class="hidden md:block">
                    <ul class="ml-10 flex items-baseline space-x-4">
                        @guest
                            <li>
                                <a href="{{ route('login') }}" class="hover:bg-[#45a049] px-3 py-2 rounded-md text-sm font-medium">Login</a>
                            </li>
                            <li>
                                <a href="{{ route('register') }}" class="hover:bg-[#45a049] px-3 py-2 rounded-md text-sm font-medium">Register</a>
                            </li>
                        @endguest

                        @auth
                            <li>
                                <a href="{{ route('books.index') }}" class="hover:bg-[#45a049] px-3 py-2 rounded-md text-sm font-medium">Home</a>
                            </li>
                            <li>
                                <a href="{{ route('books.create') }}" class="hover:bg-[#45a049] px-3 py-2 rounded-md text-sm font-medium">Add New Book</a>
                            </li>
                            <li>
                                <a href="{{ route('books.about') }}" class="hover:bg-[#45a049] px-3 py-2 rounded-md text-sm font-medium">About</a>
                            </li>
                            <li>
                                <a href="{{ route('books.contact') }}" class="hover:bg-[#45a049] px-3 py-2 rounded-md text-sm font-medium">Contact</a>
                            </li>
                        @endauth
                    </ul>
                </div>
                <!-- User Info and Logout (Visible on Desktop) -->
                @auth
                    <div class="hidden md:flex items-center">
                        <span class="mr-4">Welcome, <strong>{{ Auth::user()->name }}</strong></span>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="bg-white text-[#4CAF50] px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-200">Logout</button>
                        </form>
                    </div>
                @endauth
            </div>
        </div>

        <!-- Mobile Menu, Hidden by Default -->
        <div class="md:hidden hidden" id="mobile-menu">
            <ul class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                @guest
                    <li>
                        <a href="{{ route('login') }}" class="block px-3 py-2 rounded-md text-base font-medium hover:bg-[#45a049]">Login</a>
                    </li>
                    <li>
                        <a href="{{ route('register') }}" class="block px-3 py-2 rounded-md text-base font-medium hover:bg-[#45a049]">Register</a>
                    </li>
                @endguest

                @auth
                    <li>
                        <a href="{{ route('books.index') }}" class="block px-3 py-2 rounded-md text-base font-medium hover:bg-[#45a049]">Home</a>
                    </li>
                    <li>
                        <a href="{{ route('books.create') }}" class="block px-3 py-2 rounded-md text-base font-medium hover:bg-[#45a049]">Add New Book</a>
                    </li>
                    <li>
                        <a href="{{ route('books.about') }}" class="block px-3 py-2 rounded-md text-base font-medium hover:bg-[#45a049]">About</a>
                    </li>
                    <li>
                        <a href="{{ route('books.contact') }}" class="block px-3 py-2 rounded-md text-base font-medium hover:bg-[#45a049]">Contact</a>
                    </li>
                    <li class="border-t border-[#4CAF50] mt-2 pt-2">
                        <span class="block px-3 py-2">Welcome, <strong>{{ Auth::user()->name }}</strong></span>
                        <form method="POST" action="{{ route('logout') }}" class="mt-1">
                            @csrf
                            <button type="submit" class="w-full text-left bg-white text-[#4CAF50] px-3 py-2 rounded-md text-base font-medium hover:bg-gray-200">Logout</button>
                        </form>
                    </li>
                @endauth
            </ul>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        {{ $slot }}
    </main>

    <!-- JavaScript to Handle Hamburger Menu Toggle -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const hamburger = document.getElementById('hamburger');
            const mobileMenu = document.getElementById('mobile-menu');

            hamburger.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });
        });
    </script>
</body>
</html>
