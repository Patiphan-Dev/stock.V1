<x-layout :title="$title">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    {{-- Session Messages --}}
                    @if (session('success'))
                        <x-flashMsg msg="{{ session('success') }}" bg="bg-green" />
                    @elseif (session('delete'))
                        <x-flashMsg msg="{{ session('delete') }}" bg="bg-red" />
                    @endif
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">รายการสินค้า</h3>
                            <div class="d-flex justify-content-end align-items-end">
                                <a href="{{ route('product.add') }}" class="btn btn-primary">เพิ่มสินค้า</a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="tb_sales" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ลำดับ</th>
                                        <th>รายการสินค้า</th>
                                        <th>หน่วย</th>
                                        <th>ความยาว</th>
                                        <th>ราคาต่อหน่วย (บาท)</th>
                                        <th>จำนวนนำเข้า</th>
                                        <th>จำนวนส่งออก</th>
                                        <th>จำนวนที่เหลือ</th>
                                        <th class="text-center"><i class="fa-solid fa-gears"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $item)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $item->prod_name ?? '-' }}</td>
                                            <td>{{ $item->prod_unit ?? '-' }}</td>
                                            <td>{{ $item->prod_length ?? '-' }}</td>
                                            <td>{{ $item->prod_price_per_unit ?? '-' }}</td>
                                            <td>{{ $item->prod_buy_qty ?? '-' }}</td>
                                            <td>{{ $item->prod_sales_qty ?? '-' }}</td>
                                            <td>{{ $item->prod_min_qty ?? '-' }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('product.edit', ['id' => $item->id]) }}"
                                                    class="badge badge-warning">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="{{ route('product.delete', ['id' => $item->id]) }}"
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
                                        <th>หน่วย</th>
                                        <th>ความยาว</th>
                                        <th>ราคาต่อหน่วย (บาท)</th>
                                        <th>จำนวนนำเข้า</th>
                                        <th>จำนวนส่งออก</th>
                                        <th>จำนวนที่เหลือ</th>
                                        <th class="text-center"><i class="fa-solid fa-gears"></i></th>
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
