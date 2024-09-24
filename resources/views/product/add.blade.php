<x-layout :title="$title">

    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
    <script>
        function calculateTotal() {
            const prod_buy_qty = parseFloat(document.getElementById('prod_buy_qty').value) || 0;
            const prod_sales_qty = parseFloat(document.getElementById('prod_sales_qty').value) || 0;
            const prod_min_qty = document.getElementById('prod_min_qty');

            if (!isNaN(prod_buy_qty) && !isNaN(prod_sales_qty)) {
                prod_min_qty.value = (prod_buy_qty - prod_sales_qty);
            } else {
                prod_min_qty.value = '';
            }

        }

    </script>
    <style>
        .error {
            color: red;
        }
    </style>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h1 class="card-title">เพิ่มสินค้าเข้าสต๊อก</h1>
                        </div>
                        {{-- Session Messages --}}
                        @if (session('success'))
                            <x-flashMsg msg="{{ session('success') }}" bg="bg-green" />
                        @elseif (session('delete'))
                            <x-flashMsg msg="{{ session('delete') }}" bg="bg-red" />
                        @endif
                        <form action="{{ route('product.create') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div id="container1">
                                    <div class="row">
                                        <div class="col-md-3 col-sm-6">
                                            <div class="form-group">
                                                <label for="po_id" class="form-label">รหัสใบสั่งซื้อ(ถ้ามี) </label>
                                                <input type="text" class="form-control" name="po_id" id="po_id"
                                                    value="{{ old('po_id') }}">
                                                @error('po_id')
                                                    <p class="error">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <div class="form-group">
                                                <label for="prod_name" class="form-label">ชื่อสินค้า</label>
                                                <input type="text" class="form-control" name="prod_name"
                                                    id="prod_name" value="{{ old('prod_name') }}" @error('prod_name') is-invalid @enderror>
                                                @error('prod_name')
                                                    <p class="error">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6">
                                            <div class="form-group">
                                                <label for="prod_price_per_unit	" class="form-label">ราคาต่อหน่วย (บาท)
                                                </label>
                                                <input type="text" class="form-control" name="prod_price_per_unit"
                                                    id="prod_price_per_unit" value="{{ old('prod_price_per_unit') }}" @error('prod_price_per_unit') is-invalid @enderror>
                                                @error('prod_price_per_unit')
                                                    <p class="error">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6">
                                            <div class="form-group">
                                                <label for="prod_length" class="form-label">ความยาว (เมตร)</label>
                                                <input type="text" class="form-control" name="prod_length"
                                                    id="prod_length" value="{{ old('prod_length') }}">
                                                @error('prod_length')
                                                    <p class="error">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6">
                                            <div class="form-group">
                                                <label for="prod_buy_qty" class="form-label"> จำนวนสินค้าซื้อมา
                                                    (ชิ้น)</label>
                                                <input type="text" class="form-control" name="prod_buy_qty"
                                                    id="prod_buy_qty" oninput="calculateTotal()"
                                                    value="{{ old('prod_buy_qty') }}" @error('prod_buy_qty') is-invalid @enderror>
                                                @error('prod_buy_qty')
                                                    <p class="error">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6">
                                            <div class="form-group">
                                                <label for="prod_sales_qty" class="form-label">จำนวนสินค้าที่ขายไป
                                                    (ชิ้น)
                                                </label>
                                                <input type="text" class="form-control" name="prod_sales_qty"
                                                    id="prod_sales_qty" oninput="calculateTotal()"
                                                    value="{{ old('prod_sales_qty') }}" @error('prod_sales_qty') is-invalid @enderror>
                                                @error('prod_sales_qty')
                                                    <p class="error">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-3 col-sm-6">
                                            <div class="form-group">
                                                <label for="prod_min_qty" class="form-label">จำนวนสินค้าคงเหลือ
                                                    (ชิ้น)</label>
                                                <input type="text" class="form-control" name="prod_min_qty"
                                                    id="prod_min_qty" value="{{ old('prod_min_qty') }}" @error('prod_min_qty') is-invalid @enderror readonly>
                                                @error('prod_min_qty')
                                                    <p class="error">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row text-center">
                                    <div class="col">
                                        <a href="" class="btn btn-danger">
                                            <i class="fa-solid fa-xmark"></i> ยกเลิก
                                        </a>
                                        <button type="submit" class="btn btn-success" id="submit">
                                            <i class="fa-solid fa-floppy-disk"></i> บันทึก
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layout>
