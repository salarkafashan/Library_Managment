<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function Category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function Author()
    {
        return $this->belongsTo('App\Models\Author');
    }

    public function Publisher()
    {
        return $this->belongsTo('App\Models\Publisher');
    }

    public function Shelf()
    {
        return $this->belongsTo('App\Models\Shelf');
    }

    public function Age()
    {
        return $this->belongsTo('App\Models\Age');
    }
}
