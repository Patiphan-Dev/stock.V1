<x-layout :title="$title">
    <link rel="stylesheet" href="{{ asset('admin-lte/dist/css/adminlte.min.css') }}">
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
                            <h1 class="card-title">ใบเสร็จรับเงิน/ใบกำกับภาษี/ใบส่งสินค้า</h1>
                        </div>
                        {{-- Session Messages --}}
                        @if (session('success'))
                            <x-flashMsg msg="{{ session('success') }}" bg="bg-green" />
                        @elseif (session('delete'))
                            <x-flashMsg msg="{{ session('delete') }}" bg="bg-red" />
                        @endif
                        <form action="{{ route('so.create') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-md-3">
                                        <div class="form-group">
                                            <label for="so_number">เลขที่</label>
                                            <input type="number" name="so_number" value="{{ old('so_number') }}"
                                                class="form-control @error('so_number') is-invalid @enderror"
                                                placeholder="001">
                                            @error('so_number')
                                                <p class="error">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <div class="form-group">
                                            <label for="so_date">วันที่ <span>*</span></label>
                                            <input type="date" name="so_date" value="{{ old('so_date') }}"
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
                                                value="{{ old('so_customer_name') }}"
                                                class="form-control @error('so_customer_name') is-invalid @enderror"
                                                placeholder="ชื่อ - นามสกุล">
                                            @error('so_customer_name')
                                                <p class="error">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <div class="form-group">
                                            <label for="so_customer_taxpayer_number">เลขประจำตัวผู้เสียภาษี
                                                <span>*</span></label>
                                            <input type="number" name="so_customer_taxpayer_number"
                                                value="{{ old('so_customer_taxpayer_number') }}"
                                                class="form-control @error('so_customer_taxpayer_number') is-invalid @enderror"
                                                placeholder="0123456789" pattern="[0-9]{13}">
                                            @error('so_customer_taxpayer_number')
                                                <p class="error">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="form-group">
                                            <label for="so_customer_address">ที่อยู่ <span>*</span></label>
                                            <textarea name="so_customer_address" class="form-control @error('so_customer_address') is-invalid @enderror"
                                                rows="3">{{ old('so_customer_address') }}</textarea>
                                            @error('so_customer_address')
                                                <p class="error">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="form-group">
                                            <label for="so_note">หมายเหตุ</label>
                                            <textarea name="so_note" class="form-control @error('so_note') is-invalid @enderror" rows="3">{{ old('so_note') }}</textarea>
                                            @error('so_note')
                                                <p class="error">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-3 col-6">
                                        <div class="form-group">
                                            <label for="so_prod_name" class="form-label">รายการสินค้า
                                                <span>*</span></label>
                                        </div>
                                    </div>
                                    <div class="col-md-1 col-6">
                                        <div class="form-group">
                                            <label for="so_prod_unit" class="form-label">หน่วย <span>*</span></label>
                                        </div>
                                    </div>
                                    <div class="col-md-1 col-6">
                                        <div class="form-group">
                                            <label for="so_prod_length" class="form-label">ความยาว </label>
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-6">
                                        <div class="form-group">
                                            <label for="so_prod_quantity" class="form-label">จำนวน
                                                <span>*</span></label>
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-3">
                                        <div class="form-group">
                                            <label for="so_prod_price_per_unit" class="form-label">ราคา/หน่วย
                                                <span>*</span></label>
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-3">
                                        <div class="form-group">
                                            <label for="so_prod_price" class="form-label">จำนวนเงิน
                                                <span>*</span></label>
                                        </div>
                                    </div>
                                </div>
                                <div id="container1">
                                    <div class="input-wrapper row">
                                        <div class="col-md-3 col-6">
                                            <select class="form-control" data-placeholder="รายการสินค้า"
                                                style="width: 100%;" name="so_prod_name[]"
                                                onchange="updateQuantityFields(this)" required>
                                                <option value="" readonly>---กรุณาเลือกรายการสินค้า---</option>
                                                @foreach ($products as $item)
                                                    <option value="{{ $item->prod_name }}"
                                                        data-qty="{{ $item->prod_min_qty }}"
                                                        data-unit="{{ $item->prod_unit }}">
                                                        {{ $loop->iteration }}. {{ $item->prod_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('so_prod_name.0')
                                                <p class="error">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="col-md-1 col-6">
                                            <input type="text" class="form-control" name="so_prod_unit[]"
                                                id="so_prod_unit1" value="{{ old('so_prod_unit.0') }}"
                                                placeholder="ชิ้น" readonly>
                                            @error('so_prod_unit.0')
                                                <p class="error">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="col-md-1 col-6">
                                            <input type="number" class="form-control" name="so_prod_length[]"
                                                id="length1" value="{{ old('so_prod_length.0') }}" min="0"
                                                placeholder="99.9">
                                            @error('so_prod_length.0')
                                                <p class="error">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="col-md-2 col-6">
                                            <input type="number" class="form-control" name="so_prod_quantity[]"
                                                id="quantity1" oninput="calculateTotal2(1)" min="0"
                                                placeholder="คงเหลือ" value="{{ old('so_prod_quantity.0') }}">
                                            @error('so_prod_quantity.0')
                                                <p class="error">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="col-md-2 col-6">
                                            <input type="number" class="form-control"
                                                name="so_prod_price_per_unit[]" id="price1" min="0"
                                                placeholder="999.99" oninput="calculateTotal2(1)"
                                                value="{{ old('so_prod_price_per_unit.0') }}">
                                            @error('so_prod_price_per_unit.0')
                                                <p class="error">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="col-md-2 col-6">
                                            <input type="number" class="form-control" name="so_prod_price[]"
                                                min="0" placeholder="999.99" id="total1" readonly
                                                value="{{ old('so_prod_price.0') }}">
                                            @error('so_prod_price.0')
                                                <p class="error">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="col-md-1 col-6">
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
                                            <label for="so_total_price">รวมราคาสินค้า <span>*</span></label>
                                            <input type="text" name="so_total_price" id="so_total_price"
                                                value="{{ old('so_total_price') }}" min="0"
                                                placeholder="999.99"
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
                                                value="{{ old('so_vat') }}" min="0" placeholder="999.99"
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
                                                value="{{ old('so_net_price') }}" min="0"
                                                placeholder="999.99"
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();

            let rowCount2 = 1; // เริ่มต้นด้วยหนึ่งแถว

            // ฟังก์ชันสำหรับสร้างแถวใหม่ด้วย ID ที่ไม่ซ้ำกัน
            var template2 = (index) => `
                <div class="input-wrapper row">
                    <div class="col-md-3 col-6">
                        <select class="form-control" data-placeholder="รายการสินค้า"
                            style="width: 100%;" name="so_prod_name[]" required onchange="updateQuantityFields(this)">
                            <option value="" readonly>---กรุณาเลือกรายการสินค้า---</option>
                            @foreach ($products as $item)
                                <option value="{{ $item->prod_name }}" data-qty="{{ $item->prod_min_qty }}" data-unit="{{ $item->prod_unit }}">
                                    {{ $loop->iteration }}. {{ $item->prod_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('so_prod_name.1')
                            <p class="error">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-md-1 col-6">
                        <input type="text" class="form-control" name="so_prod_unit[]" id="so_prod_unit${index}"
                            placeholder="ชิ้น"
                            value="{{ old('so_prod_unit.1') }}">
                        @error('so_prod_unit.1')
                            <p class="error">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-md-1 col-6">
                        <input type="number" class="form-control" name="so_prod_length[]" id="length${index}"
                            oninput="calculateTotal2(${index})" placeholder="999.99"
                            value="{{ old('so_prod_length.1') }}">
                        @error('so_prod_length.1')
                            <p class="error">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-md-2 col-6">
                        <input type="number" class="form-control" name="so_prod_quantity[]" id="quantity${index}" 
                            oninput="calculateTotal2(${index})"
                            placeholder="คงเหลือ"
                            value="{{ old('so_prod_quantity.1') }}">
                        @error('so_prod_quantity.1')
                            <p class="error">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-md-2 col-6">
                        <input type="number" class="form-control" name="so_prod_price_per_unit[]" id="price${index}" 
                            oninput="calculateTotal2(${index})" placeholder="999.99"
                            value="{{ old('so_prod_price_per_unit.1') }}">
                        @error('so_prod_price_per_unit.1')
                            <p class="error">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-md-2 col-6">
                        <input type="number" class="form-control" name="so_prod_price[]" id="total${index}" placeholder="999.99" readonly>
                    </div>
                    <div class="col-md-1 col-sm-6">
                        <button type="button" class="btn btn-danger form-group delete-row"><i class="fa-solid fa-xmark"></i></button>
                    </div>
                </div>
            `;

            // ฟังก์ชันสำหรับอัปเดตฟิลด์ปริมาณตามรายการสินค้าที่เลือก
            window.updateQuantityFields = function(selectElement) {
                const selectedOption = selectElement.options[selectElement.selectedIndex];
                const selectedValue = selectedOption.value;
                const minQty = selectedOption.getAttribute('data-qty');
                const unit = selectedOption.getAttribute('data-unit');
                const quantityInput = $(selectElement).closest('.input-wrapper').find(
                    'input[name="so_prod_quantity[]"]');
                const unitInput = $(selectElement).closest('.input-wrapper').find(
                    'input[name="so_prod_unit[]"]');
                const lengthInput = $(selectElement).closest('.input-wrapper').find(
                    'input[name="so_prod_length[]"]');

                // อัปเดตค่า max และ placeholder ของ quantity input
                if (quantityInput.length > 0) {
                    quantityInput.attr('max', minQty);

                    unitInput.attr('value', `${unit}`);

                    // Show or hide lengthInput based on unit value
                    if (unit !== 'เมตร') {
                        lengthInput.attr("readonly", true); // Set to read-only if the unit is not "เมตร"
                        quantityInput.attr('placeholder', `คงเหลือ ${minQty} ${unit}`);
                    } else {
                        lengthInput.removeAttr("readonly"); // Remove read-only if the unit is "เมตร"
                        quantityInput.attr('placeholder', `คงเหลือ ${minQty}`);
                    }

                }

                // ตรวจสอบว่ารายการสินค้านี้มีอยู่ในแถวอื่นแล้วหรือไม่
                const existingSelections = $("select[name='so_prod_name[]']").map(function() {
                    return $(this).val();
                }).get();

                if (existingSelections.filter(item => item === selectedValue).length > 1) {
                    alert('ไม่สามารถเลือกรายการสินค้านี้ซ้ำได้!');
                    $(selectElement).val('').trigger('change'); // รีเซ็ตการเลือก
                }
            };

            $('#add-row').click(function() {
                rowCount2++; // เพิ่มจำนวนแถว
                $('#container1').append(template2(rowCount2)); // เพิ่มแถวใหม่
            });

            $('#container1').on("click", ".delete-row", function() {
                $(this).parents(".input-wrapper").remove(); // ลบแถวที่เลือก
            });
        });
    </script>

    <script>
        function calculateTotal2(index) {
            const quantity = Number(document.getElementById(`quantity${index}`).value);
            const price = Number(document.getElementById(`price${index}`).value);
            const total = document.getElementById(`total${index}`);
            const length = Number(document.getElementById(`length${index}`).value);
            const total_length = document.getElementById(`total_length${index}`);

            // คำนวณยอดรวมสำหรับแถวนี้
            if (!isNaN(quantity) && !isNaN(price)) {
                total.value = (quantity * price).toFixed(2);
            } else {
                total.value = '';
            }

            // หลังจากอัปเดตแถวแล้ว คำนวณยอดรวมทั้งหมดใหม่
            calculateOverallTotals2();
        }

        function calculateOverallTotals2() {
            // รับยอดรวมสินค้าทั้งหมด
            const totals = document.querySelectorAll("input[name='so_prod_price[]']");
            let totalPrice = 0;

            totals.forEach(total => {
                totalPrice += Number(total.value) || 0; // สรุปยอดรวมทั้งหมด
            });

            // ตั้งค่าให้กับยอดรวมทั้งหมด
            const totalPriceField = document.getElementById('so_total_price');
            totalPriceField.value = totalPrice.toFixed(2);

            // คำนวณและตั้งค่า VAT (7%)
            const vatField = document.getElementById('so_vat');
            const vatAmount = (totalPrice * 0.07).toFixed(2);
            vatField.value = vatAmount;

            // คำนวณและตั้งค่าเน็ต (ยอดรวม + VAT)
            const netPriceField = document.getElementById('so_net_price');
            const netPrice = (totalPrice + Number(vatAmount)).toFixed(2);
            netPriceField.value = netPrice;
        }
    </script>
</x-layout>
