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
                                        <th>จำนวน</th>
                                        <th>ราคาหน่วยละ</th>
                                        <th>ลูกค้า</th>
                                        <th>วันที่</th>
                                        <th class="text-center"><i class="fa-solid fa-gears"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($SOs as $item)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $item->so_prod_name }}</td>
                                            <td>{{ $item->so_prod_quantity }}</td>
                                            <td>{{ $item->so_prod_price_per_unit }}</td>
                                            <td>{{ $item->so_customer_name }}</td>
                                            <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y') }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('so.edit', ['id' => $item->sales_order_id]) }}"
                                                    class="badge badge-warning">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="{{ route('so.delete', ['id' => $item->sales_list_id]) }}"
                                                    class="badge badge-danger">
                                                    <i class="fas fa-trash-alt"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>ลำดับ</th>
                                        <th>รายการสินค้า</th>
                                        <th>จำนวน</th>
                                        <th>ราคาหน่วยละ</th>
                                        <th>ลูกค้า</th>
                                        <th>วันที่</th>
                                        <th class="text-center"><i class="fa-solid fa-gears"></i></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layout>
