@php
	$slot = trim($slot);
@endphp

<div class="alert alert-{{ @$type ?: 'info' }} alert-icon m-0 {{ @$class }}" role="alert">
    <div class="alert-icon-aside">
        <i class="{{ @$icon ?: 'fa fa-info-circle' }}"></i>
    </div>
    <div class="alert-icon-content">
        @if (@$title)
        	<h5 class="alert-heading m-0">{{ $title }}</h5>
        @endif

        @if ($slot)
        	<div class="mt-1">
        		{{ $slot }}
        	</div>
        @endif
    </div>
</div>