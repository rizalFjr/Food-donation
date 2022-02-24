<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeSomeColumnTypeInMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('members', function (Blueprint $table) {
            $table->string('tempat_lahir')->nullable()->change();
            $table->date('tanggal_lahir')->nullable()->change();
            $table->string('alamat')->nullable()->change();
            $table->string('provinsi')->nullable()->change();
            $table->string('kota')->nullable()->change();
            $table->string('kecamatan')->nullable()->change();
            $table->string('kelurahan')->nullable()->change();
            $table->string('rw')->nullable()->change();
            $table->string('rt')->nullable()->change();
            $table->string('kode_pos')->nullable()->change();
            $table->string('foto')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('members', function (Blueprint $table) {
            //
        });
    }
}
