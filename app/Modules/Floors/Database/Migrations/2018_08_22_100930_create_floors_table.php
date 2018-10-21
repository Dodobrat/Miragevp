<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Kalnoy\Nestedset\NestedSet;

class CreateFloorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('floors', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('floor_num')->unsigned();
            $table->boolean('show_media')->default(true)->comment('Show media'); //show media
            $table->integer('project_id')->unsigned()->nullable();
            NestedSet::columns($table);
            $table->timestamps();
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
        });

        Schema::create('floors_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('floor_id')->unsigned();
            $table->string('title');
            $table->string('slug');
            $table->longText('description')->nullable()->default(null);
            $table->string('locale')->index();
            $table->unique([
                'floor_id',
                'locale',
            ]);
            $table->unique([
                'floor_id',
                'slug',
            ]);
            $table->foreign('floor_id')->references('id')->on('floors')->onDelete('cascade');
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
        Schema::dropIfExists('floors');
        Schema::dropIfExists('floors_translations');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
