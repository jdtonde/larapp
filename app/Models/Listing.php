<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Listing extends Model
{
    use HasFactory;

    protected $fillable=['name','company','location','website','email','desc','tags','user_id','logo'];

    public function scopeFilter($query, array $filters)
    {
        if($filters['tag'] ?? false ){
            $query->where('tags', 'like', '%' . request('tag') . '%'  );
        }

        if($filters['search'] ?? false ){
            $query->where('tags', 'like', '%' . request('search') . '%'  )
                 ->orWhere('desc', 'like', '%' . request('search') . '%' )
                 ->orWhere('name', 'like', '%' . request('search') . '%' )
                 ->orWhere('location', 'like', '%' . request('search') . '%' );
        }
    }


    //Relationship with user

    public function user(){
       return $this->belongsTo(User::class, 'user_id'); 
    }
    
}

