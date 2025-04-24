<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRestaurantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restaurants', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('post_code');
            $table->string('address');
            $table->string('phone_number');
            $table->string('image_url')->nullable();
            $table->string('email')->nullable();
            $table->foreignId('area_id')->constrained('areas')->onDelete('cascade');
            $table->foreignId('cuisine_type_id')->constrained('cuisine_types')->onDelete('cascade');
            $table->text('detail')->nullable();
            $table->foreignId('owner_id')->constrained('users')->onDelete('cascade');
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
        Schema::dropIfExists('restaurants');
    }
}
