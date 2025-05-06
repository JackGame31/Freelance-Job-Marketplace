@extends('layouts.main')

@section('content')
    {{-- Hero / Intro Section --}}
    <section class="bg-white dark:bg-gray-900 py-16">
        <div class="container mx-auto px-6 text-center">
            <h1 class="text-4xl font-extrabold text-gray-900 dark:text-white mb-4">
                About FreelanceMarket
            </h1>
            <p class="text-lg text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
                FreelanceMarket is a trusted online platform that connects talented freelancers with clients looking to get work done—efficiently, securely, and globally.
            </p>
        </div>
    </section>

    {{-- Mission Section --}}
    <section class="bg-gray-50 dark:bg-gray-800 py-16">
        <div class="container mx-auto px-6 grid md:grid-cols-2 gap-12 items-center">
            <div>
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">Our Mission</h2>
                <p class="text-gray-700 dark:text-gray-300 mb-4">
                    We aim to empower people to achieve more by bridging the gap between clients and independent professionals across industries like design, development, marketing, writing, and more.
                </p>
                <p class="text-gray-700 dark:text-gray-300">
                    Whether you're a freelancer looking for flexible work or a business seeking top talent, FreelanceMarket is here to make that connection seamless and trustworthy.
                </p>
            </div>
            <img src="https://images.unsplash.com/photo-1568992687947-868a62a9f521?q=80&w=3132&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Our Mission"
                 class="w-full rounded-lg shadow-md dark:shadow-gray-700" />
        </div>
    </section>

    {{-- Values or Features Section --}}
    <section class="bg-white dark:bg-gray-900 py-16">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-10">Why FreelanceMarket?</h2>
            <div class="grid gap-10 md:grid-cols-3 text-left">
                <div>
                    <h3 class="text-xl font-semibold text-blue-700 dark:text-blue-400 mb-2">Secure Payments</h3>
                    <p class="text-gray-600 dark:text-gray-300">We hold payments in escrow and release them once work is approved—keeping both parties safe.</p>
                </div>
                <div>
                    <h3 class="text-xl font-semibold text-blue-700 dark:text-blue-400 mb-2">Verified Talent</h3>
                    <p class="text-gray-600 dark:text-gray-300">All freelancers go through a vetting process to ensure high-quality work every time.</p>
                </div>
                <div>
                    <h3 class="text-xl font-semibold text-blue-700 dark:text-blue-400 mb-2">Global Reach</h3>
                    <p class="text-gray-600 dark:text-gray-300">Hire or get hired from anywhere in the world with ease and confidence.</p>
                </div>
            </div>
        </div>
    </section>
@endsection
