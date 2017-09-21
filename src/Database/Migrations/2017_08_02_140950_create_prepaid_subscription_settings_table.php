<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrepaidSubscriptionSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prepaid_subscription_settings', function(Blueprint $table){
            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->unsignedInteger('prepaid_subscription_id');
            $table->dateTime('recharged_on')->nullable();

            $table->foreign('prepaid_subscription_id')
                ->references('id')->on('account_subscriptions')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prepaid_subscription_settings');
    }
}
