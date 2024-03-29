<?php

// Companies.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name',
        'street_address',
        'representative_name',
    ];

    // リレーションシップの定義
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
