@extends('layouts.tactical')

@section('title', 'Early Warning Dashboard // TRACE-S')

@section('content')

<!-- Header Bar -->
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 border-b border-neutral-800 pb-4">
  <div>
    <div class="flex items-center gap-2">
      <h1 class="text-lg font-bold font-mono tracking-wide text-neutral-100 uppercase">Early Warning &amp; Situational Awareness</h1>
      <span class="text-[10px] font-mono px-2 py-0.5 border border-cyan-500/40 bg-cyan-950/30 text-cyan-400 rounded-sm">MODUL A</span>
    </div>
    <p class="text-xs text-neutral-500 mt-0.5">Pemantauan sentimen dan eskalasi narasi disinformasi berbasis dataset konektor terhubung.</p>
  </div>

  <div class="flex items-center gap-2">
    <a href="{{ route('cases.index') }}" class="px-3 py-1.5 bg-neutral-900 border border-neutral-700 hover:border-cyan-500 text-neutral-300 hover:text-cyan-400 text-xs font-mono uppercase tracking-wider rounded-sm transition-all flex items-center gap-2">
      <i class="fa-solid fa-folder-open"></i>
      <span>Daftar Kasus Aktif</span>
    </a>
    <a href="{{ route('scanner.index') }}" class="px-3 py-1.5 bg-cyan-600/20 text-cyan-400 border border-cyan-500/50 hover:bg-cyan-600/40 text-xs font-mono uppercase tracking-wider rounded-sm transition-all flex items-center gap-2 shadow-[0_0_10px_rgba(6,182,212,0.15)]">
      <i class="fa-solid fa-bolt"></i>
      <span>Pindai Konten Baru</span>
    </a>
  </div>
</div>

<!-- START: 4 METRIC CARDS -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3.5">

  <!-- Metric 1: Narasi Dianalisis -->
  <div class="bg-neutral-900 border border-neutral-800 p-4 rounded-sm space-y-2 relative overflow-hidden">
    <div class="flex items-center justify-between text-neutral-500 text-[10px] font-mono uppercase tracking-widest">
      <span>Narasi Dianalisis (24j)</span>
      <i class="fa-solid fa-chart-simple text-cyan-400"></i>
    </div>
    <div class="flex items-baseline justify-between">
      <div class="text-2xl font-bold font-mono text-neutral-100 tracking-tight">{{ $narrativesCount }}</div>
      <span class="text-[10px] font-mono text-emerald-400"><i class="fa-solid fa-arrow-trend-up"></i> +14.2%</span>
    </div>
    <div class="text-[10px] text-neutral-500 font-mono truncate">Meliputi portal berita &amp; media sosial</div>
    <div class="absolute bottom-0 left-0 right-0 h-0.5 bg-cyan-500/50"></div>
  </div>

  <!-- Metric 2: Hoaks Kritis Terdeteksi -->
  <div class="bg-neutral-900 border border-rose-900/40 p-4 rounded-sm space-y-2 relative overflow-hidden shadow-[0_0_15px_rgba(225,29,72,0.1)]">
    <div class="flex items-center justify-between text-rose-400 text-[10px] font-mono uppercase tracking-widest">
      <span>Hoaks Kritis Terdeteksi</span>
      <i class="fa-solid fa-triangle-exclamation text-rose-500 animate-pulse"></i>
    </div>
    <div class="flex items-baseline justify-between">
      <div class="text-2xl font-bold font-mono text-rose-500 tracking-tight">{{ $criticalCount }}</div>
      <span class="text-[10px] font-mono px-1.5 py-0.2 bg-rose-950/60 border border-rose-600/40 text-rose-400 uppercase">ESKALASI TINGGI</span>
    </div>
    <div class="text-[10px] text-neutral-500 font-mono truncate">Disinformasi strategis prioritas komando</div>
    <div class="absolute bottom-0 left-0 right-0 h-0.5 bg-rose-600"></div>
  </div>

  <!-- Metric 3: Sentimen Publik -->
  <div class="bg-neutral-900 border border-neutral-800 p-4 rounded-sm space-y-2 relative overflow-hidden">
    <div class="flex items-center justify-between text-neutral-500 text-[10px] font-mono uppercase tracking-widest">
      <span>Sentimen Publik (Negatif)</span>
      <i class="fa-solid fa-wave-square text-amber-400"></i>
    </div>
    <div class="flex items-baseline justify-between">
      <div class="text-2xl font-bold font-mono text-amber-400 tracking-tight">{{ $sentimentRatio }}%</div>
      <span class="text-[10px] font-mono text-rose-400"><i class="fa-solid fa-arrow-up"></i> +4.5%</span>
    </div>
    <div class="text-[10px] text-neutral-500 font-mono truncate">Anomali sentimen penolakan kebijakan</div>
    <div class="absolute bottom-0 left-0 right-0 h-0.5 bg-amber-500/50"></div>
  </div>

  <!-- Metric 4: Klaster Narasi Aktif -->
  <div class="bg-neutral-900 border border-neutral-800 p-4 rounded-sm space-y-2 relative overflow-hidden">
    <div class="flex items-center justify-between text-neutral-500 text-[10px] font-mono uppercase tracking-widest">
      <span>Klaster Narasi Aktif</span>
      <i class="fa-solid fa-cubes-stacked text-cyan-400"></i>
    </div>
    <div class="flex items-baseline justify-between">
      <div class="text-2xl font-bold font-mono text-neutral-100 tracking-tight">{{ $activeClustersCount }}</div>
      <span class="text-[10px] font-mono text-cyan-400">{{ $casesCount }} Kasus Aktif</span>
    </div>
    <div class="text-[10px] text-neutral-500 font-mono truncate">Dikelompokkan secara semantik</div>
    <div class="absolute bottom-0 left-0 right-0 h-0.5 bg-cyan-500/50"></div>
  </div>

