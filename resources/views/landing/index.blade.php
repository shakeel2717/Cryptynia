@extends('layout.app')
@section('content')
    <section class="banner-section wow fadeIn">
        <div class="swiper-container banner-slider">
            <div class="swiper-wrapper">
                <!-- Slide Item -->
                <div class="swiper-slide" style="background-image: url(landing/back/2.jpg);">
                    <div class="content-outer">
                        <div class="content-box">
                            <div class="inner">
                                <h1>Trustable Trading <br> Company</h1>
                                <div class="text">Manufacturing Technology Supports Factories around the World.
                                    <br>Factories are at the heart of manufacturing.
                                </div>
                                <div class="link-box">
                                    <a href="{{ route('register') }}" class="theme-btn btn-style-one"><span>Create
                                            Account</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="banner-slider-nav">
            <div class="banner-slider-control banner-slider-button-prev"><span><i class="far fa-angle-left"></i></span>
            </div>
            <div class="banner-slider-control banner-slider-button-next"><span><i class="far fa-angle-right"></i></span>
            </div>
        </div>
        <div class="banner-shape__left_1"></div>
        <div class="banner-shape__left_2"></div>
        <div class="banner-big-title" data-parallax='{"x": 200}'>Factory</div>

    </section>

    <section class="features-two-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <!--Features One Sec Single-->
                    <div class="features-two-sec-single wow fadeInUp" data-wow-delay="300ms">
                        <div class="features-two-sec-icon">
                            <span class="flaticon-robotic"></span>
                        </div>
                        <h3>OUR VISION</h3>
                        <p>Empowering financial independence through expert-guided forex trading.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <!--Features One Sec Single-->
                    <div class="features-two-sec-single active wow fadeInUp" data-wow-delay="600ms">
                        <div class="features-two-sec-icon">
                            <span class="flaticon-development"></span>
                        </div>
                        <h3>OUR MISSION</h3>
                        <p>Becoming the leading forex platform, setting new industry standards.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <!--Features One Sec Single-->
                    <div class="features-two-sec-single wow fadeInUp" data-wow-delay="900ms">
                        <div class="features-two-sec-icon">
                            <span class="flaticon-paint-roller"></span>
                        </div>
                        <h3>OUR VALUES</h3>
                        <p>Integrity, Innovation, and Customer-Centric in every aspect of our service.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="about-tow-section about-page">
        <div class="container">
            <div class="row">
                <div class="col-xl-6">
                    <div class="about-two-left-content wow slideInLeft" data-wow-delay="100ms">
                        <div class="about-two-sec-image">
                            <div class="about-two-sec-image-bg-1"
                                style="background-image: url(/landingimages/about/about-2--pattern-1.png)"></div>
                            <div class="about-two-sec-image-bg-2"
                                style="background-image: url(/landing/images/about/about-2--pattern-2.png)"></div>
                            <img src="landing/back/4.jpg" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="about-two-right-content">
                        <div class="about-two-title">
                            <h4 class="sub-title-shape-left section_title-subheading">About Our Company</h4>
                            <h2>INVEST WITH CONFIDENCE, TRADE WITH EXPERTS </h2>
                            <p class="about-two-title-text">Welcome to {{ env('APP_NAME') }}, your trusted platform
                                for forex trading excellence. We specialize in empowering investors like you to
                                capitalize on the vast potential of the forex market. Our cutting-edge platform
                                brings together skilled traders and ambitious investors seeking financial growth and
                                success. At {{ env('APP_NAME') }}, we believe in transparency, innovation, and a
                                commitment to our
                                clients' prosperity.</p>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="about-tow-experience-years">
                                    <div class="about-tow-experience-years-icon">
                                        <span class="flaticon-check"></span>
                                    </div>
                                    <div class="about-tow-experience-years-text">
                                        <h2>100% Client <br> Satisfaction </h2>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="about-tow-experience-years">
                                    <div class="about-tow-experience-years-icon">
                                        <span class="flaticon-check"></span>
                                    </div>
                                    <div class="about-tow-experience-years-text">
                                        <h2>Instant <br> Finance System</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="funfacts-one-section" style="background-image: url(/landing/images/background/funfact-1-bg.jpg)">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <!--Funfacts One Single-->
                    <div class="funfacts-one-single wow fadeInUp" data-wow-delay="100ms">
                        <div class="icon">
                            <span class="flaticon-like"></span>
                        </div>
                        <div class="content count-box">
                            <h2>
                                <span class="timer" data-from="1" data-to="378" data-speed="5000"
                                    data-refresh-interval="50">9378</span>
                            </h2>
                            <p>Satisfied Users</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <!--Funfacts One Single-->
                    <div class="funfacts-one-single wow fadeInUp" data-wow-delay="200ms">
                        <div class="icon">
                            <span class="flaticon-architect"></span>
                        </div>
                        <div class="content count-box">
                            <h2>
                                $<span class="timer" data-from="1" data-to="780" data-speed="5000"
                                    data-refresh-interval="50">19780</span>
                            </h2>
                            <p>Total Deposit</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <!--Funfacts One Single-->
                    <div class="funfacts-one-single wow fadeInUp" data-wow-delay="300ms">
                        <div class="icon">
                            <span class="flaticon-medal"></span>
                        </div>
                        <div class="content count-box">
                            <h2>
                                $<span class="timer" data-from="1" data-to="189" data-speed="5000"
                                    data-refresh-interval="50">9189</span>
                            </h2>
                            <p>Total Withdrawals</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="main-service-one-section two">
        <div class="container">
            <div class="thm-section-title text-center">
                <h4 class="sub-title-shape-left section_title-subheading">WHAT WE OFFER</h4>
                <h2>We Are Dedicated To <br> Serve You All Time.</h2>
            </div>
            <div class="row">
                @foreach ($posts as $post)
                    <div class="col-xl-4 col-lg-4">
                        <!--Main Service One Sec Single-->
                        <div class="main-service-one-sec-single wow fadeInUp" data-wow-delay="300ms">
                            <div class="main-service-one-sec-img">
                                <img src="/landing/1.jpg" alt="">
                            </div>
                            <div class="main-service-one-sec-content">
                                <div class="main-service-one-count">0{{ $post->id }}</div>
                                <div class="main-service-one-icon"><i class="flaticon-mechanical-arm"></i></div>
                                <h3>{{ str()->words($post->title, 5) }}</h3>
                                <p>{{ str()->words($post->body, 15) }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="why-choose-two-section">
        <div class="container">
            <div class="thm-section-title text-center">
                <h4 class="sub-title-shape-left section_title-subheading">Our Skills</h4>
                <h2>We are Committed to <br> Continuous Improvement</h2>
            </div>
            <div class="row">
                <div class="col-xl-6">
                    <div class="why-choose-two-image">
                        <img src="/landing/about.jpg" alt="">
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="why-choose-right-content">
                        <div class="most-trusted-skill">
                            <div class="most-trusted-skill-icon">
                                <span class="flaticon-badge"></span>
                            </div>
                            <div class="most-trusted-text">
                                <h3>Most Trusted <br> & Certified Skills</h3>
                                <p>We stand out as a premier choice for forex trading due to our unwavering
                                    commitment to our clients' success and the exceptional value we bring to the
                                    table. Our team of expert traders is driven by a passion for excellence and an
                                    in-depth understanding of the forex market's intricacies. With a proven track
                                    record of delivering consistent profits and a transparent approach.
                                </p>
                            </div>
                        </div>
                        <div class="progress-levels">
                            <!--Skill Box-->
                            <div class="progress-box">
                                <div class="inner count-box">
                                    <div class="text">Crypto Trading</div>
                                    <div class="bar">
                                        <div class="bar-innner">
                                            <div class="skill-percent">
                                                <span class="count-text" data-speed="3000" data-stop="99">0</span>
                                                <span class="percent">%</span>
                                            </div>
                                            <div class="bar-fill" data-percent="99"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--Skill Box-->
                            <div class="progress-box">
                                <div class="inner count-box">
                                    <div class="text">Forex Trading</div>
                                    <div class="bar">
                                        <div class="bar-innner">
                                            <div class="skill-percent">
                                                <span class="count-text" data-speed="3000" data-stop="99">0</span>
                                                <span class="percent">%</span>
                                            </div>
                                            <div class="bar-fill" data-percent="99"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--Skill Box-->
                            <div class="progress-box">
                                <div class="inner count-box">
                                    <div class="text">Import Export</div>
                                    <div class="bar">
                                        <div class="bar-innner">
                                            <div class="skill-percent">
                                                <span class="count-text" data-speed="3000" data-stop="99">0</span>
                                                <span class="percent">%</span>
                                            </div>
                                            <div class="bar-fill" data-percent="99"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
