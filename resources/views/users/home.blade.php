<x-userlayout>

<section class="rev-slider">
  <div id="rev_slider_263_1_wrapper" class="rev_slider_wrapper fullwidthbanner-container" data-alias="webster-construction" data-source="gallery" style="margin:0px auto;background:transparent;padding:0px;margin-top:0px;margin-bottom:0px;">
<!-- START REVOLUTION SLIDER 5.4.6.3 fullwidth mode -->
  <div id="rev_slider_263_1" class="rev_slider fullwidthabanner" style="display:none;" data-version="5.4.6.3">
<ul>  <!-- SLIDE  -->


 @foreach($get_sliders as $slider)
<li data-index="rs-{{ $loop->index }}" 
    data-transition="fade" data-slotamount="default" 
    data-hideafterloop="0" data-hideslideonmobile="off" 
    data-easein="default" data-easeout="default" 
    data-masterspeed="300"  
    data-thumb="{{ asset('storage/sliders/' . $slider->image) }}"  
    data-rotate="0" data-saveperformance="off" 
    data-title="Slide" data-description="">
    
    <!-- MAIN IMAGE -->
    <img src="{{ asset('storage/sliders/' . $slider->image) }}"  
         alt="{{ $slider->heading_1 ?? 'Slider Image' }}"  
         data-bgposition="center center" data-bgfit="cover" 
         data-bgrepeat="no-repeat" class="rev-slidebg" data-no-retina>

    <!-- LAYER NR. 2 (Heading 1) -->
    @if(!empty($slider->heading_1))
    <div class="tp-caption tp-resizeme"
         id="slide-{{ $loop->index }}-layer-1"
         data-x="65" data-y="center" data-voffset="-140"
         data-type="text" data-responsive_offset="on"
         data-frames='[{"delay":1500,"speed":1000,"frame":"0",
                       "from":"y:[100%];opacity:0;",
                       "to":"o:1;","ease":"Power1.easeOut"},
                       {"delay":"wait","speed":300,"frame":"999",
                       "to":"opacity:0;","ease":"nothing"}]'
         style="z-index:6; font-size:73px; line-height:73px; 
                font-weight:700; color:#353535; 
                font-family:Poppins;text-transform:uppercase;">
         {{ $slider->heading_1 }}
    </div>
    @endif

    <!-- LAYER NR. 3 (Heading 2) -->
    @if(!empty($slider->heading_2))
    <div class="tp-caption tp-resizeme rev-color"
         id="slide-{{ $loop->index }}-layer-2"
         data-x="65" data-y="center" data-voffset="-72"
         data-type="text" data-responsive_offset="on"
         data-frames='[{"delay":2000,"speed":1000,"frame":"0",
                       "from":"y:[100%];opacity:0;",
                       "to":"o:1;","ease":"Power1.easeOut"},
                       {"delay":"wait","speed":300,"frame":"999",
                       "to":"opacity:0;","ease":"nothing"}]'
         style="z-index:7; font-size:73px; line-height:73px; 
                font-weight:700; color:#FFD200; 
                font-family:Poppins;text-transform:uppercase;">
         {{ $slider->heading_2 }}
    </div>
    @endif

    <!-- LAYER NR. 4 (Title) -->
    @if(!empty($slider->title))
    <div class="tp-caption tp-resizeme"
         id="slide-{{ $loop->index }}-layer-3"
         data-x="66" data-y="center" data-voffset="15"
         data-type="text" data-responsive_offset="on"
         data-frames='[{"delay":2720,"speed":1000,"frame":"0",
                       "from":"y:50px;opacity:0;",
                       "to":"o:1;","ease":"Power1.easeOut"},
                       {"delay":"wait","speed":300,"frame":"999",
                       "to":"opacity:0;","ease":"nothing"}]'
         style="z-index:8; font-size:30px; line-height:36px; 
                font-weight:700; color:#353535; 
                font-family:Poppins;">
         {{ $slider->title }}
    </div>
    @endif

</li>
@endforeach

</ul>
<div class="tp-bannertimer tp-bottom" style="visibility: hidden !important;"></div> </div>
<h6 class="lacks-heading d-none">Lacks Heading</h6> <!-- lacks heading for w3c -->
</div>

<!--=================================
 special-feature -->

<section class="special-feature">
   <div class="container">
      <div class="row-eq-height no-gutter">
       <div class="col-lg-4 col-md-4 gray-bg xs-mb-30">
        <div class="feature-text">
          <div class="feature-icon">
          <span class="ti-ruler-alt-2 theme-color"></span>
          </div>
        <div class="feature-info">
          <h4 class="mt-20">Industrial Projects</h4>
           <p>We deliver large-scale industrial and commercial projects with precision, safety, and efficiency. From fabrication to installation, PAC ensures durable and future-ready solutions.</p>
          <a class="button icon-color mt-20" href="{{url('services')}}">Read more <i class="fa fa-angle-right"></i></a>
        </div>
       </div>
      </div>
      <div class="col-lg-4 col-md-4 theme-bg xs-mb-30">
         <div class="feature-text">
          <div class="feature-icon">
          <span class="ti-home text-white"></span>
          </div>
        <div class="feature-info">
          <h4 class="mt-20 text-white">Facility Maintenance</h4>
           <p class="text-white">Our expert team provides reliable maintenance solutions for industrial, commercial, and residential facilities—ensuring smooth operations, safety, and long-term performance.</p>
          <a class="button icon-color text-white mt-20" href="{{url('services')}}">Read more <i class="fa fa-angle-right"></i></a>
        </div>
       </div>
      </div>
      <div class="col-lg-4 col-md-4 black-bg">
         <div class="feature-text">
          <div class="feature-icon">
          <span class="ti-layout theme-color"></span>
          </div>
        <div class="feature-info">
          <h4 class="mt-20 text-white">Government & Infrastructure</h4>
           <p class="text-white">PAC partners with government and institutional sectors to deliver infrastructure projects that meet the highest standards of compliance, durability, and safety.</p>
          <a class="button icon-color mt-20" href="{{url('services')}}">Read more <i class="fa fa-angle-right"></i></a>
        </div>
       </div>
      </div>
     </div>
   </div>
