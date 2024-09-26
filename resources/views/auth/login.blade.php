<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>เข้าสู่ระบบ</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('admin-lte/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('admin-lte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('admin-lte/dist/css/adminlte.min.css') }}">
    <!-- Ionicons -->
    <link rel="icon" type="image/x-icon" href="{{ asset('/store.png') }}">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="/home">
                <img src="{{ asset('/store.png') }}" alt="store Logo" class="w-25 brand-image img-circle">
                <b>คลังสินค้า</b>
            </a>
        </div>
        <div class="card">
            <div class="card-body login-card-body">
                @if (session('success'))
                    <x-flashMsg msg="{{ session('success') }}" bg="bg-green" />
                @elseif (session('error'))
                    <x-flashMsg msg="{{ session('error') }}" bg="bg-red" />
                @endif

                <form action="{{ route('login') }}" method="post">
                    @csrf
                    <label for="username">ชื่อผู้ใช้งาน</label>
                    <div class="input-group mb-3">
                        <input type="text" id="username" name="username" class="form-control" value="{{ old('username') }}">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    @error('username')
                        <div class="text-danger mb-3">{{ $message }}</div>
                    @enderror 

                    <label for="password">รหัสผ่าน</label>
                    <div class="input-group mb-3">
                        <input type="password" id="password" name="password" class="form-control">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    @error('password')
                        <div class="text-danger mb-3">{{ $message }}</div>
                    @enderror

                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" name="remember" id="remember">
                                <label for="remember">
                                    จดจำฉัน.
                                </label>
                            </div>
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">เข้าสู่ระบบ</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="{{ asset('admin-lte/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('admin-lte/dist/js/adminlte.min.js') }}"></script>
</body>

</html>
