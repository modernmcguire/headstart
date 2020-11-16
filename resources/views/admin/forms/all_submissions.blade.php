@extends('headstart::layouts.admin')

@section('page_title', 'Form Submissions')

@section('content')
	@component('admin.partials.header')
		@slot('title', 'Form Submissions')
		@slot('icon', 'fal fa-clipboard-list-check')
	@endcomponent

	<div class="container mt-n10">
	    <div class="row">
	        <div class="col">
	        	<div class="card mb-4">
	        	    <div class="card-body">
	        	        <div class="datatable">
	        	            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
	        	                <thead>
	        	                    <tr>
	        	                        <th>Date</th>
	        	                        <th>Form</th>
	        	                        <th>Status</th>
	        	                        <th>Actions</th>
	        	                    </tr>
	        	                </thead>
	        	                <tbody>
	        	                	@foreach ($submissions as $submission)
	        	                		<tr>
	        	                		    <td>
                                                <a href='{{ route('headstart::admin.forms.show.submission', ['form' => $submission->form, 'submission' => $submission]) }}'>
                                                    @if ( now()->diffInHours() <= 12 )
                                                        <span title="{{ carbon($submission->created_at->setTimezone('America/Los_Angeles'), 'm/d/Y h:i A T') }}">{{ $submission->created_at->setTimezone('America/Los_Angeles')->diffForHumans() }}</span>
                                                    @else
                                                        {{ carbon($submission->created_at->setTimezone('America/Los_Angeles'), 'm/d/Y h:i A T') }}
                                                    @endif
                                                </a>
                                            </td>
                                            <td>
                                                {{ $submission->form->name }}
                                                {{-- <a href="{{ route('headstart::admin.forms.show', ['form' => $submission->form]) }}" class="btn btn-datatable btn-icon btn-transparent-dark mr-2"><i class="fa fa-external-link"></i></a> --}}
                                            </td>
	        	                		    <td>{{ $submission->status }}</td>

	        	                		    <td>
	        	                		        <a href="{{ route('headstart::admin.forms.show.submission', ['form' => $submission->form, 'submission' => $submission]) }}" class="btn btn-datatable btn-icon btn-transparent-dark mr-2"><i class="fa fa-eye"></i></a>
	        	                		        {{-- <a href="#" class="btn btn-datatable btn-icon btn-transparent-dark"><i class="fa fa-trash"></i></a> --}}
	        	                		    </td>
	        	                		</tr>
	        	                	@endforeach
	        	                </tbody>
                            </table>

                            {{ $submissions->links() }}
	        	        </div>
	        	    </div>
	        	</div>
	        </div>
	    </div>
	</div>
@endsection

@push('scripts')
	<script>
		$(document).ready(function() {
		    $('#dataTable').DataTable({
                pageLength: 25,
                dom: "<'row'<'col-sm-3'l><'col-sm-3'f><'col-sm-6'p>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
		    });
		});
	</script>
@endpush
