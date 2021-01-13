<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function author()
    {
        return $this->belongsTo('App\Models\User', 'authour_id');
    }

    public function section()
    {
        return $this->belongsTo('App\Models\Section', 'section_id');
    }
}
