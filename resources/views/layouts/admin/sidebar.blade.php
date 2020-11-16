<div id="layoutSidenav_nav">
    <nav class="sidenav shadow-right sidenav-light">
        <div class="sidenav-menu">
            <div class="nav accordion pt-4" id="accordionSidenav">
                <a class="nav-link" href="{{ route('dashboard.show') }}">
                    <div class="nav-link-icon"><i class="fal fa-fw fa-heart-rate"></i></div> Dashboard
                </a>

                <div class="sidenav-menu-heading">Content</div>

                <a class="nav-link" href="{{-- route('admin.page.list') --}}">
                    <div class="nav-link-icon"><i class="fal fa-fw fa-file-alt"></i></div> Pages
                </a>

                @foreach (Headstart::getResources() as $resource)
                    <a class="nav-link" href="{{ route('admin.resource.list', ['resource_type' => $resource['slug']]) }}">
                        <div class="nav-link-icon"><i class="fal fa-fw {{ $resource['icon'] }}"></i></div> {{ $resource['name_plural'] }}
                    </a>
                @endforeach

                <a class="nav-link" href="{{-- route('admin.media.show') --}}">
                    <div class="nav-link-icon"><i class="fal fa-fw fa-images"></i></div> Media
                </a>

                <div class="sidenav-menu-heading">Data</div>

                <a class="nav-link" href="{{-- route('admin.forms.allSubmissions') --}}">
                    @php $new_submissions = ModernMcGuire\Headstart\Models\FormSubmission::whereStatus('New')->count(); @endphp
                    <div class="nav-link-icon"><i class="fal fa-fw fa-user"></i></div> Form Submissions <span class="badge badge-danger" style="position: relative; top: -5px; left: 3px;">{{ $new_submissions > 0 ? $new_submissions : '' }}</span>
                </a>
            </div>
        </div>

        <div class="sidenav-footer">
            <div class="sidenav-footer-content w-100">
                <a href="{{-- route('page.home') --}}" class="btn w-100 btn-light">Return to Site</a>
            </div>
        </div>
    </nav>
</div>
