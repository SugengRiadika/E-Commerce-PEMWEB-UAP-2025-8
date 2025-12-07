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
                    <li><a href="/admin/dashboard"><i class="fa-solid fa-check-double" style="width: 25px;"></i>
                            Verifikasi Toko <span class="badge bg-pending" style="float: right; font-size: 10px;">{{ $totalPendingStores }}
                                Toko</span></a></li>
                    <li
                        style="margin-top: 15px; font-size: 11px; color: #ef4444; font-weight: bold; padding-left: 15px;">
                        MANAJEMEN DATA</li>
                    <li><a href="/admin/users"><i class="fa-solid fa-users" style="width: 25px;"></i> Data Pengguna</a>
                    </li>
                    <li><a href="/admin/stores"><i class="fa-solid fa-store" style="width: 25px;"></i> Data Toko</a>
                    </li>
                    <li style="margin-top: 15px; font-size: 11px; color: #6b7280; padding-left: 15px;">SYSTEM</li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <li><a href="route('logout')" onclick="event.preventDefault();
                                                this.closest('form').submit();" style="color: #f87171;"><i
                                    class="fa-solid fa-power-off" style="width: 25px;"></i>
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
                        <div class="num" style="color: #facc15;">{{ $totalPendingStores }}</div>
                    </div><i class="fa-solid fa-hourglass-half" style="font-size: 30px; color: #4b5563;"></i>
                </div>
                <div class="stat-card">
                    <div>
                        <h4>Total User</h4>
                        <div class="num">{{ $totalUsers }}</div>
                    </div><i class="fa-solid fa-users" style="font-size: 30px; color: #4b5563;"></i>
                </div>
                <div class="stat-card">
                    <div>
                        <h4>Toko Aktif</h4>
                        <div class="num" style="color: #4ade80;">{{ $totalActiveStores }}</div>
                    </div><i class="fa-solid fa-shop" style="font-size: 30px; color: #4b5563;"></i>
                </div>
                <div class="stat-card">
                    <div>
                        <h4>Total Transaksi</h4>
                        <div class="num" style="color: tomato">{{ $totalTransactions }}</div>
                    </div><i class="fa-solid fa-chart-pie" style="font-size: 30px; color: #63554bff;"></i>
                </div>
            </div>

            <div class="card">
                <div class="card-header-sm" style="border-left: 4px solid #facc15; padding-left: 15px;">
                    <h3>Permintaan Verifikasi Toko Terbaru</h3>
                    <p style="font-size: 12px; color: #9ca3af; margin-top: 5px;">Daftar toko yang statusnya
                        <code>is_verified: false</code>.
                    </p>
                </div>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Nama Toko</th>
                            <th>Pemilik (User)</th>
                            <th>No Handphone</th>
                            <th>Kota</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pendingStoresData as $store)
                            <tr>
                                <td>
                                    <div style="font-weight: 600; color: #fff;">{{ $store->name }}</div><small
                                        style="color: #9ca3af;">ID:
                                        STR-{{ str_pad($store->id, 3, '0', STR_PAD_LEFT) }}</small>
                                </td>
                                <td>{{ $store->user->name }}</td>
                                <td>{{ $store->phone }}</td>
                                <td>{{ $store->city }}</td>
                                <!-- Verifikasi -->
                                <td>
                                <form action="{{ route('admin.store.verify', $store->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button class="btn-action btn-verify" title="Verifikasi / Approve" type="submit"
                                                onclick="return confirm('Verifikasi toko ini?')"><i
                                                    class="fa-solid fa-check"></i> Terima</button>
                                    </form>
                                    <form action="{{ route('admin.store.reject', $store->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn-action btn-reject" title="Tolak Pendaftaran" type="submit"
                                            onclick="return confirm('Tolak pendaftaran toko ini?')"><i
                                            class="fa-solid fa-xmark"></i> Tolak</button>
                                        </form>
                                    </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="card" style="margin-top: 30px;">
                <div class="card-header-sm" style="display: flex; justify-content: space-between; align-items: center;">
                    <h3>Daftar Semua Pengguna</h3>
                    <div class="search-box">
                        <form action="{{ route('admin.dashboard') }}" method="GET">
                        <i class="fa-solid fa-search"></i><input type="text"
                            name="search" placeholder="Cari nama / email..." style="width: 200px;" value="{{ $search }}" ></form></div>
                </div>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>User Info</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Toko Terkait</th>
                        </tr>
                    </thead>
                    <tbody>
                            @foreach ($users as $user)
                            @php
                            $isSeller = $user->store && $user->store->is_verified;
            @endphp
                        <tr>
                            <td>
                                <div class="user-cell">
                                    <div class="avatar-sm">AD</div>
                                    <div>
                                        <div style="font-weight: 600; color: #fff;">{{ $user->name }}</div><small
                                        style="color: #9ca3af;">{{ $user->email }}</small>
                                    </div>
                                </div>
                            </td>
                            <td><span style="color: #4ade80;">{{ $user->email }}</span></td>
                            <td><span class="badge" style="background: {{ $isSeller ? 'green' : 'black' }}; color: #d1d5db;">{{ $isSeller ? 'Seller' : 'Buyer' }}</span></td>
                            <td>{{ $isSeller ? $user->store->name : '-' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</body>

</html>