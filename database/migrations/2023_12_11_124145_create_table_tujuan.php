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
        Schema::create('tbl_tujuan', function (Blueprint $table) {
            $table->increments('tujuan_id');
            $table->string('tujuan_kode');
            $table->string('tujuan_nama');
            $table->string('tujuan_slug');
            $table->string('tujuan_alamat');
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
        Schema::dropIfExists('tbl_tujuan');
    }
};
