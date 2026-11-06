<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('sentiment_snapshots', function (Blueprint $table) {
            $table->id();
            $table->foreignId('case_id')->nullable()->constrained('cases')->onDelete('cascade');
            $table->string('topic_cluster');
            $table->timestamp('measured_at');
            $table->decimal('positive_pct', 5, 2);
            $table->decimal('neutral_pct', 5, 2);
            $table->decimal('negative_pct', 5, 2);
            $table->string('dominant_emotion'); // KEMARAHAN, KECEMASAN, HARAPAN, SINIS, NETRAL
            $table->unsignedInteger('sample_size')->default(0);
            $table->text('coverage_note')->nullable();
            $table->boolean('is_simulation')->default(true);
            $table->timestamps();
            $table->index(['topic_cluster', 'measured_at']);
        });
    }

    public function down(): void {
        Schema::dropIfExists('sentiment_snapshots');
    }
};
