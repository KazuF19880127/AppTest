<?php
// Sale.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
    ];
    
    public static function purchase($productId)
    {
        // トランザクション開始
        DB::beginTransaction();

        try {
            // 商品を取得
            $product = Product::findOrFail($productId);

            // 在庫があるか確認
            if ($product->stock <= 0) {
                throw new \Exception('在庫はありません');
            }

            // 購入処理を実行
            $sale = new Sale();
            $sale->product_id = $productId;
            $sale->save();

            $product->decrement('stock');

            // トランザクションコミット
            DB::commit();

            return true; // 購入成功
        } catch (\Exception $e) {
            // トランザクションロールバック
            DB::rollBack();
            throw $e;
        }
    }
    // リレーションシップの定義
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
