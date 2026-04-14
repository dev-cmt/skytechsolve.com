
<!-- Main Header-->
<header class="main-header header-style-one">
    <section class="header-top" style="">
        <p>
            Phone : <a href="tel:{{ $settings->phone ?? '+8801577298633' }}" class="animated-phone">{{ $settings->phone ?? '+880 1577-298633' }}</a>
        </p>
    </section>
    <style>
        .header-top{
            height: 40px;
        }
        .header-top p{
            text-align: center; padding-top: 10px; font-weight: bold;
        }
        .header-top p {
            color: #fff; font-weight: bold;
        }
        .header-top p a {
            color: #1f1f1f; font-weight: bold;
        }
        .header-top p a:hover {
            color: #ffffff;
        }

        /* Fullscreen Search Popup */
        .search-popup {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.95);
            z-index: 9999;
            display: none;
            align-items: center;
            justify-content: center;
            opacity: 0;
            visibility: hidden;
            transition: all 0.5s ease;
        }

        .search-popup.active {
            display: flex;
            opacity: 1;
            visibility: visible;
        }

        .search-popup .close-search {
            position: absolute;
            top: 40px;
            right: 40px;
            font-size: 32px;
            color: #fff;
            cursor: pointer;
            background: none;
            border: none;
            transition: transform 0.3s ease;
        }

        .search-popup .close-search:hover {
            transform: rotate(90deg);
            color: #ED5933;
        }

        .search-popup .form-container {
            width: 100%;
            max-width: 800px;
            padding: 20px;
            text-align: center;
        }

        .search-popup .form-group {
            position: relative;
        }

        .search-popup input[type="search"] {
            width: 100%;
            background: none;
            border: none;
            border-bottom: 3px solid #333;
            padding: 20px 0;
            font-size: 42px;
            color: #fff;
            outline: none;
            text-align: center;
            transition: border-color 0.4s ease;
        }

        .search-popup input[type="search"]:focus {
            border-bottom-color: #ED5933;
        }

        .search-popup .search-btn {
            margin-top: 30px;
            background: #ED5933;
            border: none;
            color: #fff;
            padding: 12px 40px;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            border-radius: 4px;
            transition: 0.3s;
        }

        .search-popup .search-btn:hover {
            background: #A02000;
        }

        .search-popup .search-btn i {
            margin-right: 10px;
        }

        @media (max-width: 767px) {
            .search-popup input[type="search"] {
                font-size: 24px;
            }
        }

        body.search-active {
            overflow: hidden;
        }

        .search-popup .search-results {
            margin-top: 30px;
            max-height: 60vh;
            overflow-y: auto;
            text-align: left;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 8px;
            padding: 10px;
        }

        .result-row {
            display: flex;
            align-items: center;
            padding: 12px 15px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            transition: background 0.3s;
            text-decoration: none !important;
        }

        .result-row:last-child {
            border-bottom: none;
        }

        .result-row:hover {
            background: rgba(255, 255, 255, 0.1);
        }

        .result-row .img-box {
            width: 60px;
            height: 45px;
            margin-right: 15px;
            overflow: hidden;
            border-radius: 4px;
            background: #222;
        }

        .result-row .img-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .result-info {
            flex: 1;
        }

        .result-title {
            color: #fff;
            font-size: 16px;
            display: block;
            margin-bottom: 2px;
            font-weight: 500;
        }

        .result-type {
            color: #ED5933;
            font-size: 11px;
            text-transform: uppercase;
            font-weight: 700;
            letter-spacing: 1px;
        }

        .no-results {
            padding: 20px;
            color: #999;
            text-align: center;
            font-style: italic;
        }

        /* Custom scrollbar for search results */
        .search-results::-webkit-scrollbar {
            width: 6px;
        }
        .search-results::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.05);
        }
        .search-results::-webkit-scrollbar-thumb {
            background: #ED5933;
            border-radius: 10px;
        }
    </style>

    <div class="auto-container">
        <div class="header-lower">
            <div class="main-box clearfix">
                <div class="logo-box">
                    <div class="logo">
                        <a href="{{url('/')}}">
                            <img loading="lazy" src="{{asset( $settings->logo_light ?? 'images/logo.png' )}}" style="height: 68px; width: auto;" alt="" title="">
                        </a>
                    </div>
                </div>

                <div class="nav-outer clearfix">
                    <!-- Main Menu -->
                    <nav class="main-menu navbar-expand-md ">
                        <div class="navbar-header">
                            <!-- Toggle Button -->
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-menu-2"><path stroke="none" d="M0 0h24v24H0z" fill="none" /><path d="M21 6a1 1 0 0 1 -1 1h-16a1 1 0 1 1 0 -2h16a1 1 0 0 1 1 1" /><path d="M21 12a1 1 0 0 1 -1 1h-16a1 1 0 0 1 0 -2h16a1 1 0 0 1 1 1" /><path d="M21 18a1 1 0 0 1 -1 1h-16a1 1 0 0 1 0 -2h16a1 1 0 0 1 1 1" /></svg>
                            </button>
                        </div>
                        @php
                            $services = App\Models\Service::where('status', true)->where('is_menu', true)->get();
                        @endphp

                        <div class="collapse navbar-collapse clearfix" id="navbarSupportedContent">
                            <ul class="navigation clearfix">
                                <li class="{{ request()->is('/') ? 'current' : '' }}"><a href="{{url('/')}}">Home</a></li>
                                <li class="{{ request()->is('about-us') ? 'current' : '' }}"><a href="{{route('page.about-us')}}">About</a></li>
                                <li class="{{ request()->is('services*') ? 'current' : '' }} dropdown"><a href="#">Services</a>
                                    <ul>
                                        @foreach ($services as $service)
                                            <li><a href="{{route('page.services-details', $service->slug)}}">{{$service->title}}</a></li>
                                        @endforeach
                                        <li><a href="{{route('page.services')}}">Other Services</a></li>
                                    </ul>
                                </li>
                                <li class="{{ request()->is('projects*') ? 'current' : '' }}"><a href="{{route('page.projects')}}">Projects</a></li>
                                <li class="{{ request()->is('products*') ? 'current' : '' }}"><a href="{{route('page.products')}}">Products</a></li>
                                <li class="{{ request()->is('teams*') ? 'current' : '' }}"><a href="{{route('page.teams')}}">Team</a></li>
                                <li class="{{ request()->is('videos*') ? 'current' : '' }}"><a href="{{ route('page.videos') }}">Videos</a></li>
                                <li class="{{ request()->is('blogs*') ? 'current' : '' }}"><a href="{{route('page.blogs')}}">Blog</a></li>
                                {{-- <li class="{{ request()->is('contact-us') ? 'current' : '' }}"><a href="{{route('page.contact-us')}}">Contact</a></li> --}}
                            </ul>
                        </div>
                    </nav><!-- Main Menu End-->

                    <!-- Outer Box-->
                    <div class="outer-box">
                        <!--Search Box-->
                        <div class="search-box-outer">
                            <button class="search-box-btn open-search"><span class="fa fa-search"></span></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Search Popup -->
    <div class="search-popup">
        <button class="close-search"><span class="fa fa-times"></span></button>
        <div class="form-container">
            <form method="GET" action="{{ route('page.blogs.search') }}">
                <div class="form-group">
                    <input type="search" id="ajax-search-input" name="query" value="" placeholder="Search Here" required autocomplete="off">
                    <button type="submit" class="search-btn"><i class="fa fa-search"></i> Search Now</button>
                </div>
            </form>
            <div id="search-results-box" class="search-results" style="display: none;">
                <!-- Results will be injected here -->
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const openSearch = document.querySelector('.open-search');
            const closeSearch = document.querySelector('.close-search');
            const searchPopup = document.querySelector('.search-popup');
            const searchInput = document.getElementById('ajax-search-input');
            const resultsBox = document.getElementById('search-results-box');

            if (openSearch && closeSearch && searchPopup) {
                openSearch.addEventListener('click', function() {
                    searchPopup.classList.add('active');
                    document.body.classList.add('search-active');
                    setTimeout(() => searchInput.focus(), 300);
                });

                closeSearch.addEventListener('click', function() {
                    searchPopup.classList.remove('active');
                    document.body.classList.remove('search-active');
                    resultsBox.style.display = 'none';
                    searchInput.value = '';
                });

                // Close on ESC
                document.addEventListener('keydown', function(e) {
                    if (e.key === 'Escape' && searchPopup.classList.contains('active')) {
                        searchPopup.classList.remove('active');
                        document.body.classList.remove('search-active');
                    }
                });

                // AJAX Search Logic
                let debounceTimer;
                searchInput.addEventListener('input', function() {
                    const query = this.value.trim();
                    clearTimeout(debounceTimer);

                    if (query.length < 2) {
                        resultsBox.style.display = 'none';
                        resultsBox.innerHTML = '';
                        return;
                    }

                    debounceTimer = setTimeout(() => {
                        fetch(`{{ route('page.blogs.ajax') }}?query=${encodeURIComponent(query)}`)
                            .then(response => response.json())
                            .then(data => {
                                resultsBox.innerHTML = '';
                                if (data.length > 0) {
                                    data.forEach(item => {
                                        const row = `
                                            <a href="${item.link}" class="result-row">
                                                <div class="img-box">
                                                    <img loading="lazy" src="${item.image}" alt="${item.title}" onerror="this.src='{{ asset('frontend/images/resource/news-1.jpg') }}'">
                                                </div>
                                                <div class="result-info">
                                                    <span class="result-type">${item.type}</span>
                                                    <span class="result-title">${item.title}</span>
                                                </div>
                                            </a>
                                        `;
                                        resultsBox.insertAdjacentHTML('beforeend', row);
                                    });
                                    resultsBox.style.display = 'block';
                                } else {
                                    resultsBox.innerHTML = '<div class="no-results">No results found for "' + query + '"</div>';
                                    resultsBox.style.display = 'block';
                                }
                            });
                    }, 300);
                });
            }
        });
    </script>
</header>
<!--End Main Header -->
