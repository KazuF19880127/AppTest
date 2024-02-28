<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Product extends Model
{
    protected $table = 'products'; 
    use HasFactory;
    use Sortable;

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

    public $sortable = [
        'id',
        'product_name', 
        'price',
        'stock',
        'company_id',
    
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }
}
