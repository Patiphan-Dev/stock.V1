<x-layout :title="$title">
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
                        <form action="{{ route('users.createuser') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-md-3">
                                        <div class="form-group">
                                            <label for="fullname">ชื่อ - นามสกุล</label>
                                            <input type="text" name="fullname" value="{{ old('fullname') }}"
                                                class="form-control @error('fullname') is-invalid @enderror">
                                            @error('fullname')
                                                <p class="error">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <div class="form-group">
                                            <label for="username">ชื่อผู้ใช้งาน</label>
                                            <input type="text" name="username" value="{{ old('username') }}"
                                                class="form-control @error('username') is-invalid @enderror">
                                            @error('username')
                                                <p class="error">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <div class="form-group">
                                            <label for="password">รหัสผ่าน</label>
                                            <input type="password" name="password" value="{{ old('password') }}"
                                                class="form-control @error('password') is-invalid @enderror">
                                            @error('password')
                                                <p class="error">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <div class="form-group">
                                            <label for="ststus">สถานะ</label>
                                            <select class="form-control select" data-placeholder="เลือกสถานะ"
                                                style="width: 100%;" name="ststus" required>
                                                <option value="admin">แอดมิน</option>
                                                <option value="owner">เจ้าของร้าน</option>
                                                <option value="employee">พนักงาน</option>
                                            </select>
                                            @error('ststus')
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
