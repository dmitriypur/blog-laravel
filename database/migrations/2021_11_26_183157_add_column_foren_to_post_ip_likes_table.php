<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnForenToPostIpLikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('post_ip_likes', function (Blueprint $table) {
            $table->index('post_id', 'pul-post_idx');
            $table->index('user_ip', 'pul-user_idx');

            $table->foreign('post_id', 'dp-post_fk')->on('posts')->references('id');
            $table->foreign('user_ip', 'dp-user_fk')->on('ip_users')->references('ip');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_ip_likes');
    }
}
