<?php
$role = session()->get('role') ?? 'guest';
$currentPath = trim(uri_string(), '/');

$isDashboard = $currentPath === '' || $currentPath === 'dashboard' || str_starts_with($currentPath, 'dashboard/');
$isPerjalananDinas = str_contains($currentPath, 'perjalanan-dinas');
$isGajiInduk = str_contains($currentPath, 'gaji-induk');
$isTunjanganKinerja = str_contains($currentPath, 'tunjangan-kinerja');
$isUangMakan = str_contains($currentPath, 'uang-makan');
$isHonorarium = str_contains($currentPath, 'honorarium');
$isNonKontraktual = $isGajiInduk || $isTunjanganKinerja || $isUangMakan || $isHonorarium;
$isKontraktual = str_contains($currentPath, 'kontraktual');
$isGup = preg_match('#^gup(?:/|$)#', $currentPath) === 1;
$isVerifikasi = str_contains($currentPath, 'verifikasi-berkas');
$isKelolaUser = str_contains($currentPath, 'kelola-user');
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? $title . ' - ' : '' ?>Sistem Monitoring Berkas BPDAS Barito</title>
    <link rel="shortcut icon" href="<?= base_url('icon.ico') ?>">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="<?= base_url('assets/css/sidebar.css') ?>" rel="stylesheet">
</head>
<body>

<div class="app-shell">
    <aside class="sidebar" id="appSidebar">
        <div class="sidebar-header">
            <div class="logo-container">
                <img src="<?= base_url('assets/img/logo.webp') ?>" alt="Logo" class="sidebar-logo">
            </div>
            <h5 class="sidebar-title">BPDAS Barito</h5>
            <small class="sidebar-subtitle">Kementerian LHK</small>
        </div>

        <nav class="sidebar-nav">
            <a href="<?= base_url('dashboard') ?>" class="nav-item <?= $isDashboard ? 'active' : '' ?>">
                <i class="bi bi-speedometer2"></i>
                <span>Dashboard</span>
            </a>

            <?php if ($role === 'operator'): ?>
                <div class="nav-item-dropdown">
                    <a
                        class="nav-item dropdown-toggle <?= $isPerjalananDinas ? 'active' : '' ?>"
                        href="#lsBendaharaMenu"
                        data-bs-toggle="collapse"
                        role="button"
                        aria-expanded="<?= $isPerjalananDinas ? 'true' : 'false' ?>"
                    >
                        <i class="bi bi-currency-dollar"></i>
                        <span>LS Bendahara</span>
                        <i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <div class="collapse submenu <?= $isPerjalananDinas ? 'show' : '' ?>" id="lsBendaharaMenu">
                        <a href="<?= base_url('perjalanan-dinas') ?>" class="submenu-item <?= $isPerjalananDinas ? 'active' : '' ?>">
                            <i class="bi bi-airplane"></i>
                            <span>Perjalanan Dinas</span>
                        </a>
                    </div>
                </div>

                <div class="nav-item-dropdown">
                    <a
                        class="nav-item dropdown-toggle <?= $isNonKontraktual ? 'active' : '' ?>"
                        href="#nonKontraktualMenu"
                        data-bs-toggle="collapse"
                        role="button"
                        aria-expanded="<?= $isNonKontraktual ? 'true' : 'false' ?>"
                    >
                        <i class="bi bi-people"></i>
                        <span>Non Kontraktual</span>
                        <i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <div class="collapse submenu <?= $isNonKontraktual ? 'show' : '' ?>" id="nonKontraktualMenu">
                        <a href="<?= base_url('gaji-induk') ?>" class="submenu-item <?= $isGajiInduk ? 'active' : '' ?>">
                            <i class="bi bi-person-badge"></i>
                            <span>Gaji Induk</span>
                        </a>
                        <a href="<?= base_url('tunjangan-kinerja') ?>" class="submenu-item <?= $isTunjanganKinerja ? 'active' : '' ?>">
                            <i class="bi bi-star"></i>
                            <span>Tunjangan Kinerja</span>
                        </a>
                        <a href="<?= base_url('uang-makan') ?>" class="submenu-item <?= $isUangMakan ? 'active' : '' ?>">
                            <i class="bi bi-cup-hot"></i>
                            <span>Uang Makan</span>
                        </a>
                        <a href="<?= base_url('honorarium') ?>" class="submenu-item <?= $isHonorarium ? 'active' : '' ?>">
                            <i class="bi bi-award"></i>
                            <span>Honorarium</span>
                        </a>
                    </div>
                </div>

                <a href="<?= base_url('kontraktual') ?>" class="nav-item <?= $isKontraktual ? 'active' : '' ?>">
                    <i class="bi bi-briefcase"></i>
                    <span>Kontraktual</span>
                </a>

                <a href="<?= base_url('gup') ?>" class="nav-item <?= $isGup ? 'active' : '' ?>">
                    <i class="bi bi-cash-stack"></i>
                    <span>GUP UP PTUP TUP</span>
                </a>
                <li class="nav-item">
                    <a href="<?= base_url('laporan-operator') ?>" class="nav-link">
                        <i class="bi bi-clipboard-data"></i>
                        <span>Laporan</span>
                    </a>
                </li>
            <?php elseif ($role === 'bendahara'): ?>
                <a href="<?= base_url('verifikasi-berkas') ?>" class="nav-item <?= $isVerifikasi ? 'active' : '' ?>">
                    <i class="bi bi-check2-all"></i>
                    <span>Verifikasi Berkas</span>
                </a>
            <?php elseif ($role === 'admin'): ?>
                <a href="<?= base_url('kelola-user') ?>" class="nav-item <?= $isKelolaUser ? 'active' : '' ?>">
                    <i class="bi bi-people"></i>
                    <span>Kelola User</span>
                </a>
            <?php endif; ?>
        </nav>

        <div class="sidebar-footer">
            <a href="<?= base_url('logout') ?>" class="btn-logout">
                <i class="bi bi-box-arrow-left"></i>
                <span>Log out</span>
            </a>
        </div>
    </aside>

    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <div class="main-content">
        <div class="topbar">
            <div class="topbar-left">
                <button class="btn-sidebar-toggle d-lg-none" type="button" id="sidebarToggle" aria-label="Buka menu">
                    <i class="bi bi-list"></i>
                </button>
                <div class="date-info">
                    <i class="bi bi-calendar"></i>
                    <span><?= date('d F Y') ?></span>
                </div>
            </div>
            <div class="topbar-right">
                <div class="user-info">
                    <i class="bi bi-person-circle"></i>
                    <span><?= session()->get('username') ?></span>
                    <span class="user-role"><?= ucfirst($role) ?></span>
                </div>
            </div>
        </div>

        <main class="content-area">
            <?= $this->renderSection('content') ?>
        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url('assets/js/scripts.js') ?>"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const body = document.body;
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebarOverlay = document.getElementById('sidebarOverlay');
    const closeSidebar = function () {
        body.classList.remove('sidebar-open');
    };

    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', function () {
            body.classList.toggle('sidebar-open');
        });
    }

    if (sidebarOverlay) {
        sidebarOverlay.addEventListener('click', closeSidebar);
    }

    document.querySelectorAll('.sidebar a').forEach(function (link) {
        link.addEventListener('click', function () {
            if (window.innerWidth <= 992) {
                closeSidebar();
            }
        });
    });

    window.addEventListener('resize', function () {
        if (window.innerWidth > 992) {
            closeSidebar();
        }
    });
});
</script>
</body>
</html>
