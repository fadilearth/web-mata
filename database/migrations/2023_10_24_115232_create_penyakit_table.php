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
        Schema::create('penyakit', function (Blueprint $table) {
            $table->id();
            $table->string('nama_penyakit', 100);
            $table->text('deskripsi')->nullable();
            $table->string('penanganan', 100);
            $table->string('created_by');
            $table->string('updated_by')->nullable();
            $table->timestamps();
        });

        Schema::create('gejala', function (Blueprint $table) {
            $table->id();
            $table->string('gejala', 100);
            $table->text('deskripsi')->nullable();
            $table->string('created_by');
            $table->string('updated_by')->nullable();
            $table->timestamps();
        });

        Schema::create('penyakit_gejala', function (Blueprint $table) {
            $table->id();
            $table->integer('penyakit_id');
            $table->integer('gejala_id');
            $table->string('created_by');
            $table->string('updated_by')->nullable();
            $table->timestamps();
        });

        Schema::create('analisa', function (Blueprint $table) {
            $table->id();
            $table->integer('pasien_id');
            $table->integer('nama_pasien');
            $table->string('tempat_lahir', 50)->nullable();
            $table->date('tgl_lahir')->nullable();
            $table->tinyInteger('umur')->nullable();
            $table->enum('jenis_kelamin', ['l', 'p'])->nullable();
            $table->text('alamat')->nullable();
            $table->date('tgl_analsa');
            $table->string('nama_penyakit')->nullable();
            $table->string('hasil')->nullable();
            $table->string('created_by');
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
        Schema::dropIfExists('penyakit');
        Schema::dropIfExists('gejala');
        Schema::dropIfExists('penyakit_gejala');
    }
};
