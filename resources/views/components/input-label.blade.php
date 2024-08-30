{{-- @props：値を受け取る --}}
@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-gray-700']) }}>
    {{-- valueを渡す --}}
    {{ $value ?? $slot }}
</label>
