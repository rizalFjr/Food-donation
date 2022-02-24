<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="/" class="brand-link">
    <img src="{{ asset('dist/img/MakananKitaLogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">Makanan Kita</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item">
          <a href="/" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Dashboard</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-donate"></i>
            <p>Donasi</p>
            <i class="right fas fa-angle-left"></i>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="/donation" class="nav-link">
                <i class="fas fa-table nav-icon"></i>
                <p>Data Donasi </p>
              </a>
            </li>
            {{-- <li class="nav-item">
              <a href="/donation/create" class="nav-link">
                <i class="fas fa-plus nav-icon"></i>
                <p>Tambah Donasi</p>
              </a>
            </li> --}}
          </ul>
        </li>        
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-hand-holding-usd"></i>
            <p>
              Kategori Donasi 
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="/donationcategory" class="nav-link">
                <i class="fas fa-table nav-icon"></i>
                <p>Data Kategori Donasi</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/donationcategory/create" class="nav-link">
                <i class="fas fa-plus nav-icon"></i>
                <p>Tambah Kategori Donasi</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-mobile"></i>
            <p>
              Status Donasi
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="/donationstatus" class="nav-link">
                <i class="fas fa-table nav-icon"></i>
                <p>Data Status Donasi</p>
              </a>
            </li>
            {{-- <li class="nav-item">
              <a href="/donationstatus/create" class="nav-link">
                <i class="fas fa-plus nav-icon"></i>
                <p>Tambah Status donasi</p>
              </a>
            </li> --}}
          </ul>
        </li>
          {{-- <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user-tag"></i>
              <p>
                Role
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/role" class="nav-link">
                  <i class="fas fa-table nav-icon"></i>
                  <p>Data Role</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/role/create" class="nav-link">
                  <i class="fas fa-plus nav-icon"></i>
                  <p>Tambah Role</p>
                </a>
              </li>
            </ul>
          </li> --}}
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-users"></i>
            <p>
              Member
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="/members" class="nav-link">
                <i class="fas fa-table nav-icon"></i>
                <p>Data Member</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/members/create" class="nav-link">
                <i class="fas fa-plus nav-icon"></i>
                <p>Tambah Member</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-user"></i>
            <p>
              User
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="/users" class="nav-link">
                <i class="fas fa-table nav-icon"></i>
                <p>Data User</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/users/create" class="nav-link">
                <i class="fas fa-plus nav-icon"></i>
                <p>Tambah User</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-balance-scale"></i>
            <p>
              Quantity
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="/quantity" class="nav-link">
                <i class="fas fa-table nav-icon"></i>
                <p>Data Quantity</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/quantity/create" class="nav-link">
                <i class="fas fa-plus nav-icon"></i>
                <p>Tambah Quantity</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-exclamation"></i>
            <p>
              Terms
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="/terms" class="nav-link">
                <i class="fas fa-table nav-icon"></i>
                <p>Data terms</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/terms/create" class="nav-link">
                <i class="fas fa-plus nav-icon"></i>
                <p>Tambah terms</p>
              </a>
            </li>
          </ul>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>