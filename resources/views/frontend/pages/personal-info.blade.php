<x-frontend-layout title="Personal Info." :breadcrumbs="$breadcrumbs" :seotags="$seotags">
    <!--Page Title-->
    <section class="page-title" style="background-image:url({{asset('frontend/images/pages/bg-title.jpg')}});">
        <div class="auto-container">
            <div class="inner-container clearfix">
                <div class="title-box">
                    <h1>Ar. Mohammad Ismaiel Parvez</h1>
                    <span class="title">The Interior speak for themselves</span>
                </div>
                <ul class="bread-crumb clearfix">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li>Personal Info.</li>
                </ul>
            </div>
        </div>
    </section>
    <!--End Page Title-->
    <!-- Personal Details Section -->
    <section class="personal-details-section pb-0">
        <div class="auto-container">
            <div class="row">
                <!-- Image Column -->
                <div class="image-column col-lg-4 col-md-12 col-sm-12">
                    <div class="inner-column">
                        <div class="image-box">
                            <img loading="lazy" src="{{ asset('frontEnd/images/pages/architect.jpg') }}" alt="Ar. Mohammad Ismaiel Parvez">
                            <div class="social-links">
                                <a href="#" class="social-icon"><i class="fa fa-facebook"></i></a>
                                <a href="#" class="social-icon"><i class="fa fa-twitter"></i></a>
                                <a href="#" class="social-icon"><i class="fa fa-linkedin"></i></a>
                                <a href="#" class="social-icon"><i class="fa fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Content Column -->
                <div class="content-column col-lg-8 col-md-12 col-sm-12">
                    <div class="inner-column">
                        <h2>About Me</h2>
                        <div class="text">
                            <p>I am a passionate interior architect with over 10 years of experience in creating
                            beautiful and functional spaces. My design philosophy revolves around creating
                            environments that speak for themselves - spaces that are not just visually appealing
                            but also enhance the quality of life for those who inhabit them.</p>

                            <p>I believe that great design is a perfect blend of aesthetics, functionality,
                            and sustainability. Every project is an opportunity to create something unique
                            that reflects the client's personality while maintaining architectural integrity.</p>
                        </div>

                        <!-- Personal Info -->
                        <div class="personal-info">
                            <h3>Personal Information</h3>
                            <div class="row">
                                <div class="col-md-6">
                                    <ul class="info-list">
                                        <li><strong>Name:</strong> Mohammad Ismaiel Parvez</li>
                                        <li><strong>Profession:</strong> Architect</li>
                                        <li><strong>Experience:</strong> 15+ Years</li>
                                        <li><strong>Location:</strong> Dhaka, Bangladesh</li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <ul class="info-list">
                                        <li><strong>Email:</strong> ecowave.bd@gmail.com</li>
                                        <li><strong>Phone:</strong> +880 1715 668144</li>
                                        <li><strong>Website:</strong> ecowaveconsultantstudio.com/</li>
                                        <li><strong>Languages:</strong> English, Bengali</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Personal Details Section -->

    <!-- Skills -->
    <section class="personal-details-section" style="background-image: url({{asset('frontEnd/images/pages/bg-about-us.jpg') }});">
        <div class="auto-container">
            <div class="skills-section">
                <h3>Professional Skills</h3>
                <div class="skills">
                    <div class="skill-item">
                        <div class="skill-header">
                            <h6>Interior Design</h6>
                            <span>95%</span>
                        </div>
                        <div class="skill-bar">
                            <div class="skill-progress" style="width: 95%"></div>
                        </div>
                    </div>

                    <div class="skill-item">
                        <div class="skill-header">
                            <h6>Space Planning</h6>
                            <span>90%</span>
                        </div>
                        <div class="skill-bar">
                            <div class="skill-progress" style="width: 90%"></div>
                        </div>
                    </div>

                    <div class="skill-item">
                        <div class="skill-header">
                            <h6>3D Visualization</h6>
                            <span>88%</span>
                        </div>
                        <div class="skill-bar">
                            <div class="skill-progress" style="width: 88%"></div>
                        </div>
                    </div>

                    <div class="skill-item">
                        <div class="skill-header">
                            <h6>Project Management</h6>
                            <span>92%</span>
                        </div>
                        <div class="skill-bar">
                            <div class="skill-progress" style="width: 92%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action Section -->
    <section class="cta-section" style="background-image: url({{ asset('frontEnd/images/pages/bg-process.jpg') }});">
        <div class="auto-container">
            <div class="content-box">
                <h2>Ready to Transform Your Space?</h2>
                <p>Let's discuss your project and create something amazing together.</p>
                <a href="{{ route('page.contact') }}" class="theme-btn btn-style-one">Get In Touch</a>
            </div>
        </div>
    </section>
    <!-- End Call to Action Section -->
