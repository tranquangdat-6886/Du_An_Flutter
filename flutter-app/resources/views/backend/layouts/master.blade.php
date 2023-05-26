<!DOCTYPE html>
<html lang="en">
  <head>
    @include('backend.layouts.head')
    <title>@yield('title')</title>
  </head>

<body class="hold-transition sidebar-mini layout-fixed">
    <!-- Site wrapper -->
<div class="wrapper">
@include('backend.layouts.header')
@include('backend.layouts.menu')
@yield('main-content')

@include('backend.layouts.footer')
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
</div>

@include('backend.layouts.script')
</body>
</html>