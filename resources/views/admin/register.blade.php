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
                    <h1 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Register Admin Account</h1>
                </div>
                <p class="text-sm text-gray-500 dark:text-gray-400">Used for backend dashboard access only.</p>

                <form class="space-y-5" method="POST" action="{{ route('admin.register.store') }}">
                    @csrf

                    {{-- Name --}}
                    <div>
                        <label for="name" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Full
                            Name</label>
                        <input type="text" id="name" name="name" required value="{{ old('name') }}"
                            class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:text-white @error('name') border-red-500 @enderror">
                        @error('name')
                            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div>
                        <label for="email" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Admin
                            Email</label>
                        <input type="email" id="email" name="email" required value="{{ old('email') }}"
                            class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:text-white @error('email') border-red-500 @enderror">
                        @error('email')
                            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div>
                        <label for="password"
                            class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                        <input type="password" id="password" name="password" required
                            class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:text-white @error('password') border-red-500 @enderror">
                        @error('password')
                            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Confirm Password --}}
                    <div>
                        <label for="confirm-password"
                            class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Confirm Password</label>
                        <input type="password" id="confirm-password" name="confirm-password" required
                            class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:text-white @error('confirm-password') border-red-500 @enderror">
                        @error('confirm-password')
                            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Terms and Conditions Checkbox --}}
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input id="terms" name="terms" aria-describedby="terms" type="checkbox"
                                class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-primary-600 dark:ring-offset-gray-800 @error('terms') border-red-500 @enderror"
                                required="" @if (old('terms')) checked @endif>
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="terms" class="font-light text-gray-500 dark:text-gray-300">I accept the <a
                                    class="font-medium text-blue-600 hover:underline dark:text-blue-400"
                                    href="#">Terms and Conditions</a></label>
                        </div>
                    </div>
                    @error('terms')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror

                    {{-- Role Note --}}
                    <div class="text-sm text-gray-500 dark:text-gray-400 italic">
                        This account will be granted admin privileges.
                    </div>

                    {{-- Submit --}}
                    <button type="submit"
                        class="w-full text-white bg-blue-800 hover:bg-blue-900 focus:ring-4 focus:outline-none focus:ring-blue-300 font-semibold rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-700 dark:hover:bg-blue-800 dark:focus:ring-blue-900">
                        Register as Admin
                    </button>

                    {{-- Back to login --}}
                    <ul class="text-sm text-gray-500 dark:text-gray-400 list-disc list-inside">
                        <li>
                            Already have an admin account? <a href="{{ route('admin.login') }}"
                                class="font-medium text-blue-600 hover:underline dark:text-blue-400">Login here</a>
                        </li>
                        <li>
                            Are you a regular user? <a href="{{ route('register') }}"
                                class="font-medium text-blue-600 hover:underline dark:text-blue-500">Switch to user register</a>
                        </li>
                    </ul>
                </form>
            </div>
        </div>
    </div>
@endsection
