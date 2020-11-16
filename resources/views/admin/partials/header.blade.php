@php
    $minimal = $minimal ?? false;
@endphp

@if ($minimal)
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-fluid">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            @if (@$icon)
                                <div class="page-header-icon"><i class="{{ $icon }}"></i></div>
                            @endif
                            
                            {{ $title }}
                        </h1>
                    </div>

                    <div class="col-12 col-xl-auto mb-3">{{ $slot }}</div>
                </div>
            </div>
        </div>
    </header>
@else
    <header class="page-header page-header-dark bg-gradient-primary pb-10">
        <div class="container">
            <div class="page-header-content pt-4">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto mt-4">
                        <h1 class="page-header-title">
                            @if (@$icon)
                                <div class="page-header-icon"><i class="{{ $icon }}"></i></div>
                            @endif
                            
                            {{ $title }}
                        </h1>

                        @if (@$subtitle)
                            <div class="page-header-subtitle">{{ $subtitle }}</div>
                        @endif
                    </div>

                    <div class="col-12 col-xl-auto mt-4">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
    </header>
@endif

