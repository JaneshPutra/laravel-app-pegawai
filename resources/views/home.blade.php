<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem HR Premium</title>
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}?v={{ time() }}">
</head>

<body class="bg-light">

    <div class="container-fluid p-0">
        <!-- HERO -->
        <div class="position-relative overflow-hidden text-white"
            style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 100vh; display: flex; align-items: center;">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-7">
                        <h1 class="display-3 font-weight-bold mb-4">Sistem HR Premium</h1>
                        <p class="lead mb-5">Kelola pegawai, presensi, cuti, dan gaji dengan mudah, cepat, dan
                            profesional.</p>

                        <div class="d-flex flex-wrap gap-3">
                            <a href="{{ route('login') }}" class="btn btn-light btn-lg px-5 shadow-lg"
                                style="border-radius: 12px;">
                                <i class="fas fa-sign-in-alt mr-2"></i> Masuk ke Sistem
                            </a>
                            <a href="#fitur" class="btn btn-outline-light btn-lg px-5" style="border-radius: 12px;">
                                Lihat Fitur <i class="fas fa-arrow-down ml-2"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-5 text-center">
                        <img src="{{ asset('assets/img/hr-illustration.svg') }}" alt="HR System" class="img-fluid"
                            style="max-height: 500px;">
                    </div>
                </div>
            </div>
        </div>

        <!-- FITUR -->
        <div id="fitur" class="py-5 bg-white">
            <div class="container">
                <h2 class="text-center mb-5">Fitur Unggulan</h2>
                <div class="row text-center">
                    <div class="col-md-4 mb-4">
                        <i class="fas fa-users fa-3x text-primary mb-3"></i>
                        <h5>Manajemen Pegawai</h5>
                    </div>
                    <div class="col-md-4 mb-4">
                        <i class="fas fa-calendar-check fa-3x text-success mb-3"></i>
                        <h5>Presensi & Cuti</h5>
                    </div>
                    <div class="col-md-4 mb-4">
                        <i class="fas fa-money-bill-wave fa-3x text-info mb-3"></i>
                        <h5>Penggajian Otomatis</h5>
                    </div>
                </div>
            </div>
        </div>

        <footer class="bg-dark text-white py-4 text-center">
            © {{ date('Y') }} Sistem HR Premium. Dibuat dengan ❤️ oleh kamu.
        </footer>
    </div>

</body>

</html>