</div>
<!-- END: 4 METRIC CARDS -->

<!-- START: PETA DAMPAK WILAYAH (Cognitive Impact Zone) + DRILLDOWN -->
<div class="grid grid-cols-1 lg:grid-cols-12 gap-4">

  <!-- Kiri: Peta 5 pulau (klik untuk drilldown) -->
  <div class="lg:col-span-7 bg-neutral-900 border border-neutral-800 rounded-sm p-4 flex flex-col space-y-3">
    <div class="flex flex-wrap items-center justify-between gap-2 border-b border-neutral-800 pb-2">
      <div class="flex items-center gap-2">
        <i class="fa-solid fa-map-location-dot text-cyan-400 text-xs"></i>
        <span class="text-xs font-mono uppercase tracking-wider text-neutral-300 font-semibold">Peta Dampak Wilayah Teritorial</span>
        <span class="text-[9px] font-mono px-1.5 py-0.5 border border-amber-500/40 text-amber-500 bg-amber-950/20">SIMULASI</span>
      </div>
      <div class="flex items-center gap-3 text-[10px] font-mono">
        <span class="flex items-center gap-1.5"><span class="w-2 h-2 rounded-full bg-rose-600"></span> Kritis</span>
        <span class="flex items-center gap-1.5"><span class="w-2 h-2 rounded-full bg-amber-500"></span> Tinggi</span>
        <span class="flex items-center gap-1.5"><span class="w-2 h-2 rounded-full bg-cyan-400"></span> Sedang</span>
        <span class="flex items-center gap-1.5"><span class="w-2 h-2 rounded-full bg-neutral-600"></span> Rendah</span>
      </div>
    </div>

    <div class="relative w-full h-72 sm:h-80 bg-neutral-950 border border-neutral-850 rounded-sm overflow-hidden p-2">
      <div class="absolute inset-0 bg-[linear-gradient(to_right,#1f1f1f_1px,transparent_1px),linear-gradient(to_bottom,#1f1f1f_1px,transparent_1px)] bg-[size:2rem_2rem] opacity-25"></div>
      <svg id="island-map" class="relative w-full h-full" viewBox="0 0 1000 450" preserveAspectRatio="xMidYMid meet" role="img" aria-label="Peta lima pulau utama Indonesia berdasarkan tingkat dampak narasi">
        <g class="island" data-island="sumatera" tabindex="0" role="button" aria-label="Sumatera"><path d="M120,60 L240,240 L180,290 L90,140 Z"/><text x="130" y="200">SUMATERA</text></g>
        <g class="island" data-island="jawa" tabindex="0" role="button" aria-label="Jawa"><path d="M220,310 L480,315 L470,335 L210,330 Z"/><text x="300" y="365">JAWA</text></g>
        <g class="island" data-island="kalimantan" tabindex="0" role="button" aria-label="Kalimantan"><path d="M370,110 L520,120 L510,250 L380,240 Z"/><text x="395" y="190">KALIMANTAN</text></g>
        <g class="island" data-island="sulawesi" tabindex="0" role="button" aria-label="Sulawesi"><path d="M560,140 L640,160 L620,280 L580,260 L570,180 Z"/><text x="545" y="305">SULAWESI</text></g>
        <g class="island" data-island="papua" tabindex="0" role="button" aria-label="Papua dan Maluku"><path d="M720,160 L780,180 L760,250 Z"/><path d="M790,190 L960,200 L950,300 L810,280 Z"/><text x="790" y="330">PAPUA &amp; MALUKU</text></g>
      </svg>
      <div class="absolute top-2 left-2 text-[9px] font-mono text-neutral-600">KLIK PULAU UNTUK RINCIAN KODAM &amp; KAB/KOTA</div>
      <div class="absolute bottom-2 right-2 text-[9px] font-mono text-neutral-600">WARNA = TINGKAT DAMPAK NARASI</div>
    </div>

    <!-- Kebijakan data: bukan pelacakan pelaku -->
    <div class="px-3 py-2 bg-neutral-950/80 border border-cyan-500/20 rounded-sm flex items-start gap-2 text-[11px] font-mono text-neutral-400">
      <i class="fa-solid fa-shield-halved text-cyan-400 mt-0.5"></i>
      <span>Peta menunjukkan <b class="text-neutral-200">wilayah yang terdampak narasi</b> (resonansi publik &amp; kesiapsiagaan KODAM), <b class="text-neutral-200">bukan</b> lokasi, IP, atau identitas pengunggah. TRACE-S tidak melakukan pelacakan pribadi atau <i>doxxing</i>.</span>
    </div>
  </div>

  <!-- Kanan: Panel drilldown Pulau -> KODAM -> Kab/Kota -->
  <div class="lg:col-span-5 bg-neutral-900 border border-neutral-800 rounded-sm p-4 flex flex-col space-y-3">
    <div class="flex items-center justify-between border-b border-neutral-800 pb-2">
      <div class="flex items-center gap-2">
        <i class="fa-solid fa-layer-group text-cyan-400 text-xs"></i>
        <span class="text-xs font-mono uppercase tracking-wider text-neutral-300 font-semibold">Rincian Wilayah</span>
      </div>
      <button id="region-back" type="button" class="hidden text-[10px] font-mono text-cyan-400 hover:text-cyan-300 px-1.5 py-0.5 border border-cyan-500/30 bg-cyan-950/30 rounded-sm">
        <i class="fa-solid fa-arrow-left text-[9px]"></i> Kembali
      </button>
    </div>

    <nav id="region-breadcrumb" class="text-[10px] font-mono text-neutral-500 uppercase tracking-wider" aria-label="Posisi drilldown"></nav>
    <div id="region-panel" class="flex-1 space-y-2 overflow-y-auto max-h-[22rem] pr-1"></div>

    <div class="text-[10px] font-mono text-neutral-500 pt-1 border-t border-neutral-800 leading-relaxed">
      <b class="text-neutral-400">Amplifikasi luar wilayah</b> = porsi akun penyebar yang berasal dari luar wilayah. Merupakan <i>indikasi</i> untuk analis (kemungkinan amplifikasi terorganisir), bukan vonis.
    </div>
  </div>

