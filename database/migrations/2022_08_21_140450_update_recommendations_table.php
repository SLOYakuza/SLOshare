<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('recommendations', function (Blueprint $table) {
            $table->unsignedBigInteger('cartoons_id')->nullable()->index();

            $table->unsignedBigInteger('recommendation_cartoons_id')->nullable()->index();

            $table->unique(['cartoons_id', 'recommendation_cartoons_id']);
        });
    }
};