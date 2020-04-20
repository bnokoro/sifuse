<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStartupMarketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('startup_markets', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->text('addressable_market')->nullable();
            $table->string('percentage_of_market')->nullable();
            $table->text('marketing_strategy')->nullable();
            $table->string('company_competitors')->nullable();
            $table->text('competitive_advantage')->nullable();
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
        Schema::dropIfExists('startup_markets');
    }
}
