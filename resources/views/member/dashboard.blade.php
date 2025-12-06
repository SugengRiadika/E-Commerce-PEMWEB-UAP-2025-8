<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gasol Store - Dashboard</title>
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
                <span class="logo-text">Gasol Store</span>
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
                <a href="checkout.html" class="btn-icon-nav" title="Checkout / Keranjang"><i
                        class="fa-solid fa-cart-shopping"></i></a>
                          <div class="info-item" style="border:none; margin:0; padding:0; text-align:right;">
                    <small style="color:#9ca3af;">halo, </small>
                    <span style="color:#fff; font-weight:600;">{{Auth::user()->name}} </span>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                        <li><a href="route('logout')"
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
                    <li><a href="/?category=all">Semua Kategori</a></li>
                    <li><a href="/?category=gaming-notebook">Gaming Notebook</a></li>
                    <li><a href="/?category=notebook">Notebook</a></li>
                    <li><a href="/?category=tablet">Tablet</a></li>
                    <li><a href="/?category=desktop">Desktop - Mini PC</a></li>
                    <li><a href="/?category=processor">Processor</a></li>
                    <li><a href="/?category=mainboard">Mainboard</a></li>
                    <li><a href="/?category=ram">Memory (RAM)</a></li>
                    <li><a href="/?category=storage">HardDisk / SSD</a></li>
                </ul>
            </div>
        </aside>

        <main class="content-center">
            <div class="promo-banner">
                <div class="promo-text">
                    <h2>Gaming Clearance</h2>
                    <h1>PROMO</h1>
                    <p>Diskon khusus aksesoris & peripheral - stok terbatas</p>
                    <button class="btn-pill-white">Lihat Detail</button>
                </div>
                <div class="promo-icon"><i class="fa-solid fa-gamepad"></i></div>
            </div>

            <div class="section-header">
                <h3>Produk Terbaru & Promo</h3>
            </div>
            <div class="product-grid">
                <div class="card product-card">
                    <div class="product-img"><i class="fa-solid fa-keyboard"></i></div>
                    <div class="product-info">
                        <h4><a href="/product/corsair-k70-rgb" style="text-decoration: none; color: inherit;">Corsair
                                K70 RGB</a></h4>
                        <span class="category-tag">Accessory</span>
                        <div class="price-row"><span class="price">Rp 1.899.000</span><a href="/product/corsair-k70-rgb"
                                class="btn-icon"><i class="fa-solid fa-chevron-right"></i></a></div>
                    </div>
                </div>
                <div class="card product-card">
                    <div class="product-img"><i class="fa-solid fa-laptop"></i></div>
                    <div class="product-info">
                        <h4><a href="/product/asus-rog-g15" style="text-decoration: none; color: inherit;">ASUS ROG
                                G15</a></h4>
                        <span class="category-tag">Gaming Notebook</span>
                        <div class="price-row"><span class="price">Rp 27.999.000</span><a href="/product/asus-rog-g15"
                                class="btn-icon"><i class="fa-solid fa-chevron-right"></i></a></div>
                    </div>
                </div>
            </div>
            <div class="ad-banner">
                <h3>Iklan Produk Utama</h3>
                <p>Space iklan tersedia di sini.</p>
            </div>
        </main>

        <aside class="sidebar-right">
            <div class="card info-card">
                <div class="info-item"><small>User Online</small>
                    <div class="big-number">209</div>
                </div>
                <div class="info-item"><small>Kontak WA</small>
                    <div class="contact-number"><i class="fa-brands fa-whatsapp"></i> 0812-3456-7890</div>
                </div>
            </div>
            <div class="card location-card">
                <div class="card-header-sm">
                    <h3>Cabang / Lokasi</h3>
                </div>
                <ul class="location-list">
                    <li><i class="fa-solid fa-store"></i> <span>Gasol WTC Sby</span><span class="badge-wa">WA</span>
                    </li>
                    <li><i class="fa-solid fa-store"></i> <span>Gasol Maspion Sby</span><span class="badge-wa">WA</span>
                    </li>
                    <li><i class="fa-solid fa-store"></i> <span>Gasol Dinoyo Mlg</span><span class="badge-wa">WA</span>
                    </li>
                    <li><i class="fa-solid fa-store"></i> <span>Gasol Cybermall</span><span class="badge-wa">WA</span>
                    </li>
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