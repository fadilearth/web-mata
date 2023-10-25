<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('is_admin', [1, 0])->default(1);
            $table->enum('active', [1, 0])->default(0);
            $table->string('foto_profile', 30)->nullable();
            $table->string('tempat_lahir', 50)->nullable();
            $table->date('tgl_lahir')->nullable();
            $table->tinyInteger('umur')->nullable();
            $table->enum('jenis_kelamin', ['l', 'p'])->nullable();
            $table->text('alamat')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->string('created_by')->default('SYSTEM');
            $table->string('updated_by')->nullable();
            $table->timestamps();
        });

        Schema::create('pasiens', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('is_admin', [1, 0])->default(0);
            $table->enum('active', [1, 0])->default(0);
            $table->string('foto_profile', 30)->nullable();
            $table->string('tempat_lahir', 50)->nullable();
            $table->date('tgl_lahir')->nullable();
            $table->tinyInteger('umur')->nullable();
            $table->enum('jenis_kelamin', ['l', 'p'])->nullable();
            $table->text('alamat')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->string('created_by')->default('SYSTEM');
            $table->string('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('pasiens');
    }
};
