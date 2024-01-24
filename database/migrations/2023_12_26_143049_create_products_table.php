<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('products', function (Blueprint $table) {
        $table->bigIncrements('id');
        $table->unsignedBigInteger('company_id'); 
        $table->string('product_name');
        $table->integer('price');
        $table->integer('stock');
        $table->text('comment');
        $table->string('img_path');
        $table->timestamps();
    
        // 外部キー制約を修正
        $table->foreign('company_id', 'products_company_id_foreign')->references('company_name')->on('companies');
    });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
