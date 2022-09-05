<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'tags',
        'company',
        'location',
        'email',
        'website',
        'description',
        'logo',
        'user_id'
    ];

    public function scopeFilter($query){
        if(request('tag') ?? false) {
            $query->where('tags','like','%'.request('tag').'%');
        }

        if (request('search')?? false){
            $query->where('title','like','%'.request('search').'%')
                ->orWhere('description','like','%'.request('search').'%')
                ->orWhere('tags','like','%'.request('search').'%')
                ->orWhere('location','like','%'.request('search').'%')
                ->orWhere('company','like','%'.request('search').'%');
        }
    }

    //Relationship to user 
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
