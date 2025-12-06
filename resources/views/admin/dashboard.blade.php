<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gasol Admin - Panel Kontrol</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>

<body class="dashboard-body">

    <nav class="navbar" style="border-bottom: 1px solid #ef4444;">
        <div class="nav-container" style="max-width: 1400px;">
            <div class="logo">
                <div class="logo-icon" style="color: #ef4444;"><i class="fa-solid fa-shield-halved"></i></div>
                <span class="logo-text">Gasol Admin Panel</span>
            </div>
            <ul class="nav-links">
                <li><a href="#" class="active">Dashboard</a></li>
                <li><a href="#">Laporan</a></li>
                <li><a href="#">Log Aktivitas</a></li>
            </ul>
            <div class="nav-actions">
                <div class="info-item" style="border:none; margin:0; padding:0; text-align:right;">
                    <small style="color:#9ca3af;">Login sebagai,</small>
                    <span style="color:#fff; font-weight:600;">{{Auth::user()->name}} </span>
                </div>
                <div class="trx-img" style="width: 35px; height: 35px; font-size: 1rem; color: #ef4444;">
                    <i class="fa-solid fa-user-shield"></i>
                </div>
            </div>
        </div>
    </nav>

    <div class="admin-container">
        <aside class="sidebar-left">
            <div class="card card-sidebar">
                <div class="card-header-sm">
                    <h3>Menu Utama</h3>
                </div>
                <ul class="category-list">
                    <li><a href="#" class="active" style="background: #374151; color: white;"><i
                                class="fa-solid fa-gauge-high" style="width: 25px;"></i> Dashboard</a></li>
                    <li
                        style="margin-top: 15px; font-size: 11px; color: #ef4444; font-weight: bold; padding-left: 15px;">
                        VERIFIKASI</li>
                    <li><a href="/admin/verification"><i class="fa-solid fa-check-double" style="width: 25px;"></i>
                            Verifikasi Toko <span class="badge bg-pending" style="float: right; font-size: 10px;">2
                                Baru</span></a></li>
                    <li
                        style="margin-top: 15px; font-size: 11px; color: #ef4444; font-weight: bold; padding-left: 15px;">
                        MANAJEMEN DATA</li>
                    <li><a href="/admin/users"><i class="fa-solid fa-users" style="width: 25px;"></i> Data Pengguna</a>
                    </li>
                    <li><a href="/admin/stores"><i class="fa-solid fa-store" style="width: 25px;"></i> Data Toko</a>
                    </li>
                    <li style="margin-top: 15px; font-size: 11px; color: #6b7280; padding-left: 15px;">SYSTEM</li>
                    <li><a href="#"><i class="fa-solid fa-gear" style="width: 25px;"></i> Pengaturan</a></li>
                    <form method="POST" action="{{ route('logout') }}">
                    @csrf
                        <li><a href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();"
                                                 style="color: #f87171;"><i class="fa-solid fa-power-off" style="width: 25px;"></i>
                                {{ __('Log out') }}</a></li>
                    </form>
                </ul>
            </div>
        </aside>

        <main class="content-center">
            <div class="section-header page-title">
                <h3>Dashboard Overview</h3>
            </div>
            <div class="stats-grid">
                <div class="stat-card">
                    <div>
                        <h4>Menunggu Verifikasi</h4>
                        <div class="num" style="color: #facc15;">2</div>
                    </div><i class="fa-solid fa-hourglass-half" style="font-size: 30px; color: #4b5563;"></i>
                </div>
                <div class="stat-card">
                    <div>
                        <h4>Total User</h4>
                        <div class="num">1,240</div>
                    </div><i class="fa-solid fa-users" style="font-size: 30px; color: #4b5563;"></i>
                </div>
                <div class="stat-card">
                    <div>
                        <h4>Toko Aktif</h4>
                        <div class="num" style="color: #4ade80;">58</div>
                    </div><i class="fa-solid fa-shop" style="font-size: 30px; color: #4b5563;"></i>
                </div>
                <div class="stat-card">
                    <div>
                        <h4>Total Transaksi</h4>
                        <div class="num">8,900</div>
                    </div><i class="fa-solid fa-chart-pie" style="font-size: 30px; color: #4b5563;"></i>
                </div>
            </div>

            <div class="card">
                <div class="card-header-sm" style="border-left: 4px solid #facc15; padding-left: 15px;">
                    <h3>Permintaan Verifikasi Toko Terbaru</h3>
                    <p style="font-size: 12px; color: #9ca3af; margin-top: 5px;">Daftar toko yang statusnya
                        <code>is_verified: false</code>.</p>
                </div>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Nama Toko</th>
                            <th>Pemilik (User)</th>
                            <th>Dokumen</th>
                            <th>Tanggal Daftar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div style="font-weight: 600; color: #fff;">Gasol Gaming Sby</div><small
                                    style="color: #9ca3af;">ID: STR-099</small>
                            </td>
                            <td>Budi Santoso</td>
                            <td><a href="#" style="color: #6366f1; text-decoration: underline;">KTP & SIUP.pdf</a></td>
                            <td>05 Des 2025</td>
                            <td><button class="btn-action btn-verify" title="Verifikasi / Approve"><i
                                        class="fa-solid fa-check"></i> Terima</button><button
                                    class="btn-action btn-reject" title="Tolak Pendaftaran"><i
                                        class="fa-solid fa-xmark"></i> Tolak</button></td>
                        </tr>
                        <tr>
                            <td>
                                <div style="font-weight: 600; color: #fff;">Tech Maju Jaya</div><small
                                    style="color: #9ca3af;">ID: STR-102</small>
                            </td>
                            <td>Siti Aminah</td>
                            <td><a href="#" style="color: #6366f1; text-decoration: underline;">Legal_Doc.zip</a></td>
                            <td>04 Des 2025</td>
                            <td><button class="btn-action btn-verify"><i class="fa-solid fa-check"></i>
                                    Terima</button><button class="btn-action btn-reject"><i
                                        class="fa-solid fa-xmark"></i> Tolak</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="card" style="margin-top: 30px;">
                <div class="card-header-sm" style="display: flex; justify-content: space-between; align-items: center;">
                    <h3>Daftar Semua Pengguna</h3>
                    <div class="search-box"><i class="fa-solid fa-search"></i><input type="text"
                            placeholder="Cari nama / email..." style="width: 200px;"></div>
                </div>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>User Info</th>
                            <th>Role</th>
                            <th>Status Akun</th>
                            <th>Toko Terkait</th>
                            <th>Kelola</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="user-cell">
                                    <div class="avatar-sm">GS</div>
                                    <div>
                                        <div style="font-weight: 600; color: #fff;">Gasol Official</div><small
                                            style="color: #9ca3af;">admin@gasol.id</small>
                                    </div>
                                </div>
                            </td>
                            <td><span class="badge bg-success" style="color: #fff; background: #059669;">Seller</span>
                            </td>
                            <td><span style="color: #4ade80;">● Aktif</span></td>
                            <td>Gasol Store Pusat</td>
                            <td><button class="btn-action btn-detail"><i class="fa-solid fa-pen-to-square"></i>
                                    Edit</button></td>
                        </tr>
                        <tr>
                            <td>
                                <div class="user-cell">
                                    <div class="avatar-sm">AD</div>
                                    <div>
                                        <div style="font-weight: 600; color: #fff;">Andi Pratama</div><small
                                            style="color: #9ca3af;">andi@gmail.com</small>
                                    </div>
                                </div>
                            </td>
                            <td><span class="badge" style="background: #374151; color: #d1d5db;">Buyer</span></td>
                            <td><span style="color: #4ade80;">● Aktif</span></td>
                            <td>-</td>
                            <td><button class="btn-action btn-detail"><i class="fa-solid fa-pen-to-square"></i>
                                    Edit</button><button class="btn-action btn-reject"><i class="fa-solid fa-ban"></i>
                                    Ban</button></td>
                        </tr>
                        <tr>
                            <td>
                                <div class="user-cell">
                                    <div class="avatar-sm">XX</div>
                                    <div>
                                        <div style="font-weight: 600; color: #9ca3af; text-decoration: line-through;">
                                            Penipu 123</div><small style="color: #ef4444;">scammer@fake.com</small>
                                    </div>
                                </div>
                            </td>
                            <td><span class="badge" style="background: #374151; color: #d1d5db;">Buyer</span></td>
                            <td><span style="color: #ef4444;">● Banned</span></td>
                            <td>-</td>
                            <td><button class="btn-action btn-verify" style="background: #4b5563;">Unban</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</body>

</html>