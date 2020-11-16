@extends('headstart::layouts.admin')

@section('page_title', 'Form Submissions')

@section('content')
	@component('admin.partials.header')
		@slot('title', 'Submission')
		@slot('icon', 'fal fa-clipboard-list-check')
	@endcomponent

	<div class="container mt-n10">
	    <div class="row">
	        <div class="col">
	        	<div class="card mb-4">
	        	    <div class="card-body">
                        Submitted On: {{ $submission->created_at->format('m/d/Y h:i A') }}<br />
                        Status: {{ $submission->status }}<br />

                        <table class="table mt-4">
                            <thead>
                                <tr>
                                    <th>Field</th>
                                    <th>Value</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($submission->data as $field => $value)
                                    <tr>
                                        <td>{{ ucwords($field) }}</td>
                                        <td>{{ $value }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
	        	    </div>
	        	</div>
	        </div>
	    </div>
	</div>
@endsection

@push('scripts')
	<script>
		$(document).ready(function() {

		});
	</script>
@endpush
