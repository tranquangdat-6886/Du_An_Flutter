  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4 ">
      <!-- Brand Logo -->
      <a href="../../index3.html" class="brand-link bg-success">
          <img src="{{ url('backend/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
              class="brand-image img-circle elevation-3" style="opacity: .8">
          <span class="brand-text font-weight-light">Admin-CDSG</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar " style="background-color: #761d1f;">


          <!-- Sidebar Menu -->
          <nav class="mt-2">
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                  data-accordion="false">
                  <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                  <li class="nav-item">
                      <a href="{{ route('dashboard.index') }}" class="nav-link">
                          <i class="nav-icon fas fa-tachometer-alt"></i>
                          <p>
                              Dashboard

                          </p>
                      </a>

                  </li>
                  <li class="nav-item">
                      <a href="{{ route('events.index') }}" class="nav-link">
                          <i class="nav-icon fas fa-th"></i>
                          <p>
                              Events Manager

                          </p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ route('users.index') }}" class="nav-link">
                          <i class="nav-icon fas fa-user"></i>
                          <p>
                              User Manager

                          </p>
                      </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('commands.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-comment-alt"></i>
                        <p>
                            Command

                        </p>
                    </a>
                </li>


                  {{-- <li class="nav-header">STUDENTS</li>

                  <li class="nav-item">
                      <a href="{{ route('attendances.index') }}" class="nav-link">
                          <i class="nav-icon far fa-circle text-warning"></i>
                          <p>Attendances</p>
                      </a>
                  </li> --}}

              </ul>
          </nav>
          <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
  </aside>
