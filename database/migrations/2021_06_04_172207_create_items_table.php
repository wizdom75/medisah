<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->integer('merchant_id')->index();
            $table->string('name');
            $table->integer('category_id')->nullable()->index();
            $table->text('description')->nullable();
            $table->string('gtin')->nullable();
            $table->string('sku')->nullable();
            $table->enum('unit', [
                'Item',
                'Kilogram',
                'Litre',
                'Metre',
                'Pack',
                'Punnet'
            ])->nullable();
            $table->integer('price')->nullable();
            $table->integer('cost')->nullable();
            $table->integer('stock')->nullable();
            $table->enum('is_active', ['Yes', 'No'])->default('Yes')->index();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
}
