<div class="sidebar sidebar-dark sidebar-fixed border-end" id="sidebar">
    <div class="sidebar-header border-bottom">
        <div class="sidebar-brand">
            {{-- <img src="{{ asset('img/logo.jpg') }}" alt="" width="40">
            <span class="sidebar-brand">Admin Panel</span> --}}
            <svg class="sidebar-brand-full" width="88" height="32" alt="CoreUI Logo">
                <use xlink:href="{{ asset('coreui/assets/brand/coreui.svg#full') }}"></use>
            </svg>
            <svg class="sidebar-brand-narrow" width="32" height="32" alt="CoreUI Logo">
                <use xlink:href="{{ asset('coreui/assets/brand/coreui.svg#signet') }}"></use>
            </svg>
        </div>
        <button class="btn-close d-lg-none" type="button" data-coreui-dismiss="offcanvas" data-coreui-theme="dark"
            aria-label="Close"
            onclick="coreui.Sidebar.getInstance(document.querySelector(&quot;#sidebar&quot;)).toggle()"></button>
    </div>
    <ul class="sidebar-nav" data-coreui="navigation" data-simplebar="">
        <li class="nav-item"><a class="nav-link" href="{{ route('admin.dashboard') }}">
                <svg class="nav-icon">
                    <use xlink:href="{{ asset('coreui/vendors/@coreui/icons/svg/free.svg#cil-speedometer') }}"></use>
                </svg> Dashboard</a></li>
        {{-- </svg> Dashboard<span class="badge badge-sm bg-info ms-auto">NEW</span></a></li> --}}

        <li class="nav-item"><a class="nav-link" href="{{ route('admin.categories') }}">
                <svg class="nav-icon">
                    <use xlink:href="{{ asset('coreui/vendors/@coreui/icons/svg/free.svg#cil-list') }}"></use>
                </svg> Categories</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('admin.events') }}">
                <svg class="nav-icon">
                    <use xlink:href="{{ asset('coreui/vendors/@coreui/icons/svg/free.svg#cil-calendar') }}"></use>
                </svg> Events</a></li>

        <li class="nav-item"><a class="nav-link" href="{{ route('admin.donations') }}">
                <svg class="nav-icon">
                    <use xlink:href="{{ asset('coreui/vendors/@coreui/icons/svg/free.svg#cil-heart') }}"></use>
                </svg> Donations</a></li>

        <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
                <svg class="nav-icon">
                    <use xlink:href="{{ asset('coreui/vendors/@coreui/icons/svg/free.svg#cil-info') }}"></use>
                </svg> Info Pages</a>
            <ul class="nav-group-items compact">
                <li class="nav-item"><a class="nav-link" href="{{ route('admin.info-pages.aboutus') }}"><span
                            class="nav-icon"><span class="nav-icon-bullet"></span></span> About Us</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('admin.info-pages.ourpurpose') }}"><span
                            class="nav-icon"><span class="nav-icon-bullet"></span></span> Our Purpose</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('admin.info-pages.contactus') }}"><span
                            class="nav-icon"><span class="nav-icon-bullet"></span></span> Contact Us</a></li>
            </ul>
        </li>
        <li class="nav-item"><a class="nav-link" href="{{ route('admin.users') }}">
                <svg class="nav-icon">
                    <use xlink:href="{{ asset('coreui/vendors/@coreui/icons/svg/free.svg#cil-people') }}"></use>
                </svg> Users</a></li>

        <li class="nav-title">Category Posts</li>
        <li class="nav-item"><a class="nav-link" href="{{ route('admin.topics.index') }}">
                <svg class="nav-icon">
                    <use xlink:href="{{ asset('coreui/vendors/@coreui/icons/svg/free.svg#cil-list') }}"></use>
                </svg> Topics</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('admin.category.posts.index') }}">
                <svg class="nav-icon">
                    <use xlink:href="{{ asset('coreui/vendors/@coreui/icons/svg/free.svg#cil-list-rich') }}"></use>
                </svg> All Posts</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('admin.category.posts.comments') }}">
                <svg class="nav-icon">
                    <use xlink:href="{{ asset('coreui/vendors/@coreui/icons/svg/free.svg#cil-comment-bubble') }}">
                    </use>
                </svg> Comments</a></li>

        <li class="nav-title">Groups</li>
        <li class="nav-item"><a class="nav-link" href="{{ route('admin.group.index') }}">
                <svg class="nav-icon">
                    <use xlink:href="{{ asset('coreui/vendors/@coreui/icons/svg/free.svg#cil-address-book') }}"></use>
                </svg> All Groups</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('admin.group.join.request') }}">
                <svg class="nav-icon">
                    <use xlink:href="{{ asset('coreui/vendors/@coreui/icons/svg/free.svg#cil-envelope-open') }}"></use>
                </svg> Join Requests</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('admin.group.comments') }}">
                <svg class="nav-icon">
                    <use xlink:href="{{ asset('coreui/vendors/@coreui/icons/svg/free.svg#cil-comment-bubble') }}">
                    </use>
                </svg> Comments</a></li>
    </ul>
    <div class="sidebar-footer border-top d-none d-md-flex">
        <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>
    </div>
</div>
