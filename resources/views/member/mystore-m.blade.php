<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Produk - Hardware_JosJis</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
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

            </div>
        </div>
    </nav>

    <div class="seller-container">
        
        <aside class="sidebar-left">
            <div class="card card-sidebar">
                <div class="store-info-content" style="flex-direction: column; text-align: center; margin-bottom: 20px;">
                <div class="store-logo-lg" style="width: 120px; height: 120px; font-size: 24px; margin: 0 auto;">
                    <img src="{{ asset('logo/' . $store->logo) }}" alt="Logo" style="width:100%; height:100%; border-radius:50%; object-fit:cover;">
                </div>
                <h3 style="color:white; margin-top:10px;">{{ $store->name }}</h3>
            </div>
                <div class="card-header-sm"><h3>Menu Toko</h3></div>
                <ul class="category-list">
                    <li>
                        <a href="{{ route('member.store') }}" class="active" style="background: #374151; color: white;">
                            <i class="fa-solid fa-chart-line" style="width: 20px;"></i> Dashboard
                        </a>
                    </li>
                    <li style="margin-top: 15px; margin-bottom: 5px; font-size: 11px; color: #6b7280; padding-left: 15px;">PRODUK</li>
                    {{-- Ganti href dengan route manajemen produk kamu jika sudah ada --}}
                    <li><a href="#"><i class="fa-solid fa-box-open" style="width: 20px;"></i> Manajemen Produk</a></li>
                    
                    <li style="margin-top: 15px; margin-bottom: 5px; font-size: 11px; color: #6b7280; padding-left: 15px;">PESANAN</li>
                    <li>
                        <a href="#">
                            <i class="fa-solid fa-clipboard-list" style="width: 20px;"></i> Pesanan Masuk 
                            @if($pendingOrders > 0)
                                <span class="badge bg-pending" style="float: right; font-size: 10px;">{{ $pendingOrders }}</span>
                            @endif
                        </a>
                    </li>
                    
                    <li style="margin-top: 15px; margin-bottom: 5px; font-size: 11px; color: #6b7280; padding-left: 15px;">KEUANGAN</li>
                    <li><a href="#"><i class="fa-solid fa-wallet" style="width: 20px;"></i> Saldo Toko</a></li>
                    
                    <li style="margin-top: 15px; margin-bottom: 5px; font-size: 11px; color: #6b7280; padding-left: 15px;">PENGATURAN</li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a href="#" onclick="event.preventDefault(); this.closest('form').submit();" style="color: #f87171;">
                                <i class="fa-solid fa-right-from-bracket" style="width: 20px;"></i> Logout
                            </a>
                        </form>
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
                    <button type="button" class="btn-close-alert" onclick="this.parentElement.style.display='none';">&times;</button>
                </div>
            @endif

            <div class="card">
                <div class="action-row" style="margin-top: 0; margin-bottom: 20px; border-bottom: 1px solid #374151; padding-bottom: 15px;">
                    <h3 style="color: white; margin: 0;">Daftar Produk</h3>
                    <a href="{{ route('member.productcreate') }}" class="btn-action btn-detail" style="text-decoration: none; padding: 10px 20px; font-size: 13px;">
                        <i class="fa-solid fa-plus"></i> Tambah Produk Baru
                    </a>
                </div>

                <div style="overflow-x: auto;">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th>Kategori</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($products as $product)
                            <tr>
                                <td>
                                    <div class="user-cell">
                                        <img src="{{ asset('images/products/' . $product->image) }}" alt="img" style="width: 40px; height: 40px; border-radius: 5px; object-fit: cover; background: #374151;">
                                        <div>
                                            <div style="font-weight: 600; color: white;">{{ $product->name }}</div>
                                            <div style="font-size: 11px; color: #9ca3af;">SKU: P-{{ $product->id }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge" style="background: #374151; color: #d1d5db;">
                                        {{ $product->productCategory->name ?? 'Uncategorized' }}
                                    </span>
                                </td>
                                <td style="color: #4ade80; font-weight: 600;">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                                <td>
                                    @if($product->stock > 0)
                                        <span style="color: white;">{{ $product->stock }}</span>
                                    @else
                                        <span style="color: #ef4444; font-weight: bold;">Habis</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="action-btn-group">
                                        <a href="{{ route('member.products.edit', $product->id) }}" class="btn-sm btn-edit">
                                            <i class="fa-solid fa-pen"></i> Edit
                                        </a>
                                        
                                        <form action="{{ route('member.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus produk ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-sm btn-delete">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" style="text-align: center; padding: 40px;">
                                    <i class="fa-solid fa-box-open" style="font-size: 40px; color: #374151; margin-bottom: 10px;"></i>
                                    <p style="color: #9ca3af;">Belum ada produk yang ditambahkan.</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div style="margin-top: 20px;">
                    {{ $products->links() }} 
                </div>

            </div>
        </div>
    </div>

</body>
</html>