<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->longText('short_des');
            $table->text('long_des');
            $table->string('logo');
            $table->string('photo');
            $table->string('address');
            $table->string('phone');
            $table->string('email');
            $table->string('country');
            $table->string('state');
            $table->string('city');
            $table->string('postcode');
            $table->float('free_shipping_cost')->nullabale();
            $table->string('location_map')->nullable;
            $table->string('meta_title')->nullable;
            $table->string('meta_keyword')->nullable;
            $table->longText('meta_description')->nullable;
            $table->longText('extra_code')->nullable;
            $table->string('facebook_url')->nullable;
            $table->string('instagram_url')->nullable;
            $table->string('twitter_url')->nullable;
            $table->string('youtube_url')->nullable;
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
        Schema::dropIfExists('settings');
    }
}
