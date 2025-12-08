<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hardware_JosJis - Upgrade Your Gear</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href={{asset('style.css')}}>

    <style>
        /* === CUSTOM STYLE KHUSUS LANDING PAGE === */
        /* Kita override sedikit container agar tidak terbagi 3 kolom (sidebar) */
        .landing-container {
            max-width: 90%;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Hero Section Custom */
        .hero-section {
            margin-top: 30px;
            padding: 60px 40px;
            background: linear-gradient(135deg, #1f2937, #111827);
            border: 1px solid #374151;
            border-radius: 30px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            overflow: hidden;
            position: relative;
        }
        
        /* Menggunakan style gradient dari CSS lama untuk aksen */
        .hero-blob {
            position: absolute;
            width: 400px;
            height: 400px;
            background: #6366f1;
            filter: blur(150px);
            opacity: 0.2;
            border-radius: 50%;
            z-index: 0;
        }

        .hero-text { z-index: 1; max-width: 50%; }
        .hero-text h1 { font-size: 48px; line-height: 1.2; margin-bottom: 20px; background: linear-gradient(to right, #fff, #818cf8); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        .hero-text p { font-size: 16px; color: #9ca3af; margin-bottom: 30px; line-height: 1.6; }

        .hero-image { z-index: 1; width:45%; display: flex; justify-content: center; }
        .hero-image img { max-width: 100%; filter: drop-shadow(0 20px 30px rgba(0,0,0,0.5)); transform: rotate(-5deg); transition: 0.5s; }
        .hero-image img:hover { transform: rotate(0deg) scale(1.05); }

        /* Fitur Grid (Reuse style stats-grid tapi di-tweak) */
        .features-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
            margin: 50px 0;
        }
        .feature-card {
            background: #1f2937;
            padding: 30px;
            border-radius: 20px;
            text-align: center;
            border: 1px solid #374151;
            transition: 0.3s;
        }
        .feature-card:hover { transform: translateY(-10px); border-color: #6366f1; }
        .feature-icon { font-size: 40px; color: #6366f1; margin-bottom: 20px; }

        /* Footer Sederhana */
        .landing-footer {
            margin-top: 80px;
            border-top: 1px solid #374151;
            padding: 40px 0;
            text-align: center;
            color: #6b7280;
        }

        /* Responsif */
        @media (max-width: 768px) {
            .hero-section { flex-direction: column; text-align: center; }
            .hero-text { max-width: 100%; margin-bottom: 40px; }
            .hero-image { width: 100%; }
            .features-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body class="dashboard-body">

    <nav class="navbar">
        <div class="nav-container">
            <div class="logo">
                <img src={{asset('ImageSource/josjis_logo.png')}} alt="Logo" style="height: 40px; width: auto;">
                <span class="logo-text">Hardware_JosJis</span>
            </div>
            <ul class="nav-links">
                <li><a href="#" class="active">Beranda</a></li>
                <li><a href="#produk">Produk</a></li>
                <li><a href="#fitur">Keunggulan</a></li>
            </ul>
            <div class="nav-actions">
                <a href="login" class="btn-nav-login" style="background: transparent; color: #fff; border: 1px solid #374151;">Masuk</a>
                <a href="register" class="btn-nav-login" style="background: #6366f1; color: white; border: none;">Daftar</a>
            </div>
        </div>
    </nav>

    <div class="landing-container">

        <section class="hero-section">
            <div class="hero-blob" style="top: -50px; left: -50px;"></div>
            <div class="hero-blob" style="bottom: -50px; right: -50px; background: #ec4899;"></div>

            <div class="hero-text">
                <h1>Upgrade Setup,<br>Level Up Skill.</h1>
                <p>Temukan laptop gaming, peripheral, dan komponen PC terbaik dengan harga yang masuk akal. Garansi resmi, pengiriman aman ke seluruh Indonesia.</p>
                
                <div style="display: flex; gap: 15px;">
                    <a href="login" class="submit-btn" style="width: auto; padding: 15px 40px; background: #6366f1; color: white; text-decoration: none;">Belanja Sekarang</a>
                    <a href="#produk" class="submit-btn" style="width: auto; padding: 15px 30px; background: #374151; color: white; text-decoration: none;">Lihat Katalog</a>
                </div>
            </div>

            <div class="hero-image">
                <img src={{asset('ImageSource/landing_page_josjis.png')}} alt="Laptop Gaming">
            </div>
        </section>

        <section id="fitur">
            <div class="section-header" style="text-align: center; margin-top: 60px;">
                <h3>Kenapa Harus Hardware_JosJis?</h3>
                <p style="color: #9ca3af; font-size: 14px;">Kami memberikan pelayanan terbaik untuk gamers.</p>
            </div>

            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon"><i class="fa-solid fa-medal"></i></div>
                    <h4 style="color: white; margin-bottom: 10px;">Produk 100% Original</h4>
                    <p style="font-size: 13px; color: #9ca3af;">Jaminan uang kembali jika barang palsu. Garansi resmi distributor Indonesia.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon"><i class="fa-solid fa-truck-fast"></i></div>
                    <h4 style="color: white; margin-bottom: 10px;">Pengiriman Kilat</h4>
                    <p style="font-size: 13px; color: #9ca3af;">Packing kayu & bubble wrap tebal. Aman sampai tujuan ke seluruh pelosok.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon"><i class="fa-solid fa-headset"></i></div>
                    <h4 style="color: white; margin-bottom: 10px;">Support 24/7</h4>
                    <p style="font-size: 13px; color: #9ca3af;">Bingung pilih spek? Konsultasikan kebutuhanmu dengan teknisi kami.</p>
                </div>
            </div>
        </section>

        <section id="produk">
            <div class="section-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
                <h3>Rekomendasi Minggu Ini</h3>
                <a href="storeDashboard.html" style="color: #6366f1; text-decoration: none; font-size: 14px;">Lihat Semua &rarr;</a>
            </div>

            <div class="product-grid" style="grid-template-columns: repeat(4, 1fr);"> 
                <div class="card product-card">
                    <div class="product-img">
                        <img src="https://dlcdnwebimgs.asus.com/gain/49D97646-0628-4467-93C0-55D4E8934449" style="width: 100%; height: 100%; object-fit: contain;">
                    </div>
                    <div class="product-info">
                        <h4>ASUS ROG Strix G15</h4>
                        <span class="category-tag">Gaming Laptop</span>
                        <div class="price-row"><span class="price">Rp 27.999.000</span></div>
                    </div>
                </div>

                <div class="card product-card">
                    <div class="product-img">
                        <img src="https://p1-ofp.static.pub/medias/bWFzdGVyfHJvb3R8MzExMjcxfGltYWdlL3BuZ3xoOTgvaGE5LzE0MzMyMjg2NTc4NzE4LnBuZ3w4OThkMzY4NTgxZDY4NmJkYTZjNWUyNzD4ZGU1ZjU4M2E1YmM1YjE2YjY5YjY1YjY5YjY5YjY5.png" style="width: 100%; height: 100%; object-fit: contain;">
                    </div>
                    <div class="product-info">
                        <h4>Lenovo Legion 5</h4>
                        <span class="category-tag">Gaming Laptop</span>
                        <div class="price-row"><span class="price">Rp 21.500.000</span></div>
                    </div>
                </div>

                <div class="card product-card">
                    <div class="product-img">
                        <i class="fa-solid fa-keyboard" style="font-size: 50px; color: #374151;"></i>
                    </div>
                    <div class="product-info">
                        <h4>Keychron K2 Pro</h4>
                        <span class="category-tag">Keyboard</span>
                        <div class="price-row"><span class="price">Rp 1.800.000</span></div>
                    </div>
                </div>

                <div class="card product-card">
                    <div class="product-img">
                        <i class="fa-solid fa-computer-mouse" style="font-size: 50px; color: #374151;"></i>
                    </div>
                    <div class="product-info">
                        <h4>Logitech G Pro X</h4>
                        <span class="category-tag">Mouse</span>
                        <div class="price-row"><span class="price">Rp 1.650.000</span></div>
                    </div>
                </div>
            </div>
        </section>

        <section style="margin-top: 60px;">
            <div class="promo-banner" style="background: linear-gradient(135deg, #059669, #047857);">
                <div class="promo-text">
                    <h2>Spesial Rakit PC</h2>
                    <h1>GRATIS PERAKITAN</h1>
                    <p>Beli komponen lengkap di sini, kami rakitkan gratis + cable management rapi.</p>
                    <button class="btn-pill-white" style="color: #047857;">Konsultasi Sekarang</button>
                </div>
                <div class="promo-icon">
                    <i class="fa-solid fa-screwdriver-wrench"></i>
                </div>
            </div>
        </section>

        <footer class="landing-footer">
            <div class="logo" style="justify-content: center; margin-bottom: 20px;">
                <i class="fa-solid fa-cube" style="color: #6366f1; font-size: 24px;"></i>
                <span class="logo-text" style="font-size: 24px;">Hardware_JosJis</span>
            </div>
            <p>&copy; 2023 Hardware_JosJis. All rights reserved.</p>
            <div style="margin-top: 20px; display: flex; justify-content: center; gap: 20px;">
                <a href="#" style="color: #9ca3af;"><i class="fa-brands fa-instagram"></i></a>
                <a href="#" style="color: #9ca3af;"><i class="fa-brands fa-twitter"></i></a>
                <a href="#" style="color: #9ca3af;"><i class="fa-brands fa-facebook"></i></a>
            </div>
        </footer>

    </div>

</body>
</html>