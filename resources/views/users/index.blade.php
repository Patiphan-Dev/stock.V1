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
                            <h3 class="card-title">จักการสมาชิก</h3>
                            <div class="d-flex justify-content-end align-items-end">
                                <a href="{{ route('users.adduser') }}" class="btn btn-primary">เพิ่มสมาชิก</a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="tb_sales" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ลำดับ</th>
                                        <th>ชื่อผู้ใช้งาน</th>
                                        <th>ชื่อ - นามสกุล</th>
                                        <th>สถานะ</th>
                                        <th>วันที่สร้าง</th>
                                        <th class="text-center"><i class="fa-solid fa-gears"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $user->username }}</td>
                                            <td>{{ $user->fullname }}</td>
                                            <td>{{ $user->status }}</td>
                                            <td>{{ \Carbon\Carbon::parse($user->created_at)->format('d/m/Y') }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('users.edituser', ['id' => $user->id]) }}"
                                                    class="badge badge-warning">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                @if ($user->status !== 'admin')
                                                    <a href="{{ route('users.deleteuser', ['id' => $user->id]) }}"
                                                        class="badge badge-danger">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>ลำดับ</th>
                                        <th>ชื่อผู้ใช้งาน</th>
                                        <th>ชื่อ - นามสกุล</th>
                                        <th>สถานะ</th>
                                        <th>วันที่สร้าง</th>
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
