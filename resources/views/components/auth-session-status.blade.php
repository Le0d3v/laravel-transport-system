@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'text-sm text-green-700 space-y-1 p-3 bg-green-300 border-l-4 border-green-700 font-bold rounded']) }}>
        {{ $status }}
    </div>
@endif
