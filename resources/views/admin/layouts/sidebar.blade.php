<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link {{ ($data['menu'] == 'dashboard')? '' : 'collapsed' }}" href="{{ route('admin.dashboard') }}">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-heading">Penyakit & Analisa</li>

      <li class="nav-item">
        <a class="nav-link {{ ($data['menu'] == 'manage-penyakit')? '' : 'collapsed' }}" data-bs-target="#penyakit-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-layout-text-window-reverse"></i><span>Manage Penyakit</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="penyakit-nav" class="nav-content {{ ($data['menu'] == 'manage-penyakit')? '' : 'collapse' }} " data-bs-parent="#sidebar-nav">
          <li>
            <a href="tables-general.html" class="{{ ($data['submenu'] == 'penyakit')? 'active' : '' }}">
              <i class="bi bi-circle"></i><span>Data Penyakit</span>
            </a>
          </li>
          <li>
            <a href="tables-data.html" class="{{ ($data['submenu'] == 'gejala')? 'active' : '' }}">
              <i class="bi bi-circle"></i><span>Data Gejala</span>
            </a>
          </li>
          <li>
            <a href="tables-data.html" class="{{ ($data['submenu'] == 'penyakit_gejala')? 'active' : '' }}">
              <i class="bi bi-circle"></i><span>Data Penyakit & Gejala</span>
            </a>
          </li>
        </ul>
      </li><!-- End Tables Nav -->

      <li class="nav-item">
        <a class="nav-link {{ ($data['menu'] == 'manage-analisa')? '' : 'collapsed' }}" href="{{ route('admin.dashboard') }}">
          <i class="bi bi-bar-chart"></i>
          <span>Manage Data Analisa</span>
        </a>
      </li>

      <li class="nav-heading">User</li>

      <li class="nav-item">
        <a class="nav-link {{ ($data['menu'] == 'manage-user')? '' : 'collapsed' }}" data-bs-target="#user-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-people"></i><span>Manage User</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="user-nav" class="nav-content {{ ($data['menu'] == 'manage-user')? '' : 'collapse' }} " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{ route('manage-pasien.index') }}" class="{{ ($data['submenu'] == 'pasien')? 'active' : '' }}">
              <i class="bi bi-circle"></i><span>Data Pasien</span>
            </a>
          </li>
          <li>
            <a href="{{ route('manage-admin.index') }}" class="{{ ($data['submenu'] == 'admin')? 'active' : '' }}">
              <i class="bi bi-circle"></i><span>Data Admin</span>
            </a>
          </li>
        </ul>
      </li><!-- End Tables Nav -->

    </ul>

  </aside><!-- End Sidebar-->