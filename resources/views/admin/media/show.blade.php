@php
use Spatie\MediaLibrary\MediaCollections\Models\Media;
@endphp

@extends('headstart::layouts.admin')

@section('content')
	{{-- @component('admin.partials.header')
		@slot('title', "Dashboard")
		@slot('subtitle', env('APP_NAME')." at a glance")
		@slot('icon', "fal fa-heart-rate")
	@endcomponent --}}

	<!-- Main page content-->
	<div class="container-fluid mt-3">
	    <div class="row">
	        <div class="col mb-4">
                @livewire('media-library')
	        </div>
	    </div>
	</div>
@endsection
