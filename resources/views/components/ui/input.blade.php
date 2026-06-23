@props([
    'label' => null,
    'name' => '',
    'type' => '',
    'value' => '',
])
@php
    $id = $attributes->get('id') ?: $name;
    $classes =
        $attributes->get('class') ?:
        'w-full h-12 px-4 bg-surface-bright border border-outline-variant rounded focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-all font-ui-label text-on-surface placeholder:text-outline';
@endphp

<input {{ $attributes }} class="{{ $classes }}" id="{{ $id }}" name="{{ $name }}"
    value="{{ $value }}" type="{{ $type }}" />
