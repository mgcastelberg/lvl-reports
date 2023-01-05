<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $filable = ['serie','correlative','base','tax','total','user_id'];

    /** Relacion Inversa 1 a M */
    public function user(){
        return $this->belongsTo('App\Models\User');
        // return $this->belongsTo(User::class);
    }
}
