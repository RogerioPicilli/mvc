<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;
    
    protected $table = 'posts'; //Quando o nome é criado pelo Laravel ela já sabe o nome da tabela mas se precisar modificar é aqui que se faz
    protected $primaryKey = 'id'; //Idem
   
    public $timestamps = true;  //Se não quiser fazer uso deste recurso nesta tabela é só setar para false
//    public const CREATED_AT = 'Criado_em';
//    public const UPDATED_AT = 'Atualizado_em';
//    Para usar as contantes acima, remover o <<timestamps>> da criação da tabela e criar duas colunas <<timestamp>> com os novos nomes. Atenção no plural

    protected $fillable = ['title', 'subtitle', 'description' ];
    //o contrário de fillable é guarded. Se declarada não permitirá a inserção de dados naquela campo via array.
    protected $guarded = [];
}



