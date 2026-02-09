{{-- Button Component --}}
@props(['href' => null, 'type' => 'button', 'variant' => 'primary', 'class' => ''])

@php
    $baseClasses = 'inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest transition ease-in-out duration-150 focus:outline-none focus:ring-2 focus:ring-offset-2';

    $variantClasses = match($variant) {
        'primary' => 'bg-blue-600 hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:ring-blue-500',
        'secondary' => 'bg-gray-600 hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:ring-gray-500',
        'success' => 'bg-green-600 hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:ring-green-500',
        'warning' => 'bg-yellow-600 hover:bg-yellow-700 focus:bg-yellow-700 active:bg-yellow-900 focus:ring-yellow-500',
        'danger' => 'bg-red-600 hover:bg-red-700 focus:bg-red-700 active:bg-red-900 focus:ring-red-500',
        default => 'bg-blue-600 hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:ring-blue-500'
    };

    $allClasses = $baseClasses . ' ' . $variantClasses . ' ' . $class;
@endphp

@if($href)
    <a href="{{ $href }}" class="{{ $allClasses }}">{{ $slot }}</a>
@else
    <button type="{{ $type }}" class="{{ $allClasses }}">{{ $slot }}</button>
@endif
