@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-2 border-green-200 focus:border-green-500 focus:ring-green-500 rounded-lg shadow-sm']) }}>
