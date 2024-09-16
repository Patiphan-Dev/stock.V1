<x-layout :title="$title">
    <link rel="stylesheet" href="{{ asset('admin-lte/dist/css/adminlte.min.css') }}">
    {{-- <script src="{{ asset('admin-lte/plugins/jquery/jquery.min.js') }}"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();

            let rowCount = 1; // Start with one row

            // Function to create a new row with unique IDs
            var template = (index) => `
                <div class="input-wrapper row">
                    <div class="col-md-5 col-sm-6">
                        <input type="text" class="form-control" name="po_prod_name[]" value="{{ old('po_prod_name.1') }}">
                        @error('po_prod_name.1')
                            <p class="error">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-md-2 col-sm-6">
                        <input type="text" class="form-control" name="po_prod_quantity[]" id="quantity${index}" oninput="calculateTotal(${index})" value="{{ old('po_prod_quantity.1') }}">
                        @error('po_prod_quantity.1')
                            <p class="error">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-md-2 col-sm-6">
                        <input type="text" class="form-control" name="po_prod_price_per_unit[]" id="price${index}" oninput="calculateTotal(${index})" value="{{ old('po_prod_price_per_unit.1') }}">
                        @error('po_prod_price_per_unit.1')
                            <p class="error">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-md-2 col-sm-6">
                        <input type="text" class="form-control" name="po_prod_price[]" id="total${index}" readonly value="{{ old('po_prod_price.1') }}">
                        @error('po_prod_price.1')
                            <p class="error">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-md-1 col-sm-6">
                        <button type="button" class="btn btn-danger form-group delete-row"><i class="fa-solid fa-xmark"></i></button>
                    </div>
                </div>
            `;

            $('#add-row').click(function() {
                rowCount++; // Increment the row count
                $('#container1').append(template(rowCount)); // Add a new row
            });

            $('#container1').on("click", ".delete-row", function() {
                $(this).parents(".input-wrapper").remove(); // Remove the specific row
            });

        });
    </script>
    <script>
        function calculateTotal(index) {
            const quantity = document.getElementById(`quantity${index}`).value;
            const price = document.getElementById(`price${index}`).value;
            const total = document.getElementById(`total${index}`);

            // Calculate total for this row
            total.value = (quantity && price) ? (quantity * price).toFixed(2) : '';

            // After updating the row, recalculate overall totals
            calculateOverallTotals();
        }

        function calculateOverallTotals() {
            // Get all the product totals
            const totals = document.querySelectorAll("input[name='po_prod_price[]']");
            let totalPrice = 0;

            totals.forEach(total => {
                totalPrice += parseFloat(total.value) || 0; // Sum up all the totals
            });

            // Set the overall total
            const totalPriceField = document.getElementById('po_total_price');
            totalPriceField.value = totalPrice.toFixed(2);

            // Calculate and set the VAT (7%)
            const vatField = document.getElementById('po_vat');
            const vatAmount = (totalPrice * 0.07).toFixed(2);
            vatField.value = vatAmount;

            // Calculate and set the net price (total + VAT)
            const netPriceField = document.getElementById('po_net_price');
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
                        <form action="{{ route('po.create') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-md-2">
                                        <div class="form-group">
                                            <label for="po_number1">เล่มที่</label>
                                            <input type="text" name="po_number1" value="{{ old('po_number1') }}"
                                                class="form-control @error('po_number1') is-invalid @enderror">
                                            @error('po_number1')
                                                <p class="error">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <div class="form-group">
                                            <label for="po_number2">เลขที่</label>
                                            <input type="text" name="po_number2" value="{{ old('po_number2') }}"
                                                class="form-control @error('po_number2') is-invalid @enderror">
                                            @error('po_number2')
                                                <p class="error">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <div class="form-group">
                                            <label for="po_date">วันที่</label>
                                            <input type="date" name="po_date" value="{{ old('po_date') }}"
                                                class="form-control @error('po_date') is-invalid @enderror">
                                            @error('po_date')
                                                <p class="error">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-5">
                                        <div class="form-group">
                                            <label for="po_company_name">ชื่อบริษัท</label>
                                            <input type="text" name="po_company_name"
                                                value="{{ old('po_company_name') }}"
                                                class="form-control @error('po_company_name') is-invalid @enderror">
                                            @error('po_company_name')
                                                <p class="error">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-2">
                                        <div class="form-group">
                                            <label for="po_company_tel">โทร</label>
                                            <input type="text" name="po_company_tel"
                                                value="{{ old('po_company_tel') }}"
                                                class="form-control @error('po_company_tel') is-invalid @enderror">
                                            @error('po_company_tel')
                                                <p class="error">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <div class="form-group">
                                            <label for="po_company_fax">แฟรกซ์</label>
                                            <input type="text" name="po_company_fax"
                                                value="{{ old('po_company_fax') }}"
                                                class="form-control @error('po_company_fax') is-invalid @enderror">
                                            @error('po_company_fax')
                                                <p class="error">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <div class="form-group">
                                            <label for="po_company_taxpayer_number">เลขผู้เสียภาษี</label>
                                            <input type="text" name="po_company_taxpayer_number"
                                                value="{{ old('po_company_taxpayer_number') }}"
                                                class="form-control @error('po_company_taxpayer_number') is-invalid @enderror">
                                            @error('po_company_taxpayer_number')
                                                <p class="error">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="po_company_address">ที่อยู่</label>
                                            <textarea name="po_company_address" class="form-control @error('po_company_address') is-invalid @enderror"
                                                rows="3">{{ old('po_company_address') }}</textarea>
                                            @error('po_company_address')
                                                <p class="error">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="po_note">หมายเหตุ</label>
                                            <textarea name="po_note" class="form-control @error('po_note') is-invalid @enderror" rows="3">{{ old('po_note') }}</textarea>
                                            @error('po_note')
                                                <p class="error">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-5 col-sm-4">
                                        <div class="form-group">
                                            <label for="quantity" class="form-label">รายการสินค้า </label>
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-4">
                                        <div class="form-group">
                                            <label for="unit" class="form-label">จำนวน/กิโล </label>
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-4">
                                        <div class="form-group">
                                            <label for="property" class="form-label">ราคา/หน่วย</label>
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-4">
                                        <div class="form-group">
                                            <label for="node" class="form-label">จำนวนเงิน </label>
                                        </div>
                                    </div>
                                </div>
                                <div id="container1">
                                    <div class="row">
                                        <div class="col-md-5 col-sm-6">
                                            <input type="text" class="form-control" name="po_prod_name[]"
                                                value="{{ old('po_prod_name.0') }}">
                                            @error('po_prod_name.0')
                                                <p class="error">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="col-md-2 col-sm-6">
                                            <input type="text" class="form-control" name="po_prod_quantity[]"
                                                id="quantity1" oninput="calculateTotal(1)"
                                                value="{{ old('po_prod_quantity.0') }}">
                                            @error('po_prod_quantity.0')
                                                <p class="error">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="col-md-2 col-sm-6">
                                            <input type="text" class="form-control"
                                                name="po_prod_price_per_unit[]" id="price1"
                                                oninput="calculateTotal(1)"
                                                value="{{ old('po_prod_price_per_unit.0') }}">
                                            @error('po_prod_price_per_unit.0')
                                                <p class="error">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="col-md-2 col-sm-6">
                                            <input type="text" class="form-control" name="po_prod_price[]"
                                                id="total1" readonly value="{{ old('po_prod_price.0') }}">
                                            @error('po_prod_price.0')
                                                <p class="error">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="col-md-1 col-sm-6">
                                            <button type="button" class="btn btn-success form-group" id="add-row">
                                                <i class="fa-solid fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" id="container1">
                                </div>
                                <div class="col text-right justify-content-end">
                                    <div class="row justify-content-end">
                                        <div class="form-group">
                                            <label for="po_total_price">รวมราคาสินค้า</label>
                                            <input type="text" name="po_total_price" id="po_total_price"
                                                value="{{ old('po_total_price') }}"
                                                class="form-control @error('po_total_price') is-invalid @enderror"
                                                readonly>
                                            @error('po_total_price')
                                                <p class="error">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row justify-content-end">
                                        <div class="form-group">
                                            <label for="po_vat">ภาษีมูลค่าเพิ่ม 7 %</label>
                                            <input type="text" name="po_vat" id="po_vat"
                                                value="{{ old('po_vat') }}"
                                                class="form-control @error('po_vat') is-invalid @enderror" readonly>
                                            @error('po_vat')
                                                <p class="error">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row justify-content-end">
                                        <div class="form-group">
                                            <label for="po_net_price">เงินรวมทั้งสิ้น</label>
                                            <input type="text" name="po_net_price" id="po_net_price"
                                                value="{{ old('po_net_price') }}"
                                                class="form-control @error('po_net_price') is-invalid @enderror"
                                                readonly>
                                            @error('po_net_price')
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
