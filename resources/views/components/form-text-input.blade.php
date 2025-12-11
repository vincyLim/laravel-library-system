<div class="container mt-2">
    <div>
        <label for="{{ $name }}" class="form-label{{$class}}">{{ $label }}</label>
        <input type="{{$type}}" class="form-control" id="{{ $name }}" name="{{ $name }}"" value="{{$value}}" {{$required}}>
    </div>
</div>