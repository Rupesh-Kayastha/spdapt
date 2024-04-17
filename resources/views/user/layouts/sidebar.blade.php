<style>
  .left {
    width: 13%;
    float: left;
    background: #ffd800;
  }

  .right {
    width: 87%;
    float: right;
  }

  .maincontent {
    width: 100%;
    margin: 0 auto;
  }

  ul#accordionSidebar li,
  .sidebar-heading {
    padding-left: 16px;
  }
  ul#accordionSidebar {
    padding-top: 51px;
    padding-bottom: 103px;
}
</style>
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">


  <!-- Nav Item - Dashboard -->
  <li class="nav-item active">
    <a class="nav-link" href="{{route('user')}}">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span></a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="sidebar-heading">
    Shop
  </div>
  <!--Orders -->
  <li class="nav-item">
    <a class="nav-link" href="{{route('user.order.index')}}">
      <i class="fas fa-hammer fa-chart-area"></i>
      <span>Orders</span>
    </a>
  </li>

  <!-- Reviews -->
  <li class="nav-item">
    <a class="nav-link" href="{{route('user.recharge.index')}}">
      <i class="	fa fa-credit-card"></i>
      <span>Recharge</span></a>
  </li>


  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Heading -->
  {{-- <div class="sidebar-heading">
    Posts
  </div> --}}
  <!-- Comments -->
  <li class="nav-item">
    <a class="nav-link" href="{{route('user.withdrawal.index')}}">
      <i class="fa-solid fa-coins"></i>
      <span>withdrawal</span>
    </a>
  </li>
  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

</ul>