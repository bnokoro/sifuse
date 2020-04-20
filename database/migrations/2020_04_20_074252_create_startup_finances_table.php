<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStartupFinancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('startup_finances', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('revenue_type');
            $table->string('capital_needed_for');
            $table->string('business_size')->nullable();
            $table->string('cash_flow_projection')->nullable();
            $table->string('growth_projection')->nullable();
            $table->string('invested_funding')->nullable();
            $table->string('funding_needed')->nullable();
            $table->string('funding_stage')->nullable();
            $table->string('investment_ask')->nullable();
            $table->string('geographical_focus')->nullable();
            $table->string('investor_type')->nullable();
            $table->tinyInteger('interested_in_mentor')->default(0);
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
        Schema::dropIfExists('startup_finances');
    }
}
