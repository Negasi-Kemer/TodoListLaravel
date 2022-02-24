<!DOCTYPE html>
<html lang="en">
    @include('Layouts.head')

<body class="hold-transition sidebar-mini">

    <div class="wrapper">
        
        @include('Layouts.header')
        @include('Layouts.sidebar')
        
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Main content -->
            @section('App-MainContent')
            
            @show
        </div>
          <!-- /.content-wrapper -->
          @include('Layouts.footer')
    </div>

    @section('pageSpecificFooter')

    @show
    
</body>
</html>