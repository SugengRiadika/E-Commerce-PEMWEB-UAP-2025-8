<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hardware_JosJis😂 - Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('style.css') }}">

</head>

<body class="dashboard-body">

    <nav class="navbar">
        <div class="nav-container">
            <div class="logo">
                <div class="logo-icon"><i class="fa-solid fa-cube"></i></div>
                <span class="logo-text">Hardware_JosJis😂</span>
            </div>
            <ul class="nav-links">
                <li><a href="/" class="active">Home</a></li>
                <li><a href="history.html">Riwayat Transaksi</a></li>
                <li><a href="topup.html">Topup Saldo</a></li>
                <li><a href="contact.html">Contact Us</a></li>
            </ul>
            <div class="nav-actions">
                <div class="search-box"><i class="fa-solid fa-search"></i><input type="text"
                        placeholder="Cari produk..."></div>
                          <div class="info-item" style="border:none; margin:0; padding:0; text-align:right;">
                    <small style="color:#9ca3af;">halo, </small>
                    <span style="color:#fff; font-weight:600;">{{Auth::user()->name}}</span>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                        <a href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();"
                                                  class="btn-nav-logout">
                                {{ __('Log out') }}</a></li>
                    </form>
            </div>
        </div>
    </nav>

    <div class="main-content container">
        <aside class="sidebar-left">
            <div class="card card-sidebar">
                <div class="card-header-sm">
                    <h3>Kategori Produk</h3>
                </div>
                <ul class="category-list">
    @foreach($categories as $category)
        <li>
            <a href="{{ url('member/category/' . $category->slug) }}">
                {{ $category->name }}
            </a>
        </li>
    @endforeach
</ul>
            </div>
        </aside>

        <main class="content-center">
            <div class="promo-banner">
                <div class="promo-text">
                    <h2>Welcome To</h2>
                    <h1>Hardware_JosJis😂</h1>
                    <p>Full laptop & hardware harga bitcoin boloo..</p>
                </div>
                <div class="promo-icon"><i class="fa-solid fa-gamepad"></i></div>
            </div>

            <div class="section-header">
                <h3>Produk Terbaru</h3>
            </div>
            <div class="product-grid">
                @foreach($latestProducts as $product)
                <div class="card product-card">
                    <div class="product-img"><img src="{{ asset('ImageSource/' . $product->slug . '.png') }}" class="product-img"></div>
                    <div class="product-info">
                        <h4><a href="product/{{ $product->slug }}" style="text-decoration: none; color: inherit;">{{ $product->name }}</a></h4>
                        <span class="category-tag">Accessory</span>
                        <div class="price-row"><span class="price">Rp {{ number_format($product->price, 0, ',', '.') . '.000' }}</span><a href="product/{{ $product->slug }}"
                                class="btn-icon"><i class="fa-solid fa-chevron-right"></i></a></div>
                    </div>
                </div>
        @endforeach
                
            </div>
        </main>

        <aside class="sidebar-right">
            <div class="card location-card">
                <div class="card-header-sm">
                    <h3>Cabang / Lokasi</h3>
                </div>
                <ul class="location-list">
                     @foreach($latestStores as $store)
                    <li><a href="store/{{ $store->id}}"style="text-decoration: none; color: inherit;"><i class="fa-solid fa-store"></i> <span>{{ $store->name }}</span></a>
                    </li>
                    @endforeach
                </ul>
            </div>
            <div class="card support-card">
                <h3>Support & Info</h3>
                <p>Butuh bantuan? Klik tombol chat di pojok kanan bawah. Kami siap membantu Anda.</p>
            </div>
        </aside>
    </div>
</body>

</html>