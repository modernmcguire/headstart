@extends('headstart::layouts.admin')

@section('page_title', $entity->resourceName().' Editor')

@section('content')
	<form action="{{ route('headstart::admin.resource.store', ['resource_type' => $entity->resourceType(), 'entity' => $entity]) }}" method="post" enctype="multipart/form-data">
		@csrf

		@component('admin.partials.header')
			@slot('title', $entity->resourceName()." Editor")
			@slot('icon', $entity->resourceIcon())
			@slot('minimal', true)

            <a href="{{ route( $entity->resourceTypePlural() . '.show', $entity) }}" target="_blank" class="btn btn-sm btn-outline-dark"><i class="fa fa-eye"></i> View {{ $entity->resourceName() }}</a>

            @component('admin.partials.save_button')
                @slot('button_text', 'Save ' . $entity->resourceName())
            @endcomponent
		@endcomponent

		<div class="container mt-4">
        	<div class="row">
        	    <div class="col-lg-9">
    	    		<div class="card mb-4">
    	    			<div class="card-header">
    	    				{{ $entity->resourceName() }} Data
    	    			</div>

    	    			<div class="card-body">
    	    				@foreach ($entity->fields() as $field)

    	    					@if ($field['type'] == 'repeater')
    	    						<h4 class="mb-4">{{ $field['title'] }}</h4>

    	    						@if (isset($entity->{$field['slug']}))
    	    							@foreach ($entity->{$field['slug']} as $index => $sub_data)
    	    								<div class="card card-header-actions mb-4 shadow-sm">
    	    									<div class="card-header">
    	    										#{{ $index + 1 }}
    	    										<div>
    	    											<button type="submit" name="data[{{ $field['slug'] }}][__unset]" value="{{ $index }}" class="btn btn-sm btn-outline-danger"><i class="fa fa-trash"></i> Delete {{ Str::singular($field['title']) }}</button>
    	    										</div>
    	    									</div>
    	    									<div class="card-body">
    	    										@foreach ($field['fields'] as $sub_field)
    	    											@include('headstart::admin.partials.block_field', [
                                                            'parent_field' => $field,
    	    												'field' => $sub_field,
    	    												'value' => @$sub_data[$sub_field['slug']],
                                                            'name' => 'data['.$field['slug'].']['.$index.']['.$sub_field['slug'].']',
                                                            'entity' => $entity,
                                                            'block' => null,
    	    											])
    	    										@endforeach
    	    									</div>
    	    								</div>
    	    							@endforeach
    	    						@endif

    	    						<div class="text-right">
    	    							<button type="submit" name="data[{{ $field['slug'] }}][__append]" value="1" class='btn btn-outline-success'><i class="fa fa-plus"></i> Add {{ Str::singular($field['title']) }}</button>
    	    						</div>
    	    					@else
    	    						@include('headstart::admin.partials.block_field', [
    	    							'field' => $field,
    	    							'value' => $entity->{$field['slug']},
    	    							'name' => 'data['.$field['slug'].']',
                                        'entity' => $entity,
                                        'block' => null,
    	    						])
    	    					@endif

    	    				@endforeach
    	    			</div>
    	    		</div>
        	    </div>

        	    <div class="col-lg-3">
                    <div class="nav-sticky">
                        <div class="card">
                            <div class="card-header">Settings</div>
                            <div class="card-body">
                                @component('admin.partials.input', ['errors' => $errors])
                                    @slot('label', 'Visibility')
                                    @slot('name', 'data[status]')
                                    @slot('type', 'select')
                                    @slot('value', $entity->status)
                                    @slot('options', \App\Enums\PageStatus::toSelectArray())
                                @endcomponent

                                @component('admin.partials.save_button')
                                    @slot('button_text', 'Save ' . $entity->resourceName())
                                @endcomponent
                            </div>
                        </div>
                    </div>
        	    </div>
		    </div>
		</div>
	</form>
@endsection

@push('scripts')
<script>
    Livewire.on('selectedMedia', function(attach_to, spot, id) {
        console.log(attach_to, spot, id);
    })
</script>
@endpush
