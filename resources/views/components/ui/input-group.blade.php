@props([
    'label' => null,
    'name' => '',
    'type' => '',
    'value' => '',
])
@php
    $id = $attributes->get('id') ?: $name;
@endphp

<div class="space-y-2 mb-2" {{ $attributes }}>
    @if ($label)
        <x-ui.label :id="$id" :label="$label" />
    @endif
    <x-ui.input id="{{ $id }}" name="{{ $name }}" value="{{ $value }}" type="{{ $type }}"
        placeholder="{{ $attributes->get('placeholder') }}" />
    @error($name)
        <p class="text-red-800">{{ $message }}</p>
    @enderror
</div>
