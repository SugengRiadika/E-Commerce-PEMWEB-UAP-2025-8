<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk - Hardware_JosJis</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    
    <style>
        .form-control {
            width: 100%;
            padding: 12px 15px;
            background-color: #111827;
            border: 1px solid #374151;
            border-radius: 8px;
            color: #fff;
            outline: none;
            font-family: 'Poppins', sans-serif;
            margin-bottom: 5px;
        }
        .form-control:focus { border-color: #f59e0b; }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; color: #d1d5db; margin-bottom: 8px; font-size: 14px; }
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        @media (max-width: 768px) { .form-row { grid-template-columns: 1fr; } }
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
                <li><a href="{{ route('member.transactionHistory') }}">Riwayat Transaksi</a></li>
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
            </div>
        </div>
    </nav>

    <div class="container" style="max-width: 800px; display: block; margin-top: 40px; margin-bottom: 40px;">
        
        <main class="content-center">
            
            <a href="{{ route('member.mystore-m') }}" style="color: #9ca3af; text-decoration: none; font-size: 13px; margin-bottom: 20px; display: inline-block;">
                <i class="fa-solid fa-arrow-left"></i> Kembali ke Manajemen Produk
            </a>

            <div class="card" style="padding: 30px;">
                <div class="section-header" style="margin-bottom: 25px; border-bottom: 1px solid #374151; padding-bottom: 15px;">
                    <h3 style="color: white;"><i class="fa-solid fa-pen-to-square" style="color: #f59e0b;"></i> Edit Produk</h3>
                    <p style="color: #9ca3af; font-size: 13px; margin-top: 5px;">Perbarui informasi produk Anda di sini.</p>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger" style="background: rgba(239, 68, 68, 0.1); color: #f87171; border: 1px solid #ef4444; padding: 15px; border-radius: 8px; margin-bottom: 25px;">
                        <ul style="padding-left: 20px; margin: 0;">
                            @foreach ($errors->all() as $error)
                                <li style="margin-bottom: 5px;">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- PERHATIKAN ROUTE ACTION INI --}}
                <form action="{{ route('member.mystore-m.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-group">
                        <label>Nama Produk</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $product->name) }}" required>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Kategori</label>
                            <select name="product_category_id" class="form-control" required>
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ (old('product_category_id', $product->product_category_id) == $cat->id) ? 'selected' : '' }}>
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Harga (Rp)</label>
                            <input type="number" name="price" class="form-control" value="{{ old('price', $product->price) }}" required>
                            <small style="color:gray; font-size:10px;">*Masukkan dalam ribuan (cth: 15000 = Rp 15.000.000)</small>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Stok Barang</label>
                            <input type="number" name="stock" class="form-control" value="{{ old('stock', $product->stock) }}" required>
                        </div>
                        <div class="form-group">
                            <label>Berat (Gram)</label>
                            <input type="number" name="weight" class="form-control" value="{{ old('weight', $product->weight) }}" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Deskripsi Produk</label>
                        <textarea name="description" class="form-control" rows="5">{{ old('description', $product->description) }}</textarea>
                    </div>

                    <div class="form-group">
                        <label>Foto Produk</label>
                        <div class="upload-area" id="uploadArea" onclick="document.getElementById('image_input').click()" style="position: relative; overflow: hidden; min-height: 200px; display: flex; align-items: center; justify-content: center; flex-direction: column; border: 2px dashed #374151; background: #111827; border-radius: 10px; cursor: pointer; transition: 0.3s;">
                            
                            <div id="uploadPlaceholder" style="text-align: center; display: none;">
                                <i class="fa-solid fa-cloud-arrow-up" style="font-size: 30px; color: #6366f1; margin-bottom: 10px;"></i>
                                <p style="font-size: 13px; color: #d1d5db; margin: 0;">Klik untuk ganti Foto Produk</p>
                                <span style="font-size: 11px; color: #6b7280;">Format: JPG, PNG (Max 2MB)</span>
                            </div>

                            {{-- Preview Gambar Existing --}}
                            <img id="imagePreview" src="{{ asset('ImageSource/' . $product->slug . '.png') }}" alt="Preview" style="display: block; max-width: 100%; max-height: 200px; object-fit: contain; position: absolute; top:0; left: 0; width: 100%; height: 100%; background: #111827;">

                            <input type="file" name="image" id="image_input" accept="image/*" style="display: none;" onchange="previewImage(this)">
                        </div>
                        <small style="color: #6b7280; font-size: 11px; margin-top: 5px;">*Biarkan kosong jika tidak ingin mengubah gambar.</small>
                    </div>

                    <div style="margin-top: 30px; display: flex; gap: 15px;">
                        <button type="submit" class="submit-btn" style="flex: 2; background: #f59e0b; color: white; border: none; padding: 12px; border-radius: 50px; cursor: pointer; font-weight: 600;">
                            <i class="fa-solid fa-save"></i> Perbarui Produk
                        </button>
                        <a href="{{ route('member.mystore-m') }}" class="btn-outline" style="flex: 1; text-decoration: none; text-align: center; padding: 12px; border: 1px solid #374151; color: #d1d5db; border-radius: 50px; display: flex; align-items: center; justify-content: center;">
                            Batal
                        </a>
                    </div>

                </form>
            </div>
        </main>
    </div>

    <script>
        function previewImage(input) {
            const preview = document.getElementById('imagePreview');
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

</body>
</html>