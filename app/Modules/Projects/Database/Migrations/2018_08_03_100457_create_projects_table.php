<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Kalnoy\Nestedset\NestedSet;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('visible')->default(true);
            $table->boolean('show_media')->default(true)->comment('Show media'); //show media
            NestedSet::columns($table);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('projects_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('projects_id')->unsigned();
            $table->string('title');
            $table->string('meta_title')->nullable()->default(null);
            $table->string('meta_description')->nullable()->default(null);
            $table->string('meta_keywords')->nullable()->default(null);
            $table->string('slug');
            $table->string('locale')->index();
            $table->unique([
                'projects_id',
                'locale',
            ]);
            $table->unique([
                'projects_id',
                'slug',
            ]);
            $table->foreign('projects_id')->references('id')->on('projects')->onDelete('cascade');
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
        Schema::drop('projects');
        Schema::drop('projects_translations');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
