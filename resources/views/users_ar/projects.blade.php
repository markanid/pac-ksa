 <x-userlayout-ar>

<section class="page-title bg-overlay-black-60 jarallax" data-speed="0.6" data-img-src="img/bg/projects.jpg">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
	      <div class="page-title-name">
	        <h1>Projects</h1>
	        <p>Showcasing Excellence in Every Project</p>
	      </div>
        <ul class="page-breadcrumb">
          <li><a href="#"><i class="fa fa-home"></i> Home</a> <i class="fa fa-angle-double-right"></i></li>
          <li><span>projects</span> </li>
        </ul>
      </div>
    </div>
  </div>
</section>

<!--=================================
page-title -->


 <!--=================================
 grid -->

<section class="white-bg page-section-ptb">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 text-center">
        <div class="isotope-filters">
    <button data-filter="*" class="active">All</button>
    @foreach($categories as $category)
        <button data-filter=".{{ Str::slug($category->name, '-') }}">
            {{ $category->name }}
        </button>
    @endforeach
</div>
       <div class="isotope columns-4 popup-gallery">
    @foreach($projects as $project)
        <div class="grid-item {{ Str::slug($project->category_name, '-') }}">
            <div class="portfolio-item">
                <img src="{{ asset('storage/projects/' . $project->desktop_image) }}" alt="">
                <div class="portfolio-overlay">
                    <h4 class="text-white">
                        <a href="portfolio-single-{{ $project->id }}.html">
                            {{ $project->name }}
                        </a>
                    </h4>
                    <span class="text-white">
                        <a href="#">{{ $project->category_name }}</a>
                    </span>
                </div>
                <a class="popup portfolio-img" href="{{ asset('storage/projects/' . $project->desktop_image) }}">
                    <i class="fa fa-arrows-alt"></i>
                </a>
            </div>
        </div>
    @endforeach
</div>

      </div>
    </div>
  </div>
</section>

 <!--=================================
 grid -->


</x-userlayout-ar>