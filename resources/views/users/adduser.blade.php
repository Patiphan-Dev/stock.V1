<x-layout :title="$title">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h1 class="card-title">เพิ่มสมาชิก</h1>
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
                                            <label for="fullname">ชื่อ - นามสกุล <span>*</span></label>
                                            <input type="text" name="fullname" value="{{ old('fullname') }}"
                                                class="form-control @error('fullname') is-invalid @enderror">
                                            @error('fullname')
                                                <p class="error">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <div class="form-group">
                                            <label for="username">ชื่อผู้ใช้งาน <span>*</span></label>
                                            <input type="text" name="username" value="{{ old('username') }}"
                                                class="form-control @error('username') is-invalid @enderror">
                                            @error('username')
                                                <p class="error">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <div class="form-group">
                                            <label for="password">รหัสผ่าน <span>*</span></label>
                                            <input type="password" name="password"
                                                class="form-control @error('password') is-invalid @enderror">
                                            @error('password')
                                                <p class="error">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <div class="form-group">
                                            <label for="status">สถานะ <span>*</span></label>
                                            <select class="form-control select" data-placeholder="เลือกสถานะ"
                                                style="width: 100%;" name="status" required>
                                                <option value="">---กรุณาเลือกสถานะ---</option>
                                                <option value="admin" {{ old('status') == 'admin' ? 'selected' : '' }}>แอดมิน</option>
                                                <option value="owner" {{ old('status') == 'owner' ? 'selected' : '' }}>เจ้าของร้าน</option>
                                                <option value="employee" {{ old('status') == 'employee' ? 'selected' : '' }}>พนักงาน</option>
                                            </select>
                                            @error('status')
                                                <p class="error">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row text-center">
                                    <div class="col">
                                        <a href="{{ route('users.index') }}" class="btn btn-danger">
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
