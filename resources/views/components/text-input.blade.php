@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border border-gray-200 focus:border-gray-300
focus:ring-gray-600 rounded-md shadow-sm transition-all duration-300 px-4 py-3 w-full']) }}>