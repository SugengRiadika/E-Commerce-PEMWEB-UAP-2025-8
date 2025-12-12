<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Transaksi - Hardware_JosJis</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    
    <style>
        .history-list {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        .history-card {
            background: #1f2937;
            border: 1px solid #374151;
            border-radius: 12px;
            overflow: hidden;
            transition: transform 0.2s;
        }
        .history-card:hover {
            border-color: #6366f1;
        }
        .trx-header {
            background: #111827;
            padding: 15px 20px;
            border-bottom: 1px solid #374151;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 13px;
            color: #9ca3af;
        }
        .trx-body {
            padding: 20px;
            display: flex;
            gap: 20px;
            align-items: center;
        }
        .trx-img {
            width: 80px;
            height: 80px;
            background: #374151;
            border-radius: 8px;
            overflow: hidden;
            flex-shrink: 0;
        }
        .trx-info h4 {
            color: #fff;
            margin-bottom: 5px;
            font-size: 16px;
        }
        .trx-info p {
            color: #9ca3af;
            font-size: 13px;
            margin: 0;
        }
        .trx-footer {
            padding: 15px 20px;
            border-top: 1px solid #374151;
            display: flex;
            justify-content: flex-end;
            align-items: center;
        }
        .total-price {
            color: #fff;
            font-size: 14px;
        }
        .total-price span {
            font-weight: 700;
            color: #4ade80;
            font-size: 16px;
            margin-left: 10px;
        }
        .badge {
            padding: 5px 10px;
            border-radius: 50px;
            font-size: 10px;
            font-weight: 600;
        }
        .bg-pending { background: rgba(250, 204, 21, 0.2); color: #facc15; border: 1px solid #facc15; }
        .bg-success { background: rgba(74, 222, 128, 0.2); color: #4ade80; border: 1px solid #4ade80; }
        
        @media (max-width: 600px) {
            .trx-body { flex-direction: column; align-items: flex-start; }
            .trx-header { flex-direction: column; gap: 10px; align-items: flex-start; }
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
                <li><a href="{{ route('member.dashboard') }}">Home</a></li>
                <li><a href="{{ route('member.transactionHistory') }}" class="active">Riwayat Transaksi</a></li>
                <li><a href="{{ route('member.topup') }}">Topup Saldo</a></li>
                <li><a href="{{ route('member.store') }}">Toko Saya</a></li>
            </ul>
            <div class="nav-actions">
                <div class="search-box">
                    <form action="{{ route('member.dashboard') }}" method="GET">
                        <i class="fa-solid fa-search"></i><input type="text" name="search" placeholder="Cari produk..." style="width: 200px;" value="">
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

    <div class="container" style="max-width: 800px; display: block;">
        <main class="content-center" style="margin-top: 40px; margin-bottom: 40px;">
            <div class="section-header page-title" style="margin-bottom: 25px;">
                <h3><i class="fa-solid fa-clock-rotate-left"></i> Riwayat Transaksi</h3>
            </div>
            
            <div class="history-list">
                @forelse($transactions as $trx)
                    @php
                        $firstDetail = $trx->transactionDetails->first(); 
                        $product = $firstDetail ? $firstDetail->product : null;
                        $totalItems = $trx->transactionDetails->sum('qty');
                    @endphp

                    <div class="history-card">
                        <div class="trx-header">
                            <div>
                                <i class="fa-solid fa-calendar" style="margin-right: 5px;"></i> {{ $trx->created_at->format('d M Y') }}
                                <span style="margin: 0 10px; color: #374151;">|</span>
                                <span style="font-family: monospace; color: #d1d5db;">{{ $trx->code }}</span>
                            </div>
                            
                            @if($trx->shipping == 'pesanan-diterima' || $trx->shipping == 'selesai')
                                <span class="badge bg-success">Selesai</span>
                            @else
                                <span class="badge bg-pending">{{ $trx->shipping }}</span>
                            @endif
                        </div>

                        <div class="trx-body">
                            <div class="trx-img">
                                @if($product)
                                    <img src="{{ asset('ImageSource/' . $product->slug . '.png') }}" alt="produk" 
                                         style="width: 100%; height: 100%; object-fit: contain;">
                                @else
                                    <div style="display:flex; justify-content:center; align-items:center; height:100%; color:#9ca3af;">
                                        <i class="fa-solid fa-box"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="trx-info">
                                <h4>
                                    {{ $product ? $product->name : 'Produk tidak ditemukan' }}
                                </h4>
                                @if($trx->transactionDetails->count() > 1)
                                    <p style="font-size: 12px; color: #6366f1;">
                                        +{{ $trx->transactionDetails->count() - 1 }} produk lainnya
                                    </p>
                                @endif
                                <p style="margin-top: 5px;">Quantity: {{ $totalItems }}</p>
                                <p style="margin-top: 5px;">Resi: {{ $trx->tracking_number }}</p>
                                <p style="margin-top: 5px;">Pengiriman VIA: {{ $trx->shipping_type }}</p>
                            </div>
                        </div>

                        <div class="trx-footer">
                            <div class="total-price">
                                Total Belanja: <span>Rp {{ number_format($trx->grand_total, 0, ',', '.') }}.000</span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div style="text-align: center; padding: 50px; color: #9ca3af; background: #1f2937; border-radius: 12px; border: 1px dashed #374151;">
                        <i class="fa-solid fa-cart-shopping" style="font-size: 50px; margin-bottom: 20px; opacity: 0.5;"></i>
                        <h3 style="color: white;">Belum ada transaksi</h3>
                        <p>Yuk mulai belanja produk impianmu!</p>
                        <a href="{{ route('member.dashboard') }}" class="btn-pill-white" style="background: #6366f1; color: white; border: none; padding: 10px 25px; margin-top: 15px; display: inline-block; text-decoration:none; border-radius: 50px;">
                            Mulai Belanja
                        </a>
                    </div>
                @endforelse

                <div style="margin-top: 30px;">
                    {{ $transactions->links() }}
                </div>
            </div>
        </main>
    </div>

</body>
</html>