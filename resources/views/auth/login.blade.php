<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Hardware_JosJis</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    
    <style>
        /* CSS Tambahan untuk Error & Status */
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

        .alert-status {
            background: rgba(99, 102, 241, 0.1);
            border: 1px solid #6366f1;
            color: #818cf8;
            padding: 10px;
            border-radius: 8px;
            font-size: 13px;
            margin-bottom: 20px;
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
                    <h2 class="active">Login</h2>
                    <a href="{{ route('register') }}"><h2 class="inactive">Register</h2></a>
                </div>

                @if (session('status'))
                    <div class="alert-status">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="input-group">
                        <i class="fa-regular fa-user input-icon"></i>
                        <input type="email" 
                               name="email" 
                               placeholder="Email Address" 
                               value="{{ old('email') }}" 
                               required 
                               autofocus 
                               autocomplete="username">
                    </div>
                    @error('email')
                        <span class="error-msg">{{ $message }}</span>
                    @enderror

                    <div class="input-group" style="margin-top: 15px;">
                        <i class="fa-solid fa-lock input-icon"></i>
                        <input type="password" 
                               name="password" 
                               placeholder="Password" 
                               required 
                               autocomplete="current-password">
                    </div>
                    @error('password')
                        <span class="error-msg">{{ $message }}</span>
                    @enderror

                    <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 15px; font-size: 12px; color: #9ca3af;">
                        <label style="cursor: pointer; display: flex; align-items: center; gap: 5px;">
                            <input type="checkbox" name="remember" style="accent-color: #6366f1;"> 
                            Remember me
                        </label>
                        
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" style="color: #6366f1; text-decoration: none; transition: 0.3s;">
                                Lupa Password?
                            </a>
                        @endif
                    </div>

                    <div class="action-row" style="margin-top: 25px;">
                        <button type="submit" class="submit-btn login-width">
                            Login
                        </button>
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