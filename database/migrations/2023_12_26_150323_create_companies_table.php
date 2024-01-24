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
        Schema::create('companies', function (Blueprint $table) {
            $table->id(); // id カラム（主キー）を自動増分の整数型で作成
            $table->string('company_name')->nullable(); // 文字列型で会社名を保存（nullable で空値を許容）
            $table->string('street_address');
            $table->string('representative_name');
            $table->timestamps(); // created_at と updated_at カラムを作成

            // 外部キー制約を追加
            $table->foreign('company_name')->references('id')->on('products')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companies');
    }
};
