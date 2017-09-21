<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscriptionServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_subscription_services', function(Blueprint $table){
            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->unsignedInteger('account_subscription_id');
            $table->unsignedBigInteger('time_balance')->nullable();
            $table->unsignedBigInteger('data_balance')->nullable();
            $table->timestamp('last_reset_on')->nullable();
            $table->boolean('exhausted')->default(0);

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
        Schema::dropIfExists('account_subscription_services');
    }
}
