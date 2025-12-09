<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pengguna - Admin Panel</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>
<body class="dashboard-body">

    <nav class="navbar" style="border-bottom: 1px solid #ef4444;">
        <div class="nav-container" style="max-width: 1400px;">
            <div class="logo">
                <div class="logo-icon" style="color: #ef4444;"><i class="fa-solid fa-shield-halved"></i></div>
                <span class="logo-text">Admin Panel Control</span>
            </div>
            <div class="nav-actions">
                <div class="info-item" style="border:none; margin:0; padding:0; text-align:right;">
                    <small style="color:#9ca3af;">Login sebagai,</small>
                    <span style="color:#fff; font-weight:600;">{{Auth::user()->name}} </span>
                </div>
                <div class="trx-img" style="width: 35px; height: 35px; font-size: 1rem; color: #ef4444;">
                    <i class="fa-solid fa-user-shield"></i>
                </div>
            </div>
        </div>
    </nav>
    <div class="admin-container">
        <aside class="sidebar-left">
            <div class="card card-sidebar">
                <div class="card-header-sm">
                    <h3>Menu Utama</h3>
                </div>
                <ul class="category-list">
                    <li><a href="/admin/dashboard" class="active" style=" color: white;"><i
                                class="fa-solid fa-gauge-high" style="width: 25px;"></i> Dashboard</a></li>
                    <li
                        style="margin-top: 15px; font-size: 11px; color: #ef4444; font-weight: bold; padding-left: 15px;">
                        VERIFIKASI</li>
                    <li><a href="/admin/verifikasi"><i class="fa-solid fa-check-double" style="width: 25px;"></i>
                            Verifikasi Toko <span class="badge bg-pending" style="float: right; font-size: 10px;">{{
                                $totalPendingStores }}
                                Toko</span></a></li>
                    <li
                        style="margin-top: 15px; font-size: 11px; color: #ef4444; font-weight: bold; padding-left: 15px;">
                        MANAJEMEN DATA</li>
                    <li><a href="/admin/users"><i class="fa-solid fa-users" style="width: 25px;"></i> Data Pengguna</a>
                    </li>
                    <li><a href="/admin/stores" style="background: #374151;"><i class="fa-solid fa-store" style="width: 25px;"></i> Data Toko</a>
                    </li>
                    <li style="margin-top: 15px; font-size: 11px; color: #6b7280; padding-left: 15px;">SYSTEM</li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <li><a href="route('logout')" onclick="event.preventDefault();
                                                this.closest('form').submit();" style="color: #f87171;"><i
                                    class="fa-solid fa-power-off" style="width: 25px;"></i>
                                {{ __('Log out') }}</a></li>
                    </form>
                </ul>
            </div>
        </aside>

        <main class="content-center">
            
            <div class="section-header page-title">
                <h3>Edit Data Pengguna</h3>
            </div>

            <div class="card">
                <div class="card-header-sm" style="margin-bottom: 20px;">
                    <h3>Form Perubahan Data</h3>
                    <p style="font-size: 12px; color: #9ca3af;">Silakan update informasi pengguna di bawah ini.</p>
                </div>

                <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label class="form-label">Nama Lengkap</label>
                        <div style="position: relative;">
                            <input type="text" class="form-input" name="name" value="{{ $user->name }}" required placeholder="Masukkan nama lengkap">
                            <i class="fa-regular fa-user" style="position: absolute; right: 15px; top: 50%; transform: translateY(-50%); color: #6b7280;"></i>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Alamat Email</label>
                        <div style="position: relative;">
                            <input type="email" class="form-input" name="email" value="{{ $user->email }}" required placeholder="example@mail.com">
                            <i class="fa-regular fa-envelope" style="position: absolute; right: 15px; top: 50%; transform: translateY(-50%); color: #6b7280;"></i>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Nomor HP / WhatsApp</label>
                        <div style="position: relative;">
                            <input type="text" class="form-input" name="phone_number" value="{{ $user->phone_number }}" placeholder="08..." required>
                            <i class="fa-solid fa-phone" style="position: absolute; right: 15px; top: 50%; transform: translateY(-50%); color: #6b7280;"></i>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Role / Peran Akun</label>
                        <select class="form-select" name="role">
                            <option value="member" {{ $user->role == 'member' ? 'selected' : '' }}>Member</option>
                            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                        <small style="color: #9ca3af; font-size: 11px; margin-top: 5px; display: block;">
                            *Mengubah role menjadi Seller akan membuka fitur Toko untuk user ini.
                        </small>
                    </div>

                    <hr style="border: 0; border-top: 1px solid #374151; margin: 25px 0;">

                    <div style="display: flex; gap: 15px;">
    <button type="submit" class="submit-btn" style="background-color: #059669; color: white; flex: 1;">
        <i class="fa-solid fa-save"></i> Simpan Perubahan
    </button>
    
    <a href="{{ route('admin.users') }}" class="submit-btn" style="background-color: #374151; color: #d1d5db; text-decoration: none; text-align: center; flex: 1; display: flex; align-items: center; justify-content: center;">
        Batal
    </a>
</div>
                </form>
                </div>
        </main>
    </div>

</body>
</html>