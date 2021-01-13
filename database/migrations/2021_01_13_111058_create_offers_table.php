<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->string('slug', 255);
            $table->timestamp('published_at')->nullable(); //dodao nullable ako nije objavljeno da bude null
            $table->timestamp('unpublished_at')->nullable();
            $table->boolean('published');
            $table->text('introduction');
            $table->text('description');
            $table->integer('authour_id')->references('id')->on('users');
            $table->integer('section_id')->references('id')->on('sections');
            $table->string('image', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('offers');
    }
}
