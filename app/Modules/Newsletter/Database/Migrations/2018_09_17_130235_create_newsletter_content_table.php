<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsletterContentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('newsletter_content', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->boolean('show_media')->default(true)->comment('Show media'); //show media
            $table->timestamps();
        });

        Schema::create('newsletter_content_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('newsletter_id')->unsigned();
            $table->string('subject');
            $table->longText('content');
            $table->string('locale')->index();
            $table->unique([
                'newsletter_id',
                'locale',
            ]);
            $table->foreign('newsletter_id')->references('id')->on('newsletter_content')->onDelete('cascade');
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
        Schema::dropIfExists('newsletter_content');
        Schema::dropIfExists('newsletter_content_translations');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
