<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{asset('img/sdo_logo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">SDO Rizal</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('img/profile_placeholder.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <router-link to="/user-profile" class="d-block">{{auth()->user()->name}}</router-link>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
              <router-link to="/dashboard" class="nav-link" active-class="active" exact>
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                Dashboard
                </p>     
              </router-link>
            </li>
            <li class="nav-item">
              <router-link to="/add-employee" class="nav-link" active-class="active" exact>
                <i class="fas fa-user-plus"></i>
                  <p>
                  Add Employee
                  </p>
              </router-link>
            </li> 
            <li class="nav-item">
              <router-link to="/users" class="nav-link" active-class="active" exact>
                  <i class="nav-icon fas fa-users"></i>
                  <p>
                  Users
                  </p>
              </router-link>
            </li>
            <li class="nav-item has-treeview">
                <a href="#" class="nav-link" active-class="active" exact>
                    <i class="fas fa-tools"></i></i>
                <p>
                    Settings
                    <i class="right fas fa-angle-left"></i>
                </p>
                </a>
                <ul class="nav nav-treeview">
                <li class="nav-item">
                    <router-link to="/represents" class="nav-link" active-class="active" exact>
                    <i class="far fa-circle nav-icon"></i>
                    <p>Representative of</p>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link to="/subjects" class="nav-link" active-class="active" exact>
                      <i class="far fa-circle nav-icon"></i>
                      <p>Subjects</p>
                    </router-link>
                </li>
                <li class="nav-item">
                  <router-link to="/type-of-employee" class="nav-link" active-class="active" exact>
                    <i class="far fa-circle nav-icon"></i>
                    <p>Type of Employee</p>
                  </router-link>
                </li>
                <li class="nav-item">
                  <router-link to="/civil-status" class="nav-link" active-class="active" exact>
                    <i class="far fa-circle nav-icon"></i>
                    <p>Civil Status</p>
                  </router-link>
              </li>                
                </ul>
            </li>
          {{-- <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Simple Link
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li> --}}
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>