<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('evidence_network_traces', function (Blueprint $table) {
            $table->id();
            $table->foreignId('evidence_item_id')->constrained('evidence_items')->onDelete('cascade');
            $table->string('island_anchor'); // SUMATERA, JAWA, KALIMANTAN, SULAWESI, PAPUA
            $table->string('city_kabupaten');
            $table->string('kecamatan')->nullable();
            $table->string('ip_subnet')->nullable(); // Subnet /24, bukan IP individu presisi penuh
            $table->string('isp_asn')->nullable(); // AS17974 Telkom Indonesia
            $table->decimal('latitude', 10, 7)->nullable(); // EXIF konsistensi konten
            $table->decimal('longitude', 11, 7)->nullable();
            $table->unsignedInteger('similar_pattern_account_count')->default(0);
            $table->boolean('is_simulation')->default(true);
            $table->timestamps();
            $table->index(['island_anchor', 'city_kabupaten', 'kecamatan']);
        });
    }

    public function down(): void {
        Schema::dropIfExists('evidence_network_traces');
    }
};
