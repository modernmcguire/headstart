@php
	$placeholder = @$placeholder ?: null;
    $value = @$value ?: optional(@$data)->$name;
    $field_dot_notation = str_replace('[', '.', str_replace(']', '', $name));
    $id = uniqid();
@endphp

<div class="form-group">
	<label for="{{ $name }}">{{ $label }}</label>

	@if ($type == 'text')
		<input class="form-control" id="{{ $name }}" type="{{ $type }}" name="{{ $name }}" placeholder="{{ @$placeholder }}" value="{{ old($name, $value) }}">
    @elseif($type == 'number')
        <input class="form-control" id="{{ $name }}" type="number" name="{{ $name }}" value="{{ old($name, $value) }}"
        @isset($field['min']) min="{{ $field['min'] }}" @endisset
        @isset($field['max']) max="{{ $field['max'] }}" @endisset
        @isset($field['step']) step="{{ $field['step'] }}" @endisset
        @isset($placeholder) placeholder="{{ $placeholder }}" @endisset
        @isset($field['placeholder']) placeholder="{{ $field['placeholder'] }}" @endisset
        >
	@elseif($type == 'textarea')
		<textarea class="form-control" id="{{ $name }}" rows="5" name="{{ $name }}"@if ($placeholder) placeholder="{{ $placeholder }}" @endif>{{ old($name, $value) }}</textarea>
    @elseif($type == 'select')
        @isset($options)
            <select class="form-control" id="{{ $name }}" name="{{ $name }}">
                @foreach($options as $option_value => $option)
                    <option value="{{ $option_value }}" {{ old($name, $value) != null && $option_value == old($name, $value) ? 'selected' : '' }}>{{ $option }}</option>
                @endforeach
            </select>
        @endisset
    @elseif($type == 'select_multiple')
        @php
        $uniqid = uniqid();
        @endphp
        @isset($options)
            <select class="selectize-{{ $uniqid }}" id="{{ $name }}" name="{{ $name }}[]" multiple>
                @foreach($options as $option_value => $option)
                    <option value="{{ $option_value }}" {{ in_array($option_value, old($name, $value) ?? []) ? 'selected' : '' }}>{{ $option }}</option>
                @endforeach
            </select>

            @push('scripts')
            <script>
                $(document).ready(function(){

                    $('select.selectize-{{ $uniqid }}').selectize({
                        @isset($field['max'])
                            maxItems: {{ $field['max'] }},
                        @endisset
                        @isset($field['create'])
                            create: {{ $field['create'] }},
                        @endisset
                    });
                });
            </script>
            @endpush
        @endisset
    @elseif($type == 'boolean')
        <div class="custom-control custom-checkbox">
            <input class="custom-control-input" id="checkbox-{{ $name }}" type="checkbox" name="{{ $name }}" {{ checked(old($name, $value), true) }} value="{{ $field['options']['value'] ?? 'on' }}">
            <label class="custom-control-label" for="checkbox-{{ $name }}">{{ $options['label'] ?? 'True' }}</label>
        </div>
    @elseif($type == 'radio')
        @isset($options)
            @foreach($options as $option_value => $option)
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" type="radio" id="radio-{{ $id }}-{{ $option_value }}" name="{{ $name }}" value="{{ $option_value }}" {{ checked($option_value, old($name, $value)) }}>
                    <label class="custom-control-label" for="radio-{{ $id }}-{{ $option_value }}">{{ $option }}</label>
                </div>
            @endforeach
        @endisset
    @else
        @component('admin.partials.alert')
            @slot('type', 'danger')

            Unhandled field type: {{ $type }}
        @endcomponent
    @endif

    @error($field_dot_notation, $error_bag ?? null)
        <div class="invalid-feedback" role="alert">{{ $message }}</div>
    @enderror

	@if (@$description)
		<small class="form-text text-muted">{{ $description }}</small>
	@endif
</div>

