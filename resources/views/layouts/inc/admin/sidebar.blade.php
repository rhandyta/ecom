<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item">
      <a class="nav-link" href="{{ route('dashboard.index') }}">
        <i class="mdi mdi-home menu-icon"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="pages/forms/basic_elements.html">
        <i class="mdi mdi-chart-bar menu-icon"></i>
        <span class="menu-title">Sales</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#category" aria-expanded="false" aria-controls="category">
        <i class="mdi mdi-database menu-icon"></i>
        <span class="menu-title">Categories</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="category">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="{{ route('category.create') }}"> Add Category </a></li>
          <li class="nav-item"> <a class="nav-link" href="{{ route('category.index') }}"> View Categories </a></li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#product" aria-expanded="false" aria-controls="product">
        <i class="mdi mdi-account menu-icon"></i>
        <span class="menu-title">Products</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="product">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="{{ route("product.create") }}"> Add Product </a></li>
          <li class="nav-item"> <a class="nav-link" href="{{ route("product.index") }}"> View Products </a></li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ route('brand.index') }}">
        <i class="mdi mdi-tag menu-icon"></i>
        <span class="menu-title">Brands</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ route('color.index') }}">
        <i class="mdi mdi-tag menu-icon"></i>
        <span class="menu-title">Colors</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
        <i class="mdi mdi-account-multiple menu-icon"></i>
        <span class="menu-title">Users</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="auth">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="pages/samples/login.html"> Login </a></li>
          <li class="nav-item"> <a class="nav-link" href="pages/samples/login-2.html"> Login 2 </a></li>
          <li class="nav-item"> <a class="nav-link" href="pages/samples/register.html"> Register </a></li>
          <li class="nav-item"> <a class="nav-link" href="pages/samples/register-2.html"> Register 2 </a></li>
          <li class="nav-item"> <a class="nav-link" href="pages/samples/lock-screen.html"> Lockscreen </a></li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="pages/tables/basic-table.html">
        <i class="mdi mdi-theater menu-icon"></i>
        <span class="menu-title">Home Slider</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="documentation/documentation.html">
        <i class="mdi mdi-settings menu-icon"></i>
        <span class="menu-title">Site Setting</span>
      </a>
    </li>
  </ul>
</nav>