</div>
<!-- END: PETA DAMPAK WILAYAH -->

<!-- START: LIVE THREAT FEED (lebar penuh) -->
<div class="bg-neutral-900 border border-neutral-800 rounded-sm p-4 space-y-3">
  <div class="flex items-center justify-between border-b border-neutral-800 pb-2">
    <div class="flex items-center gap-2">
      <span class="w-2 h-2 rounded-full bg-rose-500 animate-ping"></span>
      <span class="text-xs font-mono uppercase tracking-wider text-neutral-300 font-semibold">Live Threat Feed</span>
      <span class="text-[9px] text-amber-500 font-mono">SIMULASI LIVE STREAM</span>
    </div>
    <div class="flex items-center gap-3 text-[10px] font-mono text-neutral-500">
      <span>Auto-refresh: <b class="text-cyan-400">AKTIF</b> (5s)</span>
      <button id="toggle-feed-btn" class="text-[10px] font-mono text-cyan-400 hover:text-cyan-300 px-1.5 py-0.5 border border-cyan-500/30 bg-cyan-950/30 rounded-sm">
        <i class="fa-solid fa-pause text-[9px]"></i> Jeda
      </button>
    </div>
  </div>
  <div id="feed-terminal-container" class="h-56 bg-neutral-950 border border-neutral-850 rounded-sm p-3 font-mono text-[11px] overflow-y-auto">
    <div class="text-neutral-500 text-[10px] pb-1 border-b border-neutral-800/80 mb-2">// POLLING CONNECTED FEEDS — Cakupan: {{ $connectedSourcesCount }} sumber digital terhubung (batas lingkup dataset)</div>
    <div id="feed-items-list" class="grid grid-cols-1 md:grid-cols-2 gap-2">
      <div class="text-neutral-500 text-xs text-center py-8 md:col-span-2">Memuat aliran ancaman...</div>
    </div>
  </div>
