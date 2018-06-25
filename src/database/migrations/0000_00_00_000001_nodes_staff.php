<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NodesStaff extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staffs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('place_id')->unsigned();
            $table->integer('user_id')->nullable();
            $table->enum('type', ['regular', 'consultant', 'intern', 'external'])->nullable()->default('regular');
            $table->enum('status', ['active', 'retired', 'fired', 'resigned'])->nullable()->default('active');
            $table->string('name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('first_name')->nullable();
            $table->string('ci_number')->nullable();
            $table->string('ci_expedition')->nullable();
            $table->string('phone')->nullable();
            $table->string('cellphone')->nullable();
            $table->string('address')->nullable();
            $table->string('position')->nullable();
            $table->text('education_content')->nullable();
            $table->text('expierence_content')->nullable();
            $table->text('skills_content')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->timestamps();
            $table->foreign('place_id')->references('id')->on('places')->onDelete('cascade');
        });
        Schema::create('staff_wages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->unsigned();
            $table->integer('currency_id')->unsigned();
            $table->enum('type', ['monthly', 'yearly', 'weekly', 'biweekly'])->nullable()->default('monthly');
            $table->string('name')->nullable();
            $table->string('amount')->nullable();
            $table->text('observations')->nullable();
            $table->timestamps();
            $table->foreign('parent_id')->references('id')->on('staffs')->onDelete('cascade');
            $table->foreign('currency_id')->references('id')->on('currencies')->onDelete('cascade');
        });
        Schema::create('staff_payments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->unsigned();
            $table->integer('currency_id')->unsigned();
            $table->string('name')->nullable();
            $table->enum('status', ['pending', 'delayed', 'paid', 'cancelled'])->nullable()->default('pending');
            $table->string('amount')->nullable();
            $table->text('observations')->nullable();
            $table->timestamps();
            $table->foreign('parent_id')->references('id')->on('staffs')->onDelete('cascade');
            $table->foreign('currency_id')->references('id')->on('currencies')->onDelete('cascade');
        });
        Schema::create('attendances', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->unsigned();
            $table->integer('currency_id')->unsigned();
            $table->string('name')->nullable();
            $table->enum('status', ['pending', 'delayed', 'paid', 'cancelled'])->nullable()->default('pending');
            $table->string('amount')->nullable();
            $table->text('observations')->nullable();
            $table->timestamps();
            $table->foreign('parent_id')->references('id')->on('staffs')->onDelete('cascade');
            $table->foreign('currency_id')->references('id')->on('currencies')->onDelete('cascade');
        });
        Schema::create('labor_days', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->unsigned();
            $table->integer('currency_id')->unsigned();
            $table->string('name')->nullable();
            $table->enum('status', ['pending', 'delayed', 'paid', 'cancelled'])->nullable()->default('pending');
            $table->string('amount')->nullable();
            $table->text('observations')->nullable();
            $table->timestamps();
            $table->foreign('parent_id')->references('id')->on('staffs')->onDelete('cascade');
            $table->foreign('currency_id')->references('id')->on('currencies')->onDelete('cascade');
        });
        Schema::create('free_days', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->unsigned();
            $table->integer('currency_id')->unsigned();
            $table->string('name')->nullable();
            $table->enum('status', ['pending', 'delayed', 'paid', 'cancelled'])->nullable()->default('pending');
            $table->string('amount')->nullable();
            $table->text('observations')->nullable();
            $table->timestamps();
            $table->foreign('parent_id')->references('id')->on('staffs')->onDelete('cascade');
            $table->foreign('currency_id')->references('id')->on('currencies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('staff_payments');
        Schema::dropIfExists('staff_wages');
        Schema::dropIfExists('staffs');
    }
}
