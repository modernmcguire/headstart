@extends('headstart::layouts.admin')

@section('content')
	@component('headstart::admin.partials.header')
		@slot('title', "Dashboard")
		@slot('subtitle', env('APP_NAME')." at a glance")
		@slot('icon', "fal fa-heart-rate")
	@endcomponent

	<!-- Main page content-->
	<div class="container mt-n10">
	    <div class="row">
	        <div class="col-xxl-4 col-xl-12 mb-4">
	            <div class="card h-100">
	                <div class="card-body h-100 d-flex flex-column justify-content-center py-5 py-xl-4">
	                    <div class="row align-items-center">
	                        <div class="col-xl-8 col-xxl-12">
	                            <div class="text-center px-4 mb-4 mb-xl-0 mb-xxl-4">
	                                <h1 class="text-primary">Welcome Back!</h1>
	                                <p class="text-gray-700 mb-0">It's time to get started! If you have any questions, don't hesitate to reach out. We're here to help!</p>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
@endsection
