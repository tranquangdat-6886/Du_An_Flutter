 <!-- Navbar -->
 <nav class="main-header navbar navbar-expand navbar-white navbar-light bg-success text-white ">
     <!-- Left navbar links -->
     <ul class="navbar-nav">
         <li class="nav-item">
             <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars text-white"
                     style="font-size: 23px;"></i></a>
         </li>
         {{-- <li class="nav-item d-none d-sm-inline-block">
        <a href="../../index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li> --}}
     </ul>

     <!-- Right navbar links -->
     <ul class="navbar-nav ml-auto">
         <!-- Navbar Search -->





         <!-- Notifications Dropdown Menu -->
         <li class="nav-item dropdown">
             <a class="nav-link" data-toggle="dropdown" href="#">
                 <i class="far fa-user-circle text-white" style="font-size: 23px;"></i>
                 {{-- <span class="badge badge-warning navbar-badge">15</span> --}}
             </a>
             <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                 <div class="card">
                     <div class="card-body text-center bg-success">
                         <p>
                             <img src="{{ url('backend/dist/img/user2-160x160.jpg') }}" alt="AdminLTE Logo"
                                 class="brand-image img-circle elevation-3" style="opacity: .8">
                         </p>
                         @php
                             $loginUser = auth()->user();
                         $userName = \App\Models\User::find($loginUser->id); @endphp
                         <p> {{ $userName->name }}</p>
                         <p class="text-warning"><?php echo now(); ?></p>

                     </div>

                 </div>

                 <div class="row pb-3 text-center justify-content-center">
                     <div class="col-6">
                         <a href="" class="btn btn-outline-success">Hồ Sơ Cá Nhân</a>
                     </div>
                     <div class="col-6">
                         <form action="{{ route('logout') }}" method="post">
                             @csrf
                             <input type="submit" class="btn btn-outline-success mx-3 mt-2 d-block" value="Logout">
                         </form>
                     </div>
                 </div>

             </div>
         </li>
         <li class="nav-item">
             <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                 <i class="fas fa-expand-arrows-alt text-white" style="font-size: 23px"></i>
             </a>
         </li>
         {{-- <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li> --}}
     </ul>
 </nav>
 <!-- /.navbar -->
