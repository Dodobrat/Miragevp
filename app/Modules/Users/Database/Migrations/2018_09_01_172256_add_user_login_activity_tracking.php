<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserLoginActivityTracking extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function($table)
        {
            $table->integer('login_counter')->unsigned()->default(0);
            $table->string('last_activity')->nullable()->default(null);
            $table->timestamp('last_sign_in_at')->nullable();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function($table)
        {
            $table->dropColumn('last_activity');
            $table->dropColumn('login_counter');
            $table->dropColumn('last_sign_in_at');
        });
    }
}
