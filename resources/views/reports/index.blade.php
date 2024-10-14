<x-layout :title="$title">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">รายงานการขาย</h3>
                        </div>
                        <!-- ฟอร์มสำหรับกรองข้อมูล -->
                        <div class="card-body">
                            <form action="{{ route('sales.report') }}" method="GET">
                                <div class="row">
                                    <div class="col-md-1"><label>เลือกช่วงเวลา:</label></div>
                                    <div class="col-md-4">
                                        <select name="filter_period" class="form-control">
                                            <option value="all"
                                                {{ request('filter_period') == 'all' ? 'selected' : '' }}>ทั้งหมด
                                            </option>
                                            <option value="oneday"
                                                {{ request('filter_period') == 'oneday' ? 'selected' : '' }}>วันนี้
                                            </option>
                                            <option value="3_months"
                                                {{ request('filter_period') == '3_months' ? 'selected' : '' }}>3 เดือน
                                            </option>
                                            <option value="6_months"
                                                {{ request('filter_period') == '6_months' ? 'selected' : '' }}>6 เดือน
                                            </option>
                                            <option value="1_year"
                                                {{ request('filter_period') == '1_year' ? 'selected' : '' }}>1 ปี
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="submit" class="btn btn-primary">ค้นหา</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- ตารางรายงานการขาย -->
                        <div class="card-body">
                            <table id="tb_sales" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ลำดับ</th>
                                        <th>รายการสินค้า</th>
                                        <th>จำนวนที่ขายได้</th>
                                        <th>ราคาต่อหน่วย</th>
                                        <th>หน่วย</th>
                                        <th>จำนวนเงินทั้งหมด (บาท)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($salesData as $item)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $item->so_prod_name }}</td>
                                            <td class="text-center">{{ $item->total_quantity }}</td>
                                            <td class="text-right">
                                                {{ number_format($item->product->prod_price_per_unit, 2) }}</td>
                                            <td class="text-center">{{ $item->product->prod_unit }}</td>
                                            <td class="text-right">{{ number_format($item->total_price, 2) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layout>
