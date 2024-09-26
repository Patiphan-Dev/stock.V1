<x-layout :title="$title">
    <link rel="stylesheet" href="{{ asset('admin-lte/dist/css/adminlte.min.css') }}">
    {{-- <script src="{{ asset('admin-lte/plugins/jquery/jquery.min.js') }}"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
    <script>
        function calculateTotal2(index) {
            const quantity = document.getElementById(`quantity${index}`).value;
            const price = document.getElementById(`price${index}`).value;
            const total = document.getElementById(`total${index}`);
            const length = document.getElementById(`length${index}`).value;
            const total_length = document.getElementById(`total_length${index}`);

            // Calculate total for this row
            total.value = (quantity && price) ? (quantity * price).toFixed(2) : '';
            total_length.value = (quantity && length) ? (quantity * length).toFixed(2) : '';

            // After updating the row, recalculate overall totals
            calculateOverallTotals();
        }

        function calculateOverallTotals() {
            // Get all the product totals
            const totals = document.querySelectorAll("input[name='so_prod_price[]']");
            let totalPrice = 0;

            totals.forEach(total => {
                totalPrice += parseFloat(total.value) || 0; // Sum up all the totals
            });

            // Set the overall total
            const totalPriceField = document.getElementById('so_total_price');
            totalPriceField.value = totalPrice.toFixed(2);

            // Calculate and set the VAT (7%)
            const vatField = document.getElementById('so_vat');
            const vatAmount = (totalPrice * 0.07).toFixed(2);
            vatField.value = vatAmount;

            // Calculate and set the net price (total + VAT)
            const netPriceField = document.getElementById('so_net_price');
            const netPrice = (totalPrice + parseFloat(vatAmount)).toFixed(2);
            netPriceField.value = netPrice;
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
                            <h1 class="card-title">ต้นฉบับใบกำกับภาษี/ใบเสร็จรับเงิน</h1>
                        </div>
                        {{-- Session Messages --}}
                        @if (session('success'))
                            <x-flashMsg msg="{{ session('success') }}" bg="bg-green" />
                        @elseif (session('delete'))
                            <x-flashMsg msg="{{ session('delete') }}" bg="bg-red" />
                        @endif
                        <form action="{{ route('so.update', ['id' => $SO->id]) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-md-3">
                                        <div class="form-group">
                                            <label for="so_number">เล่มที่</label>
                                            <input type="text" name="so_number" value="{{ $SO->so_number }}"
                                                class="form-control @error('so_number') is-invalid @enderror">
                                            @error('so_number')
                                                <p class="error">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <div class="form-group">
                                            <label for="so_date">วันที่ <span>*</span></label>
                                            <input type="date" name="so_date" value="{{ $SO->so_date }}"
                                                class="form-control @error('so_date') is-invalid @enderror">
                                            @error('so_date')
                                                <p class="error">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-5">
                                        <div class="form-group">
                                            <label for="so_customer_name">ชื่อลูกค้า <span>*</span></label>
                                            <input type="text" name="so_customer_name"
                                                value="{{ $SO->so_customer_name }}"
                                                class="form-control @error('so_customer_name') is-invalid @enderror">
                                            @error('so_customer_name')
                                                <p class="error">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <div class="form-group">
                                            <label for="so_customer_taxpayer_number">เลขประจำตัวผู้เสียภาษี <span>*</span></label>
                                            <input type="text" name="so_customer_taxpayer_number"
                                                value="{{ $SO->so_customer_taxpayer_number }}"
                                                class="form-control @error('so_customer_taxpayer_number') is-invalid @enderror">
                                            @error('so_customer_taxpayer_number')
                                                <p class="error">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="form-group">
                                            <label for="so_customer_address">ที่อยู่ <span>*</span></label>
                                            <textarea name="so_customer_address" class="form-control @error('so_customer_address') is-invalid @enderror"
                                                rows="3">{{ $SO->so_customer_address }}</textarea>
                                            @error('so_customer_address')
                                                <p class="error">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="form-group">
                                            <label for="so_note">หมายเหตุ</label>
                                            <textarea name="so_note" class="form-control @error('so_note') is-invalid @enderror" rows="3">{{ $SO->so_note }}</textarea>
                                            @error('so_note')
                                                <p class="error">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-4 col-6">
                                        <div class="form-group">
                                            <label for="quantity" class="form-label">รายการสินค้า <span>*</span></label>
                                        </div>
                                    </div>
                                    <div class="col-md-1 col-6">
                                        <div class="form-group">
                                            <label for="unit" class="form-label">ยาว(ม.) </label>
                                        </div>
                                    </div>
                                    <div class="col-md-1 col-6">
                                        <div class="form-group">
                                            <label for="property" class="form-label">จำนวน <span>*</span></label>
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-3">
                                        <div class="form-group">
                                            <label for="node" class="form-label">รวมยาว(ม.) </label>
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-3">
                                        <div class="form-group">
                                            <label for="node" class="form-label">ราคา/หน่วย <span>*</span></label>
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-3">
                                        <div class="form-group">
                                            <label for="node" class="form-label">จำนวนเงิน <span>*</span></label>
                                        </div>
                                    </div>
                                </div>
                                <div id="container1">
                                    @foreach ($SalesList as $index => $item)
                                        <div class="input-wrapper row mb-3">
                                            <div class="col-md-4 col-6">
                                                <input type="text" class="form-control" name="so_prod_name[]"
                                                    value="{{ old('so_prod_name.' . $index, $item->so_prod_name) }}"
                                                    readonly>
                                                @error('so_prod_name.0')
                                                    <p class="error">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="col-md-1 col-6">
                                                <input type="text" class="form-control" name="so_prod_length[]"
                                                    id="length1"
                                                    value="{{ old('so_prod_length.' . $index, $item->so_prod_length) }}">
                                                @error('so_prod_length.0')
                                                    <p class="error">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="col-md-1 col-6">
                                                <input type="text" class="form-control" name="so_prod_quantity[]"
                                                    id="quantity1" oninput="calculateTotal2(1)"
                                                    value="{{ old('so_prod_quantity.' . $index, $item->so_prod_quantity) }}">
                                                <input type="text" class="form-control" name="old_quantity[]"
                                                    value="{{ $item->so_prod_quantity }}" hidden>
                                                @error('so_prod_quantity.0')
                                                    <p class="error">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="col-md-2 col-6">
                                                <input type="text" class="form-control"
                                                    name="so_prod_total_length[]" id="total_length1" readonly
                                                    value="{{ old('so_prod_total_length.' . $index, $item->so_prod_total_length) }}">
                                                @error('so_prod_total_length.0')
                                                    <p class="error">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="col-md-2 col-6">
                                                <input type="text" class="form-control"
                                                    name="so_prod_price_per_unit[]" id="price1"
                                                    oninput="calculateTotal2(1)"
                                                    value="{{ old('so_prod_price_per_unit.' . $index, $item->so_prod_price_per_unit) }}">
                                                @error('so_prod_price_per_unit.0')
                                                    <p class="error">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="col-md-2 col-6">
                                                <input type="text" class="form-control" name="so_prod_price[]"
                                                    id="total1" readonly
                                                    value="{{ old('so_prod_price.' . $index, $item->so_prod_price) }}">
                                                @error('so_prod_price.0')
                                                    <p class="error">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="form-group" id="container1">
                                </div>
                                <div class="col text-right justify-content-end">
                                    <div class="row justify-content-end">
                                        <div class="form-group">
                                            <label for="so_total_price">รวมราคาสินค้า <span>*</span></label>
                                            <input type="text" name="so_total_price" id="so_total_price"
                                                value="{{ old('so_total_price', $SO->so_total_price) }}"
                                                class="form-control @error('so_total_price') is-invalid @enderror"
                                                readonly>
                                            @error('so_total_price')
                                                <p class="error">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row justify-content-end">
                                        <div class="form-group">
                                            <label for="so_vat">ภาษีมูลค่าเพิ่ม 7 % <span>*</span></label>
                                            <input type="text" name="so_vat" id="so_vat"
                                                value="{{ old('so_vat', $SO->so_vat) }}"
                                                class="form-control @error('so_vat') is-invalid @enderror" readonly>
                                            @error('so_vat')
                                                <p class="error">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row justify-content-end">
                                        <div class="form-group">
                                            <label for="so_net_price">เงินรวมทั้งสิ้น <span>*</span></label>
                                            <input type="text" name="so_net_price" id="so_net_price"
                                                value="{{ old('so_net_price', $SO->so_net_price) }}"
                                                class="form-control @error('so_net_price') is-invalid @enderror"
                                                readonly>
                                            @error('so_net_price')
                                                <p class="error">{{ $message }}</p>
                                            @enderror
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
