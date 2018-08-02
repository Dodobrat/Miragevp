<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Kalnoy\Nestedset\NestedSet;

class CreateBlogCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('visible')->default(true);
            NestedSet::columns($table);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('blog_categories_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('blog_category_id')->unsigned();
            $table->string('title');
            $table->string('meta_title')->nullable()->default(null);
            $table->string('meta_description')->nullable()->default(null);
            $table->string('meta_keywords')->nullable()->default(null);
            $table->string('slug');
            $table->longText('description')->nullable()->default(null);
            $table->string('locale')->index();
            $table->unique([
                'blog_category_id',
                'locale',
            ]);
            $table->unique([
                'blog_category_id',
                'slug',
            ]);
            $table->foreign('blog_category_id')->references('id')->on('blog_categories')->onDelete('cascade');
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
        Schema::drop('blog_categories');
        Schema::drop('blog_categories_translations');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
