<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Hardware_JosJis</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('style.css') }}">

    <style>
        /* === CUSTOM CSS KHUSUS CHECKOUT === */

        /* Update class ini */
        .checkout-grid {
            display: grid;
            grid-template-columns: 1fr 380px;
            gap: 30px;
            margin-bottom: 50px;
            /* PENTING: Tambahkan ini agar kolom kanan tidak dipaksa memanjang ke bawah */
            align-items: start;
        }

        /* Tambahkan class ini untuk kolom kanan */
        .right-col {
            position: sticky;
            top: 100px;
            /* Jarak berhenti dari atas layar saat discroll */
            z-index: 10;
        }

        /* Item Keranjang */
        .cart-item {
            display: flex;
            gap: 20px;
            padding: 20px 0;
            border-bottom: 1px dashed #374151;
            align-items: center;
        }

        .cart-item:last-child {
            border-bottom: none;
        }

        .cart-img {
            width: 80px;
            height: 80px;
            background: #111827;
            border-radius: 10px;
            object-fit: contain;
            border: 1px solid #374151;
        }

        .item-details h4 {
            color: white;
            margin-bottom: 5px;
            font-size: 16px;
        }

        .item-details p {
            color: #9ca3af;
            font-size: 13px;
            margin-bottom: 5px;
        }

        .item-price {
            color: #6366f1;
            font-weight: 600;
        }

        /* Payment Methods */
        .payment-method {
            display: flex;
            gap: 15px;
            margin-top: 15px;
        }

        .pay-option {
            flex: 1;
            background: #111827;
            border: 1px solid #374151;
            border-radius: 10px;
            padding: 15px;
            text-align: center;
            cursor: pointer;
            transition: 0.3s;
        }

        .pay-option:hover,
        .pay-option.active {
            border-color: #6366f1;
            background: rgba(99, 102, 241, 0.1);
        }

        .pay-option input {
            display: none;
        }

        /* Hide radio button asli */

        /* Summary Row */
        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            color: #d1d5db;
            font-size: 14px;
        }

        .summary-total {
            border-top: 1px solid #374151;
            padding-top: 15px;
            margin-top: 15px;
            font-size: 18px;
            font-weight: 700;
            color: white;
        }

        /* Responsif */
        @media (max-width: 992px) {
            .checkout-grid {
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

    <div class="container" style="display: block; max-width: 1200px; padding-top: 20px;">

        <div class="section-header page-title">
            <h3>Checkout Pesanan</h3>
        </div>

        <form action="{{ route('member.checkout.proses') }}" method="POST">
            @csrf

            <div class="checkout-grid">

                <div class="left-col">

                    <div class="card" style="margin-bottom: 30px;">
                        <div class="card-header-sm">
                            <h3><i class="fa-solid fa-location-dot" style="color: #6366f1; margin-right: 10px;"></i>
                                Alamat Pengiriman</h3>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Nama Penerima</label>
                            <input type="text" name="postal_code" placeholder="65144" class="form-input" value="{{ Auth::user()->name }}" disabled
                                required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Kode Post</label>
                            <input type="text" name="postal_code" placeholder="65144" class="form-input" value=""
                                required>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Kota</label>
                            <input type="text" name="city" class="form-input" value=""
                                placeholder="08..." required>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Alamat Lengkap</label>
                            <textarea name="address" class="form-input" rows="3"
                                placeholder="Jalan, Nomor Rumah, Kelurahan, Kecamatan..."
                                required></textarea>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header-sm">
                            <h3><i class="fa-solid fa-box-open" style="color: #6366f1; margin-right: 10px;"></i> Item
                                Pesanan</h3>
                        </div>

                        <div class="cart-item">
                            <img src="{{ asset('ImageSource/'.$product->slug.'.png') }}" alt="Product Image"
                                class="cart-img">
                            <div class="item-details" style="flex: 1;">
                                <h4>{{$product->name}}</h4>
                                <p>Kuantitas: 1</p>
                                <span class="item-price">Rp {{ number_format($product->price, 0, ',', '.') }}.000</span>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="right-col">

                    <div class="card" style="position: sticky; top: 100px;">
                        <div class="card-header-sm">
                            <h3>Ringkasan Belanja</h3>
                        </div>

                        <div class="summary-row">
                            <span>Total Harga ({{$inputQuantity}} Barang)</span>
                            <span>Rp {{ number_format($product->price*$inputQuantity, 0, ',', '.') }}.000</span>
                        </div>

                        <div class="summary-row">
                            <span>Biaya Layanan</span>
                            <span>Rp 2.000</span>
                        </div>

                        <div class="summary-row">
                            <span>Ongkos Kirim</span>
                            <span style="color: #4ade80;">Gratis</span>
                        </div>

                        <div class="summary-row summary-total">
                            <span>Total Tagihan</span>
                            <span style="color: #6366f1;">Rp {{ number_format(($product->price*$inputQuantity)+(2), 0, ',', '.') }}.000</span>
                        </div>

                        <hr style="border: 0; border-top: 1px dashed #374151; margin: 20px 0;">
                        <div class="form-group">
                            @if (($product->price*$inputQuantity)+(2) > 2002)
                            <label class="form-label">Metode Pembayaran</label>
                            <div class="payment-method">
                                <label class="pay-option active" onclick="selectPayment(this)">
                                    <i class="fa-solid fa-building-columns"
                                    style="font-size: 20px; color: white; display: block; margin-bottom: 5px;"></i>
                                    <span style="font-size: 12px; color: #d1d5db;">Virtual Account</span><br>
                                    <span style="font-size: 12px; color: #f87171;">Saldo: Rp 124151</span>
                                    <p style="font-size: 12px; color: #f87171; text-align: center; margin-bottom: 10px;">
                                        Saldo Anda tidak mencukupi untuk melakukan pembayaran ini.
                                    
                                    </p>
                                    @else
                                    <label class="form-label">Metode Pembayaran</label>
                            <div class="payment-method">
                                <label class="pay-option active">
                                    <i class="fa-solid fa-building-columns"
                                    style="font-size: 20px; color: white; display: block; margin-bottom: 5px;"></i>
                                    <span style="font-size: 12px; color: #d1d5db;">Virtual Account</span><br>
                                    <span style="font-size: 12px; color: #d1d5db;">Saldo: Rp 124151</span>
                                <button type="submit" class="submit-btn"
                            style="background: #6366f1; width: 100%; margin-top: 10px;">
                            <i class="fa-solid fa-lock"></i> Bayar Sekarang
                        </button>
                                </label>
                            </div>
                        </div>
                        <p style="font-size: 11px; color: #6b7280; text-align: center; margin-top: 15px;">
                            Dengan membayar, Anda menyetujui S&K Hardware_JosJis.
                        </p>
                        @endif
                        
                        

                    </div>

                </div>
            </div>
        </form>

    </div>

    <script>
        function selectPayment(element) {
            document.querySelectorAll('.pay-option').forEach(el => el.classList.remove('active'));
            element.classList.add('active');
        }
    </script>

</body>

</html>