</section>
<!--=================================
 special-feature -->

 <!--=================================
about- -->

<section class="page-section-ptb">
 <div class="container">
  <div class="row">
    <div class="col-lg-6">
      <img class="img-fluid" src="{{ asset('storage/abouts/' . $about->image) }}" alt="">
    </div>
    <div class="col-lg-6 sm-mt-30">
        <div class="section-title line lef mb-20">
          <h6 class="subtitle">About Us</h6>
          <h2 class="title">{{ $about->welcome }}</h2>
        </div>
        <p>{!! str_replace('</p>', '', $about->our_journey) !!}</p>
       
    </div>
  </div>
 </div>
</section>

<!--=================================
about- -->

<!--=================================
counter-->

<section class="page-section-ptb text-white bg-overlay-black-70 jarallax" data-speed="0.6" data-img-src="img/bg/about.jpg">
  <div class="container">
  <div class="row">
     <div class="col-lg-12 col-md-12">
         <div class="section-title line lef">
            <h6 class="text-white subtitle">We're proud of</h6>
            <h2 class="text-white title">Our Impact</h2>
            <p class="text-white">Delivering excellence across industrial, civil, and MEP projects in Saudi Arabia with proven results.</p>
          </div>
       </div>
    </div>
    <div class="row">
        <div class="col-lg-3 col-sm-6 sm-mb-30">
        <div class="counter left-icon text-white">
          <span class="icon ti-cup theme-color" aria-hidden="true"></span>
          <span class="timer" data-to="100" data-speed="1000">100</span>
          <label>Successful Industrial Projects</label>
        </div>
      </div>
       <div class="col-lg-3 col-sm-6 sm-mb-30">
        <div class="counter left-icon text-white">
         <span class="icon ti-help-alt theme-color" aria-hidden="true"></span>
          <span class="timer" data-to="100" data-speed="1000">100</span>
          <label>Civil & Infrastructure Works</label>
        </div>
      </div>
       <div class="col-lg-3 col-sm-6 xs-mb-30">
        <div class="counter left-icon text-white">
          <span class="icon ti-check-box theme-color" aria-hidden="true"></span>
          <span class="timer" data-to="100" data-speed="1000">100</span>
          <label>MEP & Technical Installations</label>
        </div>
      </div>
       <div class="col-lg-3 col-sm-6">
        <div class="counter left-icon text-white">
          <span class="icon ti-face-smile theme-color" aria-hidden="true"></span>
          <span class="timer" data-to="500" data-speed="1000">500</span>
          <label>Trusted Clients Served</label>
        </div>
      </div>
    </div>
 </div>
</section>


<!--=================================
 Our activities -->

<section class="our-sercive1 page-section-1-pt">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="section-title line center text-center">
          <h6 class="subtitle">Our Featured </h6>
          <h2 class="title">Services </h2>
        </div>
      </div>
    </div>
     <div class="row justify-content-center">
       <div class="col-lg-10">
        <div class="row">
            @foreach($services as $featured)
          <div class="col-lg-6 col-md-6 col-sm-6" style="
    margin-bottom: 50px;
">
             <div class="feature-text left-icon">
                  <div class="feature-icon">
                    <span class="ti-shield theme-color" aria-hidden="true"></span>
                  </div>
                   <div class="feature-info">
                  <h5>{{$featured->name}}</h5>
                  <p> {{ Str::words(strip_tags($featured->details), 40) }} </p>
                  <a class="button icon-color" href="{{ route('users.servicedetails', $featured->slug) }}">Read more <i class="fa fa-angle-right"></i></a>
                  </div>
               </div>
          </div>
          @endforeach


         </div>
      </div>
      </div>
    <div class="row">
      <div class="col-md-12">
       <div class="text-center mt-40"><img class="img-fluid" src="{{ asset('img/bg/services-home.webp') }}" alt=""></div>
      </div>
    </div>
 </div>
</section>

<!--=================================
Meet our creative team  -->


<section class="page-section-ptb">
  <div class="container">
  <div class="row">
    <div class="col-md-8">
      <div class="section-title line lef">
          <h6 class="subtitle">Our Clients</h6>
          <h2 class="title">Our Happy Clients</h2>
        </div>
    </div>
  </div>
 <div class="row">
  

 <div class="col-lg-12 sm-mt-50">
      <div class="clients-list clients-border column-3">
         <ul class="list-unstyled">

          @foreach($clients as $client)
           <li>
              <img class="img-fluid d-block mx-auto" src="{{ asset('storage/clients/' . $client->image) }}" alt="">
           </li>
           @endforeach
         </ul>
      </div>
     </div>
    </div>
   </div>
</section>

<!--=================================
 footer -->
</x-userlayout>
