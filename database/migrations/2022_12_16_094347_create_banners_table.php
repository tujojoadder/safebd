<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->string('banner_title_en',100)->nullable();
            $table->string('banner_title_bn',100)->nullable();
            $table->string('banner_description_en',100)->nullable();
            $table->string('banner_description_bn',100)->nullable();
            $table->string('banner_slug_en',100)->nullable();;
            $table->string('button_name_en', 100)->nullable();
            $table->string('button_name_bn', 100)->nullable();
            $table->string('banner_image');
            $table->unsignedTinyInteger('status')->default(1)->comment('1=>Active, 0=>Inactive');
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
        Schema::dropIfExists('banners');
    }
}