</div>
<!-- END: LIVE THREAT FEED -->

@push('styles')
<style>
  #island-map .island path { fill: #262626; stroke: #404040; stroke-width: 1.5; cursor: pointer; transition: fill .2s, stroke .2s; }
  #island-map .island text { fill: #a3a3a3; font: 600 14px 'JetBrains Mono', monospace; pointer-events: none; letter-spacing: .05em; }
  #island-map .island:hover path, #island-map .island:focus path, #island-map .island.selected path { stroke: #22d3ee; stroke-width: 3; }
  #island-map .island:focus { outline: none; }
  #island-map .sev-KRITIS path { fill: rgba(225,29,72,.55); }
  #island-map .sev-TINGGI path { fill: rgba(245,158,11,.45); }
  #island-map .sev-SEDANG path { fill: rgba(6,182,212,.35); }
  #island-map .sev-RENDAH path { fill: #262626; }
</style>
@endpush

@push('scripts')
<script>
  // Drilldown wilayah: Nasional -> Pulau -> KODAM -> Kab/Kota (data simulasi)
  (function () {
    const DATA = @json($regionalData);
    const RANK = { KRITIS: 4, TINGGI: 3, SEDANG: 2, RENDAH: 1 };
    const BADGE = {
      KRITIS: 'text-rose-400 border-rose-600/50 bg-rose-950/40',
      TINGGI: 'text-amber-400 border-amber-500/50 bg-amber-950/40',
      SEDANG: 'text-cyan-400 border-cyan-500/40 bg-cyan-950/30',
      RENDAH: 'text-neutral-400 border-neutral-700 bg-neutral-800'
    };
    const panel = document.getElementById('region-panel');
    const crumb = document.getElementById('region-breadcrumb');
    const backBtn = document.getElementById('region-back');
    const state = { island: null, kodam: null };

    const esc = s => String(s).replace(/[&<>"']/g, c => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[c]));
    const badge = sev => `<span class="px-1.5 py-0.5 border text-[9px] uppercase ${BADGE[sev]}">${sev}</span>`;
    const cities = k => k.cities;
    const worst = list => list.reduce((m, x) => RANK[x.sev] > RANK[m] ? x.sev : m, 'RENDAH');
    const kodamCities = i => DATA[i].kodam.flatMap(cities);
    const sum = (list, f) => list.reduce((a, x) => a + f(x), 0);
    const wavg = list => { const n = sum(list, x => x.n); return n ? Math.round(sum(list, x => x.neg * x.n) / n) : 0; };

    function paintMap() {
      document.querySelectorAll('#island-map .island').forEach(g => {
        const id = g.dataset.island;
        g.classList.remove('sev-KRITIS', 'sev-TINGGI', 'sev-SEDANG', 'sev-RENDAH');
        g.classList.add('sev-' + worst(kodamCities(id)));
        g.classList.toggle('selected', state.island === id);
      });
    }

    function bar(pct, color) {
      return `<div class="w-full h-1 bg-neutral-800 rounded-sm overflow-hidden"><div class="h-full ${color}" style="width:${pct}%"></div></div>`;
    }

    function renderNational() {
      crumb.textContent = 'NKRI › 5 pulau utama';
      backBtn.classList.add('hidden');
      const rows = Object.keys(DATA)
        .map(id => ({ id, list: kodamCities(id) }))
        .sort((a, b) => RANK[worst(b.list)] - RANK[worst(a.list)] || sum(b.list, x => x.n) - sum(a.list, x => x.n));
      panel.innerHTML = rows.map(r => {
        const sev = worst(r.list);
        return `<button type="button" data-island="${r.id}" class="w-full text-left p-2.5 bg-neutral-950 border border-neutral-800 hover:border-cyan-500/50 rounded-sm space-y-1.5 transition-colors">
          <div class="flex items-center justify-between font-mono text-xs"><span class="text-neutral-200 font-semibold">${esc(DATA[r.id].name)}</span>${badge(sev)}</div>
          <div class="flex items-center justify-between text-[10px] font-mono text-neutral-500"><span>${sum(r.list, x => x.n)} narasi • ${DATA[r.id].kodam.length} KODAM</span><span>Negatif ${wavg(r.list)}%</span></div>
          ${bar(wavg(r.list), 'bg-rose-500/70')}</button>`;
      }).join('');
    }

    function renderIsland(id) {
      crumb.innerHTML = `NKRI › <span class="text-cyan-400">${esc(DATA[id].name)}</span> › KODAM`;
      backBtn.classList.remove('hidden');
      panel.innerHTML = DATA[id].kodam.map((k, idx) => {
        const sev = worst(k.cities);
        return `<button type="button" data-kodam="${idx}" class="w-full text-left p-2.5 bg-neutral-950 border border-neutral-800 hover:border-cyan-500/50 rounded-sm space-y-1.5 transition-colors">
          <div class="flex items-center justify-between font-mono text-xs"><span class="text-neutral-200 font-semibold">${esc(k.name)}</span>${badge(sev)}</div>
          <div class="text-[10px] font-mono text-neutral-500">${esc(k.area)}</div>
          <div class="flex items-center justify-between text-[10px] font-mono text-neutral-500"><span>${sum(k.cities, x => x.n)} narasi • ${k.cities.length} kab/kota</span><span>Negatif ${wavg(k.cities)}%</span></div>
          ${bar(wavg(k.cities), 'bg-rose-500/70')}</button>`;
      }).join('');
    }

    function renderKodam(id, idx) {
      const k = DATA[id].kodam[idx];
      crumb.innerHTML = `NKRI › ${esc(DATA[id].name)} › <span class="text-cyan-400">${esc(k.name)}</span>`;
      backBtn.classList.remove('hidden');
      const sorted = [...k.cities].sort((a, b) => RANK[b.sev] - RANK[a.sev] || b.n - a.n);
      panel.innerHTML = sorted.map(c => `
        <div class="p-2.5 bg-neutral-950 border border-neutral-800 rounded-sm space-y-1.5">
          <div class="flex items-center justify-between font-mono text-xs"><span class="text-neutral-200 font-semibold">${esc(c.name)}</span>${badge(c.sev)}</div>
          <div class="text-[11px] font-sans text-neutral-300">${esc(c.topic)}</div>
          <div class="grid grid-cols-3 gap-2 text-[10px] font-mono text-neutral-500">
            <div>Narasi<br><b class="text-neutral-200 text-xs">${c.n}</b></div>
            <div>Sentimen negatif<br><b class="text-rose-400 text-xs">${c.neg}%</b></div>
            <div>Amplifikasi luar<br><b class="${c.out >= 40 ? 'text-amber-400' : 'text-neutral-200'} text-xs">${c.out}%</b></div>
          </div>
          ${c.out >= 40 ? '<div class="text-[10px] font-mono text-amber-400"><i class="fa-solid fa-triangle-exclamation"></i> Indikasi amplifikasi dari luar wilayah — perlu tinjauan analis</div>' : ''}
        </div>`).join('') +
        `<a href="{{ route('cases.index') }}" class="block text-center text-[11px] font-mono text-cyan-400 hover:text-cyan-300 py-1.5 border border-cyan-500/30 bg-cyan-950/20 rounded-sm">Buka kasus terkait &rarr;</a>`;
    }

    function go(island, kodam) {
      state.island = island; state.kodam = kodam;
      if (island === null) renderNational();
      else if (kodam === null) renderIsland(island);
      else renderKodam(island, kodam);
      paintMap();
    }

    document.querySelectorAll('#island-map .island').forEach(g => {
      g.addEventListener('click', () => go(g.dataset.island, null));
      g.addEventListener('keydown', e => { if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); go(g.dataset.island, null); } });
    });
    panel.addEventListener('click', e => {
      const isl = e.target.closest('[data-island]'); const kod = e.target.closest('[data-kodam]');
      if (isl) go(isl.dataset.island, null);
      else if (kod) go(state.island, parseInt(kod.dataset.kodam, 10));
    });
    backBtn.addEventListener('click', () => go(state.kodam !== null ? state.island : null, null));

    go(null, null);
  })();
