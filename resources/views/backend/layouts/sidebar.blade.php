<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin') }}">
        <div class="sidebar-brand-text mx-3">
          {{-- <img src="https://morshgolf.com/wp-content/uploads/2020/01/morsh-golf-logo-est.png" style="width:100%;"> --}}
          <h3 style="color: red;">SPDAPT</h3>

        </div>
    </a>
    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('admin') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    <!-- Heading -->
    {{-- <div class="sidebar-heading">
    vendor
  </div> --}}
    {{-- <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsVendor" aria-expanded="true"
      aria-controls="collapsVendor">
      <i class="fas fa-users"></i>
      <span>Vendors</span>
    </a>
    <div id="collapsVendor" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Vendor Options:</h6>
        <a class="collapse-item" href="{{route('vendor.index')}}">Vendors</a>
        <a class="collapse-item" href="{{route('vendor.create')}}">Add Vendors</a>
      </div>
    </div>
  </li> --}}
    <!-- Divider -->
    <!-- Nav Item - Pages Collapse Menu -->
    <!-- Nav Item - Charts -->
    <!-- <li class="nav-item">
        <a class="nav-link" href="{{ route('file-manager') }}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Media Manager</span></a>
    </li> -->
    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Heading -->

    {{-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#postCategoryCollapse"
            aria-expanded="true" aria-controls="postCategoryCollapse">
            <i class="fas fa-sitemap fa-folder"></i>
            <span>Enquiry List</span>
        </a>
        <div id="postCategoryCollapse" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Enquiry:</h6>
                <a class="collapse-item" href="{{ route('enquiry.index') }}">Contact Us Enquiry</a>
                <a class="collapse-item" href="{{ route('affiliates-enquiry.index') }}">Affiliate Enquiry</a>
                <a class="collapse-item" href="{{ route('partners-enquiry.index') }}">Partners Enquiry</a>
            </div>
        </div>
    </li> --}}


    <!-- Categories -->

    <hr class="sidebar-divider">
    <div class="sidebar-heading">Shop</div>

    {{-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#categoryCollapse"
            aria-expanded="true" aria-controls="categoryCollapse">
            <i class="fas fa-sitemap"></i>
            <span>Category</span>
        </a>
        <div id="categoryCollapse" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Category Options:</h6>
                <a class="collapse-item" href="{{ route('category.index') }}">Category</a>
                <a class="collapse-item" href="{{ route('category.create') }}">Add Category</a>
            </div>
        </div>
    </li> --}}

    {{-- Products --}}
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#productCollapse"
            aria-expanded="true" aria-controls="productCollapse">
            <i class="fas fa-cubes"></i>
            <span>Products</span>
        </a>
        <div id="productCollapse" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Product Options:</h6>
                <a class="collapse-item" href="{{ route('product.index') }}">Products</a>
                <a class="collapse-item" href="{{ route('product.create') }}">Add Product</a>
                {{-- <a class="collapse-item" href="{{ route('productcont') }}">Manage Product Content</a> --}}
                {{-- <a class="collapse-item" href="{{route('pricing_rules.index')}}">Pricing Rule</a> --}}
            </div>
        </div>
    </li>

    {{-- <li class="nav-item">
        <a class="nav-link" href="{{ route('flex_attribute.index') }}">
            <i class="fas fa-comments"></i>
            <span>Flex Attribute</span></a>
    </li> --}}

    {{-- Shipping --}}
    {{-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#shippingCollapse"
            aria-expanded="true" aria-controls="shippingCollapse">
            <i class="fas fa-truck"></i>
            <span>Shipping</span>
        </a>
        <div id="shippingCollapse" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Shipping Options:</h6>
                <a class="collapse-item" href="{{route('shipping.index')}}">Shipping</a>
        <a class="collapse-item" href="{{route('shipping.create')}}">Add Shipping</a>
                <a class="collapse-item" href="{{ route('country.index') }}"> Shipping Management</a>
                <a class="collapse-item" href="{{ route('country.create') }}"> Add Shipping</a>
                <a class="collapse-item" href="{{route('state.index')}}"> State</a>
            </div>
        </div>
    </li> --}}

    <!--Orders -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('order.index') }}">
            <i class="fas fa-hammer fa-chart-area"></i>
            <span>Orders</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('transaction.index') }}">
            <i class="fas fa-comments fa-chart-area"></i>
            <span>Recharge</span>
        </a>
    </li>
    <!-- Abonded Cart -->
    {{-- <li class="nav-item">
        <a class="nav-link" href="{{ route('abondedcart.index') }}">
            <i class="fas fa-cart-arrow-down fa-chart-area"></i>
            <span>Abonded Cart</span>
        </a>
    </li> --}}
    <!-- Reviews -->
    {{-- <li class="nav-item">
        <a class="nav-link" href="{{ route('review.index') }}">
            <i class="fas fa-comments"></i>
            <span>Reviews</span></a>
    </li> --}}


    <!-- Divider -->
    {{-- <div class="sidebar-heading">
        Blog Posts
    </div>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#postCollapse"
            aria-expanded="true" aria-controls="postCollapse">
            <i class="fas fa-fw fa-folder"></i>
            <span>Posts</span>
        </a>
        <div id="postCollapse" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Post Options:</h6>
                <a class="collapse-item" href="{{ route('post.index') }}">Posts</a>
                <a class="collapse-item" href="{{ route('post.create') }}">Add Post</a>
            </div>
        </div>
    </li> --}}

