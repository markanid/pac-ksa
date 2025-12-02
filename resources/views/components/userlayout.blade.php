<!DOCTYPE html>
<html lang="en">
   <head>
      @php
      use Illuminate\Support\Str;
      if (!empty($metadata)) {
        $isHome                 = request()->routeIs('users.home');
        $isAbout                = request()->routeIs('users.aboutus');
        $isServices             = request()->routeIs('users.services');
        $isServiceDetails       = request()->routeIs('users.servicedetails');
        $isProjects             = request()->routeIs('users.projects');
        $isContact              = request()->routeIs('users.contactus');
        $firstPart              = Str::of($metadata->title)->before('|')->trim();
        $logoUrl                = asset('storage/meta_datas/' . $metadata->og_image);
        $item = $isServiceDetails && isset($service) ? $service : null;
        if ($item) {
          // Determine title
          $title = $item->meta_title ?? 
          ($item->heading ?? 
          ($item->name ?? ''));
          // Determine description
          $description = $item->description ?? 
          ($item->meta_description ?? 
          ($item->heading ?? ''));
          // Determine keywords
          $keyword = $item->keyword ?? '';
          // Determine image path
          $folder = $isServiceDetails ? 'services' : null;
          $imagePath = $item->image ?? 
          ($item->desktop_image ?? null);
          $pageImage = $imagePath ? asset("storage/{$folder}/{$imagePath}") : $logoUrl;
          $pageTitle      = trim($firstPart . ' | ' . $title);
          $pageDescription= $description;
          $pageKeyword    = $keyword;
        } else {
          $pageTitle      = $metadata->title;
          $pageDescription= $metadata->desciption; 
          $pageKeyword    = $metadata->keyword; 
          $pageImage      = $logoUrl;
        }
        // Final fallback in case title or description is empty
        $pageTitle      = $pageTitle ?: $metadata->title;
        $pageDescription= $pageDescription ?: $metadata->desciption;
        $pageKeyword    = $pageKeyword ?: $metadata->keyword;
        // Append route-specific title suffix
        if ($isHome) {
          $pageTitle = $firstPart . ' | Home';
        } elseif ($isAbout) {
          $pageTitle = $firstPart . ' | About Us';
        } elseif ($isServices) {
          $pageTitle = $firstPart . ' | Services';
        } elseif ($isProjects) {
          $pageTitle = $firstPart . ' | Projects';
        } elseif ($isContact) {
          $pageTitle = $firstPart . ' | Contact Us';
        }
      } else {
        // Provide sensible defaults in case $metadata is null
        $pageTitle      = 'Pearl Asia – Industrial Company';
        $pageDescription= 'Default Description';
        $pageKeyword    = 'Default Keyword';
        $pageImage      = asset('default-image.jpg'); // Replace with a real fallback image path
      }
      @endphp 
      <title>{{ $pageTitle }}</title>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="author" content="Apex Soft Labs">
      <meta name="viewport" content="width=device-width,initial-scale=1.0" />
      <meta name="description" content="{{ $pageDescription }}">
      <meta name="keywords" content="{{ $pageKeyword }}">
      <meta name="robots" content="index, follow">
      <link rel="canonical" href="{{ url()->current() }}" />
      <meta property="og:title" content="{{ $pageTitle }}" />
      <meta property="og:description" content="{{ $pageDescription }}" />
      <meta property="og:image" content="{{ $pageImage }}" alt="OG Image" />
      <meta property="og:url" content="{{ url()->current() }}" />
      <meta property="og:type" content="website" />

      <!-- Favicon -->
      <link rel="shortcut icon" href="{{ asset('img/logo1.jpg') }}" />
      <!-- font -->
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800,900">
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900">
      <!-- Plugins -->
      <link rel="stylesheet" type="text/css" href="{{ asset('css/plugins-css.css') }}" />
      <!-- revoluation -->
      <link rel="stylesheet" type="text/css" href="{{ asset('css/settings.css') }}" media="screen" />
      <!-- Typography -->
      <link rel="stylesheet" type="text/css" href="{{ asset('css/typography.css') }}" />
      <!-- Shortcodes -->
      <link rel="stylesheet" type="text/css" href="{{ asset('css/shortcodes/shortcodes.css') }}" />
      <!-- Style -->
      <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}" />
      <!-- construction -->
      <link rel="stylesheet" type="text/css" href="{{ asset('css/construction.css') }}" />
      <!-- Responsive -->
      <link rel="stylesheet" type="text/css" href="{{ asset('css/responsive.css') }}" />
      <!-- Style customizer -->
      <link rel="stylesheet" type="text/css" href="{{ asset('css/skins/skin-red.css') }}" data-style="styles"/>
   </head>
   <body>
      <div class="wrapper">
         <!--=================================
            header -->
         <header id="header" class="header fancy">
            <div class="topbar">
               <div class="container">
                  <div class="row">
                     <div class="col-lg-6 col-md-6 xs-mb-10">
                        <div class="topbar-call text-center text-md-start">
                           <ul>
                              <li><i class="fa fa-envelope-o theme-color"></i> {{$contact->email}}</li>
                              <li><i class="fa fa-phone"></i> <a href="tel:+7042791249"> <span>{!! implode(',', json_decode($contact->phones, true)) !!} </span> </a> </li>
                           </ul>
                        </div>
                     </div>
                     <div class="col-lg-6 col-md-6">
                        <div class="topbar-social text-center text-md-end">
                           <ul>
                              <li><a href="{{$contact->facebook}}"><span class="ti-facebook"></span></a></li>
                              <li><a href="{{$contact->instagram}}"><span class="ti-instagram"></span></a></li>
                              <li><a href="#"><span class="fa fa-google"></span></a></li>
                              <li><a href="{{$contact->x}}"><span class="ti-twitter"></span></a></li>
                              <li><a href="#"><span class="ti-linkedin"></span></a></li>
                              <li><a href="#"><span class="ti-dribbble"></span></a></li>
                              <!-- 👇 Language Switch -->
                              <li style="font-weight:600;">
                                 <a href="{{ url('ar' . request()->getRequestUri()) }}">العربية</a>
                              </li>
                           </ul>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!--=================================
               mega menu -->
            <div class="menu">
               <div class="container">
                  <div class="row">
                     <div class="col-lg-12 col-md-12">
                        <!-- menu start -->
                        <nav id="menu" class="mega-menu">
                           <!-- menu list items container -->
                           <section class="menu-list-items" style="height:100px">
                              <!-- menu logo -->
                              <ul class="menu-logo">
                                 <li>
                                    <a href="/"><img src="{{ asset('img/logo.webp') }}" alt="logo"> </a>
                                 </li>
                              </ul>
                              <!-- menu links -->
                              <div class="menu-bar">
                                 <ul class="menu-links">
                                  <li class="{{ request()->routeIs('users.home') ? 'active' : '' }}">
                                      <a href="/">Home</a>
                                  </li>

                                  <li class="{{ request()->routeIs('users.aboutus') ? 'active' : '' }}">
                                      <a href="{{url('aboutus')}}">About</a>
                                  </li>

                                  <li class="{{ request()->routeIs('users.services') || request()->routeIs('users.servicedetails') ? 'active' : '' }}">
                                      <a href="{{url('services')}}">Service</a>
                                  </li>

                                  <li class="{{ request()->routeIs('users.projects') ? 'active' : '' }}">
                                      <a href="{{url('projects')}}">Projects</a>
                                  </li>

                                  <li class="{{ request()->routeIs('users.contactus') ? 'active' : '' }}">
                                      <a href="{{url('contactus')}}">Contact</a>
                                  </li>
                                 </ul>
                              </div>
                           </section>
                        </nav>
                     </div>
                  </div>
               </div>
            </div>
            <!-- menu end -->
         </header>
         {{ $slot }}
         <!--=================================
            action box- -->
         <section class="action-box theme-bg full-width">
            <div class="container">
               <div class="row">
                  <div class="col-lg-12 col-md-12 position-relative">
                     <div class="action-box-text">
                        <h3><strong> PEARL ASIA - INDUSTRIAL COMPANY</strong></h3>
                        <p>Deliver expert industrial solutions with cutting-edge technology, tailored for Saudi Arabia’s infrastructure needs.</p>
                     </div>
                     <div class="action-box-button">
                        <a class="button button-border white" href="{{url('contactus')}}">
                        <span>Contact Us</span>
                        <i class="fa fa-phone"></i>
                        </a>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!--=================================
            action box- -->
         <!--=================================
            footer -->
         <footer class="footer page-section-pt black-bg">
            <div class="container">
               <div class="row">
                  <div class="col-lg-2 col-sm-6 sm-mb-30">
                     <div class="footer-useful-link footer-hedding">
                        <h6 class="text-white mb-30 mt-10 text-uppercase">Navigation</h6>
                        <ul>
                           <li><a href="/">Home</a></li>
                           <li><a href="{{url('aboutus')}}">About Us</a></li>
                           <li><a href="{{url('services')}}">Service</a></li>
                           <li><a href="{{url('contactus')}}">Contact Us</a></li>
                        </ul>
                     </div>
                  </div>
                  <div class="col-lg-4 col-sm-6 xs-mb-30">
                     <h6 class="text-white mb-30 mt-10 text-uppercase">Contact Us</h6>
                     <ul class="addresss-info">
                        <li>
                           <i class="fa fa-map-marker"></i> 
                           <p>Address: {!! collect(json_decode($contact->addresses, true))
                              ->pluck('address')
                              ->implode('<br>') !!}
                           </p>
                        </li>
                        <li><i class="fa fa-phone"></i> <a href="tel:7042791249"> <span>{!! implode(',', json_decode($contact->phones, true)) !!} </span> </a> </li>
                        <li><i class="fa fa-envelope-o"></i>Email: {{$contact->email}}</li>
                     </ul>
                  </div>
                  <div class="col-lg-4 col-sm-6">
                     <h6 class="text-white mb-30 mt-10 text-uppercase">Subscribe to Our Newsletter</h6>
                     <p>Sign Up to our Newsletter to get the latest news and offers.</p>
                     <div class="footer-Newsletter">
                        <div id="mc_embed_signup_scroll">
                           <form action="php/mailchimp-action.php" method="POST" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate">
                              <div id="msg"> </div>
                              <div id="mc_embed_signup_scroll_2">
                                 <input id="mce-EMAIL" class="form-control" type="text" placeholder="Email address" name="email1" value="">
                              </div>
                              <div id="mce-responses" class="clear">
                                 <div class="response" id="mce-error-response" style="display:none"></div>
                                 <div class="response" id="mce-success-response" style="display:none"></div>
                              </div>
                              <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                              <div style="position: absolute; left: -5000px;">
                                 <input type="text" name="b_b7ef45306f8b17781aa5ae58a_6b09f39a55" tabindex="-1" value="">
                              </div>
                              <div class="clear">
                                 <button type="submit" name="submitbtn" id="mc-embedded-subscribe" class="button button-border mt-20 form-button">  Get notified </button>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="footer-widget mt-20">
                  <div class="row">
                     <div class="col-lg-6 col-md-6">
                        <p class="mt-15">
                           &copy;Copyright 
                           <span id="copyright">
                              <script>document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))</script>
                           </span>
                           <a href="#"> Perl Asia </a> All Rights Reserved 
                        </p>
                     </div>
                     <div class="col-lg-6 col-md-6 text-start text-md-end">
                        <div class="footer-widget-social">
                           <ul>
                              <li><a href="{{$contact->facebook}}"><i class="fa fa-facebook"></i></a></li>
                              <li><a href="{{$contact->x}}"><i class="fa fa-twitter"></i></a></li>
                              <li><a href="#"><i class="fa fa-dribbble"></i> </a></li>
                              <li><a href="{{$contact->linkedin}}"><i class="fa fa-linkedin"></i> </a></li>
                           </ul>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </footer>
         <!--=================================
            footer -->
      </div>
      <div id="back-to-top"><a class="top arrow" href="#top"><i class="fa fa-angle-up"></i> <span>TOP</span></a></div>
      <!--=================================
         jquery -->
      <!-- jquery -->
      <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
      <!-- plugins-jquery -->
      <script src="{{ asset('js/plugins-jquery.js') }}"></script>
      <!-- plugin_path -->
      <script>var plugin_path = 'js/';</script>
      <!-- REVOLUTION JS FILES -->
      <script src="{{ asset('js/jquery.themepunch.tools.min.js') }}"></script>
      <script src="{{ asset('js/jquery.themepunch.revolution.min.js') }}"></script>
      <!-- SLIDER REVOLUTION 5.0 EXTENSIONS  (Load Extensions only on Local File Systems !  The following part can be removed on Server for On Demand Loading) -->
      <script src="{{ asset('js/extensions/revolution.extension.actions.min.js') }}"></script>
      <script src="{{ asset('js/extensions/revolution.extension.carousel.min.js') }}"></script>
      <script src="{{ asset('js/extensions/revolution.extension.kenburn.min.js') }}"></script>
      <script src="{{ asset('js/extensions/revolution.extension.layeranimation.min.js') }}"></script>
      <script src="{{ asset('js/extensions/revolution.extension.migration.min.js') }}"></script>
      <script src="{{ asset('js/extensions/revolution.extension.navigation.min.js') }}"></script>
      <script src="{{ asset('js/extensions/revolution.extension.parallax.min.js') }}"></script>
      <script src="{{ asset('js/extensions/revolution.extension.slideanims.min.js') }}"></script>
      <script src="{{ asset('js/extensions/revolution.extension.video.min.js') }}"></script>
      <!-- revolution custom -->
      <script src="{{ asset('js/revolution-custom.js') }}"></script>
      <!-- custom -->
      <script src="{{ asset('js/custom.js') }}"></script>

      <script>
      document.addEventListener("DOMContentLoaded", function() {
         let f = document.getElementById("contactform");
         if (f) {
            f.addEventListener("submit", function(e) {
                  // Remove all template JS overrides
                  e.stopImmediatePropagation(); 
                  // Allow normal form submit
            }, true);
         }
      });
      </script>
   </body>
</html>