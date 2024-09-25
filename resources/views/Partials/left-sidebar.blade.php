@php
    use Illuminate\Support\Facades\Route;
    $current_route = Route::currentRouteName();
@endphp

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ route('home') }}" class="brand-link">
        <img src="{{ asset('admin-lte/dist/img/AdminLTELogo.png') }}" alt="ระบบคลังสินค้า"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">ระบบคลังสินค้า</span>
    </a>

    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('admin-lte/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                @if (auth()->check())
                    <a href="{{ route('dashboard.index') }}" class="d-block">{{ auth()->user()->username }}</a>
                @else
                    <a href="{{ route('login') }}" class="d-block">Guest</a>
                @endif
            </div>
        </div>

        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('dashboard.index') }}"
                        class="nav-link {{ $current_route == 'dashboard.index' || $current_route == 'home' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            แดชบอร์ด
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('sales.report') }}"
                        class="nav-link {{ $current_route == 'sales.report' ? 'active' : '' }}">
                        <i class="nav-icon fa-solid fa-newspaper"></i>
                        <p>
                            รายงานการขาย
                        </p>
                    </a>
                </li>
                <li class="nav-item @if ($current_route == 'po.index' || $current_route == 'po.edit' || $current_route == 'po.purchaserecord') menu-is-opening menu-open @endif">
                    <a href="#"
                        class="nav-link {{ $current_route == 'po.index' || $current_route == 'po.edit' || $current_route == 'po.purchaserecord' ? 'active' : '' }}">
                        <i class="nav-icon fa-solid fa-right-to-bracket"></i>
                        <p>
                            ใบสั่งซื้อ (PO)
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('po.purchaserecord') }}"
                                class="nav-link {{ $current_route == 'po.purchaserecord' || $current_route == 'po.edit' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon ml-3"></i>
                                <p>บันทึกการซื้อ</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('po.index') }}"
                                class="nav-link {{ $current_route == 'po.index' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon ml-3"></i>
                                <p>นำเข้าสินค้า</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item @if ($current_route == 'so.index' || $current_route == 'so.edit' || $current_route == 'so.salesrecord') menu-is-opening menu-open @endif">
                    <a href="#"
                        class="nav-link {{ $current_route == 'so.index' || $current_route == 'so.edit' || $current_route == 'so.salesrecord' ? 'active' : '' }}">
                        <i class="nav-icon fa-solid fa-right-from-bracket"></i>
                        <p>
                            ใบสั่งขาย (SO)
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('so.salesrecord') }}"
                                class="nav-link {{ $current_route == 'so.salesrecord' || $current_route == 'so.edit' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon ml-3"></i>
                                <p>บันทึกการขาย</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('so.index') }}"
                                class="nav-link {{ $current_route == 'so.index' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon ml-3"></i>
                                <p>นำออกสินค้า</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('product.index') }}"
                        class="nav-link {{ $current_route == 'product.index' || $current_route == 'product.add' || $current_route == 'product.edit' ? 'active' : '' }}">
                        <i class="nav-icon fa-solid fa-warehouse"></i>
                        <p>
                            เช็คสต๊อกสินค้า
                        </p>
                    </a>
                </li>
                @if (auth()->user()->status === 'admin')
                    <li class="nav-item">
                        <a href="{{ route('users.index') }}"
                            class="nav-link {{ $current_route == 'users.index' || $current_route == 'users.adduser' || $current_route == 'users.edituser' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                จักการสมาชิก
                            </p>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
</aside>
