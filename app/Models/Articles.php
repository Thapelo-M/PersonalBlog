<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Articles extends Model
{
    use HasFactory;
    protected $guarded = [];

    //Get the category associated with the article
    // public function categories()
    // {
    //     return $this->hasOne(Categories::class);
    //     // return $this->belongsTo(Categories::class, 'articles_id');
    // }
    // //Get tag(s) associated with the article
    // public function tags()
    // {
    //     return $this->hasMany(Tags::class);
    //     // return $this->belongsTo(Tags::class, 'articles_id');
    // }

}
