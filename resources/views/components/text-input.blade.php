{{-- @props：値を受け取る --}}
@props(['disabled' => false])
{{-- valueを渡す --}}
<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm']) !!}>
