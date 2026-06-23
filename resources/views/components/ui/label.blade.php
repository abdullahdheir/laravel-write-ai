@props([
    'id' => '',
    'label' => '',
])

<label class="{{ $attributes->get('class') ?: 'font-ui-label text-ui-label text-on-surface-variant block' }}"
    for="{{ $id }}">{{ $label }}</label>
