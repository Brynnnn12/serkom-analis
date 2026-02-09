{{-- Card Component --}}
@props(['title' => null, 'class' => 'bg-white rounded-lg shadow-md p-6'])

<div class="{{ $class }}">
    @if($title)
        <h3 class="text-xl font-semibold mb-4">{{ $title }}</h3>
    @endif
    {{ $slot }}
</div>
