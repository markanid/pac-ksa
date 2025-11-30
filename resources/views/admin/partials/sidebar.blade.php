@php
$current_route = request()->route()->getName(); 
@endphp
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
<!-- Brand Logo -->
<a href="#" class="brand-link">
  <img src="{{asset('admin-assets/dist/img/logo-tp-white.png')}}" alt="Logo" class="" style="width: 200px;" >
  <span class="brand-text font-weight-light"></span>
</a>

<!-- Sidebar -->
<div class="sidebar">
  <!-- Sidebar user panel (optional) -->
   <div class="user-panel mt-3 pb-3 mb-3 d-flex">
    <div class="image">
      <img src="{{asset('admin-assets/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
    </div>
    <div class="info">
      <a href="#" class="d-block">{{auth()->user()->name}}</a>
    </div>
  </div>

 
  <!-- Sidebar Menu -->
  <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->
      
        <li class="nav-item">
          <a href="{{route('dashboard')}}" class="nav-link {{$current_route=='dashboard'?'active':''}}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        {{-- @if(auth()->user()?->role === 'admin') --}}

        <li class="nav-item">
          <a href="{{ route('meta_data.index') }}" class="nav-link {{ menuActive(['meta_data.index', 'meta_data.create', 'meta_data.edit', 'meta_data.show'], 'active') }}">
         <i class="nav-icon fas fa-code"></i>
            <p>Meta Data</p>
          </a>
        </li>
        
        <li class="nav-item">
           <a href="{{route('about.index')}}" class="nav-link {{ menuActive(['about.index', 'about.create', 'about.edit', 'about.show'], 'active') }}">
           <i class="nav-icon fas fa-info-circle"></i>
             <p>About</p>
           </a>
         </li>

         <li class="nav-item">
           <a href="{{route('features.index')}}" class="nav-link {{ menuActive(['features.index', 'features.create', 'features.edit', 'features.show'], 'active') }}">
           <i class="nav-icon fas fa-feather-alt"></i>
             <p>Features</p>
           </a>
         </li>

         <li class="nav-item">
           <a href="{{route('services.index')}}" class="nav-link {{ menuActive(['services.index', 'services.create', 'services.edit', 'services.show'], 'active') }}">
           <i class="nav-icon fab fa-servicestack"></i>
             <p>Services</p>
           </a>
         </li>

         <li class="nav-item">
           <a href="{{route('sliders.index')}}" class="nav-link {{ menuActive(['sliders.index', 'sliders.create', 'sliders.edit', 'sliders.show'], 'active') }}">
           <i class="nav-icon fab fa-servicestack"></i>
             <p>sliders</p>
           </a>
         </li>

         <li class="nav-item">
           <a href="{{route('categories.index')}}" class="nav-link {{ menuActive(['categories.index', 'categories.create', 'categories.edit', 'categories.show'], 'active') }}">
           <i class="nav-icon fas fa-list"></i>
             <p>Category</p>
           </a>
         </li>

         <li class="nav-item">
           <a href="{{route('projects.index')}}" class="nav-link {{ menuActive(['projects.index', 'projects.create', 'projects.edit', 'projects.show'], 'active') }}">
           <i class="nav-icon far fa-image"></i>
             <p>Projects</p>
           </a>
         </li>
         
          <li class="nav-item">
            <a href="{{route('clients.index')}}" class="nav-link {{ menuActive(['clients.index', 'clients.create', 'clients.edit', 'clients.show'], 'active') }}">
              <i class="nav-icon fas fa-user-tie"></i>
              <p>Clients</p>
            </a>
          </li>
         
          <li class="nav-item">
            <a href="{{route('contact.index')}}" class="nav-link {{ menuActive(['contact.index', 'contact.create', 'contact.edit', 'contact.show'], 'active') }}">
              <i class="nav-icon fas fa-address-book"></i>
              <p>Contact</p>
            </a>
          </li>
    </ul>
  </nav>
  <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
</aside>