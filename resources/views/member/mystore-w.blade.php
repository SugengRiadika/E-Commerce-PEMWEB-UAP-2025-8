<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saldo Toko - Hardware_JosJis</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href={{asset('style.css')}}>
    <style>
        /* CSS Khusus Kartu Saldo */
        .balance-card-main {
            background: linear-gradient(135deg, #059669, #10b981);
            padding: 30px;
            border-radius: 20px;
            color: white;
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 20px rgba(16, 185, 129, 0.2);
            margin-bottom: 30px;
        }

        .balance-card-main::after {
            content: '';
            position: absolute;
            right: -20px;
            top: -20px;
            width: 150px;
            height: 150px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }

        .balance-amount-lg {
            font-size: 36px;
            font-weight: 700;
            margin: 10px 0;
            letter-spacing: 1px;
        }

        /* Modal Styles (Sama seperti sebelumnya) */
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

            @if(session('error'))
                <div class="alert alert-success"
                    style="background: rgba(239, 68, 68, 0.1); color: #f87171; border-color: #ef4444;">
                    <div style="display: flex; align-items: center;">
                        <i class="fa-solid fa-circle-xmark alert-icon"></i>
                        <span>{{ session('error') }}</span>
                    </div>
                    <button type="button" class="btn-close-alert"
                        onclick="this.parentElement.style.display='none';">&times;</button>
                </div>
            @endif
            <div style="display: grid;grid-template-columns: repeat(2, 1fr);gap: 20px;margin-bottom: 25px;">
                <div class="balance-card-main">
                    <div style="font-size: 14px; opacity: 0.9;">Total Saldo Aktif</div>
                    <div class="balance-amount-lg">Rp {{ number_format($balance->balance, 0, ',', '.') }}.000</div>
                    <div style="display: flex; justify-content: space-between; align-items: end;">
                        <p style="font-size: 12px; opacity: 0.8; margin-bottom: 0;">Dana dapat ditarik ke rekening bank
                            terdaftar.</p>
                        <button onclick="openModal()"
                            style="background: white; color: #059669; border: none; padding: 10px 20px; border-radius: 50px; font-weight: 600; cursor: pointer; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                            <i class="fa-solid fa-money-bill-transfer"></i> Tarik Saldo
                        </button>
                    </div>
                </div>
                @if (!$withdrawal)
                
                <div class="balance-card-main" style="background:#8a8235ff;">
                    <div style="font-size: 14px; opacity: 0.9;">Withdrawal (Nama Bank)</div>
                    <div class="balance-amount-lg">Rp {{ number_format($balance->balance, 0, ',', '.') }}.000</div>
                    <div style="display: flex; justify-content: space-between; align-items: end;">
                        <p style="font-size: 12px; opacity: 0.8; margin-bottom: 0;">Dana Yang ditarik ke bank.</p>
                    </div>
                </div>
                @elseif($withdrawal->id && $withdrawal->id)
                <div class="balance-card-main" style="background:#8a8235ff;">
                    <div style="font-size: 14px; opacity: 0.9;">Withdrawal {{$withdrawal->bank_name}}</div>
                    <div class="balance-amount-lg">Rp {{ number_format($withdrawal->amount, 0, ',', '.') }}.000</div>
                    <div style="display: flex; justify-content: space-between; align-items: end;">
                        <p style="font-size: 12px; opacity: 0.8; margin-bottom: 0;">Dana Yang ditarik ke bank.</p>
                    </div>
                </div>
                @endif
            </div>
            <div class="card">
                <div style="border-bottom: 1px solid #374151; padding-bottom: 15px; margin-bottom: 15px;">
                    <h3 style="color: white; font-size: 16px;">Riwayat Pemasukan (Penjualan)</h3>
                </div>

                <div style="overflow-x: auto;">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>No. Pesanan</th>
                                <th>Status</th>
                                <th>Nominal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($incomeHistory as $history)
                                <tr>
                                    <td style="color: #9ca3af; font-size: 12px;">
                                        {{ $history->updated_at->format('d M Y') }} <br>
                                        {{ $history->updated_at->format('H:i') }}
                                    </td>
                                    <td>
                                        <span style="color: #6366f1; font-weight: 500;">{{ $history->code }}</span>
                                    </td>
                                    <td>
                                        @if ($history->shipping == 'pesanan-diproses')
                                            <span class="badge bg-pending">{{ $history->shipping }}</span>
                                        @else
                                            <span class="badge bg-success">{{ $history->shipping }}</span>
                                        @endif
                                    </td>
                                    <td style="text-align: right;">
                                        <span style="color: #4ade80; font-weight: 600;">+ Rp
                                            {{ number_format($history->grand_total, 0, ',', '.') }}.000</span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" style="text-align: center; padding: 40px;">
                                        <i class="fa-solid fa-sack-dollar"
                                            style="font-size: 40px; color: #374151; margin-bottom: 10px;"></i>
                                        <p style="color: #9ca3af;">Belum ada riwayat pemasukan dana.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div style="margin-top: 20px;">
                    {{ $incomeHistory->links() }}
                </div>
            </div>
        </div>
    </div>

    <div id="withdrawModal" class="modal-overlay">
        <div class="modal-box">
            <h3 style="color: white; margin-bottom: 15px;">Tarik Dana</h3>
            <p style="color: #9ca3af; font-size: 13px; margin-bottom: 20px;">
                Dana akan ditransfer maksimal 1x24 jam hari kerja.
            </p>

            <form action="{{ route('member.balance.withdraw') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label class="form-label">Nominal Penarikan (Rp)</label>
                    <input type="number" name="amount" class="form-input" placeholder="Min. 10.000" min="10000"
                        required>
                    <small style="color: #6b7280; font-size: 10px;">Saldo saat ini: Rp
                        {{ number_format($balance->balance, 0, ',', '.') }}.000</small>
                </div>

                <div class="form-group">
                    <label class="form-label">Bank Tujuan</label>
                    <select name="bank_name" class="form-select" required>
                        <option value="BCA">BCA</option>
                        <option value="BRI">BRI</option>
                        <option value="BNI">BNI</option>
                        <option value="MANDIRI">Mandiri</option>
                        <option value="JAGO">Bank Jago</option>
                        <option value="DANA">DANA (E-Wallet)</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Nomor Rekening</label>
                    <input type="number" name="account_number" class="form-input" placeholder="Masukkan nomor rekening"
                        required>
                </div>

                <div style="display: flex; gap: 10px; margin-top: 25px;">
                    <button type="button" onclick="closeModal()" class="btn-outline"
                        style="flex: 1; border-color: #374151; color: #d1d5db;">Batal</button>
                    <button type="submit" class="submit-btn"
                        style="flex: 1; background: #059669; padding: 10px; font-size: 14px;">Ajukan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openModal() {
            document.getElementById('withdrawModal').style.display = 'flex';
        }

        function closeModal() {
            document.getElementById('withdrawModal').style.display = 'none';
        }

        window.onclick = function (event) {
            if (event.target == document.getElementById('withdrawModal')) {
                closeModal();
            }
        }
    </script>

</body>

</html>