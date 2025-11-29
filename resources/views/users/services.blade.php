<x-userlayout>

        <div class="page-title">
            <div class="page-title-inner">
                <div class="left">
                    <div class="page-content">
                        <div class="subtext text-uppercase">
                            Full project management
                        </div>
                        <h2 class="title">
                            Our Services
                        </h2>
                        <div class="text">
                            We are one of the most trusted steel detailing companies, delivering accuracy and reliability across every project. Over the years, we have earned this reputation by providing high-quality models and drawings that help fabricators build safer, faster, and smarter.
                        </div>
                        <div class="breadcrumb">
                            <a href="index.html" class="text-uppercase">Home</a>
                            <span class="text-uppercase">our services</span>
                        </div>
                    </div>
                    <div class="image-item item-1">
                        <img src="{{ asset('image/page-title/page-title-item-1.png') }}" data-src="{{ asset('image/page-title/page-title-item-1.png') }}" alt="" class=" ls-is-cached lazyloaded">
                    </div>
                </div>
                <div class="right">
                    <div class="image">
                        <img src="{{ asset('image/page-title/page-title-10.jpg') }}" data-src="{{ asset('image/page-title/page-title-10.jpg') }}" alt="">
                    </div>
                </div>
            </div>
        </div>

        <div class="main-content">

            <section class="section-1 p-our-services tf-spacing-34">
                <div class="tf-container">
                    <div class="heading-section text-center mb-62">
                        <h3 class="title mb-16 tf-animate-2">
                            We Provide a Complete Range of Steel Detailing Services
                        </h3>
                        <p class="text lsp-0 body-2 fw5 tf-animate-2">
                            Our experienced team specializes in delivering end-to-end steel detailing solutions, from structural and miscellaneous steel to connection design, estimation, and project management. With advanced tools and proven workflows, we ensure accuracy, efficiency, and constructability across every project.
                        </p>
                    </div>
                </div>
                <div class="tf-container w-1800 mb-70">
                    <div class="swiper tf-swiper sw-why-us" data-swiper='{
                        "slidesPerView": 1,
                        "spaceBetween": 30,
                        "speed": 800,
                        "navigation": {
                            "clickable": true,
                            "nextEl": ".why-next",
                            "prevEl": ".why-prev"
                        },
                        "pagination": { "el": ".sw-pagination-why", "clickable": true },
                        "breakpoints": {
                            "767": { "slidesPerView": 2, "slidesPerGroup": 1},
                            "1150": { "slidesPerView": 3, "slidesPerGroup": 1}
                            }
                        }'>
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="box-card bg-color-white">
                                    <div class="top-box">
                                        <h4>
                                            <a href="#" class="title">Quality</a>
                                        </h4>
                                        <div class="desc">
                                            We deliver precise, error-free detailing backed by advanced tools like SDS2 and Tekla. Every drawing and model reflects our commitment to accuracy, constructability, and industry standards
                                        </div>
                                    </div>
                                    <!-- <div class="bottom-box flex align-items-end justify-content-between">
                                        <a href="#" class="tf-btn-default text-uppercase">
                                            view more
                                            <i class="icon-right-arrow11"></i>
                                        </a>
                                        <div class="icon-box">
                                            <i class="icon-layer"></i>
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="box-card bg-color-white">
                                    <div class="top-box">
                                        <h4>
                                            <a href="#" class="title">Integrity</a>
                                        </h4>
                                        <div class="desc">
                                            We believe strong partnerships are built on trust. At Nexont, transparency, accountability, and consistency define the way we work — ensuring clients can rely on us every time
                                        </div>
                                    </div>
                                    <!-- <div class="bottom-box flex align-items-end justify-content-between">
                                        <a href="#" class="tf-btn-default text-uppercase">
                                            view more
                                            <i class="icon-right-arrow11"></i>
                                        </a>
                                        <div class="icon-box">
                                            <i class="icon-venn-diagram"></i>
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="box-card bg-color-white">
                                    <div class="top-box">
                                        <h4>
                                            <a href="#" class="title">Experience</a>
                                        </h4>
                                        <div class="desc">
                                            With a proven track record across U.S. and Canadian markets, our team brings expertise in structural, miscellaneous, and industrial detailing. We adapt to diverse project needs, ensuring smooth execution from start to finish.
                                        </div>
                                    </div>
                                    <!-- <div class="bottom-box flex align-items-end justify-content-between">
                                        <a href="#" class="tf-btn-default text-uppercase">
                                            view more
                                            <i class="icon-right-arrow11"></i>
                                        </a>
                                        <div class="icon-box">
                                            <i class="icon-hammer"></i>
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                        <div class="sw-pagination-why sw-pagination mt-20 d-xl-none text-center"></div>
                    </div>
                </div>
                <div class="tf-container w-1800">
                    <div class="image-section">
                        <img src="{{ asset('image/section/img-home-p-our-services.jpg') }}" data-src="{{ asset('image/section/img-home-p-our-services.jpg') }}" alt="" class="lazyload parallax-img ">
                    </div>
                </div>
            </section>

            <section class="section-services tf-spacing-22">
                <div class="tf-container">
                    <div class="heading-section text-center mb-64">
                        <span class="sub-title style-2 text-uppercase fw5 mb-12 mx-auto tf-animate-2">
                            what we offer
                        </span>
                        <h3 class="title mb-12 tf-animate-2">
                            We Deliver Exceptional Value<br> to Our Clients
                        </h3>
                        <div class="text lsp-0 body-2 lh28 tf-animate-2">
                            Nexont Engineering is committed to being a trusted partner for all your steel detailing needs. With precision, innovation, and reliability at our core, we ensure every project is executed seamlessly — helping fabricators build faster, smarter, and with complete confidence.
                        </div>
                    </div>
                </div>
                <div class="tf-container">
                    <div class="row rg-57">
                         @foreach ($services as   $service)
                        <div class="col-lg-4 col-md-6">
                            <div class="services-item style-5 hover-img">
                                <div class="top-item">
                                    <a href="services-details.html" class="image">
                                        <img src="{{ asset('storage/services/' . $service['image']) }}" data-src="{{ asset('storage/services/' . $service['image']) }}" alt="" class=" ls-is-cached lazyloaded">
                                    </a>
                                    <div class="icon-services">
                                        <i class="icon-sketch"></i>
                                    </div>
                                </div>
                                <div class="services-content">
                                    <h6 class="name-services">
                                        <a href="{{ route('users.servicedetails', $service->slug) }}">{{$service['name']}}</a>
                                    </h6>
                                    <div class="desc">
                                        {{ Str::words(strip_tags($service['description']), 40) }}

                                    </div>
                                    <a href="{{ route('users.servicedetails', $service->slug) }}" class="tf-btn-default text-uppercase">
                                        view more
                                        <i class="icon-right-arrow11"></i>
                                    </a>
                                </div>
                    </div>
                </div>
               @endforeach

            </section>

            
        </div>

</x-userlayout>