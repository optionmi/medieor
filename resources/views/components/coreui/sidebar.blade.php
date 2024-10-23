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

        @if (!$user->hasRestriction('can_manage_categories'))
            <li class="nav-item"><a class="nav-link" href="{{ route('admin.categories.index') }}">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('coreui/vendors/@coreui/icons/svg/free.svg#cil-list') }}"></use>
                    </svg> Categories<span
                        class="badge badge-sm bg-info ms-auto">{{ $newCategoriesCount != 0 ?? $newCategoriesCount }}</span></a>
            </li>
        @endif

        @if (!$user->hasRestriction('can_manage_events'))
            <li class="nav-item"><a class="nav-link" href="{{ route('admin.events') }}">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('coreui/vendors/@coreui/icons/svg/free.svg#cil-calendar') }}"></use>
                    </svg> Events<span
                        class="badge badge-sm bg-info ms-auto">{{ $newEventsCount != 0 ?? $newEventsCount }}</span></a>
            </li>
        @endif

        @if (!$user->hasRestriction('can_manage_articles'))
            <li class="nav-item"><a class="nav-link" href="{{ route('admin.articles') }}">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('coreui/vendors/@coreui/icons/svg/free.svg#cil-list-rich') }}"></use>
                    </svg> Articles<span
                        class="badge badge-sm bg-info ms-auto">{{ $newArticlesCount != 0 ?? $newArticlesCount }}</span></a>
            </li>
        @endif

        @if (!$user->hasRestriction('can_manage_donations'))
            <li class="nav-item"><a class="nav-link" href="{{ route('admin.donations') }}">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('coreui/vendors/@coreui/icons/svg/free.svg#cil-heart') }}"></use>
                    </svg> Donations<span
                        class="badge badge-sm bg-info ms-auto">{{ $newDonationsCount != 0 ?? $newDonationsCount }}</span></a>
            </li>
        @endif

        @if (!$user->hasRestriction('can_manage_infopages'))
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
        @endif

        @if (!$user->hasRestriction('can_manage_users'))
            <li class="nav-item"><a class="nav-link" href="{{ route('admin.users') }}">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('coreui/vendors/@coreui/icons/svg/free.svg#cil-people') }}"></use>
                    </svg> Users<span
                        class="badge badge-sm bg-info ms-auto">{{ $newUsersCount != 0 ?? $newUsersCount }}</span></a>
            </li>
        @endif

        @if (
            !$user->hasRestriction('can_manage_category_topics') ||
                !$user->hasRestriction('can_manage_category_posts') ||
                !$user->hasRestriction('can_manage_category_comments'))
            <li class="nav-title">Category Posts</li>
        @endif
        @if (!$user->hasRestriction('can_manage_category_topics'))
            <li class="nav-item"><a class="nav-link" href="{{ route('admin.topics.index') }}">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('coreui/vendors/@coreui/icons/svg/free.svg#cil-list') }}"></use>
                    </svg> Topics<span
                        class="badge badge-sm bg-info ms-auto">{{ $newTopicsCount != 0 ?? $newTopicsCount }}</span></a>
            </li>
        @endif

        @if (!$user->hasRestriction('can_manage_category_posts'))
            <li class="nav-item"><a class="nav-link" href="{{ route('admin.category.posts.index') }}">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('coreui/vendors/@coreui/icons/svg/free.svg#cil-list-rich') }}"></use>
                    </svg> All Posts<span
                        class="badge badge-sm bg-info ms-auto">{{ $newCategoryPostsCount != 0 ?? $newCategoryPostsCount }}</span></a>
            </li>
        @endif

        @if (!$user->hasRestriction('can_manage_category_comments'))
            <li class="nav-item"><a class="nav-link" href="{{ route('admin.category.posts.comments') }}">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('coreui/vendors/@coreui/icons/svg/free.svg#cil-comment-bubble') }}">
                        </use>
                    </svg> Comments<span
                        class="badge badge-sm bg-info ms-auto">{{ $newCPCommentsCount != 0 ?? $newCPCommentsCount }}</span></a>
            </li>
        @endif

        @if (
            !$user->hasRestriction('can_manage_groups') ||
                !$user->hasRestriction('can_manage_group_join_requests') ||
                !$user->hasRestriction('can_manage_group_posts') ||
                !$user->hasRestriction('can_manage_group_comments'))
            <li class="nav-title">Groups</li>
        @endif
        @if (!$user->hasRestriction('can_manage_groups'))
            <li class="nav-item"><a class="nav-link" href="{{ route('admin.group.index') }}">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('coreui/vendors/@coreui/icons/svg/free.svg#cil-address-book') }}">
                        </use>
                    </svg> All Groups<span
                        class="badge badge-sm bg-info ms-auto">{{ $newAllGroupsCount != 0 ?? $newAllGroupsCount }}</span></a>
            </li>
        @endif

        @if (!$user->hasRestriction('can_manage_group_join_requests'))
            <li class="nav-item"><a class="nav-link" href="{{ route('admin.group.join.request') }}">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('coreui/vendors/@coreui/icons/svg/free.svg#cil-envelope-open') }}">
                        </use>
                    </svg> Join Requests<span
                        class="badge badge-sm bg-info ms-auto">{{ $newArticlesCount != 0 ?? $newArticlesCount }}</span></a>
            </li>
        @endif

        @if (!$user->hasRestriction('can_manage_group_posts'))
            <li class="nav-item"><a class="nav-link" href="{{ route('admin.group.posts') }}">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('coreui/vendors/@coreui/icons/svg/free.svg#cil-list-rich') }}">
                        </use>
                    </svg> All Posts<span
                        class="badge badge-sm bg-info ms-auto">{{ $newAllPostsCount != 0 ?? $newAllPostsCount }}</span></a>
            </li>
        @endif

        @if (!$user->hasRestriction('can_manage_group_comments'))
            <li class="nav-item"><a class="nav-link" href="{{ route('admin.group.comments') }}">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('coreui/vendors/@coreui/icons/svg/free.svg#cil-comment-bubble') }}">
                        </use>
                    </svg> Comments<span
                        class="badge badge-sm bg-info ms-auto">{{ $newCommentsCount != 0 ?? $newCommentsCount }}</span></a>
            </li>
        @endif

        @if ($user->hasRole('superadmin'))
            <li class="nav-title">Super Admin</li>
            <li class="nav-item"><a class="nav-link" href="{{ route('superadmin.superadmins.index') }}">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('coreui/vendors/@coreui/icons/svg/free.svg#cil-address-book') }}">
                        </use>
                    </svg> Super Admins</a>
            </li>
            <li class="nav-item"><a class="nav-link" href="{{ route('superadmin.admins.index') }}">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('coreui/vendors/@coreui/icons/svg/free.svg#cil-address-book') }}">
                        </use>
                    </svg> Admins</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('superadmin.users.index') }}">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('coreui/vendors/@coreui/icons/svg/free.svg#cil-address-book') }}">
                        </use>
                    </svg> Users<span
                        class="badge badge-sm bg-info ms-auto">{{ $newUsersCount != 0 ?? $newUsersCount }}</span></a>
            </li>
        @endif
    </ul>
    <div class="sidebar-footer border-top d-none d-md-flex">
        <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>
    </div>
</div>
