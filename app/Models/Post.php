<?php

namespace App\Models;

use App\Comment;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'posts';
    protected $guarded = false;

    protected $withCount = ['likedUsers', 'likes'];

    public function tags(){
        return $this->belongsToMany(Tag::class, 'post_tags', 'post_id', 'tag_id');
    }

    public function category(){
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function likedUsers(){
        return $this->belongsToMany(User::class, 'post_user_likes', 'post_id', 'user_id');
    }


    public function comments(){
        return $this->hasMany(Comment::class);
    }



    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function getDateAsCarbonAttribute(){
        return Carbon::parse($this->created_at);
    }

    public function scopeLike($query, $s){
        return $query->where('title', 'LIKE', "%{$s}%");
    }

    public function ipUser(){
        $client  = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote  = @$_SERVER['REMOTE_ADDR'];

        if(filter_var($client, FILTER_VALIDATE_IP)) $ip = $client;
        elseif(filter_var($forward, FILTER_VALIDATE_IP)) $ip = $forward;
        else $ip = $remote;

        return $ip;
    }

    public function likes(){
        return $this->hasMany(Like::class, 'post_id', 'id');
    }

    public static function uploadImage(Request $request, $image = null){
        if($request->hasFile('image')){
            if($image){
                Storage::disk('public')->delete($image);
            }
            $folder = date('Y-m-d');
            return Storage::disk('public')->put("/images/{$folder}", $request['image']);
        }
        return $image;
    }

    public function getImage(){
        return $this->image ? asset("uploads/{$this->image}") : asset('no-image.png');
    }
}
