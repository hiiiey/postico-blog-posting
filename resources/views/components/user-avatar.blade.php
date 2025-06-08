@props(['user', 'size' => 'w-12 h-12', 'class' => 'mr-2'])

@if($user->imageUrl())
<img src="{{ $user->imageUrl() }}" alt="{{ $user->name }}" class="{{ $size }} rounded-full object-cover {{ $class }}">
@else
<div class="{{ $size }} rounded-full flex items-center justify-center text-white font-medium {{ $class }}"
    style="background-color: {{ '#' . substr(md5($user->email), 0, 6) }}; font-size: calc({{ (int)substr($size, 2, 2) }}px * 0.4)">
    {{ strtoupper(substr($user->name, 0, 1)) }}
</div>
@endif