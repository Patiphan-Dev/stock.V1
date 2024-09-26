<x-layout :title="$title">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h1 class="card-title">แก้ไขข้อมูลสมาชิก</h1>
                        </div>
                        {{-- Session Messages --}}
                        @if (session('success'))
                            <x-flashMsg msg="{{ session('success') }}" bg="bg-green" />
                        @elseif (session('delete'))
                            <x-flashMsg msg="{{ session('delete') }}" bg="bg-red" />
                        @endif
                        <form action="{{ route('users.updateuser', ['id' => $user->id]) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT') <!-- เพิ่มส่วนนี้เพื่อบอกว่าเป็นการอัปเดตข้อมูล -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-md-3">
                                        <div class="form-group">
                                            <label for="fullname">ชื่อ - นามสกุล <span>*</span></label>
                                            <input type="text" name="fullname" value="{{ $user->fullname }}"
                                                class="form-control @error('fullname') is-invalid @enderror">
                                            @error('fullname')
                                                <p class="error">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <div class="form-group">
                                            <label for="username">ชื่อผู้ใช้งาน <span>*</span></label>
                                            <input type="text" name="username" value="{{ $user->username }}"
                                                class="form-control @error('username') is-invalid @enderror">
                                            @error('username')
                                                <p class="error">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <div class="form-group">
                                            <label for="status">สถานะ <span>*</span></label>
                                            <select class="form-control select" data-placeholder="เลือกสถานะ"
                                                style="width: 100%;" name="status" required>
                                                <option value="admin"
                                                    @if ($user->status == 'admin') selected @endif>แอดมิน
                                                </option>
                                                <option value="owner"
                                                    @if ($user->status == 'owner') selected @endif>เจ้าของร้าน
                                                </option>
                                                <option value="employee"
                                                    @if ($user->status == 'employee') selected @endif>พนักงาน
                                                </option>
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
