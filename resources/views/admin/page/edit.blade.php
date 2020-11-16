@php
	use App\Enums\PageStatus;
@endphp

@extends('headstart::layouts.admin')

@section('page_title', 'Edit Page: '.$page->title)

@php
	if ($errors->content->any()) {
		$active_tab = 'content';
	}
@endphp

@section('content')
	<form action="{{ route('headstart::admin.page.store', [$page]) }}" method="post">
		@csrf

		@component('admin.partials.header')
			@slot('title', "Page Editor")
			@slot('icon', "fal fa-file-alt")
			@slot('minimal', true)

			<a href="{{ route('page.show', [$page]) }}" target="_blank" class="btn btn-sm btn-outline-dark"><i class="fa fa-eye"></i> View Page</a>

			@component('admin.partials.save_button')
			    @slot('button_text', 'Save Page')
			@endcomponent
		@endcomponent

		<input type="hidden" name="active_tab" value="{{ $active_tab }}">

		<div class="container mt-4">
			<div class="row">
				<div class="col">
					<div class="card card-body mb-4">
						<ul class="nav nav-pills card-header-pills" id="cardPill" role="tablist">
				            <li class="nav-item">
				            	<a class="nav-link{{ $active_tab == 'settings' ? ' active' : null }}" id="settings-pill" href="#settings" data-toggle="tab" role="tab" aria-controls="settings" aria-selected="true">
				            		Settings
				            	</a>
				            </li>
				            <li class="nav-item">
				            	<a class="nav-link{{ $active_tab == 'layout' ? ' active' : null }}" id="layout-pill" href="#layout" data-toggle="tab" role="tab" aria-controls="layout" aria-selected="false">
				            		Layout
				            	</a>
				            </li>
				            <li class="nav-item" @if (!$page->canEditBlocks()) data-toggle="tooltip" data-placement="top" data-original-title='Click "Layout" to add a block to this page first.' @endif>
				            	<a
				            		class="nav-link {{ $active_tab == 'content' ? ' active' : null }} {{ !$page->canEditBlocks() ? ' disabled' : null }}"
				            		id="content-pill"
				            		href="#content"
				            		aria-controls="content"
				            		aria-selected="false"
				            		@if ($page->canEditBlocks())
				            			data-toggle="tab" role="tab"
				            		@endif
				            	>
				            		Content
				            	</a>
				            </li>
				        </ul>
					</div>
				</div>
			</div>

			<div class="tab-content" id="cardPillContent">
		        <div class="tab-pane fade{{ $active_tab == 'settings' ? ' show active' : null }}" id="settings" role="tabpanel" aria-labelledby="settings-pill">
		        	<div class="row">
		        		<div class="col">
		        			<div class="card">
		        				<div class="card-body">
	        						@component('admin.partials.input', ['data' => $page, 'errors' => $errors, 'error_bag' => 'settings'])
	        							@slot('label', "Page Title")
	        							@slot('name', "title")
	        							@slot('type', "text")
	        						@endcomponent

	        						@component('admin.partials.input', ['data' => $page, 'errors' => $errors, 'error_bag' => 'settings'])
	        							@slot('label', "URL Slug")
	        							@slot('name', "slug")
	        							@slot('type', "text")
	        						@endcomponent

	        						@component('admin.partials.input', ['data' => $page, 'errors' => $errors, 'error_bag' => 'settings'])
	        							@slot('label', "Visibility")
	        							@slot('name', "status")
	        							@slot('type', "radio")
	        							@slot('options', array_flip(PageStatus::toArray()))
	        						@endcomponent
		        				</div>
		        			</div>
		        		</div>
		        	</div>
		        </div> {{-- / settings pane --}}

    	        <div class="tab-pane fade{{ $active_tab == 'layout' ? ' show active' : null }}" id="layout" role="tabpanel" aria-labelledby="layout-pill">
    	        	<div class="row">
    	        		<div class="col">
    	        			<div class="card">
    	        				<div class="card-header">
    	        					Available Blocks
    	        				</div>
    	        				<div class="card-body">
    	        					@foreach ($page->getBlocks() as $block)
    	        						<div class="bg-light border-left border-left-lg rounded border-gray-700 p-3 my-1 d-flex justify-content-between align-items-center">
    	        							<span>{{ $block['title'] }}</span>
    	        							<button type="submit" name="attach_block" value="{{ $block['name'] }}" class="btn btn-sm btn-outline-success"><i class="fa fa-plus"></i> Add to Page</button>
    	        						</div>
    	        					@endforeach
    	        				</div>
    	        			</div>
    	        		</div>
    	        		<div class="col">
    	        			<div class="card">
    	        				<div class="card-header">This Page's Blocks</div>
    	        				<div class="card-body">
    	        					@if ($page->contentBlocks->count())
    	        						@foreach ($page->contentBlocks as $block)
    	        							<div class="bg-light border-left border-left-lg rounded {{ $block->enabled ? 'border-success' : 'border-gray-700' }} p-3 my-1 d-flex justify-content-between align-items-center">
    	        								<span>
    	        									{{ $block->getInfo('title') }}
    	        									@if (!$block->enabled)
    	        										<h5 class="m-0 text-uppercase-expanded text-xs text-gray-500">Disabled</h5>
    	        									@endif
    	        								</span>
    	        								<div class="d-flex flex-row">
    	        									<input type="text" name="blocks[{{ $block->uuid }}][sort_order]" value="{{ $block->sort_order }}" class="form-control text-center mr-2" style='width: 70px' data-toggle="tooltip" data-placement="top" data-original-title="Display Order">

    	        									<div class="bg-gray-200 rounded px-3 mr-2 d-flex align-items-center">
    	        										<div class="custom-control custom-checkbox">
    	        										    <input class="custom-control-input" id="enabled_{{ $block->uuid }}" type="checkbox" value="1" name="blocks[{{ $block->uuid }}][enabled]" {{ checked(true, $block->enabled) }}>
    	        										    <label class="custom-control-label text-dark" for="enabled_{{ $block->uuid }}">Enabled</label>
    	        										</div>
    	        									</div>

    	        									<button type="submit" name="detach_block" value="{{ $block->uuid }}" class="btn btn-sm btn-outline-danger"><i class="fa fa-trash"></i> Delete</button>
    	        								</div>
    	        							</div>
    	        						@endforeach

    	        						@component('admin.partials.alert')
    	        							@slot('class', 'mt-4')

    	        							Any numbers entered in the "Display Order" field will be used to change the order the blocks appear on the page.
    	        						@endcomponent
    	        					@else
    	        						@component('admin.partials.alert')
    	        							@slot('title', "There aren't any blocks on this page yet.")

    	        							Choose one in the Available Sections panel to the left.
    	        						@endcomponent
    	        					@endif

    	        				</div>
    	        			</div>
    	        		</div>
    	        	</div>
    	        </div> {{-- / settings pane --}}

		        <div class="tab-pane fade{{ $active_tab == 'content' ? ' show active' : null }}" id="content" role="tabpanel" aria-labelledby="content-pill">

		        	<div class="row">

		        	    <div class="col-lg-9">
		        	    	@foreach ($page->contentBlocks as $block)
		        	    		<div class="card card-header-actions mb-4" id="block_{{ $block->uuid }}">
		        	    			<div class="card-header">
		        	    				{{ $block->getInfo('title') }}
		        	    			</div>
		        	    			<div class="card-body">
		        	    				@foreach ($block->getInfo('fields') as $field)

		        	    					@if ($field['type'] == 'repeater')
		        	    						<h4 class="mb-4">{{ $field['title'] }}</h4>

		        	    						@if (isset($block->data[$field['slug']]))
		        	    							@foreach ($block->data[$field['slug']] as $index => $sub_data)
		        	    								<div class="card card-header-actions mb-4 shadow-sm">
		        	    									<div class="card-header">
		        	    										{{ Str::singular($field['title']) }} #{{ $index + 1 }}
		        	    										<div>
		        	    											<button type="submit" name="blocks[{{ $block->uuid }}][data][{{ $field['slug'] }}][__unset]" value="{{ $index }}" class="btn btn-sm btn-outline-danger"><i class="fa fa-trash"></i> Delete {{ Str::singular($field['title']) }}</button>
		        	    										</div>
		        	    									</div>
		        	    									<div class="card-body">
		        	    										@foreach ($field['fields'] as $sub_field)
		        	    											@include('headstart::admin.partials.block_field', [
                                                                        'parent_field' => $field,
                                                                        'index' => $index,
		        	    												'field' => $sub_field,
		        	    												'value' => @$sub_data[$sub_field['slug']],
                                                                        'name' => 'blocks['.$block->uuid.'][data]['.$field['slug'].']['.$index.']['.$sub_field['slug'].']',
                                                                        'entity' => @$page,
                                                                        'block' => $block,
		        	    											])
		        	    										@endforeach
		        	    									</div>
		        	    								</div>
		        	    							@endforeach
		        	    						@endif

		        	    						<div class="text-right">
		        	    							<button type="submit" name="blocks[{{ $block->uuid }}][data][{{ $field['slug'] }}][__append]" value="1" class='btn btn-outline-success'><i class="fa fa-plus"></i> Add {{ Str::singular($field['title']) }}</a>
		        	    						</div>
		        	    					@else
		        	    						@include('headstart::admin.partials.block_field', [
		        	    							'field' => $field,
		        	    							'value' => optional($block->data)[$field['slug']],
                                                    'name' => 'blocks['.$block->uuid.'][data]['.$field['slug'].']',
                                                    'entity' => @$page,
                                                    'block' => $block,
		        	    						])
		        	    					@endif

		        	    				@endforeach
		        	    			</div>
		        	    		</div>
		        	    	@endforeach
		        	    </div>

		        	    <div class="col-lg-3">
		        	        <div class="nav-sticky">
		        	            <div class="card">
		        	            	<div class="card-header">
		        	            		Quick Navigation
		        	            	</div>
		        	                <div class="card-body">
		        	                	<ul class="nav flex-column" id="stickyNav">
		        	                    	@foreach ($page->contentBlocks as $block)
		        	                    		<li class="nav-item">
		        	                    		    <a class="nav-link px-0" href="#block_{{ $block->uuid }}">{{ $block->getInfo('title') }}</a>
		        	                    		</li>
		        	                    	@endforeach
		        	                    </ul>

		        	                    <hr>

		        	                    @component('admin.partials.save_button')
		        	                        @slot('button_text', 'Save Page')
		        	                    @endcomponent
		        	                </div>
		        	            </div>
		        	        </div>
		        	    </div>
		        	    {{-- End sidebar --}}
		        	</div>

		        </div>
		    </div>
		</div>
	</form>
@endsection

@push('scripts')
	<script>
		$(document).ready(function() {
			$(document).on('show.bs.tab', function(e) {
				// console.log(e.target);
				$('input[name="active_tab"]').val($(e.target).attr('aria-controls'));
			})
		});

        $(function(){
            var hash = window.location.hash;
            hash && $('ul.nav a[href="' + hash + '"]').tab('show');

            $('.nav-tabs a').click(function (e) {
                $(this).tab('show');
                var scrollmem = $('body').scrollTop() || $('html').scrollTop();
                window.location.hash = this.hash;
                $('html,body').scrollTop(scrollmem);
            });
        });
	</script>
@endpush
