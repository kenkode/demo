<div class="main_wrapper">
@include('includes.head')
@include('includes.nav_memberdash')
@include('includes.nav_css_member')

<div id="page-wrapper" style="min-width:900px !important; max-width:900px !important;max-height: 500px !important;overflow: auto !important">
    <div class="row" >
        <div class="col-lg-12">
            @yield('content')
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
</div>
<!-- /#page-wrapper -->
@include('includes.footer')
</div>