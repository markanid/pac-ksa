<x-userlayout-ar>

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

<section class="page-section-ptb">
  <div class="container">
    <div class="row">
      <div class="col-lg-6">
        <img class="img-fluid mx-auto" src="{{ asset('storage/services/' . $service['image']) }}" alt="">
      </div>
      <div class="col-lg-6 sm-mt-50 align-self-center">
        <div class="section-title">
          <h2 class="title-effect">{{$service['name_ar']}} </h2>
        </div>
        <p> {!! str_replace('</p>', '', $service['details_ar']) !!} </p>
         
      </div>
   </div>
  </div>
</section>
</x-userlayout-ar>