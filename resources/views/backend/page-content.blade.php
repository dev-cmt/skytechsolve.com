<x-backend-layout title="SEO Setting">
    @push('css')
        <link rel="stylesheet" href="{{asset('backend/libs/summernote/summernote-lite.min.css')}}" />
        <style>
            .nav-tabs .nav-link {
                border-radius: 8px 8px 0 0;
                padding: 12px 20px;
                font-weight: 500;
                color: #555;
            }

            .nav-tabs .nav-link.active {
                background: #fdfdfd;
                border-bottom: 2px solid var(--primary-color, #5e72e4);
                color: var(--primary-color, #5e72e4);
            }

            .nav-tabs .nav-link i {
                margin-right: 8px;
            }

            label {
                font-weight: 500;
                color: #4a5568;
                margin-bottom: 0.5rem;
            }

            .page-section-header {
                padding-bottom: 1rem;
                border-bottom: 2px solid #f1f5f9;
                display: flex;
                align-items: center;
            }

            .page-section-header h4 {
                margin-bottom: 0;
                font-weight: 700;
                color: #2d3748;
            }

            .section-icon {
                width: 40px;
                height: 40px;
                background: rgba(94, 114, 228, 0.1);
                color: #5e72e4;
                border-radius: 10px;
                display: flex;
                align-items: center;
                justify-content: center;
                margin-right: 12px;
            }
        </style>
    @endpush

    <!-- Page Header -->
    <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
        <h1 class="page-title fw-semibold fs-18 mb-0">Page Content Management</h1>
        <div class="ms-md-1 ms-0">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Settings</li>
                </ol>
            </nav>
        </div>
    </div>


    <ul class="nav nav-tabs mb-4" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" data-bs-toggle="tab" role="tab" href="#home-tab">
                <i class="ri-home-4-line"></i> Home Page
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" data-bs-toggle="tab" role="tab" href="#about-tab">
                <i class="ri-information-line"></i> About Page
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" data-bs-toggle="tab" role="tab" href="#service-tab">
                <i class="ri-settings-5-line"></i> Services Page
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" data-bs-toggle="tab" role="tab" href="#team-tab">
                <i class="ri-team-line"></i> Teams Page
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" data-bs-toggle="tab" role="tab" href="#project-tab">
                <i class="ri-article-line"></i> Projects Page
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" data-bs-toggle="tab" role="tab" href="#project-video-tab">
                <i class="ri-video-line"></i> Projects Video
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" data-bs-toggle="tab" role="tab" href="#contact-tab">
                <i class="ri-contacts-book-line"></i> Contact Page
            </a>
        </li>
    </ul>
    <div class="tab-content border-0 p-0 shadow-none">

        <!--Home Page-->
        <div class="tab-pane active show" id="home-tab" role="tabpanel">
            <form action="{{ route('settings.pages-content.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="slug" value="home">
                <div class="page-section-header">
                    <div class="section-icon"><i class="ri-home-wifi-line fs-20"></i></div>
                    <h4>Home Page Sections</h4>
                </div>
                <div class="row">
                    <div class="col-xl-6">
                        <div class="card custom-card mb-0">
                            <div class="card-header">
                                <div class="card-title">Slider Content</div>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label>Main Title</label>
                                    <input type="text" name="content[slider][title]" class="form-control"
                                        placeholder="Slider Title"
                                        value="{{ data_get($pages['home']->content, 'slider.title') }}">
                                </div>
                                <div class="mb-3">
                                    <label>Sub Title</label>
                                    <input type="text" name="content[slider][sub_title]" class="form-control"
                                        placeholder="Slider Sub Title"
                                        value="{{ data_get($pages['home']->content, 'slider.sub_title') }}">
                                </div>
                                <div class="mb-3">
                                    <label>Button Text</label>
                                    <input type="text" name="content[slider][button_text]" class="form-control"
                                        placeholder="Button Text"
                                        value="{{ data_get($pages['home']->content, 'slider.button_text') }}">
                                </div>
                                <div class="mb-3">
                                    <label>Button URL</label>
                                    <input type="text" name="content[slider][button_url]" class="form-control"
                                        placeholder="Button URL"
                                        value="{{ data_get($pages['home']->content, 'slider.button_url') }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="card custom-card mb-0">
                            <div class="card-header">
                                <div class="card-title">Testimonial</div>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label>Title</label>
                                    <input type="text" name="content[testimonial][title]" class="form-control"
                                        placeholder="Testimonial Title"
                                        value="{{ data_get($pages['home']->content, 'testimonial.title') }}">
                                </div>
                                <div class="mb-3">
                                    <label>Description</label>
                                    <textarea name="content[testimonial][description]"
                                        class="form-control summernote">{{ data_get($pages['home']->content, 'testimonial.description') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-2 text-end">
                    <button class="btn btn-primary px-5 py-2 fw-bold shadow-sm">
                        <i class="ri-save-line me-1"></i> Update Home Content
                    </button>
                </div>
            </form>
        </div>

        <!--About Us Page-->
        <div class="tab-pane" id="about-tab" role="tabpanel">
            <form action="{{ route('settings.pages-content.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="slug" value="about">

                <!-- General Section -->
                <div class="page-section-header">
                    <div class="section-icon"><i class="ri-layout-top-line fs-20"></i></div>
                    <h4>General & Header</h4>
                </div>
                <div class="card custom-card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-6">
                                <label>Page Title</label>
                                <input type="text" name="content[header][title]" class="form-control"
                                    placeholder="About Us"
                                    value="{{ data_get($pages['about']->content, 'header.title') }}">
                            </div>
                            <div class="col-xl-6">
                                <label>Header Subtitle</label>
                                <input type="text" name="content[header][subtitle]" class="form-control"
                                    placeholder="The Interior speak for themselves"
                                    value="{{ data_get($pages['about']->content, 'header.subtitle') }}">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Features Section -->
                <div class="page-section-header">
                    <div class="section-icon"><i class="ri-star-line fs-20"></i></div>
                    <h4>Features Section</h4>
                </div>
                <div class="card custom-card">
                    <div class="card-body">
                        <div class="row">
                            @for ($i = 1; $i <= 3; $i++)
                                <div class="col-xl-4">
                                    <div class="p-3 border rounded-3 bg-light mb-3 mb-xl-0">
                                        <h6 class="fw-bold mb-3 text-primary">Feature Box 0{{ $i }}</h6>
                                        <label>Title</label>
                                        <input type="text" name="content[features_box{{ $i }}][title]"
                                            class="form-control mb-2"
                                            value="{{ data_get($pages['about']->content, 'features_box' . $i . '.title') }}">
                                        <label>Sub Title</label>
                                        <textarea name="content[features_box{{ $i }}][sub_title]" class="form-control"
                                            rows="2">{{ data_get($pages['about']->content, 'features_box' . $i . '.sub_title') }}</textarea>
                                    </div>
                                </div>
                            @endfor
                        </div>
                    </div>
                </div>

                <!-- Process Section -->
                <div class="page-section-header">
                    <div class="section-icon"><i class="ri-flow-chart fs-20"></i></div>
                    <h4>Proven Process (How We Work)</h4>
                </div>
                <div class="card custom-card">
                    <div class="card-body">
                        <div class="row">
                            @for ($i = 1; $i <= 4; $i++)
                                <div class="col-xl-3">
                                    <div class="p-3 border rounded-3 h-100">
                                        <div class="d-flex align-items-center mb-2">
                                            <span class="badge bg-primary-transparent text-primary me-2">{{ $i }}</span>
                                            <label class="mb-0">Step Title</label>
                                        </div>
                                        <input type="text" name="content[process][step{{ $i }}][title]"
                                            class="form-control mb-2"
                                            value="{{ data_get($pages['about']->content, 'process.step' . $i . '.title') }}">
                                        <label>Description</label>
                                        <textarea name="content[process][step{{ $i }}][text]" class="form-control"
                                            rows="2">{{ data_get($pages['about']->content, 'process.step' . $i . '.text') }}</textarea>
                                    </div>
                                </div>
                            @endfor
                        </div>
                    </div>
                </div>

                <!-- Marketing Section -->
                <div class="page-section-header">
                    <div class="section-icon"><i class="ri-advertisement-line fs-20"></i></div>
                    <h4>Video Campaign</h4>
                </div>
                <div class="row">
                    <div class="col-xl-6">
                        <div class="card custom-card h-100">
                            <div class="card-header">
                                <div class="card-title">Video Campaign</div>
                            </div>
                            <div class="card-body">
                                <label>Title</label>
                                <input type="text" name="content[video][title]" class="form-control mb-2"
                                    value="{{ data_get($pages['about']->content, 'video.title') }}">
                                <label>Header</label>
                                <input type="text" name="content[video][header]" class="form-control mb-2"
                                    value="{{ data_get($pages['about']->content, 'video.header') }}">
                                <label>YouTube Video URL</label>
                                <input type="text" name="content[video][url]" class="form-control mb-2"
                                    value="{{ data_get($pages['about']->content, 'video.url') }}">
                                <label>Brief Text</label>
                                <textarea name="content[video][text]" class="form-control"
                                    rows="2">{{ data_get($pages['about']->content, 'video.text') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-2 text-end">
                    <button class="btn btn-primary px-5 py-2 fw-bold shadow-sm">
                        <i class="ri-save-line me-1"></i> Update About Content
                    </button>
                </div>
            </form>
        </div>

        <!--Services Page-->
        <div class="tab-pane" id="service-tab" role="tabpanel">
            <form action="{{ route('settings.pages-content.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="slug" value="services">

                <div class="page-section-header">
                    <div class="section-icon"><i class="ri-settings-line fs-20"></i></div>
                    <h4>Services Header & Features</h4>
                </div>

                <div class="card custom-card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-6">
                                <label>Header Title</label>
                                <input type="text" name="content[header][title]" class="form-control"
                                    placeholder="Services"
                                    value="{{ data_get($pages['services']->content, 'header.title') }}">
                            </div>
                            <div class="col-xl-6">
                                <label>Header Subtitle</label>
                                <input type="text" name="content[header][subtitle]" class="form-control"
                                    placeholder="The Interior speak for themselves"
                                    value="{{ data_get($pages['services']->content, 'header.subtitle') }}">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-6">
                        <div class="card custom-card">
                            <div class="card-header">
                                <div class="card-title">Offer Details</div>
                            </div>
                            <div class="card-body">
                                <label>Title</label>
                                <input type="text" name="content[services_offer][title]" class="form-control mb-2"
                                    value="{{ data_get($pages['services']->content, 'services_offer.title') }}">
                                <label>Header Content</label>
                                <input type="text" name="content[services_offer][header]" class="form-control mb-2"
                                    value="{{ data_get($pages['services']->content, 'services_offer.header') }}">
                                <label>Discount Percentage</label>
                                <input type="text" name="content[services_offer][discount]" class="form-control mb-2"
                                    value="{{ data_get($pages['services']->content, 'services_offer.discount') }}">
                                <label>Description</label>
                                <textarea name="content[services_offer][description]" class="form-control"
                                    rows="5">{{ data_get($pages['services']->content, 'services_offer.description') }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="card custom-card">
                            <div class="card-header">
                                <div class="card-title">Services Content</div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-xl-6">
                                        <label>Title</label>
                                        <input type="text" name="content[services_content][title]"
                                            class="form-control mb-2"
                                            value="{{ data_get($pages['services']->content, 'services_content.title') }}">
                                    </div>
                                    <div class="col-xl-6">
                                        <label>Header Content</label>
                                        <input type="text" name="content[services_content][header]"
                                            class="form-control mb-2"
                                            value="{{ data_get($pages['services']->content, 'services_content.header') }}">
                                    </div>
                                    <div class="col-xl-12">
                                        <label>Description</label>
                                        <textarea name="content[services_content][description]"
                                            class="form-control summernote mb-2">{{ data_get($pages['services']->content, 'services_content.description') }}</textarea>
                                    </div>
                                    <div class="col-xl-6">
                                        <label>Button Text</label>
                                        <input type="text" name="content[services_content][button_text]"
                                            class="form-control mb-2"
                                            value="{{ data_get($pages['services']->content, 'services_content.button_text') }}">
                                    </div>
                                    <div class="col-xl-6">
                                        <label>Button Link</label>
                                        <input type="text" name="content[services_content][button_link]"
                                            class="form-control mb-2"
                                            value="{{ data_get($pages['services']->content, 'services_content.button_link') }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-2 text-end">
                    <button class="btn btn-primary px-5 py-2 fw-bold shadow-sm">
                        <i class="ri-save-line me-1"></i> Update Services Content
                    </button>
                </div>
            </form>
        </div>

        <!--Teams Page-->
        <div class="tab-pane" id="team-tab" role="tabpanel">
            <form action="{{ route('settings.pages-content.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="slug" value="teams">
                <div class="page-section-header">
                    <div class="section-icon"><i class="ri-team-line fs-20"></i></div>
                    <h4>Teams Header Settings</h4>
                </div>
                <div class="card custom-card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-6">
                                <label>Header Title</label>
                                <input type="text" name="content[header][title]" class="form-control"
                                    placeholder="Our Team"
                                    value="{{ data_get($pages['teams']->content, 'header.title') }}">
                            </div>
                            <div class="col-xl-6">
                                <label>Header Subtitle</label>
                                <input type="text" name="content[header][subtitle]" class="form-control"
                                    placeholder="The minds behind the magic"
                                    value="{{ data_get($pages['teams']->content, 'header.subtitle') }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card custom-card">
                    <div class="card-header">
                        <div class="card-title">CTA (Call to Action)</div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-6">
                                <label>Title</label>
                                <input type="text" name="content[cta][title]" class="form-control mb-2"
                                    placeholder="Ready to start your next project?"
                                    value="{{ data_get($pages['teams']->content, 'cta.title') }}">
                            </div>
                            <div class="col-xl-6">
                                <label>Subtitle</label>
                                <textarea name="content[cta][subtitle]" class="form-control mb-2"
                                    placeholder="Let’s create something amazing together"
                                    rows="1">{{ data_get($pages['teams']->content, 'cta.subtitle') }}</textarea>
                            </div>
                            <div class="col-xl-6">
                                <label>Button Text</label>
                                <input type="text" name="content[cta][button_text]" class="form-control mb-2"
                                    placeholder="Contact Us"
                                    value="{{ data_get($pages['teams']->content, 'cta.button_text') }}">
                            </div>
                            <div class="col-xl-6">
                                <label>Button Link</label>
                                <input type="text" name="content[cta][button_link]" class="form-control mb-2"
                                    placeholder="https://example.com"
                                    value="{{ data_get($pages['teams']->content, 'cta.button_link') }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-2 text-end">
                    <button class="btn btn-primary px-5 py-2 fw-bold shadow-sm">
                        <i class="ri-save-line me-1"></i> Update Teams Content
                    </button>
                </div>
            </form>
        </div>

        <!--Projects Page-->
        <div class="tab-pane" id="project-tab" role="tabpanel">
            <form action="{{ route('settings.pages-content.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="slug" value="projects">
                <div class="page-section-header">
                    <div class="section-icon"><i class="ri-article-line fs-20"></i></div>
                    <h4>Projects Header Settings</h4>
                </div>
                <div class="card custom-card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-6">
                                <label>Header Title</label>
                                <input type="text" name="content[header][title]" class="form-control"
                                    placeholder="Our Projects"
                                    value="{{ data_get($pages['projects']->content, 'header.title') }}">
                            </div>
                            <div class="col-xl-6">
                                <label>Header Subtitle</label>
                                <input type="text" name="content[header][subtitle]" class="form-control"
                                    placeholder="Discover our latest work"
                                    value="{{ data_get($pages['projects']->content, 'header.subtitle') }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-2 text-end">
                    <button class="btn btn-primary px-5 py-2 fw-bold shadow-sm">
                        <i class="ri-save-line me-1"></i> Update Projects Content
                    </button>
                </div>
            </form>
        </div>

        <!--Projects Video Page-->
        <div class="tab-pane" id="project-video-tab" role="tabpanel">
            <form action="{{ route('settings.pages-content.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="slug" value="projects-video">
                <div class="page-section-header">
                    <div class="section-icon"><i class="ri-video-line fs-20"></i></div>
                    <h4>Projects Video Header Settings</h4>
                </div>
                <div class="card custom-card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-6">
                                <label>Header Title</label>
                                <input type="text" name="content[header][title]" class="form-control"
                                    placeholder="Video Gallery"
                                    value="{{ data_get($pages['projects-video']->content, 'header.title') }}">
                            </div>
                            <div class="col-xl-6">
                                <label>Header Subtitle</label>
                                <input type="text" name="content[header][subtitle]" class="form-control"
                                    placeholder="Watch our craftsmanship in action"
                                    value="{{ data_get($pages['projects-video']->content, 'header.subtitle') }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-2 text-end">
                    <button class="btn btn-primary px-5 py-2 fw-bold shadow-sm">
                        <i class="ri-save-line me-1"></i> Update Video Content
                    </button>
                </div>
            </form>
        </div>

        <!--Contact Page-->
        <div class="tab-pane" id="contact-tab" role="tabpanel">
            <form action="{{ route('settings.pages-content.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="slug" value="contact">
                <div class="page-section-header">
                    <div class="section-icon"><i class="ri-contacts-book-line fs-20"></i></div>
                    <h4>Contact Header Settings</h4>
                </div>
                <div class="card custom-card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-6">
                                <label>Header Title</label>
                                <input type="text" name="content[header][title]" class="form-control"
                                    placeholder="Contact Us"
                                    value="{{ data_get($pages['contact']->content, 'header.title') }}">
                            </div>
                            <div class="col-xl-6">
                                <label>Header Subtitle</label>
                                <input type="text" name="content[header][subtitle]" class="form-control"
                                    placeholder="Get in touch with us"
                                    value="{{ data_get($pages['contact']->content, 'header.subtitle') }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-2 text-end">
                    <button class="btn btn-primary px-5 py-2 fw-bold shadow-sm">
                        <i class="ri-save-line me-1"></i> Update Contact Content
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('js')
        <script src="{{asset('backend/libs/summernote/summernote-lite.min.js')}}"></script>

        <script>
            $('.summernote').summernote({
                height: 150,
            });
        </script>
    @endpush
</x-backend-layout>