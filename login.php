
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Serah Terima & Pengembalian Barang</title>
    <link rel="stylesheet" href="assets/css_login/style.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100">
    <?php
    session_start();
    
    // If already logged in, redirect to appropriate dashboard
    if(isset($_SESSION['role'])) {
        switch($_SESSION['role']) {
            case 'admin':
                header("Location: admin/dashboard_admin.php");
                break;
            case 'super_admin':
                header("Location: super_admin/dashboard_super_admin.php");
                break;
            case 'user':
                header("Location: user/dashboard_user.php");
                break;
        }
        exit();
    }
    ?>
    <div class="min-h-screen flex">
        <!-- Left Panel - Orange -->
        <div class="hidden lg:flex lg:w-1/2 gradient-bg relative overflow-hidden animate-fade-in-left">
            <!-- Decorative circles -->
            <div class="absolute top-0 right-0 w-96 h-96 bg-orange-400/20 rounded-full -translate-y-1/2 translate-x-1/2"></div>
            <div class="absolute bottom-0 left-0 w-80 h-80 bg-orange-800/20 rounded-full translate-y-1/2 -translate-x-1/2"></div>
            
            <!-- Vertical Text -->
            <div class="absolute left-8 top-1/2 -translate-y-1/2 -rotate-90 origin-center">
                <h2 class="text-white/40 tracking-[0.3em] whitespace-nowrap text-xl font-bold">
                    FORM LOGIN
                </h2>
            </div>

            <!-- Content -->
            <div class="relative z-10 flex flex-col items-center justify-center w-full px-16 text-white">
                <div class="text-center space-y-8 animate-scale-in">
                    <div class="space-y-4">
                        <h1 class="text-4xl font-bold uppercase tracking-wide">
                            Sistem Serah Terima &<br />Pengembalian Barang
                        </h1>
                        
                        <!-- Illustration -->
                        <div class="flex justify-center py-8">
                            <div class="relative">
                                <div class="w-64 h-64 bg-white/10 backdrop-blur-sm rounded-3xl flex items-center justify-center shadow-2xl animate-rotate">
                                    <!-- Boxes Icon SVG -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="128" height="128" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="text-white/90">
                                        <path d="M2.97 12.92A2 2 0 0 0 2 14.63v3.24a2 2 0 0 0 .97 1.71l3 1.8a2 2 0 0 0 2.06 0L12 19v-5.5l-5-3-4.03 2.42Z"/>
                                        <path d="m7 16.5-4.74-2.85"/>
                                        <path d="m7 16.5 5-3"/>
                                        <path d="M7 16.5v5.17"/>
                                        <path d="M12 13.5V19l3.97 2.38a2 2 0 0 0 2.06 0l3-1.8a2 2 0 0 0 .97-1.71v-3.24a2 2 0 0 0-.97-1.71L17 10.5l-5 3Z"/>
                                        <path d="m17 16.5-5-3"/>
                                        <path d="m17 16.5 4.74-2.85"/>
                                        <path d="M17 16.5v5.17"/>
                                        <path d="M7.97 4.42A2 2 0 0 0 7 6.13v4.37l5 3 5-3V6.13a2 2 0 0 0-.97-1.71l-3-1.8a2 2 0 0 0-2.06 0l-3 1.8Z"/>
                                        <path d="M12 8 7.26 5.15"/>
                                        <path d="m12 8 4.74-2.85"/>
                                        <path d="M12 13.5V8"/>
                                    </svg>
                                </div>
                                
                                <!-- Floating elements -->
                                <div class="absolute -top-4 -right-4 w-20 h-20 bg-orange-300/30 backdrop-blur-sm rounded-2xl flex items-center justify-center animate-float">
                                    <!-- Package Icon -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-white">
                                        <path d="m7.5 4.27 9 5.15"/>
                                        <path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"/>
                                        <path d="m3.3 7 8.7 5 8.7-5"/>
                                        <path d="M12 22V12"/>
                                    </svg>
                                </div>
                                
                                <div class="absolute -bottom-4 -left-4 w-16 h-16 bg-orange-300/30 backdrop-blur-sm rounded-xl flex items-center justify-center animate-float-slow">
                                    <!-- Arrow Right Icon -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-white">
                                        <path d="M5 12h14"/>
                                        <path d="m12 5 7 7-7 7"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Bottom Features -->
                    <div class="grid grid-cols-3 gap-6 pt-8">
                        <div class="text-center space-y-2">
                            <div class="w-12 h-12 mx-auto bg-white/10 backdrop-blur-sm rounded-xl flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m7.5 4.27 9 5.15"/>
                                    <path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"/>
                                    <path d="m3.3 7 8.7 5 8.7-5"/>
                                    <path d="M12 22V12"/>
                                </svg>
                            </div>
                            <p class="text-sm text-white/80">Kelola Barang</p>
                        </div>
                        <div class="text-center space-y-2">
                            <div class="w-12 h-12 mx-auto bg-white/10 backdrop-blur-sm rounded-xl flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M5 12h14"/>
                                    <path d="m12 5 7 7-7 7"/>
                                </svg>
                            </div>
                            <p class="text-sm text-white/80">Serah Terima</p>
                        </div>
                        <div class="text-center space-y-2">
                            <div class="w-12 h-12 mx-auto bg-white/10 backdrop-blur-sm rounded-xl flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M2.97 12.92A2 2 0 0 0 2 14.63v3.24a2 2 0 0 0 .97 1.71l3 1.8a2 2 0 0 0 2.06 0L12 19v-5.5l-5-3-4.03 2.42Z"/>
                                    <path d="m7 16.5-4.74-2.85"/>
                                    <path d="m7 16.5 5-3"/>
                                    <path d="M7 16.5v5.17"/>
                                    <path d="M12 13.5V19l3.97 2.38a2 2 0 0 0 2.06 0l3-1.8a2 2 0 0 0 .97-1.71v-3.24a2 2 0 0 0-.97-1.71L17 10.5l-5 3Z"/>
                                    <path d="m17 16.5-5-3"/>
                                    <path d="m17 16.5 4.74-2.85"/>
                                    <path d="M17 16.5v5.17"/>
                                    <path d="M7.97 4.42A2 2 0 0 0 7 6.13v4.37l5 3 5-3V6.13a2 2 0 0 0-.97-1.71l-3-1.8a2 2 0 0 0-2.06 0l-3 1.8Z"/>
                                    <path d="M12 8 7.26 5.15"/>
                                    <path d="m12 8 4.74-2.85"/>
                                    <path d="M12 13.5V8"/>
                                </svg>
                            </div>
                            <p class="text-sm text-white/80">Pengembalian</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Panel - White/Login Form -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-8 lg:p-16 bg-white">
            <div class="w-full max-w-md animate-fade-in-right">
                <!-- Mobile Logo/Title -->
                <div class="lg:hidden text-center mb-8">
                    <div class="w-16 h-16 mx-auto bg-gradient-to-br from-orange-500 to-orange-600 rounded-2xl flex items-center justify-center mb-4 shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-white">
                            <path d="m7.5 4.27 9 5.15"/>
                            <path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"/>
                            <path d="m3.3 7 8.7 5 8.7-5"/>
                            <path d="M12 22V12"/>
                        </svg>
                    </div>
                    <h1 class="text-2xl font-bold text-orange-600 mb-2">
                        Sistem Serah Terima & Pengembalian Barang
                    </h1>
                </div>

                <div class="space-y-6">
                    <div>
                        <h2 class="text-3xl font-bold text-slate-900 mb-2">Login</h2>
                        <p class="text-sm text-slate-500">
                            Belum punya akun? 
                            <a href="register.php" class="text-orange-600 hover:text-orange-700 font-medium">
                                Buat akun Anda
                            </a>
                        </p>
                    </div>

                    <?php if (isset($error)): ?>
                    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg" role="alert">
                        <p class="text-sm"><?php echo htmlspecialchars($error); ?></p>
                    </div>
                    <?php endif; ?>

                    <form method="POST" action="login_procces.php" class="space-y-5" id="loginForm">
                        <!-- ID Karyawan Field -->
                        <div class="space-y-2">
                            <label for="id_karyawan" class="block text-sm font-medium text-slate-700">
                                ID Karyawan
                            </label>
                            <input
                                type="text"
                                id="id_karyawan"
                                name="id_karyawan"
                                placeholder="Masukkan ID Karyawan"
                                required
                                class="w-full h-12 px-4 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all"
                            />
                        </div>

                        <!-- Password Field -->
                        <div class="space-y-2">
                            <label for="password" class="block text-sm font-medium text-slate-700">
                                Password
                            </label>
                            <div class="relative">
                                <input
                                    type="password"
                                    id="password"
                                    name="password"
                                    placeholder="••••••••"
                                    required
                                    class="w-full h-12 px-4 pr-12 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all"
                                />
                                <button
                                    type="button"
                                    onclick="togglePassword()"
                                    class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 transition-colors"
                                >
                                    <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/>
                                        <circle cx="12" cy="12" r="3"/>
                                    </svg>
                                    <svg id="eyeOffIcon" class="hidden" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M9.88 9.88a3 3 0 1 0 4.24 4.24"/>
                                        <path d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68"/>
                                        <path d="M6.61 6.61A13.526 13.526 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61"/>
                                        <line x1="2" x2="22" y1="2" y2="22"/>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <!-- Remember Me & Forgot Password -->
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-2">
                                <input
                                    type="checkbox"
                                    id="remember"
                                    name="remember"
                                    class="w-4 h-4 text-orange-600 border-slate-300 rounded focus:ring-orange-500"
                                />
                                <label for="remember" class="text-sm text-slate-600 cursor-pointer select-none">
                                    Ingat saya
                                </label>
                            </div>
                            <a href="forgot-password.php" class="text-sm text-orange-600 hover:text-orange-700 font-medium">
                                Lupa password?
                            </a>
                        </div>

                        <!-- Submit Button -->
                        <button
                            type="submit"
                            name="login"
                            id="loginBtn"
                            class="w-full h-12 bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white font-medium rounded-lg shadow-lg shadow-orange-500/30 transition-all duration-300 flex items-center justify-center"
                        >
                            <span id="loginText">Login</span>
                            <div id="loginSpinner" class="hidden w-5 h-5 border-2 border-white/30 border-t-white rounded-full animate-spin"></div>
                        </button>
                    </form>

                    <!-- Divider -->
                    <div class="relative my-6">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-slate-200"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-4 bg-white text-slate-500">
                                Atau masuk dengan
                            </span>
                        </div>
                    </div>

                    <!-- Social Login Buttons -->
                    <div class="grid grid-cols-3 gap-3">
                        <button class="h-11 flex items-center justify-center bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                        </button>
                        <button class="h-11 flex items-center justify-center bg-sky-500 hover:bg-sky-600 text-white rounded-lg transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                            </svg>
                        </button>
                        <button class="h-11 flex items-center justify-center bg-red-600 hover:bg-red-700 text-white rounded-lg transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                                <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                                <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                                <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');
            const eyeOffIcon = document.getElementById('eyeOffIcon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.add('hidden');
                eyeOffIcon.classList.remove('hidden');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('hidden');
                eyeOffIcon.classList.add('hidden');
            }
        }

        // Show loading state on form submit
        document.getElementById('loginForm').addEventListener('submit', function() {
            const loginBtn = document.getElementById('loginBtn');
            const loginText = document.getElementById('loginText');
            const loginSpinner = document.getElementById('loginSpinner');
            
            loginBtn.disabled = true;
            loginText.classList.add('hidden');
            loginSpinner.classList.remove('hidden');
        });
    </script>
</body>
</html>
