
  <!-- BEGIN: Body-->
  <body class="vertical-layout vertical-menu-modern semi-dark-layout 2-columns  navbar-sticky footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="2-columns" data-layout="semi-dark-layout">

    <!-- BEGIN: Header-->
    <div class="header-navbar-shadow"></div>
    <nav class="header-navbar main-header-navbar navbar-expand-lg navbar navbar-with-menu fixed-top ">
      <div class="navbar-wrapper">
        <div class="navbar-container content">
          <div class="navbar-collapse" id="navbar-mobile">
            <div class="mr-auto float-left bookmark-wrapper d-flex align-items-center">
              <ul class="nav navbar-nav">
                <li class="nav-item mobile-menu d-xl-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ficon bx bx-menu"></i></a></li>
              </ul>
              <ul class="nav navbar-nav bookmark-icons">
                <li class="nav-item d-none d-lg-block"><a class="nav-link" href="{{ route('seller_product') }}" data-toggle="tooltip" data-placement="top" title="Seller Product price"><i class="ficon bx bx-dollar-circle"></i></a></li>
                <li class="nav-item d-none d-lg-block"><a class="nav-link" href="{{ route('wishlist') }}" data-toggle="tooltip" data-placement="top" title="Wishlist"><i class="ficon bx bx-add-to-queue"></i></a></li>
                <li class="nav-item d-none d-lg-block"><a class="nav-link" href="{{ route('shopping_cart') }}" data-toggle="tooltip" data-placement="top" title="Shopping cart"><i class="ficon bx bx-cart-alt"></i></a></li>
              </ul>
            </div>
            <ul class="nav navbar-nav float-right">
              <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-expand"><i class="ficon bx bx-fullscreen"></i></a></li>
  
              <li class="dropdown dropdown-notification nav-item"><a class="nav-link nav-link-label" href="#" data-toggle="dropdown"><i class="ficon bx bx-bell bx-tada bx-flip-horizontal"></i><span class="badge badge-pill badge-danger badge-up">5</span></a>
                <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                  <li class="dropdown-menu-header">
                    <div class="dropdown-header px-1 py-75 d-flex justify-content-between"><span class="notification-title">7 new Notification</span><span class="text-bold-400 cursor-pointer">Mark all as read</span></div>
                  </li>
                  <li class="dropdown-menu-footer"><a class="dropdown-item p-50 text-primary justify-content-center" href="javascript:void(0)">Read all notifications</a></li>
                </ul>
              </li>
              <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                  <div class="user-nav d-sm-flex d-none"><span class="user-name">Admin</span><span class="user-status text-muted">Available</span></div><span><img class="round" src="{{ asset('assets/app-assets/images/portrait/small/avatar-s-11.jpg') }}" alt="avatar" height="40" width="40"></span></a>
                <div class="dropdown-menu dropdown-menu-right pb-0"><a class="dropdown-item" href="page-user-profile.html"><i class="bx bx-user mr-50"></i> Edit Profile</a><a class="dropdown-item" href="app-todo.html"><i class="bx bx-check-square mr-50"></i> Change password</a>
                  <div class="dropdown-divider mb-0"></div><a class="dropdown-item" href="auth-login.html"><i class="bx bx-power-off mr-50"></i> Logout</a>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </nav>
    <!-- END: Header-->


    <!-- BEGIN: Main Menu-->
    <div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
      <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
          <li class="nav-item mr-auto"><a class="navbar-brand" href="index.html">
              <div class="brand-logo"><img class="logo" src="{{ asset('assets/app-assets/images/logo/logo.png') }}"/></div>
              <h2 class="brand-text mb-0">Flash</h2></a></li>
          <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="bx bx-x d-block d-xl-none font-medium-4 primary"></i><i class="toggle-icon bx bx-disc font-medium-4 d-none d-xl-block primary" data-ticon="bx-disc"></i></a></li>
        </ul>
      </div>
      <div class="shadow-bottom"></div>
      <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation" data-icon-style="lines">
          <li class=" nav-item"><a href=""><i class="bx bx-home" data-icon="desktop"></i><span class="menu-title" data-i18n="Dashboard">Dashboard</span></a>
          </li>
          <li class=" navigation-header"><span>Category</span>
          </li>
          @php $active = (Route::currentRouteName() == 'category') ? 'active' : ''; @endphp
          <li class=" nav-item {{ $active }}"><a href="{{ route('category.index') }}"><i class="bx bx-spreadsheet" data-icon="envelope-pull"></i><span class="menu-title" data-i18n="Email">Category</span></a>
          </li>
       
          <li class=" nav-item {{ Route::currentRouteName() == 'sub-category' ? ' active' : '' }}"><a href="{{ route('sub-category.index') }}"><i class="bx bx-sitemap" data-icon="comments"></i><span class="menu-title" data-i18n="Chat">Sub category</span></a>
          </li>
          <li class=" navigation-header"><span>Product</span>
          </li>
          <li class=" nav-item"><a href=""><i class="bx bx-basket" data-icon="settings"></i><span class="menu-title" data-i18n="Form Layout">Product</span></a>
          </li>
          <li class=" nav-item"><a href=""><i class="bx bx-detail" data-icon="priority-low"></i><span class="menu-title" data-i18n="Form Wizard">Product details</span></a>
          </li>
          <li class=" navigation-header"><span>Delivery</span>
          </li>
        <li class=" nav-item {{ Route::currentRouteName() == 'delivery-slot-master' ? ' active' : '' }}"><a href="{{ route('delivery-slot-master.index') }}"><i class="bx bx-time-five" data-icon="settings"></i><span class="menu-title" data-i18n="Form Layout">Delivery slot master</span></a>
          </li>
          <li class=" nav-item"><a href=""><i class="bx bx-truck" data-icon="priority-low"></i><span class="menu-title" data-i18n="Form Wizard">Delivery</span></a>
          </li>
          <li class="disabled nav-item"><a href=""><i class="bx bx-credit-card-alt" data-icon="morph-preview"></i><span class="menu-title" data-i18n="Disabled Menu">Delivery charge list</span></a>
          </li>
          <li class=" navigation-header"><span>Offer</span>
          </li>
          <li class=" nav-item"><a href=""><i class="bx bx-purchase-tag-alt" data-icon="settings"></i><span class="menu-title" data-i18n="Form Layout">Store offers</span></a>
          </li>
          <li class=" nav-item"><a href=""><i class="bx bx-gift" data-icon="priority-low"></i><span class="menu-title" data-i18n="Form Wizard">Category offers</span></a>
          </li>
          <li class=" navigation-header"><span>Order</span>
          </li>
          <li class=" nav-item"><a href=""><i class="bx bx-receipt" data-icon="warning-alt"></i><span class="menu-title" data-i18n="Sweet Alert">Order list</span></a>
          </li>
          <li class=" nav-item"><a href=""><i class="bx bx-briefcase-alt" data-icon="morph-map"></i><span class="menu-title" data-i18n="Toastr">Bulk order</span></a>
          </li>
          <li class=" navigation-header"><span>Receipe</span>
          </li>
          <li class=" nav-item"><a href=""><i class="bx bx-news" data-icon="warning-alt"></i><span class="menu-title" data-i18n="Sweet Alert">Receipe master</span></a>
          </li>
          <li class=" nav-item"><a href=""><i class="bx bxs-dock-top" data-icon="morph-map"></i><span class="menu-title" data-i18n="Toastr">Receipe category</span></a>
          </li>
          <li class=" nav-item"><a href=""><i class="bx bx-grid-alt" data-icon="morph-map"></i><span class="menu-title" data-i18n="Toastr">Receipe subcategory</span></a>
          </li>
          <li class=" navigation-header"><span>Components</span>
          </li>
          <li class="disabled nav-item"><a href=""><i class="bx bx-revision" data-icon="morph-preview"></i><span class="menu-title" data-i18n="Disabled Menu">Slider</span></a>
          </li>
          <li class="disabled nav-item"><a href=""><i class="bx bx-money" data-icon="morph-preview"></i><span class="menu-title" data-i18n="Disabled Menu">User payment type</span></a>
          </li>
          <li class="disabled nav-item"><a href=""><i class="bx bx-message" data-icon="morph-preview"></i><span class="menu-title" data-i18n="Disabled Menu">SMS template list</span></a>
          </li>
          <li class=" navigation-header"><span>Other masters</span>
          </li>
        <li class=" nav-item {{ Route::currentRouteName() == 'event-master' ? ' active' : '' }}"><a href="{{ route('event-master.index') }}"><i class="bx bx-calendar-event" data-icon="user"></i><span class="menu-title" data-i18n="User Profile">Event master</span></a>
          </li>
          <li class=" nav-item"><a href=""><i class="bx bx-store" data-icon="info-alt"></i><span class="menu-title" data-i18n="Knowledge Base">Store</span></a>
          </li>
          <li class=" nav-item"><a href=""><i class="bx bx-id-card" data-icon="wrench"></i><span class="menu-title" data-i18n="Account Settings">Membership</span></a>
          </li>
          <li class=" nav-item"><a href=""><i class="bx bx-user-check" data-icon="wrench"></i><span class="menu-title" data-i18n="Account Settings">Display customer list</span></a>
          </li>
          <li class=" nav-item"><a href=""><i class="bx bx-compass" data-icon="wrench"></i><span class="menu-title" data-i18n="Account Settings">Weight</span></a>
          </li>
          <li class=" nav-item"><a href=""><i class="bx bx-bell" data-icon="wrench"></i><span class="menu-title" data-i18n="Account Settings">Notification</span></a>
          </li>
          <li class=" navigation-header"><span>Settings</span>
          </li>
          <li class=" nav-item"><a href=""><i class="bx bx-cog" data-icon="warning-alt"></i><span class="menu-title" data-i18n="Sweet Alert">Settings</span></a>
          </li>
          <li class=" nav-item"><a href=""><i class="bx bx-wrench" data-icon="morph-map"></i><span class="menu-title" data-i18n="Toastr">Footer settings</span></a>
          </li>
          <li class=" navigation-header"><span>Reports</span>
          </li>
          @php $active = (Route::currentRouteName() == 'seller_selling') ? 'active' : ''; @endphp
          <li class=" nav-item {{ $active }}"><a href="{{ route('seller_selling') }}"><i class="bx bx-spreadsheet" data-icon="warning-alt"></i><span class="menu-title" data-i18n="Sweet Alert">Seller selling report</span></a>
          </li>
          @php $active = (Route::currentRouteName() == 'selling_invoice') ? 'active' : ''; @endphp
          <li class=" nav-item {{ $active }}"><a href="{{ route('selling_invoice') }}"><i class="bx bx-server" data-icon="morph-map"></i><span class="menu-title" data-i18n="Toastr">Selling invoice report</span></a>
          </li>
          @php $active = (Route::currentRouteName() == 'product_price') ? 'active' : ''; @endphp
          <li class=" nav-item {{ $active }}"><a href="{{ route('product_price') }}"><i class="bx bx-copy-alt" data-icon="morph-map"></i><span class="menu-title" data-i18n="Toastr">Product price report</span></a>
          </li>
        </ul>
      </div>
    </div>
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    <div class="app-content content">
      <div class="content-overlay"></div>
      <div class="content-wrapper">
        <div class="content-header row">
          <div class="content-header-left col-12 mb-2 mt-1">
            <div class="row breadcrumbs-top">
              <div class="col-12">
                <div class="breadcrumb-wrapper col-12">
                  <div id="flash-msg">
                  @include('flash::message')
                </div>
                 
                  @yield('content')
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="content-body"><!-- Chartist  -->


        </div>
      </div>
    </div>
    <!-- END: Content-->

    @push('scripts')
    <script>
      $(function () {
          // flash auto hide
          $('#flash-msg .alert').not('.alert-danger, .alert-important').delay(6000).slideUp(500);
      })
</script>
        
    @endpush


    

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>
