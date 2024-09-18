<x-layout :title="$title">
    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            @if ($bestSellingToday == null)
                                <h3> 0 </h3>
                                ว่าง
                            @else
                                <h3> {{ $bestSellingToday->total_quantity }}<sup style="font-size: 20px">ชิ้น</sup> </h3>
                                <p>{{ $bestSellingToday->so_prod_name }}</p>
                            @endif
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="#" class="small-box-footer">สินค้าขายดีวันนี้ <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            @if ($bestSellingThreeMonths == null)
                                <h3> 0 </h3>
                                ว่าง
                            @else
                                <h3> {{ $bestSellingThreeMonths->total_quantity }}<sup
                                        style="font-size: 20px">ชิ้น</sup> </h3>
                                <p>{{ $bestSellingThreeMonths->so_prod_name }}</p>
                            @endif
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="#" class="small-box-footer">สินค้าขายดี 3 เดือน <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            @if ($bestSellingSixMonths == null)
                                <h3> 0 </h3>
                                ว่าง
                            @else
                                <h3> {{ $bestSellingSixMonths->total_quantity }}<sup style="font-size: 20px">ชิ้น</sup>
                                </h3>
                                <p>{{ $bestSellingSixMonths->so_prod_name }}</p>
                            @endif
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="#" class="small-box-footer">สินค้าขายดี 6 เดือน <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{ $productcount }} <sup style="font-size: 20px">รายการ</sup></h3>

                            <p>สินค้าทั้งหมด</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            {{-- <div class="row">
                <h2>สินค้าขายดีวันนี้</h2>
                <ul>
                    @foreach ($bestSellingToday as $so_prod_name)
                        <li>{{ $so_prod_name->so_prod_name }} - จำนวนขาย: {{ $so_prod_name->total_quantity }}</li>
                    @endforeach
                </ul>

                <h2>สินค้าขายดี 3 เดือนย้อนหลัง</h2>
                <ul>
                    @foreach ($bestSellingThreeMonths as $so_prod_name)
                        <li>{{ $so_prod_name->so_prod_name }} - จำนวนขาย: {{ $so_prod_name->total_quantity }}</li>
                    @endforeach
                </ul>

                <h2>สินค้าขายดี 6 เดือนย้อนหลัง</h2>
                <ul>
                    @foreach ($bestSellingSixMonths as $so_prod_name)
                        <li>{{ $so_prod_name->so_prod_name }} - จำนวนขาย: {{ $so_prod_name->total_quantity }}</li>
                    @endforeach
                </ul>

            </div> --}}
        </div>
    </section>
</x-layout>
