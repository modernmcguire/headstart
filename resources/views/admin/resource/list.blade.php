@extends('headstart::layouts.admin')

@section('page_title', $resource->resourceName())

@section('content')
	@component('admin.partials.header')
		@slot('title', $resource->resourceNamePlural())
		@slot('icon', $resource->resourceIcon())

		<a href="{{ route('headstart::admin.resource.create', ['resource_type' => $resource->resourceType()]) }}" class="btn btn-white"><i class="fa fa-plus"></i> New {{ $resource->resourceName() }}</a>
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
	        	                        <th>Name</th>
	        	                        <th>Created By</th>
	        	                        <th>Status</th>
	        	                        <th>Actions</th>
	        	                    </tr>
	        	                </thead>
	        	                <tbody>
	        	                	@foreach ($entities as $entity)
	        	                		<tr>
	        	                		    <td><a href='{{ route('headstart::admin.resource.edit', ['resource_type' => $resource->resourceType(), 'entity' => $entity]) }}'>{{ $entity->title }}</a></td>
	        	                		    <td>{{ $entity->user->name }}</td>
	        	                		    <td>{{ ucfirst($entity->status) }}</td>
	        	                		    <td>
	        	                		        <a href="{{ route('headstart::admin.resource.edit', ['resource_type' => $resource->resourceType(), 'entity' => $entity]) }}" class="btn btn-datatable btn-icon btn-transparent-dark mr-2"><i class="fa fa-edit"></i></a>
	        	                		        <a href="{{ route('headstart::admin.resource.destroy', ['resource_type' => $resource->resourceType(), 'entity' => $entity]) }}" class="btn btn-datatable btn-icon btn-transparent-dark" onclick="window.confirm('Are you sure you want to delete this {{ strtolower($resource->resourceType()) }}?')"><i class="fa fa-trash text-danger"></i></a>
	        	                		    </td>
	        	                		</tr>
	        	                	@endforeach
	        	                </tbody>
	        	            </table>
	        	        </div>
	        	    </div>
	        	</div>
	        </div>
	    </div>
	</div>
@endsection

@styles('https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css')
@scripts('https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js')
@scripts('https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js')

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
