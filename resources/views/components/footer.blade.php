<footer class="bg-white dark:bg-gray-900 border-t border-gray-200 dark:border-gray-700 mt-16">
    <div class="container mx-auto px-6 py-10">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">
            {{-- Column 1: Branding --}}
            <div class="text-center md:text-left">
                <h2 class="text-2xl font-semibold text-gray-900 dark:text-white mb-2">FreelanceMarket</h2>
                <p class="text-sm text-gray-500 dark:text-gray-400">Connecting talent with opportunity.</p>
            </div>

            {{-- Column 2: Contact Information --}}
            <div class="text-center md:text-left">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Contact Information</h3>
                <ul class="space-y-2">
                    <li>
                        <p class="dark:text-gray-400">Email: <a href="mailto:support@freelancemarket.com" class="text-blue-600 hover:underline">support@freelancemarket.com</a></p>
                    </li>
                    <li>
                        <p class="dark:text-gray-400">Phone: <a href="tel:+18001234567" class="text-blue-600 hover:underline">+1 (800) 123-4567</a></p>
                    </li>
                    <li>
                        <p class="dark:text-gray-400">Address: 123 Freelancer St., Remote City, Webland</p>
                    </li>
                </ul>
            </div>

            {{-- Column 3: Quick Links --}}
            <div class="text-center md:text-left">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Quick Links</h3>
                <ul class="space-y-2 text-sm text-gray-600 dark:text-gray-400">
                    <li><a href="{{ route('home') }}" class="hover:underline">Home</a></li>
                    <li><a href="{{ route('search') }}" class="hover:underline">Jobs</a></li>
                    <li><a href="{{ route('about') }}" class="hover:underline">About</a></li>
                </ul>
            </div>
        </div>

        {{-- Social Media and Copyright --}}
        <div class="mt-10 border-t border-gray-200 dark:border-gray-700 pt-6 text-center">
            <div class="flex justify-center gap-6 mb-6">
                <a href="#" class="text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white">
                    <i class="bi bi-facebook text-xl"></i>
                </a>
                <a href="#" class="text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white">
                    <i class="bi bi-twitter text-xl"></i>
                </a>
                <a href="#" class="text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white">
                    <i class="bi bi-linkedin text-xl"></i>
                </a>
            </div>

            <p class="text-sm text-gray-500 dark:text-gray-400">
                &copy; {{ date('Y') }} FreelanceMarket. All rights reserved.
            </p>
        </div>
    </div>
</footer>
