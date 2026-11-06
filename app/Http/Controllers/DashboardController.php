<?php

namespace App\Http\Controllers;

use App\Models\Connector;
use App\Models\InvestigationCase;
use App\Models\Narrative;
use App\Models\NarrativeCluster;
use App\Models\ThreatAnalysis;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $narrativesCount = Narrative::count();
        $criticalCount = ThreatAnalysis::where('threat_level', 'KRITIS')->count();
        $activeClustersCount = NarrativeCluster::count();
        $casesCount = InvestigationCase::count();

        // Sentimen
        $negatives = Narrative::where('sentiment', 'NEGATIF')->count();
        $sentimentRatio = $narrativesCount > 0 ? round(($negatives / $narrativesCount) * 100, 1) : 68.4;

        // Peta ancaman titik (Master §7.2, config trace.regions)
        $regions = config('trace.regions');
        $threatPoints = [
            ['name' => 'Jakarta', 'x' => 33, 'y' => 63, 'severity' => 'KRITIS', 'count' => 14, 'pulse' => 'animate-ping'],
            ['name' => 'Surabaya', 'x' => 46, 'y' => 68, 'severity' => 'TINGGI', 'count' => 8, 'pulse' => 'animate-pulse'],
            ['name' => 'Medan', 'x' => 14, 'y' => 30, 'severity' => 'SEDANG', 'count' => 5, 'pulse' => ''],
            ['name' => 'Makassar', 'x' => 61, 'y' => 62, 'severity' => 'SEDANG', 'count' => 4, 'pulse' => ''],
            ['name' => 'Balikpapan', 'x' => 55, 'y' => 45, 'severity' => 'RENDAH', 'count' => 2, 'pulse' => ''],
            ['name' => 'Jayapura', 'x' => 91, 'y' => 56, 'severity' => 'RENDAH', 'count' => 1, 'pulse' => ''],
        ];

        // Peta Dampak Wilayah (Cognitive Impact Zone): Pulau -> KODAM -> Kabupaten/Kota.
        // Menggambarkan WILAYAH TERDAMPAK narasi (resonansi publik), BUKAN lokasi/IP pelaku.
        // Seluruh angka adalah DATA SIMULASI untuk skenario TS-2026-001.
        $regionalData = $this->regionalImpactData();

        // Status konektor pengumpul data yang jujur
        $connectors = Connector::orderBy('priority')->get();
        $connectedSourcesCount = InvestigationCase::withCount('sources')->get()->sum('sources_count');

        // Recent cases
        $recentCases = InvestigationCase::with(['creator', 'analyses'])->latest()->take(5)->get();

        return view('dashboard.index', compact(
            'narrativesCount',
            'criticalCount',
            'activeClustersCount',
            'casesCount',
            'sentimentRatio',
            'threatPoints',
            'regionalData',
            'connectors',
            'connectedSourcesCount',
            'recentCases'
        ));
    }

    /**
     * Data simulasi dampak narasi per wilayah teritorial.
     * Field kota: sev (severity), n (jumlah narasi), neg (% sentimen negatif),
     * out (% amplifikasi dari luar wilayah - indikasi, bukan vonis), topic (isu dominan).
     */
    private function regionalImpactData(): array
    {
        $c = fn (string $name, string $sev, int $n, int $neg, int $out, string $topic) => [
            'name' => $name, 'sev' => $sev, 'n' => $n, 'neg' => $neg, 'out' => $out, 'topic' => $topic,
        ];

        return [
            'sumatera' => ['name' => 'Sumatera', 'kodam' => [
                ['name' => 'Kodam I/Bukit Barisan', 'area' => 'Sumut, Riau, Sumbar', 'cities' => [
                    $c('Kota Medan', 'TINGGI', 21, 71, 32, 'Isu penghentian MBG'),
                    $c('Kota Pekanbaru', 'SEDANG', 9, 55, 18, 'Isu anggaran pendidikan'),
                ]],
                ['name' => 'Kodam II/Sriwijaya', 'area' => 'Sumsel, Lampung, Jambi', 'cities' => [
                    $c('Kota Palembang', 'SEDANG', 11, 58, 25, 'Isu penghentian MBG'),
                    $c('Kota Bandar Lampung', 'RENDAH', 4, 39, 12, 'Isu anggaran pendidikan'),
                ]],
                ['name' => 'Kodam Iskandar Muda', 'area' => 'Aceh', 'cities' => [
                    $c('Kota Banda Aceh', 'RENDAH', 3, 34, 9, 'Isu anggaran pendidikan'),
                ]],
            ]],
            'jawa' => ['name' => 'Jawa', 'kodam' => [
                ['name' => 'Kodam Jaya', 'area' => 'DKI Jakarta, Bekasi, Depok', 'cities' => [
                    $c('Jakarta Pusat', 'KRITIS', 48, 84, 41, 'Isu penghentian MBG & KDMP'),
                    $c('Kota Bekasi', 'TINGGI', 19, 69, 36, 'Isu penghentian MBG'),
                ]],
                ['name' => 'Kodam III/Siliwangi', 'area' => 'Jawa Barat, Banten', 'cities' => [
                    $c('Kab. Subang', 'KRITIS', 27, 81, 22, 'Kepanikan pemasok dapur MBG'),
                    $c('Kota Bandung', 'TINGGI', 23, 72, 30, 'Isu penghentian MBG'),
                ]],
                ['name' => 'Kodam IV/Diponegoro', 'area' => 'Jawa Tengah, DIY', 'cities' => [
                    $c('Kab. Banyumas', 'TINGGI', 16, 70, 19, 'Kepanikan pemasok dapur MBG'),
                    $c('Kota Semarang', 'SEDANG', 12, 57, 27, 'Isu anggaran pendidikan'),
                ]],
                ['name' => 'Kodam V/Brawijaya', 'area' => 'Jawa Timur', 'cities' => [
                    $c('Kota Surabaya', 'TINGGI', 24, 74, 29, 'Isu penghentian MBG'),
                    $c('Kab. Jember', 'TINGGI', 14, 68, 17, 'Kepanikan pemasok dapur MBG'),
                    $c('Kota Malang', 'SEDANG', 10, 56, 24, 'Isu anggaran pendidikan'),
                ]],
            ]],
            'kalimantan' => ['name' => 'Kalimantan', 'kodam' => [
                ['name' => 'Kodam VI/Mulawarman', 'area' => 'Kaltim, Kalsel, Kaltara', 'cities' => [
                    $c('Kota Balikpapan', 'SEDANG', 8, 52, 44, 'Isu penghentian MBG'),
                    $c('Kota Samarinda', 'RENDAH', 5, 41, 31, 'Isu anggaran pendidikan'),
                ]],
                ['name' => 'Kodam XII/Tanjungpura', 'area' => 'Kalbar, Kalteng', 'cities' => [
                    $c('Kota Pontianak', 'SEDANG', 7, 49, 62, 'Isu penghentian MBG'),
                ]],
            ]],
            'sulawesi' => ['name' => 'Sulawesi', 'kodam' => [
                ['name' => 'Kodam XIV/Hasanuddin', 'area' => 'Sulsel, Sulbar, Sultra', 'cities' => [
                    $c('Kota Makassar', 'SEDANG', 13, 61, 26, 'Isu penghentian MBG'),
                    $c('Kota Kendari', 'RENDAH', 4, 37, 15, 'Isu anggaran pendidikan'),
                ]],
                ['name' => 'Kodam XIII/Merdeka', 'area' => 'Sulut, Sulteng, Gorontalo', 'cities' => [
                    $c('Kota Manado', 'RENDAH', 3, 33, 20, 'Isu anggaran pendidikan'),
                    $c('Kota Palu', 'RENDAH', 3, 35, 14, 'Isu penghentian MBG'),
                ]],
            ]],
            'papua' => ['name' => 'Papua & Maluku', 'kodam' => [
                ['name' => 'Kodam XVII/Cenderawasih', 'area' => 'Papua', 'cities' => [
                    $c('Kota Jayapura', 'SEDANG', 6, 54, 58, 'Isu penghentian MBG'),
                    $c('Kab. Merauke', 'RENDAH', 2, 31, 47, 'Isu anggaran pendidikan'),
                ]],
                ['name' => 'Kodam XVI/Pattimura', 'area' => 'Maluku', 'cities' => [
                    $c('Kota Ambon', 'RENDAH', 3, 36, 28, 'Isu penghentian MBG'),
                ]],
            ]],
        ];
    }

    /**
     * Polling JSON Feed untuk Live Threat Feed di dashboard
     */
    public function threatFeed(Request $request)
    {
        $logs = Narrative::latest()->take(10)->get()->map(fn ($n) => [
            'id' => $n->id,
            'time' => $n->captured_at ? $n->captured_at->format('H:i:s') : now()->format('H:i:s'),
            'region' => $n->region ?? 'NASIONAL',
            'severity' => $n->severity,
            'title' => $n->title,
            'category' => $n->category ?? 'DISINFORMASI',
            'is_simulation' => $n->is_simulation,
        ]);

        return response()->json([
            'status' => 'OK',
            'source_scope' => 'Berdasarkan dataset aktif pada database internal Trace-S',
            'data' => $logs,
        ]);
    }
}