</script>
@endpush


<!-- START: RECENT CASES OVERVIEW -->
<div class="bg-neutral-900 border border-neutral-800 rounded-sm p-4 space-y-3">
  <div class="flex items-center justify-between border-b border-neutral-800 pb-3">
    <div>
      <h2 class="text-sm font-semibold font-mono uppercase tracking-wide text-neutral-200">Kasus Investigasi Aktif</h2>
      <p class="text-[11px] text-neutral-500 mt-0.5">Daftar kasus siber sosial yang sedang ditangani oleh operator dan analis.</p>
    </div>
    <a href="{{ route('cases.index') }}" class="text-xs font-mono text-cyan-400 hover:text-cyan-300 flex items-center gap-1">
      <span>Lihat Seluruh Kasus</span>
      <i class="fa-solid fa-arrow-right text-[10px]"></i>
    </a>
  </div>

  <div class="overflow-x-auto">
    <table class="w-full text-left font-mono text-xs">
      <thead>
        <tr class="border-b border-neutral-800 text-[10px] uppercase tracking-wider text-neutral-500">
          <th class="py-2 px-3">Kode Kasus</th>
          <th class="py-2 px-3">Judul Investigasi</th>
          <th class="py-2 px-3">Kategori</th>
          <th class="py-2 px-3">Prioritas</th>
          <th class="py-2 px-3">Status</th>
          <th class="py-2 px-3 text-right">Aksi</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-neutral-800/60">
        @forelse($recentCases as $rc)
        <tr class="hover:bg-neutral-850/50 transition-colors">
          <td class="py-2.5 px-3 font-semibold text-cyan-400">
            <a href="{{ route('cases.show', $rc->id) }}">{{ $rc->case_code }}</a>
            @if($rc->is_simulation)
            <span class="ml-1 text-[8px] px-1 py-0.2 border border-amber-500/40 text-amber-500 bg-amber-950/20">SIMULASI</span>
            @endif
          </td>
          <td class="py-2.5 px-3 font-sans text-neutral-200 max-w-md truncate">{{ $rc->title }}</td>
          <td class="py-2.5 px-3 text-[11px] text-neutral-400">{{ $rc->category }}</td>
          <td class="py-2.5 px-3">
            @if($rc->priority === 'KRITIS')
              <span class="px-1.5 py-0.5 bg-rose-950/50 border border-rose-600/50 text-rose-400 text-[9px] uppercase">KRITIS</span>
            @elseif($rc->priority === 'TINGGI')
              <span class="px-1.5 py-0.5 bg-amber-950/50 border border-amber-500/50 text-amber-400 text-[9px] uppercase">TINGGI</span>
            @else
              <span class="px-1.5 py-0.5 bg-cyan-950/50 border border-cyan-500/50 text-cyan-400 text-[9px] uppercase">{{ $rc->priority }}</span>
            @endif
          </td>
          <td class="py-2.5 px-3">
            <span class="px-1.5 py-0.5 bg-neutral-800 border border-neutral-700 text-neutral-300 text-[9px] uppercase">
              {{ $rc->status }}
            </span>
          </td>
          <td class="py-2.5 px-3 text-right space-x-2">
            <a href="{{ route('scanner.index', ['case_id' => $rc->id]) }}" class="text-cyan-400 hover:text-cyan-300 text-[11px]" title="Buka Scanner">
              <i class="fa-solid fa-shield-halved"></i>
            </a>
            <a href="{{ route('cases.show', $rc->id) }}" class="text-neutral-400 hover:text-neutral-200 text-[11px]" title="Detail Kasus">
              <i class="fa-solid fa-arrow-right"></i>
            </a>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="6" class="py-4 text-center text-neutral-500">Belum ada kasus investigasi terdaftar.</td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
