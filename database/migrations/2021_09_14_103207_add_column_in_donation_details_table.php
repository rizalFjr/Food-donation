<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnInDonationDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('donation_details', function (Blueprint $table) {
            $table->bigInteger('members_id')->after('donations_id')->unsigned()->nullable();
            $table->string('status')->after('foto')->nullable();
            $table->bigInteger('donations_id')->unsigned()->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('donation_details', function (Blueprint $table) {
            //
        });
    }
}
