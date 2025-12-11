@props(['name', 'label'])

<div class="container mt-2">
    <label for="{{ $name }}">{{ $label }}</label>
    <textarea name="{{ $name }}" id="{{ $name }}" class="form-control" rows="4">{{ $slot }}</textarea>
</div>