<!-- END: RECENT CASES OVERVIEW -->

@endsection

@push('scripts')
<script>
  // Vanilla JS Polling untuk Live Threat Feed
  let feedActive = true;
  const feedList = document.getElementById('feed-items-list');
  const toggleBtn = document.getElementById('toggle-feed-btn');

  async function fetchThreatFeed() {
    if (!feedActive) return;
    try {
      const res = await fetch("{{ route('api.threat-feed') }}");
      if (!res.ok) return;
      const json = await res.json();
      if (!json.data || !json.data.length) return;

      feedList.innerHTML = json.data.map(item => {
        let badgeColor = 'text-cyan-400 border-cyan-500/30 bg-cyan-950/20';
        if (item.severity === 'KRITIS') badgeColor = 'text-rose-400 border-rose-600/40 bg-rose-950/30';
        else if (item.severity === 'TINGGI') badgeColor = 'text-amber-400 border-amber-500/40 bg-amber-950/30';

        return `
          <div class="p-2 bg-neutral-900 border border-neutral-800 rounded-sm hover:border-neutral-700 transition-colors">
            <div class="flex items-center justify-between text-[10px] text-neutral-500 mb-1">
              <span class="text-cyan-400 font-semibold">[${item.time}]</span>
              <span class="px-1 py-0.2 border rounded-sm text-[8px] uppercase ${badgeColor}">${item.severity}</span>
            </div>
            <div class="text-neutral-200 text-xs font-sans leading-tight line-clamp-2">${item.title}</div>
            <div class="mt-1 flex items-center justify-between text-[9px] text-neutral-500">
              <span>Sektor: <b class="text-neutral-400">${item.region}</b></span>
              <span class="text-amber-500">SIMULASI</span>
            </div>
          </div>
        `;
      }).join('');
    } catch (e) {
      console.warn("Polling feed error:", e);
    }
  }

  // Toggle button handler
  if (toggleBtn) {
    toggleBtn.addEventListener('click', () => {
      feedActive = !feedActive;
      toggleBtn.innerHTML = feedActive
        ? '<i class="fa-solid fa-pause text-[9px]"></i> Jeda'
        : '<i class="fa-solid fa-play text-[9px]"></i> Lanjutkan';
      toggleBtn.classList.toggle('text-amber-400', !feedActive);
    });
  }

  // Run immediately and poll every 5s
  fetchThreatFeed();
  setInterval(fetchThreatFeed, 5000);
</script>
@endpush