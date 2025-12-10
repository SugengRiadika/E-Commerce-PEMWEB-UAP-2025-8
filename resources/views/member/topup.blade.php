<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Isi Saldo - Hardware_JosJis</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('style.css') }}">

    <style>
        /* CSS tambahan agar layout lebih rapi */
        .topup-grid {
            display: grid;
            gap: 25px;
        }

        @media (max-width: 768px) {
            .topup-grid {
                grid-template-columns: 1fr;
            }
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
                        <i class="fa-solid fa-search"></i>
                        <input type="text" name="search" placeholder="Cari produk..." style="width: 200px;">
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


    <div class="container" style="display: block; max-width: 1000px; padding-top: 20px;">

        <main class="content-center">

            <div class="section-header page-title">
                <h3>Isi Saldo JosjisPay</h3>
            </div>

            <div class="balance-header">
                <div>
                    <div class="balance-label">Saldo Aktif Anda</div>
                    <div class="balance-amount">Rp {{ number_format(Auth::user()->balance ?? 0, 0, ',', '.') }}</div>
                </div>
                <div style="font-size: 40px; color: #374151;">
                    <i class="fa-solid fa-wallet"></i>
                </div>
            </div>

            @if(session('success'))
                <div class="alert"
                    style="background: rgba(74, 222, 128, 0.1); border: 1px solid #4ade80; color: #4ade80; padding: 15px; border-radius: 10px; margin-bottom: 20px;">
                    <i class="fa-solid fa-check-circle"></i> {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert"
                    style="background: rgba(239, 68, 68, 0.1); border: 1px solid #ef4444; color: #ef4444; padding: 15px; border-radius: 10px; margin-bottom: 20px;">
                    <ul style="margin: 0; padding-left: 20px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="topup-grid">

                <div class="card">
                    <div class="card-header-sm">
                        <h3>Pilih Nominal Topup</h3>
                    </div>

                    <form action="{{ route('member.topup.process') }}" method="POST" id="topupForm">
                        @csrf

                        <div class="nominal-grid">
                            <button type="button" class="nominal-btn" onclick="setNominal(20000)">Rp 20.000
                                <span>IDR</span></button>
                            <button type="button" class="nominal-btn" onclick="setNominal(50000)">Rp 50.000
                                <span>IDR</span></button>
                            <button type="button" class="nominal-btn" onclick="setNominal(100000)">Rp 100.000
                                <span>IDR</span></button>
                            <button type="button" class="nominal-btn" onclick="setNominal(200000)">Rp 200.000
                                <span>IDR</span></button>
                            <button type="button" class="nominal-btn" onclick="setNominal(500000)">Rp 500.000
                                <span>IDR</span></button>
                            <button type="button" class="nominal-btn" onclick="setNominal(1000000)">Rp 1.000.000
                                <span>IDR</span></button>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Atau Masukkan Nominal Lain (Min. Rp 10.000)</label>
                            <input type="number" name="amount" id="amountInput" class="form-input"
                                placeholder="Contoh: 75000" min="10000" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Metode Pembayaran</label>
                            <select name="payment_method" class="form-select" required>
                                <option value="" disabled selected>-- Pilih Bank / E-Wallet --</option>
                                <option value="bca">Transfer Virtual Account BCA</option>
                                <option value="mandiri">Transfer Virtual Account Mandiri</option>
                                <option value="bri">Transfer Virtual Account BRI</option>
                                <option value="bni">Transfer Virtual Account BNI</option>
                            </select>
                        </div>

                        <button type="submit" class="submit-btn"
                            style="background: #6366f1; color: white; margin-top: 10px;">
                            <i class="fa-solid fa-paper-plane"></i> Buat Pesanan Topup
                        </button>
                    </form>

                    <div class="va-card" style="margin-top: 30px;">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span style="font-size: 13px; color: #c7d2fe;">Menunggu Pembayaran</span>
                            <span class="badge bg-pending" style="background: #fff; color: #f59e0b;">Pending</span>
                        </div>

                        <h4 style="margin-top: 10px; color: #fff;"> JosJis Virtual Account</h4>

                        <div class="va-number">{{ preg_replace('/(.{4})/', '$1 ', $transactions->first()->id) }}
                        </div>

                        <p style="font-size: 12px; color: #c7d2fe; text-align: center;">
                            Silakan transfer nominal<strong> Rp </strong>
                        </p>
                    </div>

                    <div class="card support-card">
                        <h3><i class="fa-solid fa-circle-info"></i> Cara Topup</h3>
                        <ol
                            style="padding-left: 20px; font-size: 12px; color: #d1d5db; line-height: 1.6; margin-top: 10px;">
                            <li>Pilih nominal instan atau ketik manual.</li>
                            <li>Pilih metode pembayaran (Transfer Bank / E-Wallet).</li>
                            <li>Klik tombol "Buat Pesanan".</li>
                            <li>Salin nomor <strong>Virtual Account (VA)</strong> yang muncul.</li>
                            <li>Lakukan transfer melalui ATM/M-Banking sesuai nominal.</li>
                            <li>Saldo akan masuk otomatis dalam 5-10 menit setelah bayar.</li>
                        </ol>
                    </div>
                </div>



            </div>

        </main>

    </div>

    <script>
        // Update realtime dari input nominal
        document.getElementById('amountInput').addEventListener('input', function () {
            let value = this.value;

            // Format angka jadi format Indonesia (10.000)
            let formatted = value ? parseInt(value).toLocaleString('id-ID') : "0";

            // Update paragraf nominal
            document.querySelector('p strong').innerText = " Rp " + formatted + " ";
        });

        // Fungsi setNominal tetap bisa dipakai
        function setNominal(amount) {
            document.getElementById('amountInput').value = amount;

            // Format Indonesia
            let formatted = parseInt(amount).toLocaleString('id-ID');

            // Update paragraf nominal
            document.querySelector('p strong').innerText = " Rp " + formatted + " ";

            // Visual button (jika ada tombol nominal)
            let buttons = document.querySelectorAll('.nominal-btn');
            buttons.forEach(btn => {
                btn.classList.remove('selected');
                if (btn.innerText.includes(formatted)) {
                    btn.classList.add('selected');
                }
            });
        }
    </script>
</body>

</html>