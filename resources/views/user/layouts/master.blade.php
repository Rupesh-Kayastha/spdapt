<!DOCTYPE html>
<html lang="en">
@include('../frontend/layouts.head')
<body id="page-top"  class="inner-page-sec">
<!-- Page Wrapper -->
<div id="wrapper">
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">
<!-- Main Content -->
<div id="content">
    <!-- Topbar -->
    @include('../frontend.layouts.header') 
    <!-- End of Topbar -->
    <div class="maincontent dashboard-sec"> 
        <!-- Sidebar -->
        <div class="left"> @include('user.layouts.sidebar') </div>
        <!-- End of Sidebar -->
        <!-- Begin Page Content -->
        <div class="right"> @yield('main-content') </div>
    </div>
    <!-- /.container-fluid -->
</div>
    
<style>
.maincontent.dashboard-sec {
    display: flex;
    gap: 0 2%;
    padding: 30px;
}
.maincontent.dashboard-sec .left {
    width: 25%;
    border-radius: 8px;
    background: #f1f1f1;
}
.maincontent.dashboard-sec .left ul#accordionSidebar {
    padding: 15px;
    gap: 10px;
}
.maincontent.dashboard-sec .left ul#accordionSidebar hr {
    margin: 0;
}
.maincontent.dashboard-sec .left .sidebar-heading {
    margin: 0;
    padding: 0;
    font-size: 14px;
    text-transform: uppercase;
    font-weight: 600;
}
ul#accordionSidebar li {
    margin: 0;
    padding: 0;
    position: relative;
}
ul#accordionSidebar li a {
    margin: 0;
    padding: 10px;
    background: #FFF;
    display: flex;
    align-items: center;
    gap: 0 9px;
    font-size: 14px;
    color: #000;
    font-weight: 600;
    border-radius: 6px;
}
ul#accordionSidebar li a i {
    color: #00867a;
}
ul#accordionSidebar li.nav-item.active a {
    color: #00867a;
}
    
@media only screen and (max-width: 768px) {
.maincontent.dashboard-sec {
    flex-direction: column;
    gap: 30px 0;
}
.maincontent.dashboard-sec .left, .maincontent.dashboard-sec .right {
    width: 100%;
}
.maincontent.dashboard-sec .left ul#accordionSidebar {
    flex-direction: row;
    overflow: auto;
}
.maincontent.dashboard-sec .left .sidebar-heading,
.maincontent.dashboard-sec .left ul#accordionSidebar hr {
    display: none;
}
.maincontent.dashboard-sec .right .container-fluid {
    padding: 0;
}
}

@media only screen and (max-width: 480px) {
.user-product-list {
    grid-template-columns: repeat(auto-fill, minmax(100%, 1fr));
}
.user-product-box .user-product-body .p-list-name {
    flex-direction: column;
    align-items: start;
}
}
</style>

<!-- End of Main Content --> 
@include('../frontend.layouts.footer')
</body>
</html>