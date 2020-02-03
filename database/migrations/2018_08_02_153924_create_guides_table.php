<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGuidesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guides', function (Blueprint $table) {
            $table->increments('id');
            $table->string('number', 100);
            $table->date('shipping_date');
            $table->date('dex_date')->nullable();
            $table->timestamps();
            // $table->softDeletes();
        });

        Schema::table('guides', function (Blueprint $table) {
            $table->unsignedInteger('type_guide_id');
            $table->foreign('type_guide_id')->references('id')->on('type_guides')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('guides');
    }
}
