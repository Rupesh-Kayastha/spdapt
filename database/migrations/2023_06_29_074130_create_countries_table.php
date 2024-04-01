<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('country_code');
            $table->string('country_name');
            $table->string('currency_symbol');
            $table->string('currency');
            $table->unsignedBigInteger('continent_id')->nullable();
            $table->foreign('continent_id')->references('id')->on('continents')->onDelete('SET NULL');
            $table->float('shipping_charge')->nullabale();
            $table->float('fuel_surcharge')->nullabale();
            $table->enum('status',['active','inactive'])->default('inactive');
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
        Schema::dropIfExists('countries');
    }
}
