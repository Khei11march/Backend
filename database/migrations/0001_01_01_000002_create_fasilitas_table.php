<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Buat sequence dulu
        DB::statement("CREATE SEQUENCE IF NOT EXISTS fasilitas_id_seq START WITH 1 INCREMENT BY 1;");

        // Baru buat tabel
        Schema::create('fasilitas', function (Blueprint $table) {
            $table->integer('id')->primary()->default(DB::raw("nextval('fasilitas_id_seq'::regclass)"));
            $table->string('nama_fasilitas', 100)->nullable(false);
            $table->integer('stok')->default(0);
            $table->text('deskripsi')->nullable();
            $table->string('foto', 255)->nullable();

            $table->timestamps(); // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fasilitas');
        
        // Hapus sequence jika diperlukan
        DB::statement("DROP SEQUENCE IF EXISTS fasilitas_id_seq;");
    }
};