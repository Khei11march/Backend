<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{

    public function up(): void
    {
        DB::statement("DO $$ 
            BEGIN
                IF NOT EXISTS (SELECT 1 FROM pg_type WHERE typname = 'user_role') THEN
                    CREATE TYPE user_role AS ENUM ('warga', 'admin', 'petugas');
                END IF;
            END $$;");

        if (!Schema::hasTable('users')) {
            Schema::create('users', function (Blueprint $table) {
                $table->integer('id')->primary()->default(DB::raw("nextval('users_id_seq'::regclass)"));
                $table->string('username', 50)->nullable(false);
                $table->string('password', 100)->nullable(false);
                $table->enum('role', ['warga', 'admin', 'petugas'])->default('warga');
                $table->string('nama_lengkap', 100)->nullable(false);
                $table->timestamp('created_at')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
                $table->timestamp('updated_at')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
            });

            DB::statement("CREATE SEQUENCE IF NOT EXISTS users_id_seq START WITH 1 INCREMENT BY 1;");
            DB::statement("ALTER TABLE users ALTER COLUMN id SET DEFAULT nextval('users_id_seq');");
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('users');

        DB::statement("DROP TYPE IF EXISTS user_role;");
    }
};