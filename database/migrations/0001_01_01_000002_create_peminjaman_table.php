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
        // Buat enum type dulu jika belum ada
        DB::statement("DO $$ 
            BEGIN
                IF NOT EXISTS (SELECT 1 FROM pg_type WHERE typname = 'approval_status') THEN
                    CREATE TYPE approval_status AS ENUM ('Menunggu Persetujuan', 'Disetujui', 'Ditolak');
                END IF;
            END $$;");

        DB::statement("DO $$ 
            BEGIN
                IF NOT EXISTS (SELECT 1 FROM pg_type WHERE typname = 'pengembalian_status') THEN
                    CREATE TYPE pengembalian_status AS ENUM ('Belum', 'Sudah');
                END IF;
            END $$;");

        // Buat sequence untuk id
        DB::statement("CREATE SEQUENCE IF NOT EXISTS peminjaman_id_seq START WITH 1 INCREMENT BY 1;");

        // Buat tabel peminjaman
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->integer('id')->primary()->default(DB::raw("nextval('peminjaman_id_seq'::regclass)"));
            $table->integer('id_user')->nullable(false);
            $table->integer('id_fasilitas')->nullable(false);
            $table->date('tanggal_pinjam')->nullable(false);
            $table->date('tanggal_kembali')->nullable(false);
            $table->enum('status_approval', ['Menunggu Persetujuan', 'Disetujui', 'Ditolak'])->default('Menunggu Persetujuan');
            $table->enum('status_pengembalian', ['Belum', 'Sudah'])->default('Belum');
            $table->text('keterangan')->nullable();

            $table->timestamps(); // created_at & updated_at

            // Foreign Key Constraints
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_fasilitas')->references('id')->on('fasilitas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjaman');

        // Hapus enum types
        DB::statement("DROP TYPE IF EXISTS approval_status;");
        DB::statement("DROP TYPE IF EXISTS pengembalian_status;");
    }
};