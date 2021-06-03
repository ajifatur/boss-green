    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
      <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="https://s3.amazonaws.com/uifaces/faces/twitter/jsa/48.jpg" alt="User Image">
        <div>
          <p class="app-sidebar__user-name">{{ Auth::user()->name }}</p>
          <p class="app-sidebar__user-designation">{{ ucfirst(Auth::user()->role) }}</p>
        </div>
      </div>
      <ul class="app-menu">
        <li><a class="app-menu__item {{ strpos(Request::path(),'dashboard') ? 'active' : '' }}" href="/admin/dashboard"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>
        <li class="treeview {{ strpos(Request::path(),'user') ? 'is-expanded' : '' }}"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-users"></i><span class="app-menu__label">Users</span><i class="treeview-indicator fa fa-angle-right"></i></a>
        <ul class="treeview-menu">
          <li><a class="treeview-item {{ strpos(Request::path(),'user/kurir') ? 'active' : '' }}" href="/admin/user/kurir"><i class="icon fa fa-circle-o"></i> Kurir</a></li>
          <li><a class="treeview-item {{ strpos(Request::path(),'user/member') ? 'active' : '' }}" href="/admin/user/member"><i class="icon fa fa-circle-o"></i> Member</a></li>
<!--             <li><a class="treeview-item {{ strpos(Request::path(),'add-user') ? 'active' : '' }}" href="/admin/add-user"><i class="icon fa fa-circle-o"></i> Tambah User</a></li> -->
        </ul>
        </li>
        <li class="treeview {{ strpos(Request::path(),'boss-sampah') ? 'is-expanded' : '' }}"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-trash"></i><span class="app-menu__label">Boss Sampah</span><i class="treeview-indicator fa fa-angle-right"></i></a>
        <ul class="treeview-menu">
          <li><a class="treeview-item {{ strpos(Request::path(),'boss-sampah/belum-diambil') ? 'active' : '' }}" href="/admin/boss-sampah/belum-diambil"><i class="icon fa fa-circle-o"></i> Belum Diambil</a></li>
          <li><a class="treeview-item {{ strpos(Request::path(),'boss-sampah/akan-diambil') ? 'active' : '' }}" href="/admin/boss-sampah/akan-diambil"><i class="icon fa fa-circle-o"></i> Akan Diambil</a></li>
          <li><a class="treeview-item {{ strpos(Request::path(),'boss-sampah/sudah-diambil') ? 'active' : '' }}" href="/admin/boss-sampah/sudah-diambil"><i class="icon fa fa-circle-o"></i> Sudah Diambil</a></li>
          <li><a class="treeview-item {{ strpos(Request::path(),'boss-sampah/harga/sampah') ? 'active' : '' }}" href="/admin/boss-sampah/harga/sampah"><i class="icon fa fa-circle-o"></i> Harga Sampah</a></li>
        </ul>
        </li>
        <li class="treeview {{ strpos(Request::path(),'boss-green-store') ? 'is-expanded' : '' }}"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-shopping-cart"></i><span class="app-menu__label">Boss Green Store</span><i class="treeview-indicator fa fa-angle-right"></i></a>
        <ul class="treeview-menu">
          <li><a class="treeview-item {{ strpos(Request::path(),'boss-green-store/semua-produk') ? 'active' : '' }}" href="/admin/boss-green-store/semua-produk"><i class="icon fa fa-circle-o"></i> Semua Produk</a></li>
          <li><a class="treeview-item {{ strpos(Request::path(),'boss-green-store/tambah-produk') ? 'active' : '' }}" href="/admin/boss-green-store/tambah-produk"><i class="icon fa fa-circle-o"></i> Tambah Produk</a></li>
        </ul>
      </li>
<!--         <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-th-list"></i><span class="app-menu__label">Tables</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item" href="table-basic.html"><i class="icon fa fa-circle-o"></i> Basic Tables</a></li>
            <li><a class="treeview-item" href="table-data-table.html"><i class="icon fa fa-circle-o"></i> Data Tables</a></li>
          </ul>
        </li> -->
      </ul>
    </aside>
