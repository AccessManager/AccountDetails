<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_subscriptions', function(Blueprint $table){

            $table->increments('id');
            $table->unsignedInteger('account_id');
            $table->unsignedTinyInteger('type');
            $table->string('username')->unique();
            $table->string('password');
            $table->string('name')->nullable();
            $table->unsignedInteger('sim_sessions')->nullable();
            $table->unsignedInteger('interim_updates')->nullable();
            $table->dateTime('expires_on')->nullable();
            $table->timestamps();
            $table->unsignedTinyInteger('status')->default(\AccessManager\Constants\Subscription::STATUS_ACTIVE);

            $table->foreign('account_id')
                ->references('id')->on('accounts')
                ->onDelete('cascade');
        });

        Schema::create('account_subscription_primary_policies', function(Blueprint $table){
            $table->engine = 'InnoDB';

            $table->increments('account_subscription_id');
            $table->unsignedInteger('min_up');
            $table->enum('min_up_unit', \AccessManager\Constants\Bandwidth::BANDWIDTH_UNITS );
            $table->unsignedInteger('min_down');
            $table->enum('min_down_unit', \AccessManager\Constants\Bandwidth::BANDWIDTH_UNITS );
            $table->unsignedInteger('max_up');
            $table->enum('max_up_unit', \AccessManager\Constants\Bandwidth::BANDWIDTH_UNITS );
            $table->unsignedInteger('max_down');
            $table->enum('max_down_unit', \AccessManager\Constants\Bandwidth::BANDWIDTH_UNITS );

            $table->foreign('account_subscription_id', 'acct_sub_pr_policy_foreign')
                ->references('id')
                ->on('account_subscriptions')
                ->onDelete('cascade');
        });

        Schema::create('account_subscription_limits', function(Blueprint $table){
            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->unsignedInteger('account_subscription_id');
            $table->unsignedInteger('time_limit')->nullable();
            $table->enum('time_unit', \AccessManager\Constants\Time::TIME_LIMIT_UNITS);
            $table->unsignedInteger('data_limit')->nullable();
            $table->enum('data_unit', \AccessManager\Constants\Data::DATA_LIMIT_UNITS);
            $table->unsignedInteger('reset_every');
            $table->enum('reset_every_unit', \AccessManager\Constants\Time::TIME_DURATION_UNITS);

            $table->foreign('account_subscription_id')
                ->references('id')
                ->on('account_subscriptions')
                ->onDelete('cascade');
        });

        Schema::create('account_subscription_aq_policies', function(Blueprint $table){
            $table->engine = 'InnoDB';

            $table->unsignedInteger('account_subscription_id');
            $table->unsignedInteger('min_up');
            $table->enum('min_up_unit', \AccessManager\Constants\Bandwidth::BANDWIDTH_UNITS );
            $table->unsignedInteger('min_down');
            $table->enum('min_down_unit', \AccessManager\Constants\Bandwidth::BANDWIDTH_UNITS );
            $table->unsignedInteger('max_up');
            $table->enum('max_up_unit', \AccessManager\Constants\Bandwidth::BANDWIDTH_UNITS );
            $table->unsignedInteger('max_down');
            $table->enum('max_down_unit', \AccessManager\Constants\Bandwidth::BANDWIDTH_UNITS );

            $table->foreign('account_subscription_id')
                ->references('id')
                ->on('account_subscriptions')
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
        Schema::dropIfExists('account_subscription_aq_policies');
        Schema::dropIfExists('account_subscription_limits');
        Schema::dropIfExists('account_subscription_primary_policies');
        Schema::dropIfExists('account_subscriptions');
    }
}
