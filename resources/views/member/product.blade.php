<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }} - Hardware_JosJis</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('style.css') }}">

    <style>
        /* === CUSTOM CSS KHUSUS HALAMAN DETAIL (Sama seperti sebelumnya) === */
        .detail-container {
            display: grid;
            grid-template-columns: 450px 1fr;
            gap: 40px;
            margin-bottom: 40px;
        }

        .main-image-card {
            background-color: #1f2937;
            border: 1px solid #374151;
            border-radius: 20px;
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 400px;
            position: relative;
            overflow: hidden;
        }

        .main-image-card img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            transition: 0.3s;
        }

        .main-image-card:hover img {
            transform: scale(1.05);
        }

        .thumbnail-list {
            display: flex;
            gap: 15px;
            margin-top: 15px;
            justify-content: center;
        }

        .thumb-item {
            width: 80px;
            height: 80px;
            background: #1f2937;
            border: 1px solid #374151;
            border-radius: 10px;
            padding: 5px;
            cursor: pointer;
            transition: 0.2s;
        }

        .thumb-item:hover,
        .thumb-item.active {
            border-color: #6366f1;
            transform: translateY(-3px);
        }

        .thumb-item img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .product-title {
            font-size: 28px;
            font-weight: 700;
            color: white;
            margin-bottom: 10px;
        }

        .product-meta {
            display: flex;
            gap: 20px;
            color: #9ca3af;
            font-size: 14px;
            margin-bottom: 20px;
            align-items: center;
        }

        .rating-stars {
            color: #facc15;
        }

        .product-price {
            font-size: 32px;
            font-weight: 700;
            color: #6366f1;
            margin-bottom: 20px;
            background: rgba(99, 102, 241, 0.1);
            display: inline-block;
            padding: 5px 20px;
            border-radius: 10px;
        }

        .variant-group {
            margin-bottom: 25px;
        }

        .variant-label {
            display: block;
            color: #d1d5db;
            margin-bottom: 10px;
            font-weight: 500;
        }

        .variant-options {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .variant-btn {
            background: #1f2937;
            border: 1px solid #374151;
            color: #d1d5db;
            padding: 8px 20px;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.2s;
            font-size: 13px;
        }

        .variant-btn:hover,
        .variant-btn.selected {
            background: #6366f1;
            border-color: #6366f1;
            color: white;
        }

        .action-area {
            display: flex;
            gap: 20px;
            align-items: center;
            margin-top: 30px;
            border-top: 1px solid #374151;
            padding-top: 30px;
        }

        .qty-control {
            display: flex;
            align-items: center;
            background: #1f2937;
            border-radius: 50px;
            border: 1px solid #374151;
        }

        .qty-btn {
            background: none;
            border: none;
            color: white;
            padding: 10px 15px;
            cursor: pointer;
            font-size: 16px;
        }

        .qty-input {
            width: 50px;
            background: transparent;
            border: none;
            text-align: center;
            color: white;
            font-weight: 600;
        }

        .details-tabs {
            margin-top: 60px;
        }

        .tab-buttons {
            display: flex;
            gap: 30px;
            border-bottom: 1px solid #374151;
            margin-bottom: 30px;
        }

        .tab-link {
            padding-bottom: 15px;
            color: #9ca3af;
            cursor: pointer;
            font-size: 16px;
            font-weight: 500;
            position: relative;
        }

        .tab-link.active {
            color: #6366f1;
        }

        .tab-link.active::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 3px;
            background: #6366f1;
        }

        .tab-content {
            color: #d1d5db;
            line-height: 1.8;
            font-size: 14px;
        }

        .spec-table {
            width: 100%;
            border-collapse: collapse;
        }

        .spec-table td {
            padding: 10px 0;
            border-bottom: 1px solid #374151;
        }

        .spec-table td:first-child {
            width: 200px;
            color: #9ca3af;
        }

        @media (max-width: 992px) {
            .detail-container {
                grid-template-columns: 1fr;
            }

            .action-area {
                flex-direction: column;
                align-items: stretch;
            }

            .qty-control {
                justify-content: center;
                margin-bottom: 15px;
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

    <div class="container" style="display: block; max-width: 1200px; padding-top: 20px;">

        <div style="margin-bottom: 20px; font-size: 13px; color: #9ca3af;">
            <a href="{{ route('member.dashboard') }}" style="color: #9ca3af; text-decoration: none;">Beranda</a>
            <span style="margin: 0 5px;">/</span>
            <a href="{{ route('member.category', $product->productCategory->slug) }}"
                style="color: #9ca3af; text-decoration: none;">{{ $product->category->name ?? 'Produk' }}</a>
            <span style="margin: 0 5px;">/</span>
            <span style="color: #6366f1;">{{ $product->name }}</span>
        </div>

        <div class="detail-container">

            <div class="product-gallery">
                <div class="main-image-card">
                    <img src="{{ asset('ImageSource/' . $product->slug . '.png') }}" alt="{{ $product->name }}"
                        id="mainImg">

                </div>


            </div>

            <div class="product-info-col">
                <h1 class="product-title">{{ $product->name }}</h1>

                <div class="product-meta">
                    <div class="rating-stars">
                        @for($i = 0; $i < 5; $i++) <i class="fa-solid fa-star"></i> @endfor
                        <span style="color: #d1d5db; margin-left: 5px;">(5.0)</span>
                    </div>
                    <div>Stok:
                        @if($product->stock > 0)
                            <span style="color: #4ade80;">Tersedia ({{ $product->stock }})</span>
                        @else
                            <span style="color: #ef4444;">Habis</span>
                        @endif
                    </div>
                </div>

                <div class="product-price">Rp {{ number_format($product->price, 0, ',', '.') }}.000</div>

                <p style="color: #d1d5db; margin-bottom: 25px; line-height: 1.6;">
                    {{ Str::limit($product->description, 150) }}
                </p>
                <div class="action-area">
                    <div class="qty-control">
                        <form action="{{ route('member.checkout', $product->id) }}" method="POST">
    @csrf

                            <button type="button" class="qty-btn" onclick="decrementQty()">-</button>
                            <input type="number" name="quantity" id="qtyInput" class="qty-input" value="1" min="1"
                                max="{{ $product->stock }}">
                            <button type="button" class="qty-btn" onclick="incrementQty()">+</button>
                    </div>
                    <a id="buyNowBtn" href="#">
    <button class="submit-btn" style="flex:1; background:#6366f1;">
        <i class="fa-solid fa-money-bill-wave"></i> Beli Sekarang
    </button>
</a>
                </div>
            </form>

                <div style="margin-top: 15px; font-size: 12px; color: #9ca3af; display: flex; gap: 15px;">
                    <span><i class="fa-solid fa-shield-halved"></i> Garansi Resmi
                        {{ $product->store->name ?? 'Toko' }}</span>
                    <span><i class="fa-solid fa-truck"></i> Pengiriman Aman</span>
                </div>
            </div>
        </div>

        <div class="details-tabs">
            <div class="tab-buttons">
                <div class="tab-link active">Deskripsi Lengkap</div>
            </div>

            <div class="card" style="padding: 30px;">
                <div class="tab-content">
                    <p>{!! nl2br(e($product->description)) !!}</p>
                </div>
            </div>
        </div>

        <div class="section-header" style="margin-top: 60px; margin-bottom: 20px;">
            <h3>Produk Terkait</h3>
        </div>

        <div class="product-grid" style="grid-template-columns: repeat(4, 1fr); margin-bottom: 50px;">
            @if(isset($related_products) && count($related_products) > 0)
                @foreach($related_products as $related)
                    <div class="card product-card">
                        <div class="product-img">
                            <img
                                src="{{ $related->image ? asset('storage/' . $related->image) : 'https://via.placeholder.com/300' }}">
                        </div>
                        <div class="product-info">
                            <h4><a href="{{ route('product.detail', $related->id) }}"
                                    style="text-decoration: none; color: inherit;">{{ $related->name }}</a></h4>
                            <span class="category-tag">{{ $related->category->name ?? 'Gadget' }}</span>
                            <div class="price-row">
                                <span class="price">Rp {{ number_format($related->price, 0, ',', '.') }}</span>
                                <a href="{{ route('product.detail', $related->id) }}" class="btn-icon"><i
                                        class="fa-solid fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <p style="color: #9ca3af;">Belum ada produk terkait.</p>
            @endif
        </div>

    </div>

    <footer
        style="text-align: center; color: #6b7280; padding: 40px 0; border-top: 1px solid #374151; margin-top: 50px;">
        <p>&copy; 2025 Hardware_JosJis. All rights reserved.</p>
    </footer>

    <script>
        function changeImage(element, src) {
            document.getElementById('mainImg').src = src;
            document.querySelectorAll('.thumb-item').forEach(el => el.classList.remove('active'));
            element.classList.add('active');
        }

        function incrementQty() {
            var input = document.getElementById('qtyInput');
            if (parseInt(input.value) < parseInt(input.max)) {
                input.value = parseInt(input.value) + 1;
            }
        }

        function decrementQty() {
            var input = document.getElementById('qtyInput');
            if (parseInt(input.value) > 1) {
                input.value = parseInt(input.value) - 1;
            }
        }
        document.getElementById('buyNowBtn').addEventListener('click', function(event) {
    event.preventDefault();

    let qty = document.getElementById('qtyInput').value;

    // bangun URL checkout dengan quantity
    let url = "{{ route('member.checkout', ['id' => $product->id]) }}?quantity=" + qty;

    window.location.href = url;
});
    </script>

</body>

</html>