</x-frontend-layout>

@push('styles')
<style>
    .personal-details-section {
        padding: 80px 0;
        background: #fff;
    }

    .image-box {
        position: relative;
        text-align: center;
        margin-bottom: 30px;
    }

    .image-box img {
        width: 100%;
        max-width: 300px;
        height: auto;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }

    .social-links {
        margin-top: 20px;
        display: flex;
        justify-content: center;
        gap: 15px;
    }

    .social-icon {
        width: 45px;
        height: 45px;
        background: #41e843;
        color: #ffffff;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .social-icon:hover {
        background: #0056b3;
        transform: translateY(-3px);
    }

    .inner-column h2 {
        color: #333;
        margin-bottom: 20px;
        font-size: 2.5rem;
        font-weight: 700;
    }

    .inner-column .text {
        margin-bottom: 30px;
    }

    .inner-column .text p {
        font-size: 16px;
        line-height: 1.8;
        color: #666;
        margin-bottom: 15px;
    }

    .personal-info {
        margin: 40px 0;
        padding: 30px;
        background: #f8f9fa;
        border-radius: 10px;
    }

    .personal-info h3 {
        color: #333;
        margin-bottom: 20px;
        font-size: 1.5rem;
    }

    .info-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .info-list li {
        padding: 8px 0;
        border-bottom: 1px solid #eee;
        color: #555;
    }

    .info-list li:last-child {
        border-bottom: none;
    }

    .info-list strong {
        color: #333;
        min-width: 120px;
        display: inline-block;
    }

    .skills-section {
        margin-top: 40px;
    }

    .skills-section h3 {
        color: #333;
        margin-bottom: 25px;
        font-size: 1.5rem;
    }

    .skill-item {
        margin-bottom: 20px;
    }

    .skill-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 8px;
    }

    .skill-header h6 {
        margin: 0;
        font-size: 16px;
        color: #333;
        font-weight: 600;
    }

    .skill-header span {
        color: #41e843;
        font-weight: 600;
    }

    .skill-bar {
        width: 100%;
        height: 8px;
        background: #e9ecef;
        border-radius: 4px;
        overflow: hidden;
    }

    .skill-progress {
        height: 100%;
        background: linear-gradient(45deg, #41e843, #018803);
        border-radius: 4px;
        transition: width 1s ease-in-out;
    }

    .cta-section {
        padding: 80px 0;
        background-size: cover;
        background-position: center;
        position: relative;
        color: #fff;
        text-align: center;
    }

    .cta-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0,0,0,0.7);
    }

    .content-box {
        position: relative;
        z-index: 2;
    }

    .content-box h2 {
        font-size: 2.5rem;
        margin-bottom: 20px;
    }

    .content-box p {
        font-size: 1.2rem;
        margin-bottom: 30px;
        opacity: 0.9;
    }

    @media (max-width: 768px) {
        .inner-column h2 {
            font-size: 2rem;
        }

        .personal-info {
            padding: 20px;
        }

        .info-list li {
            padding: 10px 0;
        }

        .info-list strong {
            min-width: 100px;
        }
    }
</style>
@endpush
