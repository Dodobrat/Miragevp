<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('lat')->nullable()->default(NULL);
            $table->string('lng')->nullable()->default(NULL);
            $table->boolean('show_map')->default(true);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('contacts_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('contacts_id')->unsigned();
            $table->string('title')->nullable()->default(null);
            $table->longText('description')->nullable()->default(null);
            $table->longText('working_days')->nullable()->default(null);
            $table->string('email')->nullable()->default(null);
            $table->text('address')->nullable()->default(null);
            $table->string('phone')->nullable()->default(null);
            $table->string('locale')->index();

            $table->unique([
                'contacts_id',
                'locale'
            ]);

            $table->foreign('contacts_id')->references('id')->on('contacts')->onDelete('cascade');
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
        Schema::drop('contacts');
        Schema::drop('contacts_translations');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
