<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Masuk - Hardware_JosJis</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href={{ asset('style.css') }}>
    <style>
        .order-tabs {
            display: flex;
            gap: 20px;
            border-bottom: 1px solid #374151;
            margin-bottom: 20px;
        }

        .order-tab-item {
            padding: 10px 20px;
            color: #9ca3af;
            text-decoration: none;
            font-size: 14px;
            border-bottom: 2px solid transparent;
            transition: 0.3s;
        }

        .order-tab-item:hover {
            color: white;
        }

        .order-tab-item.active {
            color: #6366f1;
            border-bottom-color: #6366f1;
            font-weight: 600;
        }

        /* Modal Style */
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            z-index: 999;
            justify-content: center;
            align-items: center;
        }

        .modal-box {
            background: #1f2937;
            padding: 25px;
            border-radius: 15px;
            width: 400px;
            border: 1px solid #374151;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.5);
        }
    </style>
</head>

<body class="dashboard-body">

    <nav class="navbar">
        <div class="nav-container">
            <div class="logo">
                <img src="{{ asset('ImageSource/josjis_logo.png') }}" alt="Logo josjis">
                <span class="logo-text">Hardware_JosJis</span>
            </div>
            <ul class="nav-links">
                <li><a href="{{ route('member.dashboard') }}" class="active">Home</a></li>
                <li><a href="{{ route('member.transactionHistory') }}">Riwayat Transaksi</a></li>
                <li><a href="{{ route('member.topup') }}">Topup Saldo</a></li>
                <li><a href="{{ route('member.store') }}">Toko Saya</a></li>
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

 @if(session('success'))
                <div class="alert"
                    style="background: rgba(74, 222, 128, 0.1); border: 1px solid #4ade80; color: #4ade80; padding: 15px; border-radius: 10px; margin-bottom: 20px;">
                    <i class="fa-solid fa-check-circle"></i> {{ session('success') }}
                </div>
            @endif
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


        <div class="main-content">

            @if(session('success'))
                <div class="alert alert-success">
                    <div style="display: flex; align-items: center;">
                        <i class="fa-solid fa-circle-check alert-icon"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                    <button type="button" class="btn-close-alert"
                        onclick="this.parentElement.style.display='none';">&times;</button>
                </div>
            @endif

            <div class="card">
                <h3 style="color: white; margin-bottom: 20px;">Manajemen Pesanan</h3>

                <div style="overflow-x: auto;">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Info Produk</th>
                                <th>Pembeli & Alamat</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentOrders as $order)
                                <tr>
                                    <td width="40%">
                                        <div style="font-size: 11px; color: #6366f1; margin-bottom: 5px; font-weight:bold;">
                                            {{ $order->code }}
                                        </div>
                                        @foreach($order->transactionDetails as $detail)
                                            <div style="display: flex; gap: 10px; margin-bottom: 10px;">
                                                <img src="{{ asset('ImageSource/' . $detail->product->slug) }}.png"
                                                    style="width: 45px; height: 45px; object-fit: cover; object-fit: contain; border-radius: 5px; background: #374151;">
                                                <div>
                                                    <div style="color: white; font-size: 13px; font-weight: 500;">
                                                        {{ $detail->product->name }}</div>
                                                    <div style="color: #9ca3af; font-size: 11px;">{{ $detail->qty }} x Rp
                                                        {{ number_format($detail->product->price, 0, ',', '.') }}.000</div>
                                                </div>
                                            </div>
                                        @endforeach
                                        <div style="font-size: 12px; color: #d1d5db; font-weight: 600; margin-top: 5px;">
                                            Total: Rp {{ number_format($order->grand_total-2, 0, ',', '.') }}.000
                                        </div>
                                    </td>

                                    <td width="30%">
                                        <div style="color: white; font-weight: 600; font-size: 13px;">{{ $detail->auth }}
                                        </div>
                                        <div style="font-size: 11px; color: #9ca3af; margin-top: 5px; line-height: 1.4;">
                                            {{ $order->address }} <br>
                                            {{ $order->city }}, {{ $order->postal_code }}
                                        </div>
                                        @if($order->shipping == 'pesanan-diterima')
                                            <div style="margin-top: 5px; font-size: 10px; color: #6366f1;">
                                                Resi: {{ $order->tracking_number }}
                                            </div>
                                        @endif
                                    </td>

                                    <td width="15%">
                                        @if($order->shipping == 'pesanan-diproses')
                                            <span class="badge bg-pending" style="font-size: 11px;">Proses</span>
                                        @elseif($order->shipping == 'pesanan-diterima')
                                            <span class="badge bg-success" style="font-size: 11px;">Selesai</span>
                                        @endif
                                    </td>

                                    <td width="15%">
                                        @if($order->shipping == 'pesanan-diproses')
                                            <button onclick="openModal('{{ $order->id }}')" class="btn-sm"
                                                style="background: #6366f1; width: 100%; margin-bottom: 5px; padding: 8px 0;">
                                                <i class="fa-solid fa-paper-plane"></i> Proses
                                            </button>
                                        @else
                                            <button class="btn-sm"
                                                style="background: #111827; border: 1px solid #374151; color: #4ade80; width: 100%; cursor: default;">
                                                <i class="fa-solid fa-check"></i> Tuntas
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" style="text-align: center; padding: 40px;">
                                        <i class="fa-solid fa-folder-open"
                                            style="font-size: 40px; color: #374151; margin-bottom: 10px;"></i>
                                        <p style="color: #9ca3af;">Tidak ada data pesanan di tab ini.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div style="margin-top: 20px;">
                    {{ $recentOrders->links() }}
                </div>
            </div>
        </div>

        <div id="processModal" class="modal-overlay">
            <div class="modal-box">
                <h3 style="color: white; margin-bottom: 15px;">Proses Pesanan</h3>
                <p style="color: #9ca3af; font-size: 13px; margin-bottom: 20px;">
                    Masukkan info pengiriman. Pesanan akan ditandai sebagai <strong>Diterima/Selesai</strong>.
                </p>

                <form id="processForm" method="POST" action="route{{ 'member.mystore-o.process' }}">
                    @csrf
            @method('PUT')
                    <div class="form-group">
                        <label class="form-label">Kurir / Metode Kirim</label>
                        <input name="shipping_type" class="form-input"
                            placeholder="Contoh: JNE / Kurir Toko" required>
                    </div>

                    <div style="display: flex; gap: 10px; margin-top: 25px;">
                        <button type="button" onclick="closeModal()" class="btn-outline"
                            style="flex: 1; border-color: #374151; color: #d1d5db;">Batal</button>
                        <button type="submit" class="submit-btn"
                            style="flex: 1; background: #6366f1; padding: 10px; font-size: 14px;">Selesaikan
                            Pesanan</button>
                    </div>
                </form>
            </div>
        </div>

        <script>
            function openModal(orderId) {
                const form = document.getElementById('processForm');
                // Ganti route action secara dinamis
                form.action = "{{ route('member.mystore-o.process', ':id') }}".replace(':id', orderId);
                document.getElementById('processModal').style.display = 'flex';
            }

            function closeModal() {
                document.getElementById('processModal').style.display = 'none';
            }

            window.onclick = function (event) {
                if (event.target == document.getElementById('processModal')) {
                    closeModal();
                }
            }
        </script>

</body>

</html>