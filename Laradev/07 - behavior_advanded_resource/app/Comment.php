<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['content','item_type', 'item_id'];

    //é o mesmo nome do campo criado lá na tabela comments
    public function item() 
    {
        return $this->morphTo();
    }
}
