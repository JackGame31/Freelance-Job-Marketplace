@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-bold mb-6 text-gray-900 dark:text-white">
        {{ isset($freelance) ? 'Edit Freelance Job' : 'Create Freelance Job' }}
    </h1>

    <form action="{{ isset($freelance) ? route('admin.freelances.update', $freelance->id) : route('admin.freelances.store') }}" 
          method="POST" class="space-y-6">
        @csrf
        @if(isset($freelance))
            @method('PUT')
        @endif

        {{-- Title --}}
        <div>
            <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
            <input type="text" id="title" name="title"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 
                       dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('title') border-red-500 @enderror"
                value="{{ old('title', $freelance->title ?? '') }}" required>
            @error('title')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Description --}}
        <div>
            <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
            <textarea id="description" name="description" rows="5"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 
                       dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('description') border-red-500 @enderror"
                required>{{ old('description', $freelance->description ?? '') }}</textarea>
            @error('description')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Logo --}}
        <div>
            <label for="logo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Logo URL</label>
            <input type="url" id="logo" name="logo"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 
                       dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('logo') border-red-500 @enderror"
                value="{{ old('logo', $freelance->logo ?? '') }}">
            @error('logo')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Salary Range --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="start_salary" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Start Salary</label>
                <input type="number" step="0.01" id="start_salary" name="start_salary"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 
                           dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('start_salary') border-red-500 @enderror"
                    value="{{ old('start_salary', $freelance->start_salary ?? '') }}" required>
                @error('start_salary')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="end_salary" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">End Salary</label>
                <input type="number" step="0.01" id="end_salary" name="end_salary"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 
                           dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('end_salary') border-red-500 @enderror"
                    value="{{ old('end_salary', $freelance->end_salary ?? '') }}" required>
                @error('end_salary')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- Status --}}
        <div>
            <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
            <select name="status" id="status"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 
                       dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('status') border-red-500 @enderror" required>
                <option value="open" {{ old('status', $freelance->status ?? '') === 'open' ? 'selected' : '' }}>Open</option>
                <option value="closed" {{ old('status', $freelance->status ?? '') === 'closed' ? 'selected' : '' }}>Closed</option>
            </select>
            @error('status')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Category Dropdown --}}
        <div>
            <label for="category_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
            <select name="category_id" id="category_id"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 
                       dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('category_id') border-red-500 @enderror" required>
                <option value="">Select a category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ old('category_id', $freelance->category_id ?? '') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit"
            class="text-white bg-blue-600 hover:bg-blue-700 font-medium rounded-lg text-sm px-5 py-2.5">
            {{ isset($freelance) ? 'Update' : 'Create' }}
        </button>
    </form>
@endsection
