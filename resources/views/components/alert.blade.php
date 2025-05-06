@props(['type' => 'info', 'message'])

@php
    $alertClasses = [
        'success' => 'bg-green-100 text-green-800 border-green-400',
        'error' => 'bg-red-100 text-red-800 border-red-400',
        'info' => 'bg-blue-100 text-blue-800 border-blue-400',
        'warning' => 'bg-yellow-100 text-yellow-800 border-yellow-400',
    ];
@endphp

@if (session($type))
    <div
        class="flex items-center p-4 mb-4 text-sm border rounded-lg {{ $alertClasses[$type] ?? $alertClasses['info'] }}">
        @if ($type === 'success')
            <i class="w-5 h-5 mr-2 bi bi-check-circle-fill"></i>
        @elseif($type === 'error')
            <i class="w-5 h-5 mr-2 bi bi-exclamation-circle-fill"></i>
        @elseif($type === 'info')
            <i class="w-5 h-5 mr-2 bi bi-info-circle-fill"></i>
        @elseif($type === 'warning')
            <i class="w-5 h-5 mr-2 bi bi-exclamation-triangle-fill"></i>
        @endif
        <div>
            <strong>{{ ucfirst($type) }}:</strong> {{ session($type) }}
        </div>
    </div>
@endif
