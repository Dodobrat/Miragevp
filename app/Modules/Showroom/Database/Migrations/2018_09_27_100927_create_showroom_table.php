<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Kalnoy\Nestedset\NestedSet;

class CreateShowroomTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('showroom', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('show_media')->default(true)->comment('Show media'); //show media
            NestedSet::columns($table);
            $table->timestamps();
        });

        Schema::create('showroom_translations', function (Blueprint $table){
            $table->increments('id');
            $table->integer('showroom_id')->unsigned();
            $table->string('title');
            $table->longText('description')->nullable()->default(null);
            $table->string('locale')->index();
            $table->unique([
                'showroom_id',
                'locale',
            ]);
            $table->foreign('showroom_id')->references('id')->on('showroom')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('showroom');
        Schema::dropIfExists('showroom_translations');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
