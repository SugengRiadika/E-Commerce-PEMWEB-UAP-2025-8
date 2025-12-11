<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Menjadi Seller - Hardware_JosJis</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('style.css') }}">

    <style>
        /* CSS Tambahan untuk Status State */
        .status-container {
            text-align: center;
            padding: 50px 20px;
        }

        .status-icon {
            font-size: 80px;
            margin-bottom: 20px;
        }

        .status-pending {
            color: #facc15;
        }

        /* Kuning */
        .status-success {
            color: #4ade80;
        }

        /* Hijau */

        .upload-area {
            border: 2px dashed #374151;
            padding: 30px;
            border-radius: 15px;
            text-align: center;
            background: #111827;
            cursor: pointer;
            transition: 0.3s;
        }

        .upload-area:hover {
            border-color: #6366f1;
            background: #1f2937;
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
    <div class="alert alert-success" id="success-alert">
        <div style="display: flex; align-items: center;">
            <i class="fa-solid fa-circle-check alert-icon"></i>
            <span>{{ session('success') }}</span>
        </div>
        
        <button type="button" class="btn-close-alert" onclick="this.parentElement.style.display='none';">
            &times;
        </button>
    </div>
@endif
    <div class="container" style="max-width: 800px; display: block;">

        <div class="card" style="margin-top: 40px;">

            {{-- LOGIKA UTAMA --}}
            @if(Auth::user()->store && Auth::user()->store->is_verified)

                <div class="status-container">
                    <i class="fa-solid fa-circle-check status-icon status-success"></i>
                    <h2 style="color: white; margin-bottom: 10px;">Selamat! Toko Anda Terverifikasi</h2>
                    <p style="color: #9ca3af; margin-bottom: 30px;">
                        Anda sekarang adalah Seller resmi di Hardware_JosJis. Mulai tambahkan produk Anda sekarang.
                    </p>

                    <div style="display: flex; gap: 15px; justify-content: center;">
                        <a href="{{ route('member.mystore') }}" class="submit-btn"
                            style="width: auto; background: #374151; color: white; text-decoration: none;">
                            <i class="fa-solid fa-chart-line"></i> Dashboard Toko
                        </a>
                    </div>
                </div>

            @elseif(Auth::user()->store && !Auth::user()->store->is_verified)

                <div class="status-container">
                    <i class="fa-solid fa-hourglass-half status-icon status-pending"></i>
                    <h2 style="color: white; margin-bottom: 10px;">Menunggu Verifikasi Admin</h2>
                    <p style="color: #9ca3af; margin-bottom: 20px;">
                        Data pendaftaran toko <strong>"{{ Auth::user()->store->name }}"</strong> sedang ditinjau oleh tim
                        kami. <br>
                        Proses ini biasanya memakan waktu 1x24 jam.
                    </p>
                    <div
                        style="background: rgba(250, 204, 21, 0.1); border: 1px solid #facc15; padding: 15px; border-radius: 10px; display: inline-block; color: #facc15; font-size: 13px;">
                        <i class="fa-solid fa-circle-info"></i> Form pendaftaran disembunyikan sampai status berubah.
                    </div>
                    <br><br>
                    <a href="{{ route('member.dashboard') }}" class="btn-outline" style="padding: 10px 30px;">Kembali ke
                        Beranda</a>
                </div>

            @else

                <div class="card-header-sm">
                    <h3>Form Pendaftaran Toko Baru</h3>
                    <p style="font-size: 12px; color: #9ca3af; margin-top: 5px;">Lengkapi data di bawah untuk mulai
                        berjualan.</p>
                </div>

                <form action="{{ route('member.store.save') }}" enctype="multipart/form-data" method="POST" style="padding-top: 20px;">
                    @csrf

                    <div class="form-group">
                        <label class="form-label">Nama Toko</label>
                        <div
                            style="display: flex; align-items: center; background: #111827; border: 1px solid #374151; border-radius: 8px; padding-left: 15px; color: #9ca3af; font-size: 13px;">
                            <input type="text" name="name"
                                style="background: transparent; border: none; color: white; padding: 12px; width: 100%; outline: none;"
                                placeholder="Contoh: Josjis Store Mlg" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Tentang Toko (Deskripsi singkat)</label>
                        <textarea name="about" class="form-input" rows="3" style="height: auto; border-radius: 10px;"
                            placeholder="Jelaskan apa yang Anda jual..."></textarea>
                    </div>

                    
                    <div class="form-group">
                        <label class="form-label">Nomor Telepon</label>
                        <div
                        style="display: flex; align-items: center; background: #111827; border: 1px solid #374151; border-radius: 8px; padding-left: 15px; color: #9ca3af; font-size: 13px;">
                        <input type="text" name="phone"
                        style="background: transparent; border: none; color: white; padding: 12px; width: 100%; outline: none;"
                        placeholder="08..." required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Kota</label>
                    <div
                    style="display: flex; align-items: center; background: #111827; border: 1px solid #374151; border-radius: 8px; padding-left: 15px; color: #9ca3af; font-size: 13px;">
                    <input type="text" name="city"
                    style="background: transparent; border: none; color: white; padding: 12px; width: 100%; outline: none;"
                    placeholder="Contoh: Malang" required>
                </div>
            </div>
            
            <div class="form-group">
                <label class="form-label">Alamat Toko</label>
                <div
                style="display: flex; align-items: center; background: #111827; border: 1px solid #374151; border-radius: 8px; padding-left: 15px; color: #9ca3af; font-size: 13px;">
                <input type="text" name="address"
                style="background: transparent; border: none; color: white; padding: 12px; width: 100%; outline: none;"
                placeholder="Contoh: Jl. Bend Sigura-gura, Lowokwaru, Malang" required>
            </div>
        </div>
        
        <div class="form-group">
            <label class="form-label">Kode Pos</label>
            <div
            style="display: flex; align-items: center; background: #111827; border: 1px solid #374151; border-radius: 8px; padding-left: 15px; color: #9ca3af; font-size: 13px;">
            <input type="text" name="postal_code"
            style="background: transparent; border: none; color: white; padding: 12px; width: 100%; outline: none;"
            placeholder="Contoh: 65134" required>
        </div>
    </div>
    
    <div class="form-group">
    <label class="form-label">Logo Toko</label>
    
    <div class="upload-area" id="uploadArea" onclick="document.getElementById('logo_input').click()" style="position: relative; overflow: hidden; min-height: 150px; display: flex; align-items: center; justify-content: center; flex-direction: column;">
        
        <div id="uploadPlaceholder" style="text-align: center;">
            <i class="fa-solid fa-cloud-arrow-up" style="font-size: 30px; color: #6366f1; margin-bottom: 10px;"></i>
            <p style="font-size: 13px; color: #d1d5db;">Klik untuk upload Logo</p>
            <span style="font-size: 11px; color: #6b7280;">Format: JPG, PNG (Max 2MB)</span>
        </div>

        <img id="logoPreview" src="#" alt="Preview Logo" style="display: none; max-width: 100%; max-height: 200px; object-fit: contain; position: absolute; top:0; left: 0; width: 100%; height: 100%; background: #111827;">

        <input type="file" name="logo" id="logo_input" accept="image/*" style="display: none;" onchange="previewLogo(this)">
    </div>
</div>

<script>
    function previewLogo(input) {
        const placeholder = document.getElementById('uploadPlaceholder');
        const preview = document.getElementById('logoPreview');
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                // Tampilkan gambar dan sembunyikan placeholder
                preview.src = e.target.result;
                preview.style.display = 'block';
                placeholder.style.display = 'none';
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
                    <div class="checkbox-container" style="margin-top: 20px;">
                        <label style="display: flex; align-items: center; gap: 10px; cursor: pointer;">
                            <input type="checkbox" required style="width: 16px; height: 16px;">
                            <span class="text" style="color: #9ca3af; font-size: 13px;">Saya menyetujui Syarat & Ketentuan
                                Penjual.</span>
                        </label>
                    </div>

                    <button type="submit" class="submit-btn" style="background: #6366f1; color: white; margin-top: 20px;">
                        <i class="fa-solid fa-paper-plane"></i> Ajukan Pendaftaran Toko
                    </button>

                </form>

            @endif
        </div>
    </div>

</body>

</html>