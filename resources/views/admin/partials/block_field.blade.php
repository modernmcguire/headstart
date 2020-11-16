@php
	$value = @$value;
	$description = $field['description'] ?? null;
    $name = @$name ?: $field['slug'];
@endphp

@if (in_array($field['type'], [
    'text',
    'number',
    'textarea',
    'select',
    'select_multiple',
    'boolean',
    'radio',
]))
	@component('admin.partials.input', ['data' => @$page, 'errors' => $errors])
		@slot('entity', $entity)
		@slot('field', $field)
		@slot('label', $field['title'])
		@slot('name', $name)
		@slot('type', $field['type'])
		@slot('description', $description)
        @slot('value', @$value)
		@slot('options', @$field['options'])
	@endcomponent
@elseif($field['type'] == 'select')
	{{-- @component('admin.partials.select', ['data' => $page, 'errors' => $errors])
		@slot('label', $field['title'])
		@slot('name', $name)
		@slot('description', $description)
		@slot('value', @$value)
    @endcomponent --}}
@elseif($field['type'] == 'media')
    @livewire('admin-media-block', [
        'model' => $entity,
        'parent_field' => @$parent_field,
        'index' => @$index,
        'field' => $field,
        'value' => $value,
        'block' => @$block,
    ], key(time() . $field['slug']))
@elseif($field['type'] == 'group')
    <div class="card shadow-sm my-3">
        <div class="card-header d-flex justify-content-between">
            <span>{{ $field['title'] }}</span>

        </div>

        <div class="card-body">
            @foreach($field['fields'] as $new_field)
                @include('headstart::admin.partials.block_field', [
                    'parent_field' => $field,
                    'field' => $new_field,
                    'value' => @$value[$new_field['slug']],
                    'name' => 'data['.$field['slug'].']['.$new_field['slug'].']',
                    'entity' => $entity,
                    'block' => null,
                ])
            @endforeach
        </div>
    </div>
@else
    @component('admin.partials.alert')
        @slot('type', 'danger')
        @slot('class', 'mb-2')

        Unhandled field type: {{ $field['type'] }}
    @endcomponent
@endif
