<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Monitoring Berkas BPDAS Barito</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <!-- Custom CSS -->
    <link href="<?= base_url('assets/css/styles.css') ?>" rel="stylesheet">
    
    <style>
        body {
            padding: 0 !important;
            margin: 0 !important;
        }
        nav, .navbar, .sidebar {
            display: none !important;
        }
    </style>
</head>
<body class="login-page">

<div class="login-container">
  <div class="row w-100 justify-content-center mx-0">
    <div class="col-11 col-sm-10 col-md-8 col-lg-5 col-xl-4">
      <div class="card login-card">
        <div class="card-body p-4 p-md-5">
          
          <!-- Logo & Title Section -->
          <div class="text-center mb-4">
            <div class="logo-container mb-3">
              <img src="<?= base_url('assets/img/logo.webp') ?>" alt="Logo KLHK" class="logo-img">
            </div>
            <h4 class="fw-bold text-klhk mb-2">Sistem Monitoring Berkas</h4>
            <p class="text-muted small mb-0">BPDAS Barito</p>
            <p class="text-muted small">Kementerian Lingkungan Hidup dan Kehutanan</p>
          </div>

          <!-- Alert Messages -->
          <?php if(session()->getFlashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <i class="bi bi-exclamation-triangle-fill me-2"></i>
              <?= session()->getFlashdata('error') ?>
              <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
          <?php endif; ?>

          <?php if(isset($validation)): ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
              <i class="bi bi-exclamation-circle-fill me-2"></i>
              <?= $validation->listErrors() ?>
              <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
          <?php endif; ?>

          <!-- Login Form -->
          <form method="post" action="<?= base_url('login') ?>" class="needs-validation" novalidate>
            <!-- <form method="post" action="<?= site_url('debug/post') ?>" class="needs-validation" novalidate> -->
            <?= csrf_field() ?>
            
            <div class="mb-3">
              <label for="username" class="form-label fw-semibold">
                <i class="bi bi-person-fill text-klhk me-1"></i>Username
              </label>
              <input 
                value="<?= old('username') ?>" 
                type="text" 
                name="username" 
                id="username" 
                class="form-control form-control-lg" 
                placeholder="Masukkan username"
                required>
              <div class="invalid-feedback">
                Username harus diisi
              </div>
            </div>

            <div class="mb-4">
              <label for="password" class="form-label fw-semibold">
                <i class="bi bi-lock-fill text-klhk me-1"></i>Password
              </label>
              <input 
                value="<?= old('password') ?>" 
                type="password" 
                name="password" 
                id="password" 
                class="form-control form-control-lg" 
                placeholder="Masukkan password"
                required>
              <div class="invalid-feedback">
                Password harus diisi
              </div>
            </div>

            <div class="d-grid">
              <button class="btn btn-klhk btn-lg fw-semibold" type="submit">
                <i class="bi bi-box-arrow-in-right me-2"></i>Masuk
              </button>
            </div>
          </form>

          <!-- Footer Info -->
          <div class="text-center mt-4">
            <p class="text-muted small mb-0">
              <i class="bi bi-shield-lock-fill text-klhk me-1"></i>
              Login dilindungi dengan enkripsi
            </p>
          </div>
        </div>
      </div>

      <!-- Copyright -->
      <div class="text-center mt-3">
        <p class="text-white small mb-0">
          &copy; <?= date('Y') ?> BPDAS Barito - Kementerian LHK
        </p>
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Form Validation Script -->
<script>
(function () {
  'use strict'
  var forms = document.querySelectorAll('.needs-validation')
  Array.prototype.slice.call(forms).forEach(function (form) {
    form.addEventListener('submit', function (event) {
      if (!form.checkValidity()) {
        event.preventDefault()
        event.stopPropagation()
      }
      form.classList.add('was-validated')
    }, false)
  })
})()

// Auto dismiss alerts after 5 seconds
document.addEventListener('DOMContentLoaded', function() {
    const alerts = document.querySelectorAll('.alert-dismissible');
    alerts.forEach(function(alert) {
        setTimeout(function() {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        }, 5000);
    });
});
</script>

</body>
</html>