<!DOCTYPE html>
<html lang="id" class="dark">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'TRACE-S // Cognitive Defense Platform')</title>

  <!-- Google Fonts: Inter & JetBrains Mono -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=JetBrains+Mono:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <!-- FontAwesome 6 -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

  <!-- Tailwind CSS via CDN with Tactical Tokens -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      darkMode: 'class',
      theme: {
        extend: {
          fontFamily: {
            sans: ['Inter', 'sans-serif'],
            mono: ['"JetBrains Mono"', 'monospace'],
          },
          colors: {
            slate: {
              850: '#141c2e',
              900: '#0f172a',
              925: '#0b0f19',
              950: '#070a12',
            },
            neutral: {
              850: '#141c2e',
              900: '#0f172a',
              950: '#0b0f19',
            }
          }
        }
      }
    }
  </script>

  <style>
    /* Tactical extreme dark mode adjustments */
    body {
      background-color: #0b0f19;
      color: #cbd5e1;
      font-family: 'Inter', sans-serif;
    }
    .font-mono {
      font-family: 'JetBrains Mono', monospace;
    }
    /* Custom tactful scrollbars */
    ::-webkit-scrollbar {
      width: 5px;
      height: 5px;
    }
    ::-webkit-scrollbar-track {
      background: #0b0f19;
    }
    ::-webkit-scrollbar-thumb {
      background: #1e293b;
      border-radius: 2px;
    }
    ::-webkit-scrollbar-thumb:hover {
      background: #334155;
    }
    @keyframes radar-ripple {
      0% { transform: scale(0.6); opacity: 0.9; }
      100% { transform: scale(2.8); opacity: 0; }
    }
    .animate-radar-ripple {
      animation: radar-ripple 2.4s cubic-bezier(0, 0.2, 0.8, 1) infinite;
    }
  </style>
  @stack('styles')
