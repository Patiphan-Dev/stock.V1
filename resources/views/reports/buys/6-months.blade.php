<x-layout :title="$title">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">รายการสินค้า</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="tb_sales" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ลำดับ</th>
                                        <th>รายการสินค้า</th>
                                        <th>ความยาว(ม.)</th>
                                        <th>ราคาต่อหน่วย</th>
                                        <th>จำนวนนำเข้า</th>
                                        <th>จำนวนส่งออก</th>
                                        <th>จำนวนที่เหลือ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($reports as $item)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $item->prod_name }}</td>
                                            <td>{{ $item->prod_length }}</td>
                                            <td>{{ $item->prod_price_per_unit }}</td>
                                            <td>{{ $item->prod_buy_qty }}</td>
                                            <td>{{ $item->prod_sales_qty }}</td>
                                            <td>{{ $item->prod_min_qty }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>ลำดับ</th>
                                        <th>รายการสินค้า</th>
                                        <th>ความยาว(ม.)</th>
                                        <th>ราคาต่อหน่วย</th>
                                        <th>จำนวนนำเข้า</th>
                                        <th>จำนวนส่งออก</th>
                                        <th>จำนวนที่เหลือ</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
</x-layout>
