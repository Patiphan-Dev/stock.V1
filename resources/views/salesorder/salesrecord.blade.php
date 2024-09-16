<x-layout :title="$title">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">บันทึกการขาย</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="tb_sales" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ลำดับ</th>
                                        <th>รายการสินค้า</th>
                                        <th>ยาว(ม.)</th>
                                        <th>จำนวน</th>
                                        <th>รวมยาว(ม.)</th>
                                        <th>ราคาหน่วยละ</th>
                                        <th>จำนวนเงิน</th>
                                        <th>วันที่</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($SLs as $item)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $item->so_prod_name }}</td>
                                            <td>{{ $item->so_prod_length }}</td>
                                            <td>{{ $item->so_prod_quantity }}</td>
                                            <td>{{ $item->so_prod_total_length }}</td>
                                            <td>{{ $item->so_prod_price_per_unit }}</td>
                                            <td>{{ $item->so_prod_price }}</td>
                                            <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>ลำดับ</th>
                                        <th>รายการสินค้า</th>
                                        <th>ยาว(ม.)</th>
                                        <th>จำนวน</th>
                                        <th>รวมยาว(ม.)</th>
                                        <th>ราคาหน่วยละ</th>
                                        <th>จำนวนเงิน</th>
                                        <th>วันที่</th>
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