</head>
<body class="bg-[#0b0f19] text-slate-300 min-h-screen flex flex-col antialiased selection:bg-blue-500/30 selection:text-blue-200">

  <!-- START: TOP BAR -->
  <header class="h-14 bg-[#0d131f] border-b border-slate-800/80 px-4 flex items-center justify-between shrink-0 select-none z-30">
    <div class="flex items-center gap-3">
      <div class="w-8 h-8 rounded-lg bg-blue-600/20 border border-blue-500/40 flex items-center justify-center text-blue-400 shadow-[0_0_12px_rgba(59,130,246,0.3)]">
        <i class="fa-solid fa-shield-halved text-sm"></i>
      </div>
      <div>
        <div class="flex items-center gap-2">
          <span class="font-bold tracking-wider text-sm text-white">TRACE-S</span>
          <span class="text-[9px] font-mono tracking-widest text-cyan-400 px-1.5 py-0.2 border border-cyan-500/30 bg-cyan-950/40 rounded">C4ISR</span>
          <span class="text-[9px] font-mono tracking-widest text-amber-400 px-1.5 py-0.2 border border-amber-500/40 bg-amber-950/30 rounded">SIMULASI</span>
        </div>
        <div class="text-[9px] font-mono uppercase tracking-widest text-slate-400 leading-none">
          SOCIAL CYBER INTELLIGENCE
        </div>
      </div>
    </div>

    <!-- Center Clock, Coordinates & Status Indicators -->
    <div class="hidden lg:flex items-center gap-6 font-mono text-xs">
      <div class="flex items-center gap-2 text-slate-300">
        <i class="fa-regular fa-clock text-slate-400 text-xs"></i>
        <span id="utc-clock" class="tracking-wide">UTC 00:42:17 Mon, 03 Nov 2025</span>
      </div>
      <div class="text-slate-700 text-xs">|</div>
      <div class="flex items-center gap-2">
        <span class="relative flex h-2 w-2">
          <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
          <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
        </span>
        <span class="text-slate-300 text-[11px]">Secure Link <b class="text-emerald-400 font-normal">Operational</b></span>
      </div>
      <div class="text-slate-700 text-xs">|</div>
      <div class="flex items-center gap-2">
        <span class="relative flex h-2 w-2">
          <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
          <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
        </span>
        <span class="text-slate-300 text-[11px]">AI Server <b class="text-emerald-400 font-bold">ONLINE</b></span>
      </div>
      <div class="text-slate-700 text-xs">|</div>
      <div class="px-2.5 py-1 bg-slate-800/80 border border-slate-700/70 rounded-full text-[11px] text-slate-300 flex items-center gap-1.5">
        <i class="fa-solid fa-microchip text-blue-400 text-[10px]"></i>
        <span>Model: <b class="text-blue-400 font-semibold">Llama-3.1-70B</b></span>
      </div>
    </div>

    <!-- Right Controls: Status Link & User Profile -->
    <div class="flex items-center gap-3">
      <!-- User Clearance Badge -->
      @auth
      <div class="relative" id="user-menu-wrapper">
        <button id="user-menu-btn" class="flex items-center gap-2.5 px-3 py-1.5 rounded-lg bg-slate-800/50 hover:bg-slate-800 border border-slate-700/70 transition-colors text-left" aria-label="Menu Pengguna">
          <div class="w-7 h-7 rounded-full bg-blue-600/20 border border-blue-500/40 flex items-center justify-center text-xs text-blue-400">
            <i class="fa-solid fa-user"></i>
          </div>
          <div class="leading-tight hidden sm:block">
            <div class="text-xs font-semibold text-slate-100">{{ Auth::user()->name }}</div>
            <div class="text-[10px] text-slate-400 font-mono">Level: {{ Auth::user()->roleLabel() }}</div>
          </div>
          <i class="fa-solid fa-chevron-down text-[10px] text-slate-400 ml-1"></i>
        </button>

        <div id="user-dropdown" class="hidden absolute right-0 mt-2 w-64 bg-slate-900 border border-slate-800 rounded-xl shadow-2xl p-2 z-50 text-xs font-sans">
          <div class="px-2.5 py-1.5 border-b border-slate-800 mb-1">
            <div class="text-[10px] uppercase tracking-wider text-slate-400 font-mono">Beralih Peran (Evaluasi Juri):</div>
          </div>
          <div class="space-y-1">
            <form action="{{ route('login.quick') }}" method="POST">
              @csrf
              <input type="hidden" name="role" value="operator">
              <button type="submit" class="w-full text-left px-2.5 py-1.5 rounded-lg hover:bg-slate-800 text-xs flex items-center justify-between {{ Auth::user()->role === 'operator' ? 'text-blue-400 font-bold bg-blue-950/30' : 'text-slate-300' }}">
                <span><i class="fa-solid fa-desktop w-4 text-center mr-1 text-slate-400"></i> Operator (Level-1)</span>
                @if(Auth::user()->role === 'operator') <i class="fa-solid fa-check text-[10px]"></i> @endif
              </button>
            </form>
            <form action="{{ route('login.quick') }}" method="POST">
              @csrf
              <input type="hidden" name="role" value="analis">
              <button type="submit" class="w-full text-left px-2.5 py-1.5 rounded-lg hover:bg-slate-800 text-xs flex items-center justify-between {{ Auth::user()->role === 'analis' ? 'text-blue-400 font-bold bg-blue-950/30' : 'text-slate-300' }}">
                <span><i class="fa-solid fa-magnifying-glass-chart w-4 text-center mr-1 text-blue-400"></i> Analis (Level-2)</span>
                @if(Auth::user()->role === 'analis') <i class="fa-solid fa-check text-[10px]"></i> @endif
              </button>
            </form>
            <form action="{{ route('login.quick') }}" method="POST">
              @csrf
              <input type="hidden" name="role" value="komandan">
              <button type="submit" class="w-full text-left px-2.5 py-1.5 rounded-lg hover:bg-slate-800 text-xs flex items-center justify-between {{ Auth::user()->role === 'komandan' ? 'text-blue-400 font-bold bg-blue-950/30' : 'text-slate-300' }}">
                <span><i class="fa-solid fa-star w-4 text-center mr-1 text-slate-400"></i> Komandan (Level-3)</span>
                @if(Auth::user()->role === 'komandan') <i class="fa-solid fa-check text-[10px]"></i> @endif
              </button>
            </form>
            <form action="{{ route('login.quick') }}" method="POST">
              @csrf
              <input type="hidden" name="role" value="admin">
              <button type="submit" class="w-full text-left px-2.5 py-1.5 rounded-lg hover:bg-slate-800 text-xs flex items-center justify-between {{ Auth::user()->role === 'admin' ? 'text-blue-400 font-bold bg-blue-950/30' : 'text-slate-300' }}">
                <span><i class="fa-solid fa-server w-4 text-center mr-1 text-slate-400"></i> Administrator (Level-4)</span>
                @if(Auth::user()->role === 'admin') <i class="fa-solid fa-check text-[10px]"></i> @endif
              </button>
            </form>
          </div>
          <div class="border-t border-slate-800 mt-2 pt-1">
            <form action="{{ route('logout') }}" method="POST">
              @csrf
              <button type="submit" class="w-full text-left px-2.5 py-1.5 rounded-lg hover:bg-rose-950/40 text-rose-400 text-xs flex items-center gap-2">
                <i class="fa-solid fa-arrow-right-from-bracket w-4 text-center"></i>
                <span>Keluar Sesi Terminal</span>
              </button>
            </form>
          </div>
        </div>
      </div>
      @endauth
    </div>
  </header>
  <!-- END: TOP BAR -->

  <!-- START: BODY (SIDEBAR + MAIN) -->
  <div class="flex-1 flex overflow-hidden">

    <!-- START: LEFT SIDEBAR -->
    <aside class="w-64 bg-[#0d131f] border-r border-slate-800/80 flex flex-col justify-between shrink-0 select-none overflow-y-auto">
      <div class="py-3 px-3 space-y-4">
        
        <!-- Category 1: INTELLIGENCE -->
        <div>
          <div class="px-3 pb-1 text-[10px] uppercase tracking-wider text-slate-400 font-mono font-semibold">INTELLIGENCE</div>
          <nav class="space-y-0.5">
            <a href="{{ route('dashboard') }}" class="w-full flex items-center gap-3 px-3 py-2 rounded-lg border-l-2 text-xs transition-colors {{ request()->routeIs('dashboard*') ? 'border-blue-500 bg-blue-600/15 text-blue-300 font-medium' : 'border-transparent text-slate-400 hover:bg-slate-800/60 hover:text-slate-200' }}">
              <i class="fa-solid fa-chart-line w-4 text-center text-blue-400"></i>
              <span class="flex-1 text-left">Early Warning Dashboard</span>
              <span class="w-1.5 h-1.5 rounded-full bg-blue-400 animate-pulse"></span>
            </a>
          </nav>
        </div>

        <!-- Category 2: ANALYSIS -->
        <div>
          <div class="px-3 pb-1 text-[10px] uppercase tracking-wider text-slate-400 font-mono font-semibold">ANALYSIS</div>
          <nav class="space-y-0.5">
            <a href="{{ route('scanner.index') }}" class="w-full flex items-center gap-3 px-3 py-2 rounded-lg border-l-2 text-xs transition-colors {{ request()->routeIs('scanner*') ? 'border-blue-500 bg-blue-600/15 text-blue-300 font-medium' : 'border-transparent text-slate-400 hover:bg-slate-800/60 hover:text-slate-200' }}">
              <i class="fa-solid fa-magnifying-glass w-4 text-center"></i>
              <span class="flex-1 text-left">Credibility Scanner</span>
            </a>
            <a href="{{ route('network.index') }}" class="w-full flex items-center gap-3 px-3 py-2 rounded-lg border-l-2 text-xs transition-colors {{ request()->routeIs('network*') ? 'border-blue-500 bg-blue-600/15 text-blue-300 font-medium' : 'border-transparent text-slate-400 hover:bg-slate-800/60 hover:text-slate-200' }}">
              <i class="fa-solid fa-circle-nodes w-4 text-center"></i>
              <span class="flex-1 text-left">Threat Actor Network</span>
            </a>
            <a href="{{ route('sentiment.index') }}" class="w-full flex items-center gap-3 px-3 py-2 rounded-lg border-l-2 text-xs transition-colors {{ request()->routeIs('sentiment*') ? 'border-violet-500 bg-violet-950/30 text-violet-300 font-medium' : 'border-transparent text-slate-400 hover:bg-slate-800/60 hover:text-slate-200' }}">
              <i class="fa-solid fa-heart-pulse w-4 text-center text-violet-400"></i>
              <span class="flex-1 text-left">Sentiment Analysis</span>
              <span class="text-[9px] px-1 bg-violet-950/60 border border-violet-500/30 text-violet-400 rounded">A2</span>
            </a>
          </nav>
        </div>

        <!-- Category 3: REPORTING -->
        <div>
          <div class="px-3 pb-1 text-[10px] uppercase tracking-wider text-slate-400 font-mono font-semibold">REPORTING</div>
          <nav class="space-y-0.5">
            <a href="{{ route('reports.index') }}" class="w-full flex items-center gap-3 px-3 py-2 rounded-lg border-l-2 text-xs transition-colors {{ request()->routeIs('reports*') ? 'border-blue-500 bg-blue-600/15 text-blue-300 font-medium' : 'border-transparent text-slate-400 hover:bg-slate-800/60 hover:text-slate-200' }}">
              <i class="fa-regular fa-file-lines w-4 text-center"></i>
              <span class="flex-1 text-left">Intelligence Reports</span>
            </a>
            <a href="{{ route('cases.index') }}" class="w-full flex items-center gap-3 px-3 py-2 rounded-lg border-l-2 text-xs transition-colors {{ request()->routeIs('cases*') ? 'border-blue-500 bg-blue-600/15 text-blue-300 font-medium' : 'border-transparent text-slate-400 hover:bg-slate-800/60 hover:text-slate-200' }}">
              <i class="fa-solid fa-folder-closed w-4 text-center"></i>
              <span class="flex-1 text-left">Investigasi Kasus</span>
              <span class="text-[9px] px-1 bg-slate-800 text-cyan-400 rounded font-mono">TS-001</span>
            </a>
          </nav>
        </div>

        <!-- Category 4: AI SYSTEM -->
        <div>
          <div class="px-3 pb-1 text-[10px] uppercase tracking-wider text-slate-400 font-mono font-semibold">AI SYSTEM</div>
          <nav class="space-y-0.5">
            <a href="{{ route('console.index') }}" class="w-full flex items-center gap-3 px-3 py-2 rounded-lg border-l-2 text-xs transition-colors {{ request()->routeIs('console*') ? 'border-blue-500 bg-blue-600/15 text-blue-300 font-medium' : 'border-transparent text-slate-400 hover:bg-slate-800/60 hover:text-slate-200' }}">
              <i class="fa-solid fa-microchip w-4 text-center"></i>
              <span class="flex-1 text-left">AI Analyst Console</span>
            </a>
            @if(Auth::check() && Auth::user()->hasRole('admin'))
            <a href="{{ route('admin.ai.index') }}" class="w-full flex items-center gap-3 px-3 py-2 rounded-lg border-l-2 text-xs transition-colors {{ request()->routeIs('admin.ai*') ? 'border-blue-500 bg-blue-600/15 text-blue-300 font-medium' : 'border-transparent text-slate-400 hover:bg-slate-800/60 hover:text-slate-200' }}">
              <i class="fa-solid fa-gear w-4 text-center"></i>
              <span class="flex-1 text-left">Local AI Management</span>
              <span class="text-[9px] px-1 bg-slate-800 text-slate-400 rounded font-mono">ADMIN ONLY</span>
            </a>
            <a href="{{ route('admin.audit.index') }}" class="w-full flex items-center gap-3 px-3 py-2 rounded-lg border-l-2 text-xs transition-colors {{ request()->routeIs('admin.audit*') ? 'border-blue-500 bg-blue-600/15 text-blue-300 font-medium' : 'border-transparent text-slate-400 hover:bg-slate-800/60 hover:text-slate-200' }}">
              <i class="fa-solid fa-clock-rotate-left w-4 text-center"></i>
              <span class="flex-1 text-left">Audit Log (Immutable)</span>
            </a>
            @endif
          </nav>
        </div>

      </div>

      <!-- Bottom Card in Sidebar (Matching Reference UI) -->
      <div class="p-3 border-t border-slate-800/80 bg-slate-950/60 select-none">
        <div class="p-3 bg-slate-900/90 border border-slate-800 rounded-xl relative overflow-hidden">
          <div class="absolute -right-3 -bottom-3 w-14 h-14 bg-blue-500/10 rounded-full blur-xl pointer-events-none"></div>
          <div class="flex items-center gap-2 mb-1">
            <div class="w-6 h-6 rounded-md bg-blue-500/20 border border-blue-500/30 flex items-center justify-center text-blue-400 text-xs">
              <i class="fa-solid fa-shield-halved"></i>
            </div>
            <span class="text-xs font-bold text-white tracking-wider">TRACE-S</span>
          </div>
          <div class="text-[9px] font-mono text-slate-400 uppercase tracking-wider mb-2">
            SOCIAL CYBER INTELLIGENCE PLATFORM
          </div>
          <div class="text-[10px] text-slate-400 leading-relaxed font-sans">
            Monitor. Analyze. Verify.<br>
            <span class="text-blue-400 font-semibold">Deliver Intelligence.</span>
          </div>
        </div>
      </div>
    </aside>
    <!-- END: LEFT SIDEBAR -->

    <!-- START: MAIN CONTENT -->
    <main class="flex-1 overflow-y-auto bg-[#0b0f19] relative">

      <!-- Flash Notification Banners -->
      <div class="max-w-7xl mx-auto px-4 pt-3">
        @if(session('success'))
        <div class="mb-3 px-3.5 py-2.5 bg-emerald-950/40 border border-emerald-500/40 text-emerald-400 text-xs font-mono rounded-sm flex items-center justify-between">
          <div class="flex items-center gap-2">
            <i class="fa-solid fa-circle-check"></i>
            <span>{{ session('success') }}</span>
          </div>
          <button onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-300"><i class="fa-solid fa-xmark"></i></button>
        </div>
        @endif

        @if(session('error'))
        <div class="mb-3 px-3.5 py-2.5 bg-rose-950/40 border border-rose-600/50 text-rose-400 text-xs font-mono rounded-sm flex items-center justify-between">
          <div class="flex items-center gap-2">
            <i class="fa-solid fa-triangle-exclamation"></i>
            <span>{{ session('error') }}</span>
          </div>
          <button onclick="this.parentElement.remove()" class="text-rose-500 hover:text-rose-300"><i class="fa-solid fa-xmark"></i></button>
        </div>
        @endif

        @if(session('warning'))
        <div class="mb-3 px-3.5 py-2.5 bg-amber-950/40 border border-amber-500/40 text-amber-400 text-xs font-mono rounded-sm flex items-center justify-between">
          <div class="flex items-center gap-2">
            <i class="fa-solid fa-circle-exclamation"></i>
            <span>{{ session('warning') }}</span>
          </div>
          <button onclick="this.parentElement.remove()" class="text-amber-500 hover:text-amber-300"><i class="fa-solid fa-xmark"></i></button>
        </div>
        @endif
      </div>

      <!-- Content Yield -->
      <div class="p-4 lg:p-6 max-w-7xl mx-auto space-y-5">
        @yield('content')
      </div>
    </main>
    <!-- END: MAIN CONTENT -->

  </div>
  <!-- END: BODY -->

  <!-- Application Script (Vanilla JS Only) -->
  <script>
    // Real-time UTC Clock
    function updateUtcClock() {
      const now = new Date();
      const utcString = now.toUTCString().split(' ')[4] + ' UTC';
      const el = document.getElementById('utc-clock');
      if (el) el.textContent = utcString;
    }
    setInterval(updateUtcClock, 1000);
    updateUtcClock();

    // User Dropdown toggle
    const userMenuBtn = document.getElementById('user-menu-btn');
    const userDropdown = document.getElementById('user-dropdown');
    if (userMenuBtn && userDropdown) {
      userMenuBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        userDropdown.classList.toggle('hidden');
      });
      document.addEventListener('click', (e) => {
        if (!userDropdown.contains(e.target) && !userMenuBtn.contains(e.target)) {
          userDropdown.classList.add('hidden');
        }
      });
    }
  </script>
  @stack('scripts')
</body>
</html>
