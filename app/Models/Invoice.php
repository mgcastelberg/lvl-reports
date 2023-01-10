<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $filable = ['serie','correlative','base','tax','total','user_id'];

    /** QueryScopes */
    public function scopeFilters($query, $filters){
        // $query->when(true, function($query){});
        $query->when($filters['serie'] ?? null, function($query, $serie){
            $query->where('serie', $serie);
        })->when($filters['fromNumber'] ?? null, function($query, $fromNumber){
            $query->where('correlative', '>=', $fromNumber);
        })->when($filters['toNumber'] ?? null, function($query, $toNumber){
            $query->where('correlative', '<=', $toNumber);
        })->when($filters['fromDate'] ?? null, function($query, $fromDate){
            $query->where('create_at', '>=', $fromDate);
        })->when($filters['toDate'] ?? null, function($query, $toDate){
            $query->where('create_at', '>=', $toDate);
        });
    }

    /** Relacion Inversa 1 a M */
    public function user(){
        return $this->belongsTo('App\Models\User');
        // return $this->belongsTo(User::class);
    }
}
