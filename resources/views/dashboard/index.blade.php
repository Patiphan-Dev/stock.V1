<x-layout :title="$title">
    <section class="content">
        <div class="container-fluid">

            <div class="row">

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            @if ($bestSellingToday->isEmpty())
                                <h3> 0 <sup style="font-size: 20px">ชิ้น</sup></h3>
                                <p>ว่าง</p>
                            @else
                                <h3> {{ $bestSellingToday[0]->total_quantity }}<sup style="font-size: 20px">ชิ้น</sup>
                                </h3>
                                <p>{{ $bestSellingToday[0]->so_prod_name }}</p>
                            @endif
                        </div>
                        <div class="icon">
                            <i class="fa-solid fa-bag-shopping"></i>
                        </div>
                        <a href="/sales/report?filter_period=oneday" class="small-box-footer">
                            สินค้าขายดีวันนี้ <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            @if ($bestSellingThreeMonths->isEmpty())
                                <h3> 0 <sup style="font-size: 20px">ชิ้น</sup></h3>
                                <p>ว่าง</p>
                            @else
                                <h3> {{ $bestSellingThreeMonths[0]->total_quantity }}<sup
                                        style="font-size: 20px">ชิ้น</sup> </h3>
                                <p>{{ $bestSellingThreeMonths[0]->so_prod_name }}</p>
                            @endif
                        </div>
                        <div class="icon">
                            <i class="fa-solid fa-basket-shopping"></i>
                        </div>
                        <a href="/sales/report?filter_period=3_months" class="small-box-footer">
                            สินค้าขายดี 3 เดือน <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            @if ($bestSellingSixMonths->isEmpty())
                                <h3> 0 <sup style="font-size: 20px">ชิ้น</sup></h3>
                                <p>ว่าง</p>
                            @else
                                <h3> {{ $bestSellingSixMonths[0]->total_quantity }}<sup
                                        style="font-size: 20px">ชิ้น</sup> </h3>
                                <p>{{ $bestSellingSixMonths[0]->so_prod_name }}</p>
                            @endif
                        </div>
                        <div class="icon">
                            <i class="fa-solid fa-cart-shopping"></i>
                        </div>
                        <a href="/sales/report?filter_period=6_months" class="small-box-footer">
                            สินค้าขายดี 6 เดือน <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{ $productcount }} <sup style="font-size: 20px">รายการ</sup></h3>
                            <p>สินค้าทั้งหมด</p>
                        </div>
                        <div class="icon">
                            <i class="fa-solid fa-shop"></i>
                        </div>
                        <a href="/sales/report?filter_period=all" class="small-box-footer">
                            สินค้าทั้งหมด <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
                @include('dashboard.PieChart')
            </div>
            <div class="row">
                @include('dashboard.LineChart')
            </div>
        </div>
    </section>

</x-layout>
