@extends('layouts.main')

@section('content')
    <div class="flex flex-col items-center justify-center px-6 py-12 mx-auto mt-16 lg:py-0">
        <div
            class="w-full bg-gray-100 border border-gray-300 rounded-lg shadow-lg sm:max-w-md xl:p-0 dark:bg-gray-900 dark:border-gray-700">
            <div class="p-6 space-y-6 sm:p-8">
                <div class="flex items-center space-x-2">
                    <svg class="w-8 h-8 text-blue-700 dark:text-blue-500" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path d="M12 12v.01M12 16h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h1 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Admin Panel Login</h1>
                </div>
                <p class="text-sm text-gray-500 dark:text-gray-400">Please authenticate to access the admin dashboard.</p>

                <form class="space-y-5" method="POST" action="{{ route('admin.login') }}">
                    @csrf
                    <div>
                        <label for="email" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Admin
                            Email</label>
                        <input type="email" id="email" name="email" required
                            class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                    </div>

                    <div>
                        <label for="password"
                            class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                        <input type="password" id="password" name="password" required
                            class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                    </div>

                    <div class="flex items-center justify-between">
                        <label class="flex items-center text-sm text-gray-500 dark:text-gray-400">
                            <input type="checkbox" name="remember"
                                class="w-4 h-4 mr-2 border-gray-300 rounded dark:bg-gray-700 dark:border-gray-600">
                            Remember me
                        </label>
                        <a href="#"
                            class="text-sm font-medium text-blue-600 hover:underline dark:text-blue-400">Forgot
                            password?</a>
                    </div>

                    <button type="submit"
                        class="w-full text-white bg-blue-800 hover:bg-blue-900 focus:ring-4 focus:outline-none focus:ring-blue-300 font-semibold rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-700 dark:hover:bg-blue-800 dark:focus:ring-blue-900">
                        Sign in as Admin
                    </button>

                    <ul class="text-sm font-light text-gray-500 dark:text-gray-400 list-disc list-inside">
                        <li>
                            Don’t have an account yet? <a href="{{ route('admin.register') }}"
                                class="font-medium text-blue-600 hover:underline dark:text-blue-400">Sign up</a>
                        </li>
                        <li>
                            Are you a regular user? <a href="{{ route('login') }}"
                                class="font-medium text-blue-600 hover:underline dark:text-blue-500">Switch to user
                                login</a>
                        </li>
                    </ul>
                </form>
            </div>
        </div>
    </div>
@endsection
