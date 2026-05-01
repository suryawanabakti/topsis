<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — SPK TOPSIS Penerima BLT Desa Turungan Baji</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }

        .bg-pattern {
            background-color: #1e1b4b;
            background-image:
                radial-gradient(ellipse at 20% 50%, rgba(99, 102, 241, 0.3) 0%, transparent 60%),
                radial-gradient(ellipse at 80% 20%, rgba(139, 92, 246, 0.25) 0%, transparent 50%),
                radial-gradient(ellipse at 60% 80%, rgba(59, 130, 246, 0.2) 0%, transparent 50%);
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .input-dark {
            background: rgba(255,255,255,0.07);
            border: 1px solid rgba(255,255,255,0.15);
            color: white;
            transition: border-color 0.2s, background 0.2s;
        }
        .input-dark::placeholder { color: rgba(255,255,255,0.35); }
        .input-dark:focus {
            outline: none;
            border-color: rgba(129, 140, 248, 0.8);
            background: rgba(255,255,255,0.1);
            box-shadow: 0 0 0 3px rgba(129, 140, 248, 0.15);
        }

        .btn-glow {
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            box-shadow: 0 4px 24px rgba(99, 102, 241, 0.45);
            transition: all 0.2s ease;
        }
        .btn-glow:hover {
            box-shadow: 0 6px 32px rgba(99, 102, 241, 0.65);
            transform: translateY(-1px);
        }
        .btn-glow:active { transform: translateY(0); }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-12px); }
        }
        @keyframes float2 {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-18px); }
        }
        .float-1 { animation: float 6s ease-in-out infinite; }
        .float-2 { animation: float2 8s ease-in-out infinite 1s; }
        .float-3 { animation: float 7s ease-in-out infinite 2s; }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(24px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .fade-up { animation: fadeUp 0.6s ease both; }
        .fade-up-delay { animation: fadeUp 0.6s ease 0.15s both; }
    </style>
</head>
<body class="bg-pattern min-h-screen flex items-center justify-center px-4 py-10 relative overflow-hidden">

    <!-- Decorative floating blobs -->
    <div class="float-1 absolute top-16 left-10 w-24 h-24 rounded-full bg-indigo-500/20 blur-2xl pointer-events-none"></div>
    <div class="float-2 absolute bottom-20 right-10 w-32 h-32 rounded-full bg-purple-500/20 blur-2xl pointer-events-none"></div>
    <div class="float-3 absolute top-1/2 left-1/4 w-16 h-16 rounded-full bg-blue-400/10 blur-xl pointer-events-none"></div>

    <!-- Decorative circles -->
    <div class="absolute top-0 right-0 w-80 h-80 rounded-full border border-white/5 translate-x-1/2 -translate-y-1/2 pointer-events-none"></div>
    <div class="absolute bottom-0 left-0 w-96 h-96 rounded-full border border-white/5 -translate-x-1/2 translate-y-1/2 pointer-events-none"></div>

    <div class="w-full max-w-md z-10">
        <!-- Logo / Brand -->
        <div class="text-center mb-8 fade-up">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-gradient-to-br from-indigo-500 to-purple-600 shadow-lg shadow-indigo-500/40 mb-4">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
            </div>
            <p class="text-indigo-400 text-xs font-semibold tracking-widest uppercase mb-1">Desa Turungan Baji · Sinjai Barat</p>
            <h1 class="text-2xl font-bold text-white tracking-tight">SPK Penerima BLT</h1>
            <p class="text-indigo-300 text-sm mt-1">Bantuan Langsung Tunai — Metode TOPSIS</p>
        </div>

        <!-- Card -->
        <div class="glass-card rounded-2xl p-8 fade-up-delay">
            <div class="mb-6">
                <h2 class="text-xl font-semibold text-white">Selamat Datang</h2>
                <p class="text-white/50 text-sm mt-1">Masuk ke akun administrator Anda</p>
            </div>

            @if ($errors->any())
            <div class="mb-5 flex items-start gap-3 bg-red-500/10 border border-red-500/30 text-red-300 px-4 py-3 rounded-xl text-sm">
                <svg class="w-4 h-4 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span>{{ $errors->first() }}</span>
            </div>
            @endif

            <form action="/login" method="POST" class="space-y-5">
                @csrf

                <!-- Email -->
                <div>
                    <label class="block text-sm font-medium text-white/70 mb-1.5">Alamat Email</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-3 flex items-center pointer-events-none">
                            <svg class="w-4 h-4 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path></svg>
                        </div>
                        <input
                            id="email"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="admin@gmail.com"
                            required
                            autocomplete="email"
                            class="input-dark w-full pl-10 pr-4 py-3 rounded-xl text-sm"
                        >
                    </div>
                </div>

                <!-- Password -->
                <div>
                    <label class="block text-sm font-medium text-white/70 mb-1.5">Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-3 flex items-center pointer-events-none">
                            <svg class="w-4 h-4 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        </div>
                        <input
                            id="password"
                            type="password"
                            name="password"
                            placeholder="••••••••"
                            required
                            autocomplete="current-password"
                            class="input-dark w-full pl-10 pr-4 py-3 rounded-xl text-sm"
                        >
                    </div>
                </div>

                <!-- Submit -->
                <button type="submit" class="btn-glow w-full py-3 rounded-xl text-white font-semibold text-sm mt-2 flex items-center justify-center gap-2">
                    Masuk ke Dashboard
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                </button>
            </form>
        </div>

        <!-- Footer hint -->
        <p class="text-center text-white/25 text-xs mt-6">
            Desa Turungan Baji, Sinjai Barat &copy; {{ date('Y') }}
        </p>
    </div>

</body>
</html>
