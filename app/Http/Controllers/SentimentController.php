<?php

namespace App\Http\Controllers;

use App\Models\InvestigationCase;
use App\Models\SentimentSnapshot;
use Illuminate\Http\Request;

class SentimentController extends Controller
{
    public function index(Request $request)
    {
        $cases = InvestigationCase::all();
        $selectedCase = $request->has('case_id')
            ? InvestigationCase::find($request->get('case_id'))
            : InvestigationCase::first();

        // Riwayat tren polaritas sentimen (Data 24 Jam)
        $trendSnapshots = [
            ['time' => '24j lalu', 'pos' => 35, 'neu' => 45, 'neg' => 20, 'vol' => 120, 'velocity_rate' => '+8/j'],
            ['time' => '18j lalu', 'pos' => 28, 'neu' => 42, 'neg' => 30, 'vol' => 195, 'velocity_rate' => '+15/j'],
            ['time' => '12j lalu', 'pos' => 22, 'neu' => 38, 'neg' => 40, 'vol' => 290, 'velocity_rate' => '+24/j'],
            ['time' => '6j lalu',  'pos' => 12, 'neu' => 26, 'neg' => 62, 'vol' => 410, 'velocity_rate' => '+52/j'],
            ['time' => 'Terkini',  'pos' => 5,  'neu' => 20, 'neg' => 75, 'vol' => 620, 'velocity_rate' => '+98/j'],
        ];

        // 5 Emosi Dominan pada Korpus (Linguistic Analysis)
        $emotionBreakdown = [
            ['name' => 'Marah / Murka', 'pct' => 46, 'color' => 'bg-rose-500', 'desc' => 'Diksi penolakan keras terhadap narasi pemotongan anggaran'],
            ['name' => 'Takut / Cemas', 'pct' => 28, 'color' => 'bg-amber-500', 'desc' => 'Kekhawatiran peternak/petani terhadap kelangsungan dapur pangan'],
            ['name' => 'Sinis / Apatis', 'pct' => 14, 'color' => 'bg-violet-400', 'desc' => 'Komentar sarkastik terhadap stabilitas komitmen kebijakan'],
            ['name' => 'Simpati / Peduli', 'pct' => 8, 'color' => 'bg-cyan-400', 'desc' => 'Dukungan terhadap penerima manfaat program prioritas'],
            ['name' => 'Optimis / Percaya', 'pct' => 4, 'color' => 'bg-emerald-400', 'desc' => 'Respons terhadap siaran pers resmi klarifikasi kementerian'],
        ];

        // Sebaran Sentimen per Platform
        $platformBreakdown = [
            ['platform' => 'Instagram', 'neg' => 82, 'neu' => 13, 'pos' => 5, 'volume' => 310, 'alert' => 'VELOCITY TINGGI'],
            ['platform' => 'TikTok', 'neg' => 76, 'neu' => 18, 'pos' => 6, 'volume' => 185, 'alert' => 'VIRAL SURGE'],
            ['platform' => 'X (Twitter)', 'neg' => 88, 'neu' => 10, 'pos' => 2, 'volume' => 95, 'alert' => 'BOT ANOMALY'],
            ['platform' => 'YouTube', 'neg' => 58, 'neu' => 34, 'pos' => 8, 'volume' => 30, 'alert' => 'MODERAT'],
        ];

        // Velocity & Crisis Alert Evaluation (§8.3 FR-018)
        $velocityAlert = [
            'is_triggered' => true,
            'level' => 'KRISIS OPINI PUBLIK',
            'velocity_index' => '+98 interaksi/jam',
            'threshold' => 'Ambang batas: +30/jam',
            'recommendation' => 'Lonjakan velocity di atas ambang batas berpadu dengan sentimen negatif 75%. Rekomendasi: Segera terbitkan siaran pers klarifikasi akurasi.',
        ];

        return view('sentiment.index', compact(
            'cases',
            'selectedCase',
            'trendSnapshots',
            'emotionBreakdown',
            'platformBreakdown',
            'velocityAlert'
        ));
    }
}
