<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonationDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donation_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('donations_id');
            $table->bigInteger('donation_categories_id');
            $table->bigInteger('quantities_id');
            $table->string('nama_barang');
            $table->integer('jumlah');
            $table->string('foto');
            $table->softDeletes();
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
        Schema::dropIfExists('donation_details');
    }
}
