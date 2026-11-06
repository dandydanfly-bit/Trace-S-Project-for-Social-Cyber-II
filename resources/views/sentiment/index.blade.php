@extends('layouts.tactical')

@section('title', 'Modul A2: Sentiment Analysis Dashboard - TRACE-S')

@section('content')
<!-- START: MODUL A2 - SENTIMENT ANALYSIS DASHBOARD -->
<div class="p-6 space-y-6">

  <!-- Header & Case Identification -->
  <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4 pb-4 border-b border-neutral-800">
    <div>
      <div class="flex items-center gap-2 mb-1">
        <span class="text-[10px] font-mono uppercase tracking-widest text-violet-400 px-2 py-0.5 bg-violet-950/40 border border-violet-500/40 rounded-sm">
          MODUL A2 // PERCEPTION & SENTIMENT
        </span>
        <span class="text-[10px] font-mono uppercase tracking-widest text-amber-400 px-2 py-0.5 bg-amber-950/40 border border-amber-500/40 rounded-sm">
          SIMULASI AKTIF
        </span>
        <span class="text-[10px] font-mono text-neutral-500">KASUS: {{ $selectedCase ? $selectedCase->case_code : 'TS-001' }}</span>
      </div>
      <h1 class="text-xl font-bold tracking-tight text-neutral-100 flex items-center gap-2.5">
        <i class="fa-solid fa-heart-pulse text-violet-400 text-lg"></i>
        <span>SENTIMENT DYNAMICS & VELOCITY ALERT DASHBOARD</span>
      </h1>
      <p class="text-xs text-neutral-400 mt-0.5">
        Pemantauan spektrum emosi korpus wacana siber sosial, rasio polaritas, dan deteksi lonjakan sentimen (Velocity Crisis).
      </p>
    </div>

    <!-- Active Case Selector -->
    <div class="flex items-center gap-3">
      <form action="{{ route('sentiment.index') }}" method="GET" class="flex items-center gap-2">
        <label for="case_id" class="text-[11px] font-mono uppercase text-neutral-400">Kasus:</label>
        <select name="case_id" id="case_id" onchange="this.form.submit()" class="bg-neutral-900 border border-neutral-700 text-neutral-200 text-xs rounded-sm px-3 py-1.5 font-mono focus:border-violet-500 focus:outline-none">
          @foreach($cases as $c)
            <option value="{{ $c->id }}" {{ ($selectedCase && $selectedCase->id === $c->id) ? 'selected' : '' }}>
              [{{ $c->case_code }}] {{ Str::limit($c->title, 28) }}
            </option>
          @endforeach
        </select>
      </form>
      <div class="hidden sm:flex items-center gap-2 px-3 py-1.5 bg-violet-950/30 border border-violet-500/30 rounded-sm">
        <i class="fa-solid fa-waveform-lines text-violet-400 text-xs"></i>
        <span class="text-[11px] font-mono text-violet-300">VELOCITY ENGINE: ONLINE</span>
      </div>
    </div>
  </div>

  <!-- START: MANDATORY DISCLAIMER BANNER (PRD v2.0 §8.3 & §10.2B) -->
  <div class="p-3.5 bg-neutral-900 border-l-4 border-violet-500 rounded-sm border border-neutral-800 flex items-start gap-3">
    <div class="w-7 h-7 rounded-sm bg-violet-950/60 border border-violet-500/40 flex items-center justify-center text-violet-400 shrink-0 mt-0.5">
      <i class="fa-solid fa-scale-balanced text-xs"></i>
    </div>
    <div class="flex-1">
      <div class="flex items-center gap-2 mb-1">
        <span class="text-xs font-bold text-violet-300 uppercase tracking-wide font-mono">
          BATASAN CAKUPAN DAN METODOLOGI ETIK (PRD §8.3)
        </span>
        <span class="text-[9px] font-mono bg-violet-950 text-violet-400 px-1.5 py-0.2 border border-violet-500/30 rounded-sm">
          NON-REPRESENTASI NASIONAL
        </span>
      </div>
      <p class="text-xs text-neutral-300 leading-relaxed font-sans">
        <strong class="text-violet-400">CAKUPAN TERBATAS:</strong> Skor polaritas dan emosi yang ditampilkan hanya mencerminkan korpus data yang berhasil dikumpulkan dari akun dan unggahan terpantau pada kasus <span class="font-mono text-neutral-200">[{{ $selectedCase ? $selectedCase->case_code : 'TS-001' }}]</span>. Metrik ini <span class="underline decoration-violet-500">bukan</span> merupakan representasi mutlak dari seluruh opini publik atau populasi warga negara Indonesia. Algoritma mengukur persepsi linguistik agregat tanpa melakukan profiling data pribadi.
      </p>
    </div>
  </div>
  <!-- END: MANDATORY DISCLAIMER BANNER -->

  <!-- Top 4 Summary Metric Cards (Violet Tactical Theme) -->
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
    <!-- Card 1: Polaritas Terkini -->
    <div class="bg-neutral-900 border border-neutral-800 rounded-sm p-4 relative overflow-hidden">
      <div class="absolute top-0 left-0 w-full h-[2px] bg-violet-500"></div>
      <div class="flex items-center justify-between text-neutral-400 mb-2">
        <span class="text-[10px] font-mono uppercase tracking-wider">Polaritas Korpus Terkini</span>
        <i class="fa-solid fa-chart-pie text-violet-400 text-xs"></i>
      </div>
      <div class="flex items-baseline gap-2">
        <span class="text-2xl font-bold font-mono text-rose-400">75%</span>
        <span class="text-xs font-mono text-rose-500 uppercase">Negatif</span>
      </div>
      <div class="mt-2 text-[11px] text-neutral-400 font-mono flex items-center justify-between border-t border-neutral-800 pt-1.5">
        <span>Netral: <strong class="text-neutral-200">20%</strong></span>
        <span>Positif: <strong class="text-emerald-400">5%</strong></span>
      </div>
    </div>

    <!-- Card 2: Velocity Index -->
    <div class="bg-neutral-900 border border-violet-500/30 rounded-sm p-4 relative overflow-hidden bg-violet-950/10">
      <div class="absolute top-0 left-0 w-full h-[2px] bg-rose-500"></div>
      <div class="flex items-center justify-between text-neutral-400 mb-2">
        <span class="text-[10px] font-mono uppercase tracking-wider text-violet-300">Velocity Sebaran</span>
        <span class="w-2 h-2 rounded-full bg-rose-500 animate-ping"></span>
      </div>
      <div class="flex items-baseline gap-2">
        <span class="text-2xl font-bold font-mono text-neutral-100">+98</span>
        <span class="text-xs font-mono text-rose-400">interaksi/jam</span>
      </div>
      <div class="mt-2 text-[11px] text-neutral-400 font-mono flex items-center justify-between border-t border-neutral-800 pt-1.5">
        <span>Ambang Batas: <strong class="text-neutral-300">+30/j</strong></span>
        <span class="text-rose-400 font-bold uppercase">KRISIS TERLAMPAUI</span>
      </div>
    </div>

    <!-- Card 3: Emosi Dominan -->
    <div class="bg-neutral-900 border border-neutral-800 rounded-sm p-4 relative overflow-hidden">
      <div class="absolute top-0 left-0 w-full h-[2px] bg-amber-500"></div>
      <div class="flex items-center justify-between text-neutral-400 mb-2">
        <span class="text-[10px] font-mono uppercase tracking-wider">Emosi Dominan Korpus</span>
        <i class="fa-solid fa-face-angry text-rose-400 text-xs"></i>
      </div>
      <div class="flex items-baseline gap-2">
        <span class="text-xl font-bold font-mono text-amber-400">MARAH / MURKA</span>
      </div>
      <div class="mt-2 text-[11px] text-neutral-400 font-mono flex items-center justify-between border-t border-neutral-800 pt-1.5">
        <span>Pangsa: <strong class="text-amber-300">46% dari korpus</strong></span>
        <span class="text-neutral-500">Leksikal Diksi</span>
      </div>
    </div>

    <!-- Card 4: Platform Terdampak Tertinggi -->
    <div class="bg-neutral-900 border border-neutral-800 rounded-sm p-4 relative overflow-hidden">
      <div class="absolute top-0 left-0 w-full h-[2px] bg-cyan-500"></div>
      <div class="flex items-center justify-between text-neutral-400 mb-2">
        <span class="text-[10px] font-mono uppercase tracking-wider">Vektor Sebaran Tercepat</span>
        <i class="fa-brands fa-x-twitter text-cyan-400 text-xs"></i>
      </div>
      <div class="flex items-baseline gap-2">
        <span class="text-xl font-bold font-mono text-neutral-100">X (Twitter)</span>
        <span class="text-xs font-mono text-rose-400">88% Negatif</span>
      </div>
      <div class="mt-2 text-[11px] text-neutral-400 font-mono flex items-center justify-between border-t border-neutral-800 pt-1.5">
        <span>Volume Pantau: <strong class="text-neutral-300">95 postingan</strong></span>
        <span class="text-amber-400">Bot Amplified</span>
      </div>
    </div>
  </div>

  <!-- Main Analysis Section (2 Column Tactical Grid) -->
  <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    <!-- Column 1 & 2: Main Dynamics (2 Cols on lg) -->
    <div class="lg:col-span-2 space-y-6">

      <!-- Panel 1: 24-Hour Polarity Trend & Velocity Surge -->
      <div class="bg-neutral-900 border border-neutral-800 rounded-sm p-5">
        <div class="flex items-center justify-between pb-3 border-b border-neutral-800 mb-4">
          <div class="flex items-center gap-2">
            <i class="fa-solid fa-chart-area text-violet-400 text-sm"></i>
            <h3 class="font-mono font-bold text-xs uppercase tracking-wider text-neutral-200">
              Riwayat Tren Polaritas Sentimen (24 Jam Terakhir)
            </h3>
          </div>
          <div class="flex items-center gap-3 text-[10px] font-mono">
            <div class="flex items-center gap-1.5"><span class="w-2.5 h-2.5 bg-rose-500 rounded-sm"></span> Negatif</div>
            <div class="flex items-center gap-1.5"><span class="w-2.5 h-2.5 bg-neutral-600 rounded-sm"></span> Netral</div>
            <div class="flex items-center gap-1.5"><span class="w-2.5 h-2.5 bg-emerald-500 rounded-sm"></span> Positif</div>
          </div>
        </div>

        <!-- Visual Stacked Bar Timelines -->
        <div class="space-y-4">
          @foreach($trendSnapshots as $t)
          <div class="p-3 bg-neutral-950 border border-neutral-800/80 rounded-sm hover:border-violet-500/40 transition-colors">
            <div class="flex items-center justify-between text-xs font-mono mb-2">
              <div class="flex items-center gap-2">
                <span class="text-violet-400 font-bold uppercase">{{ $t['time'] }}</span>
                <span class="text-[10px] text-neutral-500">| Korpus: {{ $t['vol'] }} data</span>
              </div>
              <div class="flex items-center gap-3 text-[11px]">
                <span class="text-neutral-400">Velocity: <strong class="text-amber-400">{{ $t['velocity_rate'] }}</strong></span>
                <span class="text-rose-400 font-bold">{{ $t['neg'] }}% Neg</span>
                <span class="text-neutral-400">{{ $t['neu'] }}% Neu</span>
                <span class="text-emerald-400">{{ $t['pos'] }}% Pos</span>
              </div>
            </div>

            <!-- Stacked Bar -->
            <div class="h-3 w-full bg-neutral-900 rounded-sm overflow-hidden flex">
              <div class="bg-rose-500 h-full transition-all duration-500" style="width: {{ $t['neg'] }}%" title="Negatif: {{ $t['neg'] }}%"></div>
              <div class="bg-neutral-600 h-full transition-all duration-500" style="width: {{ $t['neu'] }}%" title="Netral: {{ $t['neu'] }}%"></div>
              <div class="bg-emerald-500 h-full transition-all duration-500" style="width: {{ $t['pos'] }}%" title="Positif: {{ $t['pos'] }}%"></div>
            </div>
          </div>
          @endforeach
        </div>

        <div class="mt-4 p-2.5 bg-violet-950/20 border border-violet-500/20 rounded-sm flex items-center justify-between text-xs font-mono text-neutral-400">
          <div class="flex items-center gap-2">
            <i class="fa-solid fa-circle-info text-violet-400"></i>
            <span>Dinamika: Lonjakan sentimen negatif dari 20% menjadi 75% terjadi dalam rentang 12 jam seiring sinkronisasi tagar terkoordinasi.</span>
          </div>
        </div>
      </div>

      <!-- Panel 2: 5 Emosi Dominan pada Korpus (Linguistic Analysis) -->
      <div class="bg-neutral-900 border border-neutral-800 rounded-sm p-5">
        <div class="flex items-center justify-between pb-3 border-b border-neutral-800 mb-4">
          <div class="flex items-center gap-2">
            <i class="fa-solid fa-brain-circuit text-violet-400 text-sm"></i>
            <h3 class="font-mono font-bold text-xs uppercase tracking-wider text-neutral-200">
              Distribusi 5 Spektrum Emosi Linguistik Korpus
            </h3>
          </div>
          <span class="text-[10px] font-mono text-violet-400 bg-violet-950/40 px-2 py-0.5 border border-violet-500/30 rounded-sm">
            NATURAL LANGUAGE EXTRACTION
          </span>
        </div>

        <div class="space-y-3.5">
          @foreach($emotionBreakdown as $em)
          <div class="p-3 bg-neutral-950 border border-neutral-800/80 rounded-sm">
            <div class="flex items-center justify-between text-xs font-mono mb-1.5">
              <div class="flex items-center gap-2">
                <span class="w-2 h-2 rounded-full {{ $em['color'] }}"></span>
                <span class="text-neutral-200 font-bold">{{ $em['name'] }}</span>
              </div>
              <span class="text-neutral-100 font-bold">{{ $em['pct'] }}%</span>
            </div>
            <!-- Progress Bar -->
            <div class="h-2 w-full bg-neutral-800 rounded-sm overflow-hidden mb-1.5">
              <div class="{{ $em['color'] }} h-full" style="width: {{ $em['pct'] }}%"></div>
            </div>
            <div class="text-[11px] text-neutral-400 font-sans">
              <i class="fa-regular fa-quote-left text-[9px] text-neutral-600 mr-1"></i>
              {{ $em['desc'] }}
            </div>
          </div>
          @endforeach
        </div>
      </div>

      <!-- Panel 3: Sebaran Sentimen Lintas Platform -->
      <div class="bg-neutral-900 border border-neutral-800 rounded-sm p-5">
        <div class="flex items-center justify-between pb-3 border-b border-neutral-800 mb-4">
          <div class="flex items-center gap-2">
            <i class="fa-solid fa-cubes-stacked text-violet-400 text-sm"></i>
            <h3 class="font-mono font-bold text-xs uppercase tracking-wider text-neutral-200">
              Sebaran Sentimen Lintas Platform Terpantau
            </h3>
          </div>
          <span class="text-[10px] font-mono text-neutral-400">Total Korpus: 620 Konten</span>
        </div>

        <div class="overflow-x-auto">
          <table class="w-full text-left font-mono text-xs">
            <thead>
              <tr class="border-b border-neutral-800 text-[10px] text-neutral-500 uppercase tracking-wider">
                <th class="pb-2">Platform Media</th>
                <th class="pb-2">Distribusi Polaritas</th>
                <th class="pb-2 text-right">Volume</th>
                <th class="pb-2 text-right">Status Velocity</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-neutral-800/60">
              @foreach($platformBreakdown as $pb)
              <tr class="hover:bg-neutral-800/30">
                <td class="py-2.5 font-bold text-neutral-200">
                  @if($pb['platform'] === 'Instagram')
                    <i class="fa-brands fa-instagram text-pink-400 mr-1.5"></i> Instagram
                  @elseif($pb['platform'] === 'TikTok')
                    <i class="fa-brands fa-tiktok text-cyan-400 mr-1.5"></i> TikTok
                  @elseif($pb['platform'] === 'X (Twitter)')
                    <i class="fa-brands fa-x-twitter text-neutral-300 mr-1.5"></i> X (Twitter)
                  @else
                    <i class="fa-brands fa-youtube text-rose-500 mr-1.5"></i> YouTube
                  @endif
                </td>
                <td class="py-2.5 pr-4">
                  <div class="flex items-center gap-2">
                    <div class="h-2 w-32 bg-neutral-800 rounded-sm overflow-hidden flex">
                      <div class="bg-rose-500 h-full" style="width: {{ $pb['neg'] }}%"></div>
                      <div class="bg-neutral-600 h-full" style="width: {{ $pb['neu'] }}%"></div>
                      <div class="bg-emerald-500 h-full" style="width: {{ $pb['pos'] }}%"></div>
                    </div>
                    <span class="text-[10px] text-neutral-400">{{ $pb['neg'] }}% Neg</span>
                  </div>
                </td>
                <td class="py-2.5 text-right text-neutral-300 font-bold">
                  {{ $pb['volume'] }}
                </td>
                <td class="py-2.5 text-right">
                  <span class="text-[9px] font-mono px-1.5 py-0.5 rounded-sm {{ $pb['alert'] === 'VELOCITY TINGGI' || $pb['alert'] === 'BOT ANOMALY' ? 'bg-rose-950/60 border border-rose-500/40 text-rose-400' : ($pb['alert'] === 'VIRAL SURGE' ? 'bg-amber-950/60 border border-amber-500/40 text-amber-400' : 'bg-neutral-800 text-neutral-400') }}">
                    {{ $pb['alert'] }}
                  </span>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>

    </div>

    <!-- Column 3: Tactical Side Panels (1 Col on lg) -->
    <div class="space-y-6">

      <!-- Side Box 1: Velocity Crisis Alert (PRD v2.0 §8.3 FR-018) -->
      <div class="bg-neutral-900 border-2 border-violet-500/60 rounded-sm p-4 relative overflow-hidden bg-violet-950/20 shadow-[0_0_15px_rgba(139,92,246,0.15)]">
        <div class="flex items-center justify-between pb-2 border-b border-violet-500/40 mb-3">
          <div class="flex items-center gap-2">
            <span class="w-2.5 h-2.5 rounded-full bg-rose-500 animate-ping"></span>
            <span class="font-mono font-bold text-xs text-violet-300 uppercase tracking-wider">
              TRIGGER // VELOCITY CRISIS ALERT
            </span>
          </div>
          <span class="text-[9px] font-mono bg-rose-950 border border-rose-500/50 text-rose-400 px-1.5 py-0.2 rounded-sm font-bold">
            KRISIS AKTIF
          </span>
        </div>

        <div class="space-y-3">
          <div>
            <div class="text-[10px] font-mono uppercase text-neutral-400 mb-0.5">Indeks Kecepatan Sebaran:</div>
            <div class="text-xl font-bold font-mono text-neutral-100 flex items-baseline gap-2">
              <span>{{ $velocityAlert['velocity_index'] }}</span>
              <span class="text-[10px] font-mono text-rose-400">({{ $velocityAlert['threshold'] }})</span>
            </div>
          </div>

          <div class="p-3 bg-neutral-950 border border-violet-500/30 rounded-sm text-xs font-sans text-neutral-300 leading-relaxed">
            <div class="font-mono text-[10px] text-violet-400 font-bold uppercase mb-1">Analisis Pemicu Otomatis:</div>
            {{ $velocityAlert['recommendation'] }}
          </div>

          <!-- Action Items for Public Communication Defense -->
          <div class="border-t border-violet-500/20 pt-3 space-y-2">
            <div class="text-[10px] font-mono uppercase tracking-wider text-neutral-400">Rekomendasi Tindakan Strategis:</div>
            <div class="flex items-start gap-2 text-[11px] text-neutral-300">
              <span class="font-mono text-violet-400 font-bold">01.</span>
              <span>Rilis klarifikasi resmi faktual via saluran kementerian & Satgas Penerangan.</span>
            </div>
            <div class="flex items-start gap-2 text-[11px] text-neutral-300">
              <span class="font-mono text-violet-400 font-bold">02.</span>
              <span>Publikasikan infografis alokasi riil di feed Instagram & TikTok untuk redam bot.</span>
            </div>
            <div class="flex items-start gap-2 text-[11px] text-neutral-300">
              <span class="font-mono text-violet-400 font-bold">03.</span>
              <span>Eskalasi laporan intel brief PDF ke Komandan Satgas Siber Sosial.</span>
            </div>
          </div>
        </div>
      </div>

      <!-- Side Box 2: Diksi Leksikal & Tagar Utama Korpus -->
      <div class="bg-neutral-900 border border-neutral-800 rounded-sm p-4">
        <div class="flex items-center justify-between pb-2 border-b border-neutral-800 mb-3">
          <span class="font-mono font-bold text-xs text-neutral-300 uppercase tracking-wider">
            Diksi Leksikal & Tagar Korpus
          </span>
          <span class="text-[9px] font-mono text-neutral-500">LEXICAL TOKENS</span>
        </div>

        <div class="space-y-3">
          <div>
            <div class="text-[10px] font-mono uppercase text-rose-400 mb-1.5 flex items-center gap-1.5">
              <i class="fa-solid fa-triangle-exclamation text-[10px]"></i>
              Tagar Pemicu Sentimen Negatif
            </div>
            <div class="flex flex-wrap gap-1.5 font-mono text-xs">
              <span class="px-2 py-1 bg-rose-950/40 border border-rose-500/30 text-rose-300 rounded-sm">#TolakPangkasGizi (412)</span>
              <span class="px-2 py-1 bg-rose-950/40 border border-rose-500/30 text-rose-300 rounded-sm">#DapurBatal (280)</span>
              <span class="px-2 py-1 bg-rose-950/40 border border-rose-500/30 text-rose-300 rounded-sm">#APBNFiktif (145)</span>
            </div>
          </div>

          <div>
            <div class="text-[10px] font-mono uppercase text-violet-400 mb-1.5 flex items-center gap-1.5">
              <i class="fa-solid fa-quote-right text-[10px]"></i>
              Kata Kunci Diksi Kritis
            </div>
            <div class="flex flex-wrap gap-1.5 font-mono text-xs">
              <span class="px-2 py-0.5 bg-neutral-950 border border-neutral-800 text-neutral-300 rounded-sm">pangkas anggaran</span>
              <span class="px-2 py-0.5 bg-neutral-950 border border-neutral-800 text-neutral-300 rounded-sm">batal bertahap</span>
              <span class="px-2 py-0.5 bg-neutral-950 border border-neutral-800 text-neutral-300 rounded-sm">bodong</span>
              <span class="px-2 py-0.5 bg-neutral-950 border border-neutral-800 text-neutral-300 rounded-sm">janji palsu</span>
            </div>
          </div>

          <div>
            <div class="text-[10px] font-mono uppercase text-cyan-400 mb-1.5 flex items-center gap-1.5">
              <i class="fa-solid fa-circle-check text-[10px]"></i>
              Narasi Faktual Klarifikasi
            </div>
            <div class="flex flex-wrap gap-1.5 font-mono text-xs">
              <span class="px-2 py-0.5 bg-cyan-950/30 border border-cyan-500/30 text-cyan-300 rounded-sm">klarifikasi kemenkeu</span>
              <span class="px-2 py-0.5 bg-cyan-950/30 border border-cyan-500/30 text-cyan-300 rounded-sm">alokasi tetap 71T</span>
            </div>
          </div>
        </div>
      </div>

      <!-- Side Box 3: Anti-Doxxing & Ethical Compliance (§4A-A) -->
      <div class="bg-neutral-900 border border-neutral-800 rounded-sm p-4 font-mono text-xs">
        <div class="flex items-center gap-2 text-emerald-400 font-bold mb-2">
          <i class="fa-solid fa-shield-check"></i>
          <span class="text-[11px] uppercase tracking-wider">GUARDRAIL ETIK: AGREGAT ONLY</span>
        </div>
        <p class="text-[11px] text-neutral-400 font-sans leading-relaxed mb-3">
          Sesuai PRD v2.0 §4A-A, sistem tidak melakukan identifikasi personal (Nama, KTP, Alamat Rumah, No HP). Granularitas analisis dibatasi pada tingkat sub-populasi dan pola perilaku bot terkoordinasi.
        </p>
        <div class="p-2 bg-neutral-950 border border-neutral-800 rounded-sm text-[10px] text-neutral-400 space-y-1">
          <div class="flex justify-between">
            <span>Level Geospatial Maksimal:</span>
            <span class="text-neutral-200">Kecamatan / Subnet /24</span>
          </div>
          <div class="flex justify-between">
            <span>Penyimpanan Data Pribadi:</span>
            <span class="text-emerald-400">TIDAK ADA (0 PII)</span>
          </div>
          <div class="flex justify-between">
            <span>Tindakan Sistem:</span>
            <span class="text-neutral-200">Verifikasi Fakta & Counter Narasi</span>
          </div>
        </div>
      </div>

    </div>

  </div>

</div>
<!-- END: MODUL A2 - SENTIMENT ANALYSIS DASHBOARD -->
@endsection
