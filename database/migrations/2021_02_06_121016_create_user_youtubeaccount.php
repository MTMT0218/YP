<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserYoutubeaccount extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_youtubeaccount', function (Blueprint $table) {
                $table->bigInteger('user_id')->references('id')->on('users')->onDelete('cascade') ->onUpdate('cascade');

                $table->string('account_id')->references('account_id')->on('youyube_accounts')->onDelete('cascade') ->onUpdate('cascade');
                $table->primary(['user_id', 'account_id']);
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_youtubeaccount');
    }
}
