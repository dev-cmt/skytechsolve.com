<aside class="app-sidebar sticky" id="sidebar">
    <!-- Start::main-sidebar-header -->
    <div class="main-sidebar-header">
        <a href="{{ route('dashboard') }}" class="header-logo">
            <img src="{{ asset($settings ? $settings->logo_light : '') }}" alt="logo" class="desktop-logo">
            <img src="{{ asset($settings ? $settings->logo_dark : '') }}" alt="logo" class="toggle-logo">
            <img src="{{ asset($settings ? $settings->logo_light : '') }}" alt="logo" class="desktop-dark">
            <img src="{{ asset($settings ? $settings->logo_light : '') }}" alt="logo" class="toggle-dark">
            <img src="{{ asset($settings ? $settings->logo_dark : '') }}" alt="logo" class="desktop-white">
            <img src="{{ asset($settings ? $settings->logo_dark : '') }}" alt="logo" class="toggle-white">
        </a>
    </div>
    <!-- End::main-sidebar-header -->

    <!-- Start::main-sidebar -->
    <div class="main-sidebar" id="sidebar-scroll">

        <!-- Start::nav -->
        <nav class="main-menu-container nav nav-pills flex-column sub-open">
            <div class="slide-left" id="slide-left">
                <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
                    <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"></path>
                </svg>
            </div>

            <ul class="main-menu">

                <!-- Dashboard - Always visible -->
                <li class="slide">
                    <a href="{{ route('dashboard') }}"
                        class="side-menu__item {{ Request::is('dashboard') ? 'active' : '' }}">
                        <i class="bx bxs-dashboard side-menu__icon"></i>
                        <span class="side-menu__label">Dashboard</span>
                    </a>
                </li>

                <!-- Hero Sliders -->
                @can('view sliders')
                    <li class="slide">
                        <a href="{{ route('sliders.index') }}"
                            class="side-menu__item {{ Request::is('sliders*') ? 'active' : '' }}">
                            <i class="bx bx-slideshow side-menu__icon"></i>
                            <span class="side-menu__label">Hero Sliders</span>
                        </a>
                    </li>
                @endcan

                <!-- Category -->
                @can('view categories')
                    <li class="slide">
                        <a href="{{ route('categories.index') }}"
                            class="side-menu__item {{ Request::is('categories*') ? 'active' : '' }}">
                            <i class="bx bx-layer side-menu__icon"></i>
                            <span class="side-menu__label">Category</span>
                        </a>
                    </li>
                @endcan

                <!-- Services -->
                @canany(['view services', 'view features'])
                    <li
                        class="slide has-sub {{ Request::is('services*') || Request::is('features*') ? 'active open' : '' }}">
                        <a href="javascript:void(0);"
                            class="side-menu__item {{ Request::is('services*') || Request::is('features*') ? 'active' : '' }}">
                            <i class="bx bx-task side-menu__icon"></i>
                            <span class="side-menu__label">Services</span>
                            <i class="fe fe-chevron-right side-menu__angle"></i>
                        </a>
                        <ul class="slide-menu child1">
                            @can('view services')
                                <li class="slide">
                                    <a href="{{ route('services.index') }}"
                                        class="side-menu__item {{ Request::is('services*') ? 'active' : '' }}">
                                        Service List
                                    </a>
                                </li>
                            @endcan
                            @can('view features')
                                <li class="slide">
                                    <a href="{{ route('features.index') }}"
                                        class="side-menu__item {{ Request::is('features*') ? 'active' : '' }}">
                                        Feature List
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcanany

                <!-- Project -->
                @can('view projects')
                    <li class="slide">
                        <a href="{{ route('projects.index') }}"
                            class="side-menu__item {{ Request::is('projects*') ? 'active' : '' }}">
                            <i class="bx bx-network-chart side-menu__icon"></i>
                            <span class="side-menu__label">Project</span>
                        </a>
                    </li>
                @endcan

                <!-- Products -->
                @can('view products')
                    <li class="slide">
                        <a href="{{ route('products.index') }}"
                            class="side-menu__item {{ Request::is('products*') ? 'active' : '' }}">
                            <i class="bx bx-cart side-menu__icon"></i>
                            <span class="side-menu__label">Products</span>
                        </a>
                    </li>
                @endcan

                <!-- Testimonial -->
                @can('view testimonials')
                    <li class="slide">
                        <a href="{{ route('testimonials.index') }}"
                            class="side-menu__item {{ Request::is('testimonials*') ? 'active' : '' }}">
                            <i class="bx bx-comment-detail side-menu__icon"></i>
                            <span class="side-menu__label">Testimonial</span>
                        </a>
                    </li>
                @endcan

                <!-- Story -->
                @can('view story')
                    <li class="slide">
                        <a href="{{ route('story.index') }}"
                            class="side-menu__item {{ Request::is('story*') ? 'active' : '' }}">
                            <i class="bx bx-book side-menu__icon"></i>
                            <span class="side-menu__label">Story</span>
                        </a>
                    </li>
                @endcan

                <!-- Achievement -->
                @can('view achievements')
                    <li class="slide">
                        <a href="{{ route('achievements.index') }}"
                            class="side-menu__item {{ Request::is('achievements*') ? 'active' : '' }}">
                            <i class="bx bx-trophy side-menu__icon"></i>
                            <span class="side-menu__label">Achievement</span>
                        </a>
                    </li>
                @endcan


                <!-- Team -->
                @can('view teams')
                    <li class="slide">
                        <a href="{{ route('team.index') }}"
                            class="side-menu__item {{ Request::is('team*') ? 'active' : '' }}">
                            <i class="bx bx-group side-menu__icon"></i>
                            <span class="side-menu__label">Team</span>
                        </a>
                    </li>
                @endcan

                <!-- Clients -->
                @can('view clients')
                    <li class="slide">
                        <a href="{{ route('clients.index') }}"
                            class="side-menu__item {{ Request::is('clients*') ? 'active' : '' }}">
                            <i class="bx bx-briefcase side-menu__icon"></i>
                            <span class="side-menu__label">Clients</span>
                        </a>
                    </li>
                @endcan

                <!-- Mission -->
                @can('view missions')
                    <li class="slide">
                        <a href="{{ route('mission.index') }}"
                            class="side-menu__item {{ Request::is('mission*') ? 'active' : '' }}">
                            <i class="bx bx-flag side-menu__icon"></i>
                            <span class="side-menu__label">Mission</span>
                        </a>
                    </li>
                @endcan

                <!-- Contact Information -->
                @can('view contact')
                    <li class="slide">
                        <a href="{{ route('contact.index') }}"
                            class="side-menu__item {{ Request::is('contact*') ? 'active' : '' }}">
                            <i class="bx bx-envelope side-menu__icon"></i>
                            <span class="side-menu__label">Contact Us</span>
                        </a>
                    </li>
                @endcan

                <!-- Submissions -->
                @can('view submissions')
                    <li class="slide">
                        <a href="{{ route('submissions.index') }}"
                            class="side-menu__item {{ Request::is('submissions*') ? 'active' : '' }}">
                            <i class="bx bx-party side-menu__icon"></i>
                            <span class="side-menu__label">Submissions</span>
                        </a>
                    </li>
                @endcan

                <!-- Blogs -->
                @canany(['view blogs', 'view tags'])
                    <li class="slide has-sub {{ Request::is('blogs*') || Request::is('tags*') ? 'active open' : '' }}">
                        <a href="javascript:void(0);"
                            class="side-menu__item {{ Request::is('blogs*') || Request::is('tags*') ? 'active' : '' }}">
                            <i class="bx bx-news side-menu__icon"></i>
                            <span class="side-menu__label">Blogs</span>
                            <i class="fe fe-chevron-right side-menu__angle"></i>
                        </a>
                        <ul class="slide-menu child1">
                            @can('view blogs')
                                <li class="slide">
                                    <a href="{{ route('blogs.index') }}"
                                        class="side-menu__item {{ Request::is('blogs*') ? 'active' : '' }}">
                                        Blog List
                                    </a>
                                </li>
                            @endcan
                            @can('view tags')
                                <li class="slide">
                                    <a href="{{ route('tags.index') }}"
                                        class="side-menu__item {{ Request::is('tags*') ? 'active' : '' }}">
                                        Tags List
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcanany

                <!-- Authentication -->
                <li class="slide__category"><span class="category-name">User Management</span></li>

                @can('view users')
                    <li class="slide">
                        <a href="{{ route('users.index') }}"
                            class="side-menu__item {{ Request::is('users*') ? 'active' : '' }}">
                            <i class="bx bx-check-shield side-menu__icon"></i>
                            <span class="side-menu__label">Users</span>
                        </a>
                    </li>
                @endcan

                @can('view roles')
                    <li class="slide">
                        <a href="{{ route('roles.index') }}"
                            class="side-menu__item {{ Request::is('roles*') ? 'active' : '' }}">
                            <i class="bx bx-fingerprint side-menu__icon"></i>
                            <span class="side-menu__label">Roles & Permissions</span>
                        </a>
                    </li>
                @endcan

                <li class="slide__category"><span class="category-name">Settings</span></li>

                @can('view settings')
                    <!-- Dashboard - Always visible -->
                    <li class="slide">
                        <a href="{{ route('setting.index') }}"
                            class="side-menu__item {{ Request::is('setting*') ? 'active' : '' }}">
                            <i class="bx bx-cog side-menu__icon"></i>
                            <span class="side-menu__label">General Settings</span>
                        </a>
                    </li>
                @endcan

                <!-- SEO Settings -->
                @can('view seo')
                    <li class="slide">
                        <a href="{{ route('settings.seo.index') }}"
                            class="side-menu__item {{ Request::is('seo-pages*') ? 'active' : '' }}">
                            <i class="bx bx-search-alt-2 side-menu__icon"></i>
                            <span class="side-menu__label">SEO Settings</span>
                        </a>
                    </li>
                @endcan

                <!-- Page Content -->
                @can('view page content')
                    <li class="slide">
                        <a href="{{ route('settings.pages-content.index') }}"
                            class="side-menu__item {{ Request::is('pages-content*') ? 'active' : '' }}">
                            <i class="bx bx-book-content side-menu__icon"></i>
                            <span class="side-menu__label">Page Content</span>
                        </a>
                    </li>
                @endcan

                <!-- Site Monitoring -->
                @can('view sites')
                    <li class="slide has-sub {{ Request::is('sites*') || Request::is('visitors*') ? 'active open' : '' }}">
                        <a href="javascript:void(0);"
                            class="side-menu__item {{ Request::is('sites*') || Request::is('visitors*') ? 'active' : '' }}">
                            <i class="bx bx-globe side-menu__icon"></i>
                            <span class="side-menu__label">Monitoring</span>
                            <i class="fe fe-chevron-right side-menu__angle"></i>
                        </a>
                        <ul class="slide-menu child1">
                            <li class="slide">
                                <a href="{{ route('sites.index') }}"
                                    class="side-menu__item {{ Request::is('sites*') ? 'active' : '' }}">
                                    Site Status
                                </a>
                            </li>
                            <li class="slide">
                                <a href="{{ route('visitors.index') }}"
                                    class="side-menu__item {{ Request::is('visitors*') ? 'active' : '' }}">
                                    Visitor Log
                                </a>
                            </li>
                        </ul>
                    </li>
                @endcan

                <!-- Developer API -->
                @can('view developer api')
                    <li class="slide">
                        <a href="{{ route('developer-api.index') }}"
                            class="side-menu__item {{ Request::is('developer-api*') ? 'active' : '' }}">
                            <i class="bx bx-code-alt side-menu__icon"></i>
                            <span class="side-menu__label">Developer Api</span>
                        </a>
                    </li>
                @endcan

            </ul>
            <div class="slide-right" id="slide-right">
                <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
                    <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z"></path>
                </svg>
            </div>
        </nav>
        <!-- End::nav -->

    </div>
    <!-- End::main-sidebar -->

</aside>