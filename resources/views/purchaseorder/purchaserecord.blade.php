<x-layout :title="$title">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    @if (session('success'))
                        <x-flashMsg msg="{{ session('success') }}" bg="bg-green" />
                    @elseif (session('error'))
                        <x-flashMsg msg="{{ session('error') }}" bg="bg-red" />
                    @endif
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">บันทึกการขาย</h3>
                        </div>
                        <div class="card-body">
                            <table id="tb_sales" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ลำดับ</th>
                                        <th>รายการสินค้า</th>
                                        <th>จำนวน</th>
                                        <th>หน่วย</th>
                                        <th>ราคา/หน่วย</th>
                                        <th>พาร์ทเนอร์</th>
                                        <th>วันที่</th>
                                        <th class="text-center"><i class="fa-solid fa-gears"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($POs as $item)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $item->po_prod_name }}</td>
                                            <td class="text-center">{{ $item->po_prod_quantity }}</td>
                                            <td class="text-center">{{ $item->product->prod_unit ?? '-' }}</td>
                                            <td class="text-right">{{ number_format($item->po_prod_price_per_unit, 2) }}</td>
                                            <td>{{ $item->po_company_name }}</td>
                                            <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y') }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('po.edit', ['id' => $item->purchase_order_id]) }}"
                                                    class="badge badge-warning">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="{{ route('po.delete', ['id' => $item->purchase_list_id]) }}"
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
                                        <th>หน่วย</th>
                                        <th>ราคา/หน่วย</th>
                                        <th>พาร์ทเนอร์</th>
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
