{{-- resources/views/dashboard/auth/login.blade.php --}}
<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <title>تسجيل الدخول</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">

    <!-- Bootstrap RTL -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.rtl.min.css" rel="stylesheet">

    <!-- Custom login CSS -->
    <link rel="stylesheet" href="{{ asset('template/css/login.css') }}">
</head>

<body>

    <div class="login-page bg-light min-vh-100 d-flex align-items-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 offset-lg-1">
                    <h3 class="mb-3 text-center">تسجيل الدخول للمتجر</h3>
                    <div style="margin: 50px 0;" class="bg-white shadow rounded">
                        <div style="height: 450px;" class="row justify-content-center">
                            <div class="col-md-6 ps-0 mt-5">
                                <div class="form-left h-100 py-5 px-5">
                                    <form method="POST" action="{{ route('vendor.login') }}" class="row g-4">
                                        @csrf

                                        <div class="col-12">
                                            <label class="mb-2">البريد الالكتروني</label>
                                            <div class="input-group">
                                                <div class="input-group-text"><i class="bi bi-person-fill"></i></div>
                                                <input type="email" name="email" class="form-control"
                                                    placeholder="ادخل البريد الالكتروني"
                                                    value="{{ old('email') }}" required autofocus>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label class="mb-2">كلمة المرور</label>
                                            <div class="input-group">
                                                <div class="input-group-text"><i class="bi bi-lock-fill"></i></div>
                                                <input type="password" name="password" id="password"
                                                    class="form-control"
                                                    placeholder="ادخل كلمة المرور" required>
                                                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                                    <i class="bi bi-eye-slash" id="toggleIcon"></i>
                                                </button>
                                            </div>
                                        </div>

                                        @if ($errors->any())
                                        <div class="col-12">
                                            <div class="alert alert-danger mt-2 text-center w-100">
                                                {{ $errors->first() }}
                                            </div>
                                        </div>
                                        @endif

                                        <div class="col-12 text-center mx-auto d-flex justify-content-center">
                                            <button type="submit" class="btn btn-login px-4 float-start mt-4">تسجيل الدخول</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-md-6 pe-0 d-none d-md-block">
                                <div class="form-right align h-100 bg-login text-white text-center pt-5">
                                    <img class="mt-5" src="{{ asset('template/images/MyTours.jpg') }}" width="150px" alt="">
                                    <h2 class="fs-1 mt-4">مرحباً بعودتك!</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript لإظهار/إخفاء كلمة المرور -->
    <script>
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        const toggleIcon = document.getElementById('toggleIcon');

        togglePassword.addEventListener('click', () => {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);

            toggleIcon.classList.toggle('bi-eye');
            toggleIcon.classList.toggle('bi-eye-slash');
        });
    </script>

</body>

</html>