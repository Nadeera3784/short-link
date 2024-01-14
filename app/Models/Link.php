<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Builders\LinkQueryBuilder;
use Illuminate\Database\Eloquent\Builder;

class Link extends Model
{
    use HasFactory;

    protected $fillable = [
        'url',
        'identifier'
    ];

    public function newEloquentBuilder($query): Builder
    {
        return new LinkQueryBuilder($query);
    }
}