{{-- 
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#postCategoryCollapse"
            aria-expanded="true" aria-controls="postCategoryCollapse">
            <i class="fas fa-sitemap fa-folder"></i>
            <span>Post Category</span>
        </a>
        <div id="postCategoryCollapse" class="collapse" aria-labelledby="headingPages"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Category Options:</h6>
                <a class="collapse-item" href="{{ route('post-category.index') }}">Category</a>
                <a class="collapse-item" href="{{ route('post-category.create') }}">Add Category</a>
            </div>
        </div>
    </li> --}}

    <!-- Tags -->
    {{-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#tagCollapse"
            aria-expanded="true" aria-controls="tagCollapse">
            <i class="fas fa-tags fa-folder"></i>
            <span>Tags</span>
        </a>
        <div id="tagCollapse" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Tag Options:</h6>
                <a class="collapse-item" href="{{ route('post-tag.index') }}">Tag</a>
                <a class="collapse-item" href="{{ route('post-tag.create') }}">Add Tag</a>
            </div>
        </div>
    </li> --}}

    <!-- Comments -->
    {{-- <li class="nav-item">
        <a class="nav-link" href="{{ route('comment.index') }}">
            <i class="fas fa-comments fa-chart-area"></i>
            <span>Comments</span>
        </a>
    </li> --}}

    {{-- <li class="nav-item">
        <a class="nav-link" href="{{ route('coupon.index') }}">
            <i class="fas fa-table"></i>
            <span>Coupon</span></a>
    </li> --}}

    {{-- <hr class="sidebar-divider"> --}}
    <!-- General settings -->

    <div class="sidebar-heading">Users</div>
    <!-- Users -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('users.index') }}">
            <i class="fas fa-users"></i>
            <span>Users</span></a>
    </li>

    {{-- <hr class="sidebar-divider"> --}}
    <!-- General settings -->

    {{-- <div class="sidebar-heading">General Settings</div>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#brandCollapse"
            aria-expanded="true" aria-controls="brandCollapse">
            <i class="fas fa-table"></i>
            <span>Gallery</span>
        </a>
        <div id="brandCollapse" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Gallery Options:</h6>
                <a class="collapse-item" href="{{ route('brand.index') }}">Gallery</a>
                <a class="collapse-item" href="{{ route('brand.create') }}">Add Gallery</a>
            </div>
        </div>
    </li> --}}

    {{-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwoo"
            aria-expanded="true" aria-controls="collapseTwoo">
            <i class="fas fa-cog"></i>
            <span>Settings</span>
        </a>
        <div id="collapseTwoo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('settings') }}">General Settings</a>
                <a class="collapse-item" href="{{ route('homepage_popup') }}">Home Page Settings</a>
                <a class="collapse-item" href="{{ route('aboutus') }}">About Us</a>
                <a class="collapse-item" href="{{ route('ourstory') }}">Our story</a>
                <a class="collapse-item" href="{{ route('menus') }}">Menus</a>
            </div>
        </div>
    </li> --}}
    <!-- Sidebar Toggler (Sidebar) -->
    {{-- <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div> --}}
</ul>
