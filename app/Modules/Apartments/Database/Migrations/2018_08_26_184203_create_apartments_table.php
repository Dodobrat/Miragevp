<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Kalnoy\Nestedset\NestedSet;

class CreateApartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apartments', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('show_media')->default(true)->comment('Show media'); //show media
            $table->integer('project_id')->unsigned()->nullable();
            $table->integer('floor_id')->unsigned()->nullable();
            $table->boolean('reserved')->default(false);
            NestedSet::columns($table);
            $table->timestamps();
            $table->foreign('floor_id')->references('id')->on('floors')->onDelete('cascade');
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
        });

        Schema::create('apartments_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('apartment_id')->unsigned();
            $table->string('title');
            $table->string('meta_title')->nullable()->default(null);
            $table->string('meta_description')->nullable()->default(null);
            $table->string('meta_keywords')->nullable()->default(null);
            $table->string('slug');
            $table->longText('description')->nullable()->default(null);
            $table->string('locale')->index();
            $table->unique([
                'apartment_id',
                'locale',
            ]);
            $table->unique([
                'apartment_id',
                'slug',
            ]);
            $table->foreign('apartment_id')->references('id')->on('apartments')->onDelete('cascade');
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
        Schema::dropIfExists('apartments');
        Schema::dropIfExists('apartments_translations');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
