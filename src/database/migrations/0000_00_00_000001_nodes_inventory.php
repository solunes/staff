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
        Schema::create('product_stocks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->unsigned();
            $table->integer('place_id')->unsigned();
            $table->integer('initial_quantity')->nullable();
            $table->integer('quantity')->nullable();
            $table->timestamps();
            $table->foreign('parent_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('place_id')->references('id')->on('places')->onDelete('cascade');
        });
        Schema::create('purchases', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('place_id')->unsigned();
            $table->integer('user_id')->nullable();
            $table->integer('currency_id')->unsigned();
            $table->enum('type', ['normal', 'online'])->nullable()->default('normal');
            $table->string('name')->nullable();
            $table->text('files')->nullable();
            $table->enum('status', ['pending','delivered','paid'])->nullable()->default('pending');
            $table->timestamps();
            $table->foreign('place_id')->references('id')->on('places')->onDelete('cascade');
            $table->foreign('currency_id')->references('id')->on('currencies')->onDelete('cascade');
        });
        Schema::create('purchase_products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->enum('status', ['holding','finished'])->nullable()->default('holding');
            $table->integer('initial_quantity')->nullable()->default(0);
            $table->integer('quantity')->nullable()->default(0);
            $table->integer('currency_id')->unsigned();
            $table->decimal('cost', 10, 2)->nullable();
            $table->integer('sale_item_id')->nullable();
            $table->integer('partner_id')->nullable();
            $table->integer('partner_transport_id')->nullable();
            $table->decimal('investment', 10, 2)->nullable()->default(0);
            $table->decimal('transport_investment', 10, 2)->nullable()->default(0);
            $table->decimal('return', 10, 2)->nullable()->default(0);
            $table->decimal('transport_return', 10, 2)->nullable()->default(0);
            $table->decimal('profit', 10, 2)->nullable()->default(0);
            $table->timestamps();
            $table->foreign('parent_id')->references('id')->on('purchases')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
        Schema::create('staff_movements', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->unsigned();
            $table->integer('place_id')->unsigned();
            $table->string('name')->nullable();
            $table->enum('type', ['move_in','move_out'])->nullable()->default('move_in');
            $table->integer('quantity')->nullable();
            $table->timestamps();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('place_id')->references('id')->on('places')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('staff_movements');
        Schema::dropIfExists('purchase_products');
        Schema::dropIfExists('purchases');
        Schema::dropIfExists('product_stocks');
    }
}