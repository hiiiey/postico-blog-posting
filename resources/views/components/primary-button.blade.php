@props(['href' => null])

@if ($href)
<a href="{{ $href }}" {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center
    rounded-md font-medium ring-offset-background transition-all duration-300 focus-visible:outline-none
    focus-visible:ring-2
    focus-visible:ring-gray-400 focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-gray-900
    hover:bg-gray-800 text-white border-0 px-8 py-3 text-base group shadow-md hover:shadow-lg transform
    hover:-translate-y-0.5']) }}>
    {{ $slot }}
    <span class="ml-2 group-hover:translate-x-1 transition-transform duration-300">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5">
            <path d="M5 12h14"></path>
            <path d="m12 5 7 7-7 7"></path>
        </svg>
    </span>
</a>
@else
<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center rounded-md
    font-medium ring-offset-background transition-all duration-300 focus-visible:outline-none focus-visible:ring-2
    focus-visible:ring-gray-400 focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-gray-900
    hover:bg-gray-800 text-white border-0 px-8 py-3 text-base group shadow-md hover:shadow-lg transform
    hover:-translate-y-0.5']) }}>
    {{ $slot }}
    <span class="ml-2 group-hover:translate-x-1 transition-transform duration-300">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5">
            <path d="M5 12h14"></path>
            <path d="m12 5 7 7-7 7"></path>
        </svg>
    </span>
</button>
@endif