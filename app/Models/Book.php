<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'book';
    protected $fillable = [
        'title',
        'description',
        'year',
        'pages',
        'isbn',
        'editorial',
        'edition',
        'autor',
        'cover',
        'category_id'
    ];

    public function category()
    {
        return $this->belongsTo('App\Category', 'category_id');
    }
}
