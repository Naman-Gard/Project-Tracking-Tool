
<!DOCTYPE html>
<html lang="en">
@include('include.head')

<body class="g-sidenav-show  bg-gray-200">
@include('include.sidebar')
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
  @include('include.navbar')
    <!-- End Navbar -->
     @yield('content')
       @include('include.footer')
  

 @include('include.script')
 </main>
</body>

</html>