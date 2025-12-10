<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $store->name }} - Halaman Toko</title>
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

    <div class="container">
        <aside class="sidebar-left">
    <div class="card card-sidebar">
        <div class="card-header-sm">
            <h3>Etalase Toko</h3>
        </div>
        <ul class="category-list etalase-list">
            {{-- Link Semua Produk --}}
            <li>
                <a href="{{ route('member.dstore', $store->id) }}" 
                   class="{{ !request('category') ? 'active-category' : '' }}" 
                       style="color: #ffffffff; display: flex; justify-content: space-between;">
                    Semua Produk 
                    <span class="count-badge">{{ $totalProducts }}</span>
                </a>
            </li>

            {{-- Looping Kategori dari Controller --}}
            @foreach($categories as $cat)
                <li>
                    <a href="{{ route('member.dstore', $store->id) }}?category={{ $cat->id }}"
                       class="{{ request('category') == $cat->id ? 'active-category' : '' }}"
                       style="color: #ffffffff; display: flex; justify-content: space-between;">
                        {{ $cat->name }}
                        <span class="count-badge">
                            {{ $cat->products_count }}
                        </span>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
    
    {{-- Card Jam Operasional tetap sama --}}
    <div class="card info-card">
       <div class="info-item">
                    <small>Jam Operasional</small>
                    <div style="font-size: 13px; color: #fff; margin-top: 5px;">
                        <i class="fa-regular fa-clock" style="color: #6366f1;"></i> 09:00 - 17:00 WIB
                    </div>
                </div>
    </div>
</aside>

        <main class="content-center">
            <div class="store-header-card">
                <div class="store-info-content">
                    <div class="store-logo-lg">
                        @if($store->logo)
                            <img src="{{ asset('logo/' . $store->logo) }}" alt="Logo"
                                style="width:100%; height:100%; object-fit:cover; border-radius:50%;">
                        @else
                            <i class="fa-solid fa-store"></i>
                        @endif
                    </div>

                    <div class="store-details">
                        <h1>{{ $store->name }}
                            @if($store->is_verified)
                                <i class="fa-solid fa-circle-check verified-badge" title="Official Store"></i>
                            @endif
                        </h1>
                        <div class="store-stats">
                            <span><i class="fa-solid fa-box-open"></i> {{ $totalProducts }} Produk</span><span>|</span>
                            <span><i class="fa-solid fa-location-dot"></i> {{ $store->city }}</span>
                        </div>
                        <div style="margin-top: 10px; font-size: 12px; color: #9ca3af;">
                            {{ Str::limit($store->about, 100) }}
                        </div>
                    </div>
                </div>
            </div>

        

            <div class="section-header" style="margin-top: 20px; display:flex; justify-content:space-between; align-items:center;">
        <h3>
            @if(request('category'))
                {{-- Cari nama kategori berdasarkan ID di URL --}}
                @php 
                    $activeCat = $categories->firstWhere('id', request('category')); 
                @endphp
                Kategori: {{ $activeCat ? $activeCat->name : 'Produk' }}
            @else
                Semua Produk
            @endif
        </h3>
        
        @if(request('category'))
            <a href="{{ route('member.dstore', $store->id) }}" style="font-size:12px; color:#ef4444; text-decoration:none;">
                <i class="fa-solid fa-times"></i> Hapus Filter
            </a>
        @endif
    </div>

    {{-- GRID PRODUK --}}
    <div class="product-grid">
        
        {{-- PENTING: Gunakan variable $products, JANGAN $store->products --}}
        @forelse($products as $product)
            <div class="card product-card">
                <a href="{{ route('member.product', $product->id) }}" style="color: inherit;text-decoration:none;">
                    
                    {{-- Gambar Produk --}}
                    <div class="product-img">
                        <img src="{{ asset('ImageSource/' . $product->slug . '.png') }}" 
                             class="product-img" 
                             alt="{{ $product->name }}">
                    </div>

                    {{-- Info Produk --}}
                    <div class="product-info">
                        <h4>{{ $product->name }}</h4>
                        <span class="category-tag">
                            {{ $product->productCategory->name ?? 'Uncategorized' }}
                        </span>
                        
                        <div class="price-row">
                            <span class="price">
                                Rp {{ number_format($product->price, 0, ',', '.') . '.000' }}
                            </span>
                            <span class="btn-icon">
                                <i class="fa-solid fa-chevron-right"></i>
                            </span>
                        </div>
                    </div>
                </a>
            </div>
        @empty
            {{-- Tampilan JIKA KOSONG (Saat diklik kategori tapi tidak ada isinya) --}}
            <div style="grid-column: 1 / -1; text-align: center; padding: 40px; color: #9ca3af;">
                <i class="fa-solid fa-box-open" style="font-size: 40px; margin-bottom: 10px;"></i>
                <p>Belum ada produk di kategori ini.</p>
                <a href="{{ route('member.dstore', $store->id) }}" class="btn-pill-white" style="margin-top:10px; display:inline-block; font-size:12px;">
                    Lihat Semua Produk
                </a>
            </div>
        @endforelse

    </div>
        </main>

        <aside class="sidebar-right">
            <div class="card support-card">
                <h3>Hubungi Penjual</h3>
                <p>Ada pertanyaan seputar produk? Chat langsung dengan admin toko.</p>
                <a href="#" target="_blank" class="btn-pill-white"
                    style="width: 100%; margin-top: 10px; font-size: 13px; text-align:center; display:block; text-decoration:none; color:#000;">
                    <i class="fa-brands fa-whatsapp"></i> Chat WhatsApp
                </a>
            </div>
        </aside>
    </div>
</body>

</html>