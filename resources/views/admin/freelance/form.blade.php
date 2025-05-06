@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-bold mb-6 text-gray-900 dark:text-white">
        {{ isset($isEdit) && $isEdit ? 'Edit Freelance Job' : 'Create Freelance Job' }}
    </h1>

    <form action="#" method="POST" class="space-y-6">
        @csrf
        {{-- Title --}}
        <div>
            <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
            <input type="text" id="title" name="title"
                class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                placeholder="Job title" value="{{ old('title', $freelance['title'] ?? '') }}" required>
        </div>

        {{-- Category --}}
        <div>
            <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
            <input type="text" id="category" name="category"
                class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                placeholder="e.g. Web Development" value="{{ old('category', $freelance['category'] ?? '') }}" required>
        </div>

        {{-- Description --}}
        <div>
            <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
            <textarea id="description" name="description" rows="5"
                class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                placeholder="Describe the job role">{{ old('description', $freelance['description'] ?? '') }}</textarea>
        </div>

        {{-- Status --}}
        <div>
            <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
            <select name="status" id="status"
                class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                <option value="draft" selected>Draft</option>
                <option value="published" {{ (old('status', $freelance['status'] ?? '') === 'published') ? 'selected' : '' }}>
                    Published
                </option>
            </select>
        </div>

        <button type="submit"
            class="text-white bg-blue-600 hover:bg-blue-700 font-medium rounded-lg text-sm px-5 py-2.5">
            {{ isset($isEdit) && $isEdit ? 'Update' : 'Create' }}
        </button>
    </form>
@endsection
