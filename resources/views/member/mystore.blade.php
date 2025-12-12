<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $store->name }} - Seller Center</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>

<body class="dashboard-body">

    <nav class="navbar">
        <div class="nav-container">
            <div class="logo">
                <img src="{{ asset('ImageSource/josjis_logo.png') }}" alt="Logo josjis">
                <span class="logo-text">Hardware_JosJis</span>
            </div>
            <ul class="nav-links">
                <li><a href="{{ route('member.dashboard') }}">Home</a></li>
                <li><a href="{{ route('member.transactionHistory') }}">Riwayat Transaksi</a></li>
                <li><a href="{{ route('member.topup') }}">Topup Saldo</a></li>
                <li><a href="{{ route('member.store') }}"class="active">Toko Saya</a></li>
            </ul>
            <div class="nav-actions">

                <div class="search-box">
                    <form action="{{ route('member.dashboard') }}" method="GET">
                        <i class="fa-solid fa-search"></i><input type="text" name="search" placeholder="Cari produk..."
                            style="width: 200px;" value="">
                    </form>
                </div>

                <div class="info-item" style="border:none; margin:0; padding:0; text-align:right;">
                    <small style="color:#9ca3af;">halo, </small>
                    <span style="color:#fff; font-weight:600;">{{Auth::user()->name}}</span>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="#" onclick="event.preventDefault(); this.closest('form').submit();" class="btn-nav-logout">
                        {{ __('Log out') }}
                    </a>
                </form>

            </div>
        </div>
    </nav>

    <div class="seller-container">
        <aside class="sidebar-left">
            <div class="card card-sidebar">
                <div class="store-info-content"
                    style="flex-direction: column; text-align: center; margin-bottom: 20px;">
                    <div class="store-logo-lg" style="width: 120px; height: 120px; font-size: 24px; margin: 0 auto;">
                        <img src="{{ asset('logo/' . $store->logo) }}" alt="Logo"
                            style="width:100%; height:100%; border-radius:50%; object-fit:cover;">
                    </div>
                    <h3 style="color:white; margin-bottom:10px;">{{ $store->name }}</h3>
                </div>
                <div class="card-header-sm">
                    <h3>Menu Toko</h3>
                </div>
                <ul class="category-list">
                    <li>
                        <a href="{{ route('member.mystore') }}" class="active"
                            style="background: #374151; color: white;">
                            <i class="fa-solid fa-chart-line" style="width: 20px;"></i> Dashboard
                        </a>
                    </li>
                    <li
                        style="margin-top: 15px; margin-bottom: 5px; font-size: 11px; color: #6b7280; padding-left: 15px;">
                        PRODUK</li>
                    <li><a href="{{ route('member.mystore-m') }}"><i class="fa-solid fa-box-open"
                                style="width: 20px;"></i> Manajemen Produk</a></li>

                    <li
                        style="margin-top: 15px; margin-bottom: 5px; font-size: 11px; color: #6b7280; padding-left: 15px;">
                        PESANAN</li>
                    <li>
                        <a href="{{route('member.mystore-o')}}">
                            <i class="fa-solid fa-clipboard-list" style="width: 20px;"></i> Pesanan Masuk
                            @if($pendingOrders > 0)
                                <span class="badge bg-pending"
                                    style="float: right; font-size: 10px;">{{ $pendingOrders }}</span>
                            @endif
                        </a>
                    </li>

                    <li
                        style="margin-top: 15px; margin-bottom: 5px; font-size: 11px; color: #6b7280; padding-left: 15px;">
                        KEUANGAN</li>
                    <li><a href="{{route('member.mystore-w')}}"><i class="fa-solid fa-wallet" style="width: 20px;"></i>
                            Saldo Toko</a></li>
                    </li>
                </ul>
            </div>
        </aside>

        <main class="content-center">
            <div class="section-header page-title">
                <h3>Ringkasan Penjualan</h3>
            </div>
            <div class="stats-grid">
                {{-- KARTU SALDO --}}
                <div class="stat-card">
                    <div class="stat-info">
                        <h4>Saldo Toko Aktif</h4>
                        <div class="num" style="color: #4ade80;">Rp
                            {{ number_format($currentBalance->balance, 0, ',', '.') }}.000</div>
                        <a href="{{ route('member.mystore-w') }}"
                            style="font-size: 12px; color: #6366f1; text-decoration: none;">Tarik Dana &rarr;</a>
                    </div>
                    <div class="stat-icon"><i class="fa-solid fa-sack-dollar"></i></div>
                </div>

                {{-- KARTU PESANAN PENDING --}}
                <div class="stat-card">
                    <div class="stat-info">
                        <h4>Pesanan Perlu Dikirim</h4>
                        <div class="num" style="color: #facc15;">{{ $pendingOrders }} Pesanan</div>
                        <span style="font-size: 12px; color: #9ca3af;">Segera proses</span>
                    </div>
                    <div class="stat-icon"><i class="fa-solid fa-truck-fast"></i></div>
                </div>

                {{-- KARTU TOTAL PRODUK --}}
                <div class="stat-card">
                    <div class="stat-info">
                        <h4>Total Produk Aktif</h4>
                        <div class="num">{{ $totalProducts }} Item</div>
                        <a href="{{ route('member.mystore-m') }}"
                            style="font-size: 12px; color: #6366f1; text-decoration: none;">Tambah Produk &rarr;</a>
                    </div>
                    <div class="stat-icon"><i class="fa-solid fa-box"></i></div>
                </div>
            </div>

            <div class="card">
                <div class="card-header-sm" style="display: flex; justify-content: space-between; align-items: center;">
                    <h3>Pesanan Terbaru</h3>
                    <a href="{{ route('member.mystore-o') }}" class="btn-outline" style="font-size: 12px;">Lihat
                        Semua</a>
                </div>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Code Pesanan</th>
                            <th>Produk</th>
                            <th>Total</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentOrders as $order)
                            <tr>
                                <td>{{ $order->code }}</td>

                                <td>
                                    @php
                                        $firstDetail = $order->transactionDetails->first();
                                    @endphp

                                    {{-- Produk pertama --}}
                                    @if($firstDetail && $firstDetail->product)
                                        <div>{{ $firstDetail->product->name }}</div>
                                    @else
                                        <div>Produk tidak ditemukan</div>
                                    @endif
                                    @if($order->transactionDetails->count() > 1)
                                        <small style="color: #9ca3af;">
                                            + {{ $order->transactionDetails->count() - 1 }} lainnya
                                        </small>
                                    @endif
                                </td>
                                <td>Rp {{ number_format($order->grand_total-2, 0, ',', '.') }}.000</td>
                                <td>
                                    @if ($order->shipping=='pesanan-diproses')
                                    <span class="badge bg-pending">{{ $order->shipping }}</span>
                                    @else
                                    <span class="badge bg-success">{{ $order->shipping }}</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" style="text-align: center; color: #9ca3af; padding: 20px;">
                                    Belum ada pesanan terbaru.
                                </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </main>
    </div>
</body>

</html>