@extends('headstart::layouts.admin')

@section('page_title', 'Pages')

@section('content')
	@component('admin.partials.header')
		@slot('title', "Pages")
		@slot('subtitle', "Manage the basic content on your site")
		@slot('icon', "fal fa-file-alt")

		<a href="{{ route('headstart::admin.page.create') }}" class="btn btn-white"><i class="fa fa-plus"></i> New Page</a>
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
	        	                        <th>Title</th>
	        	                        <th>Author</th>
	        	                        <th>Status</th>
	        	                        <th>Actions</th>
	        	                    </tr>
	        	                </thead>
	        	                <tbody>
	        	                	@foreach ($pages as $page)
	        	                		<tr>
	        	                		    <td><a href='{{ route('headstart::admin.page.edit', [$page]) }}'>{{ $page->title }}</a></td>
	        	                		    <td>{{ $page->author->name }}</td>
	        	                		    <td>{{ ucfirst($page->status) }}</td>
	        	                		    <td>
	        	                		        <a href="{{ route('page.show', $page->slug) }}" class="btn btn-datatable btn-icon btn-transparent-dark mr-2" target="_blank"><i class="fa fa-eye"></i></a>
	        	                		        <a href="{{ route('headstart::admin.page.edit', [$page]) }}" class="btn btn-datatable btn-icon btn-transparent-dark mr-2"><i class="fa fa-edit"></i></a>
	        	                		        <a href="{{ route('headstart::admin.page.destroy', [$page]) }}" class="btn btn-datatable btn-icon btn-transparent-dark" onclick="window.confirm('Are you sure you want to delete this page?')"><i class="fa fa-trash"></i></a>
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
                dom: "<'row'<'col-sm-3'l><'col-sm-3'f><'col-sm-6'p>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            });
		});
	</script>
@endpush
