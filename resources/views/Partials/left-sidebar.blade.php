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
                        class="nav-link {{ $current_route == 'dashboard.index' || $current_route == '' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            แดชบอร์ด
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('users.index') }}"
                        class="nav-link {{ $current_route == 'users.index' || $current_route == '' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            จักการสมาชิก
                        </p>
                    </a>
                </li>
                <li class="nav-item @if ($current_route == 'po.index' || $current_route == 'po.purchaserecord') menu-is-opening menu-open @endif">
                    <a href="#"
                        class="nav-link {{ $current_route == 'po.index' || $current_route == 'po.purchaserecord' ? 'active' : '' }}">
                        <i class="nav-icon fa-solid fa-right-to-bracket"></i>
                        <p>
                            ใบสั่งซื้อ (PO)
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('po.purchaserecord') }}"
                                class="nav-link {{ $current_route == 'po.purchaserecord' ? 'active' : '' }}">
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
                <li class="nav-item @if ($current_route == 'so.index' || $current_route == 'salesrecord.index') menu-is-opening menu-open @endif">
                    <a href="#"
                        class="nav-link {{ $current_route == 'so.index' || $current_route == 'salesrecord.index' ? 'active' : '' }}">
                        <i class="nav-icon fa-solid fa-right-from-bracket"></i>
                        <p>
                            ใบสั่งขาย (SO)
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('salesrecord.index') }}"
                                class="nav-link {{ $current_route == 'salesrecord.index' ? 'active' : '' }}">
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
                        class="nav-link {{ $current_route == 'product.index' ? 'active' : '' }}">
                        <i class="nav-icon fa-solid fa-warehouse"></i>
                        <p>
                            เช็คสต๊อกสินค้า
                        </p>
                    </a>
                </li>
                <li class="nav-item @if (
                    $current_route == 'salesReportThreeMonths' ||
                        $current_route == 'salesReportSixMonths' ||
                        $current_route == 'buysReportThreeMonths' ||
                        $current_route == 'buysReportSixMonths') menu-is-opening menu-open @endif">
                    <a href="#"
                        class="nav-link 
                        {{ $current_route == 'salesReportThreeMonths' ||
                        $current_route == 'salesReportSixMonths' ||
                        $current_route == 'buysReportThreeMonths' ||
                        $current_route == 'buysReportSixMonths'
                            ? 'active'
                            : '' }}">
                        <i class="nav-icon fa-solid fa-file-lines"></i>
                        <p>
                            รายงาน
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item @if ($current_route == 'buysReportThreeMonths' || $current_route == 'buysReportSixMonths') menu-is-opening menu-open @endif">
                            <a href="#"
                                class="nav-link {{ $current_route == 'buysReportThreeMonths' || $current_route == 'buysReportThreeMonths' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon ml-3"></i>
                                <p>
                                    การซื้อ
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('buysReportThreeMonths') }}"
                                        class="nav-link {{ $current_route == 'buysReportThreeMonths' ? 'active' : '' }}">
                                        <i class="far fa-dot-circle nav-icon ml-4"></i>
                                        <p>3 เดือนย้อนหลัง</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('buysReportSixMonths') }}"
                                        class="nav-link {{ $current_route == 'buysReportSixMonths' ? 'active' : '' }}">
                                        <i class="far fa-dot-circle nav-icon ml-4"></i>
                                        <p>6 เดือนย้อนหลัง</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item @if ($current_route == 'salesReportThreeMonths' || $current_route == 'salesReportSixMonths') menu-is-opening menu-open @endif">
                            <a href="#"
                                class="nav-link {{ $current_route == 'salesReportThreeMonths' || $current_route == 'salesReportSixMonths' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon ml-3"></i>
                                <p>
                                    การขาย
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('salesReportThreeMonths') }}"
                                        class="nav-link {{ $current_route == 'salesReportThreeMonths' ? 'active' : '' }}">
                                        <i class="far fa-dot-circle nav-icon ml-4"></i>
                                        <p>3 เดือนย้อนหลัง</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('salesReportSixMonths') }}"
                                        class="nav-link {{ $current_route == 'salesReportSixMonths' ? 'active' : '' }}">
                                        <i class="far fa-dot-circle nav-icon ml-4"></i>
                                        <p>6 เดือนย้อนหลัง</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</aside>
