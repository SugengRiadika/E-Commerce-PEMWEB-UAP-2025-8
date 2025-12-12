<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Hardware_JosJis</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    
    <style>
        .tab-header { display: flex; gap: 20px; margin-bottom: 30px; }
        .tab-header h2 { cursor: pointer; border-bottom: 2px solid transparent; padding-bottom: 5px; color: #6b7280; font-size: 20px; }
        .tab-header h2.active { color: #fff; border-bottom-color: #6366f1; }
        .tab-header a { text-decoration: none; }
        
        .error-msg { 
            color: #ef4444; 
            font-size: 12px; 
            margin-top: 5px; 
            display: block; 
            text-align: left;
        }
    </style>
</head>
<body>

    <div class="card-container">
        
        <div class="left-section">
            
            <nav class="top-nav">
                <div class="logo">
                    <img src="{{ asset('ImageSource/josjis_logo.png') }}" alt="Logo" style="height: 40px; width: auto;">
                    <span class="logo-text">Hardware_JosJis</span>
                </div>
            </nav>

            <div class="form-content">
                
                <div class="tab-header">
                    <a href="{{ route('login') }}"><h2 class="inactive">Login</h2></a>
                    <h2 class="active">Register</h2>
                </div>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="input-group">
                        <i class="fa-regular fa-id-card input-icon"></i>
                        <input type="text" 
                               name="name" 
                               placeholder="Nama Lengkap" 
                               value="{{ old('name') }}" 
                               required 
                               autofocus 
                               autocomplete="name">
                    </div>
                    @error('name')
                        <span class="error-msg">{{ $message }}</span>
                    @enderror

                    <div class="input-group" style="margin-top: 15px;">
                        <i class="fa-regular fa-envelope input-icon"></i>
                        <input type="email" 
                               name="email" 
                               placeholder="Email Address" 
                               value="{{ old('email') }}" 
                               required 
                               autocomplete="username">
                    </div>
                    @error('email')
                        <span class="error-msg">{{ $message }}</span>
                    @enderror

                    <div class="input-group" style="margin-top: 15px;">
                        <i class="fa-solid fa-phone input-icon"></i>
                        <input type="text" 
                               name="phone_number" 
                               placeholder="Nomor Telepon / WhatsApp" 
                               value="{{ old('phone_number') }}" 
                               required 
                               autocomplete="phone_number">
                    </div>
                    @error('phone_number')
                        <span class="error-msg">{{ $message }}</span>
                    @enderror

                    <div class="input-group" style="margin-top: 15px;">
                        <i class="fa-solid fa-lock input-icon"></i>
                        <input type="password" 
                               name="password" 
                               placeholder="Password (Min. 8 karakter)" 
                               required 
                               autocomplete="new-password">
                    </div>
                    @error('password')
                        <span class="error-msg">{{ $message }}</span>
                    @enderror

                    <div class="input-group" style="margin-top: 15px;">
                        <i class="fa-solid fa-lock input-icon"></i>
                        <input type="password" 
                               name="password_confirmation" 
                               placeholder="Ulangi Password" 
                               required 
                               autocomplete="new-password">
                    </div>
                    @error('password_confirmation')
                         <span class="error-msg">{{ $message }}</span>
                    @enderror

                    <div class="action-row" style="margin-top: 25px;">
                        <button type="submit" class="submit-btn login-width">
                            Daftar Akun
                        </button>
                    </div>

                    <div style="margin-top: 15px; text-align: center; font-size: 13px; color: #9ca3af;">
                        Sudah punya akun? <a href="{{ route('login') }}" style="color: #6366f1; text-decoration: none;">Login disini</a>
                    </div>
                </form>
            </div>
        </div>

        <div class="right-section-auth">
            <img src="{{ asset('ImageSource/landing_page_josjis.png') }}" alt="Hardware_JosJis Big Logo">
        </div>

    </div>

</body>
</html>