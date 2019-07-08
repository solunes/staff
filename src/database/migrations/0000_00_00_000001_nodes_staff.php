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
        Schema::create('staff_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->boolean('active')->nullable()->default(1);
            $table->timestamps();
        });
        Schema::create('staffs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('agency_id')->unsigned();
            $table->integer('user_id')->nullable();
            $table->integer('staff_category_id')->nullable();
            $table->enum('type', ['regular', 'consultant', 'intern', 'external'])->nullable()->default('regular');
            $table->enum('status', ['active', 'retired', 'fired', 'resigned'])->nullable()->default('active');
            $table->string('name')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->nullable();
            $table->string('ci_number')->nullable();
            $table->string('ci_expedition')->nullable();
            $table->string('phone')->nullable();
            $table->string('cellphone')->nullable();
            $table->string('address')->nullable();
            $table->string('position')->nullable();
            $table->string('password')->nullable();
            $table->text('education_content')->nullable();
            $table->text('expierence_content')->nullable();
            $table->text('skills_content')->nullable();
            $table->date('initial_date')->nullable();
            $table->date('end_date')->nullable();
            $table->timestamps();
            $table->foreign('agency_id')->references('id')->on('agencies')->onDelete('cascade');
        });
        if(config('staff.human_resources')){
            Schema::create('staff_years', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('parent_id')->unsigned();
                $table->string('name')->nullable();
                $table->date('initial_date')->nullable();
                $table->date('end_date')->nullable();
                $table->integer('initial_vacation_days')->default(0);
                $table->integer('vacation_days')->default(0);
                $table->integer('remaining_vacation_days')->default(0);
                $table->timestamps();
                $table->foreign('parent_id')->references('id')->on('staffs')->onDelete('cascade');
            });
            Schema::create('staff_schedules', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('parent_id')->unsigned();
                $table->string('name')->nullable();
                $table->enum('day', ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'])->nullable();
                $table->time('initial_time')->nullable();
                $table->time('end_time')->nullable();
                $table->integer('hours')->nullable();
                $table->timestamps();
                $table->foreign('parent_id')->references('id')->on('staffs')->onDelete('cascade');
            });
            Schema::create('staff_vacations', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('parent_id')->unsigned();
                $table->integer('staff_year_id')->nullable();
                $table->date('initial_date')->nullable();
                $table->date('end_date')->nullable();
                $table->integer('days')->nullable();
                $table->timestamps();
                $table->foreign('parent_id')->references('id')->on('staffs')->onDelete('cascade');
            });
            Schema::create('staff_wages', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('parent_id')->unsigned();
                $table->integer('currency_id')->unsigned();
                $table->enum('type', ['monthly', 'yearly', 'weekly', 'biweekly'])->nullable()->default('monthly');
                $table->string('name')->nullable();
                $table->date('initial_date')->nullable();
                $table->date('end_date')->nullable();
                $table->decimal('total_gained',10,2)->nullable();
                $table->decimal('company_contribution',10,2)->nullable();
                $table->decimal('company_expense',10,2)->nullable();
                $table->decimal('laboral_discount',10,2)->nullable();
                $table->decimal('real_amount',10,2)->nullable();
                $table->decimal('extra_amount',10,2)->nullable();
                $table->decimal('final_amount',10,2)->nullable();
                $table->decimal('amount',10,2)->nullable();
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
                $table->decimal('initial_amount', 10, 2)->nullable();
                $table->decimal('discount_amount', 10, 2)->default(0);
                $table->decimal('amount', 10, 2)->nullable();
                $table->text('discount_observations')->nullable();
                $table->text('observations')->nullable();
                $table->timestamps();
                $table->foreign('parent_id')->references('id')->on('staffs')->onDelete('cascade');
                $table->foreign('currency_id')->references('id')->on('currencies')->onDelete('cascade');
            });
            Schema::create('attendances', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('staff_id')->unsigned();
                $table->integer('staff_schedule_id')->unsigned();
                $table->string('name')->nullable();
                $table->date('date')->nullable();
                $table->time('initial_time')->nullable();
                $table->time('end_time')->nullable();
                $table->boolean('delay')->default(0);
                $table->integer('delay_minutes')->default(0);
                $table->text('observations')->nullable();
                $table->timestamps();
                $table->foreign('staff_id')->references('id')->on('staffs')->onDelete('cascade');
                $table->foreign('staff_schedule_id')->references('id')->on('staff_schedules')->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attendances');
        Schema::dropIfExists('staff_payments');
        Schema::dropIfExists('staff_wages');
        Schema::dropIfExists('staff_vacations');
        Schema::dropIfExists('staff_schedules');
        Schema::dropIfExists('staff_years');
        Schema::dropIfExists('staffs');
        Schema::dropIfExists('staff_categories');
    }
}
