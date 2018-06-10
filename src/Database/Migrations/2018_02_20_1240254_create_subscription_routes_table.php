<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscriptionRoutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_subscription_routes', function(Blueprint $table){

            $table->increments('id');
            $table->unsignedInteger('account_subscription_id');
            $table->string('cidr')->unique();
            $table->dateTime('assigned_on')->nullable();

            $table->foreign('account_subscription_id')
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
        Schema::dropIfExists('account_subscription_routes');
    }
}
