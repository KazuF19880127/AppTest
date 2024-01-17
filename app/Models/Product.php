<?php

// Product.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    
    protected $table = 'products'; 
    use HasFactory;

    protected $fillable = [
        'company_id',
        'product_name', 
        'price',
        'stock',
        'comment',
        'img_path',
        'created_at',
        'updated_at',
    ];
    
    public static $rules = [
     'product_name' => 'required|max:20',
       'price' => 'required|numeric',
       'company_id' => 'required|exists:companies,id', 
      'shosai' => 'required|max:140',
      'stock' => 'nullable|integer|min:0',
       'img_path' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
    ];
    
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
        }

    // リレーションシップの定義
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }
}

