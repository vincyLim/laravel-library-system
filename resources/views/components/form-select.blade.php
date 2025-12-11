<div class="container mt-2">
    <div>
        <label for="{{ $name }}" class="form-label{{$class}}">{{ $label }}</label>
        <select class="form-control {{$selectClass}}" id="{{ $name }}" name="{{ $name }}" {{$required}} {{$selectClass=="formMultiSelect"||$selectClass=="formSelfMultiSelect" ? 'multiple' : ''}}>
            <option value="" disabled></option>            
            {{ $slot }}
        </select>
    </div>
</div>