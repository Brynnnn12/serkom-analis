{{-- Button Component --}}
@props(['href' => null, 'type' => 'button', 'class' => 'bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded'])

@if($href)
    <a href="{{ $href }}" class="{{ $class }}">{{ $slot }}</a>
@else
    <button type="{{ $type }}" class="{{ $class }}">{{ $slot }}</button>
@endif
