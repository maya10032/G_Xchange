{{-- @props：値を受け取る --}}
@props(['messages'])

@if ($messages)
    <ul {{ $attributes->merge(['class' => 'text-sm text-red-600 space-y-1']) }}>
        @foreach ((array) $messages as $message)
            {{-- messagesを渡す --}}
            <li>{{ $message }}</li>
        @endforeach
    </ul>
@endif
