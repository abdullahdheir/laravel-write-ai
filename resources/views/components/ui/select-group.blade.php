@props([
    'label' => null,
    'name' => '',
    'value' => '',
    'multiple' => false,
    'options' => [],
])
@php
    $id = $attributes->get('id') ?: $name;
@endphp

<div class="space-y-2 mb-2" {{ $attributes }}>
    @if ($label)
        <x-ui.label :id="$id" :label="$label" />
    @endif
    <x-ui.select id="{{ $id }}" name="{{ $name }}" value="{{ old($name, $value) }}" :multiple="$multiple" :options="$options" />
    @error($name)
        <p class="text-red-800">{{ $message }}</p>
    @enderror
</div>
