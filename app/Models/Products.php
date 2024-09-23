<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;


    protected $table = 'table_products';
    protected $fillable = [
        'id',
        'user_id',
        'name',
        'descricao',
        'imagem',
        'preco',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
