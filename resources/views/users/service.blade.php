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
          <li><span>Services</span> </li>
        </ul>
      </div>
    </div>
  </div>
</section>

<section class="our-clients theme-bg text-white page-section-ptb position-relative">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <h2 class="text-uppercase text-white mb-0 text-center">We provide the best service</h2>
      </div>
    </div>
  </div>
</section>

<section class="secrvice-blog pb-80">
  <div class="container">
    <div class="row">

       @foreach ($services as   $service)
      <div class="col-lg-4 col-md-4 col-sm-12 mb-30">
        <div class="card border-0  box-content o-hidden h-100">
          <img class="" src="{{ asset('storage/services/' . $service->image) }}" alt="" style="width: 350px;height: 350px;padding: 20px 20px 20px 35px;">
          <div class="p-4">
            <h4 class="fw-5"><a href="{{ route('users.servicedetails', $service->slug) }}" class="text-black"> {{$service->name}}</a></h4>
            <p class="mb-0 pb-0 text-black"> {{ Str::words(strip_tags($service->details), 40) }}</p>
          </div>
        </div>
      </div>
         @endforeach
       
    </div>
  </div>
</section>

</x-userlayout>