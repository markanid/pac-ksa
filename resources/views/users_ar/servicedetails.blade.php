<x-userlayout>

<section class="page-title bg-overlay-black-60 jarallax" data-speed="0.6" data-img-src="{{ asset('img/bg/services-bg.webp') }}">
  <div class="container">
    <div class="row">

      <div class="col-lg-12">
        <div class="page-title-name">
          <h1>Services</h1>
          <p>Delivering Industrial Excellence With Integrity</p>
        </div>
        <ul class="page-breadcrumb">
          <li><a href="#"><i class="fa fa-home"></i> Home</a> <i class="fa fa-angle-double-right"></i></li>
          <li><span>Service Details</span> </li>
        </ul>
      </div>
    </div>
  </div>
</section>


<!--=================================
 Premium Features -->

<section class="page-section-ptb">
  <div class="container">
    <div class="row">
      <div class="col-lg-6">
        <img class="img-fluid mx-auto" src="{{ asset('storage/services/' . $service_detail['image']) }}" alt="">
      </div>
      <div class="col-lg-6 sm-mt-50 align-self-center">
        <div class="section-title">
          <h2 class="title-effect">{{$service_detail['name']}} </h2>
         <!--  <p class="mt-30">Webster's ultimate, easy to use and customizable UI elements make it most customizable template on the market.</p> -->
        </div>
        <p> {!! str_replace('</p>', '', $service_detail['details']) !!} </p>
         
      </div>
   </div>
  </div>
</section>

<!--=================================
 Premium Features -->







</x-userlayout>