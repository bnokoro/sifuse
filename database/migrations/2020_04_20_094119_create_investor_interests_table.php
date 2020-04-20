<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvestorInterestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('investor_interests', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('investor_type');
            $table->string('geographical_focus')->nullable();
            $table->string('investment_range')->nullable();
            $table->integer('investment_stage_id');
            $table->string('investment_type')->nullable();
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
        Schema::dropIfExists('investor_interests');
    }
}
