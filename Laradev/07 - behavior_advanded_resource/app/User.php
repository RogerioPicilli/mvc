<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Address;
use App\Post;
use App\Comment;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $visible = ['name', 'email', 'admin'];

    //Este metodo pega la embaixo getAdminAttributes removendo o get e Attributes fica só o admin (legal) e ponho o admin tambem acima no visible
    protected $appends = ['admin'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function address()
    {
        return $this->hasOne(Address::class, 'user', 'id');
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'author', 'id');
    }

    public function commentsOnMyPost()
    {
        //related, through, firstkey, secondkey, localkey, secondlocalkey
        return $this->hasManyThrough(Comment::class, Post::class, 'author', 'post', 'id', 'id');
        //chave que tem em artigo que liga ao usuario = author
        //o que liga o meu comentário ao artigo = post
        //a chave da local no meu caso é sempre o campo primário id
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'item');
    }

    public function scopeUsuarios($query) 
    {
        return $query->where('level', '<=', 8);
    }

    public function scopeAdmins($query) 
    {
        return $query->where('level', '>', 8);
    }

    public function getAdminAttribute() 
    {
        return ($this->attributes['level'] > 8 ? true : false);
    }
}
