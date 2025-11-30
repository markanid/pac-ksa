<x-userlayout-ar>

<section class="page-title bg-overlay-black-60 jarallax" data-speed="0.6" data-img-src="{{ asset('img/bg/about.jpg') }} ">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="page-title-name">
          <h1>About</h1>
          <p>Building Excellence. Powering Progress.</p>
        </div>
        <ul class="page-breadcrumb">
          <li><a href="#"><i class="fa fa-home"></i> Home</a> <i class="fa fa-angle-double-right"></i></li>
          <li><span>About</span> </li>
        </ul>
      </div>
    </div>
  </div>
</section>

<section class="page-section-ptb">
  <div class="container">
     <div class="row">
           <div class="col-lg-6">
         <div class="who-we-are-left">
         <div class="" data-nav-dots="true" data-items="1" data-md-items="1" data-sm-items="1" data-xs-items="1" data-xx-items="1">
          
          <div class="item"><img class="img-fluid full-width" src="{{ asset('storage/abouts/' . $about['image']) }}" alt="">
          </div>
         </div>
        </div>
      </div>
      <div class="col-lg-6 sm-mt-30">
        <div class="section-title">
            <h6> {{ $about['welcome_ar'] }}</h6>
            <h2 class="title-effect">Get to know us better.</h2>
          </div>
          <p> {!! str_replace('</p>', '', $about['our_journey_ar']) !!}  </p>
         
      </div>
     </div>
       
  </div>
</section>


<section class="theme-bg page-section-ptb">
   <div class="container">
       <div class="row">
         <div class="col-lg-4 col-md-4 col-sm-4 mb-30">
              <h1 class="text-white">01<span class="text-black">.</span></h1>
              <h3 class="text-white">INDUSTRIAL EXPERTISE</h3>
              <p class="text-white">We bring years of experience and technical know-how, ensuring high-quality solutions for complex industrial challenges.</p>
         </div>
         <div class="col-lg-4 col-md-4 col-sm-4 mb-30">
              <h1 class="text-white">02<span class="text-black">.</span></h1>
              <h3 class="text-white">CUSTOMER-FOCUSED APPROACH</h3>
              <p class="text-white">Our team works closely with clients to understand their needs and deliver efficient, safe, and reliable solutions on time.</p>
         </div>
         <div class="col-lg-4 col-md-4 col-sm-4">
              <h1 class="text-white">03<span class="text-black">.</span></h1>
              <h3 class="text-white">CERTIFIED & RELIABLE</h3>
              <p class="text-white">Trusted by leading businesses, we uphold the highest industry standards to guarantee compliance, safety, and performance.</p>
         </div>
      </div>
  </div>
</section>

<section class="our-activities gray-bg page-section-ptb">
  <div class="container">
     <div class="row">
      <div class="col-lg-7 ">
         <div class="section-title">
            <h6>Let's have a look at</h6>
            <h2 class="title-effect">Why choose us</h2>
            <p>{!! str_replace('</p>', '', $about['whychooseus_ar']) !!}</p>
          </div>
        
        </div>
        <div class="col-lg-5">
          <div class="accordion plus-icon shadow">
              <div class="acd-group acd-active">
                  <a href="#" class="acd-heading acd-active">01. Our Vision</a>
                  <div class="acd-des"> {!! str_replace('</p>', '', $about['vision_ar']) !!}</div>
              </div>
              <div class="acd-group">
                  <a href="#" class="acd-heading">02. Our Commitment & Collaboration</a>
                  <div class="acd-des"> {!! str_replace('</p>', '', $about['commitment_ar']) !!}</div>
              </div> 
               <div class="acd-group">
                  <a href="#" class="acd-heading">03. Health & Safety Policy</a>
                  <div class="acd-des"> {!! str_replace('</p>', '', $about['hspolicy_ar']) !!}</div>
              </div> 
          </div>
      </div>
    </div>
 </div>
</section>
</x-userlayout-ar>