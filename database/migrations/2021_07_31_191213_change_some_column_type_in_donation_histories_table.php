<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeSomeColumnTypeInDonationHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('donation_histories', function (Blueprint $table) {
            $table->bigInteger('users_id')
                  ->after('donation_statuses_id')->unsigned();
            $table->datetime('histories_date')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('donation_histories', function (Blueprint $table) {
            //
        });
    }
}
