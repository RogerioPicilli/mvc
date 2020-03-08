// Após a instalação que foi laravel new behavior configurar o namespace

php artisan app:name LaraDev

Vai ganhar  um erro pois este comando foi retirada a partir da versão 6. Se quiser corrigir aplique:
composer require andrey-helldar/laravel-app --dev   e depois execute novamente o comando app:name

------------------------------------------------------------------------------------------------------
Documentação sobre o migration https://laravel.com/docs/6.x/migrations 
------------------------------------------------------------------------------------------------------
Criar o modelo já com migration php artisan make:model Post -m
------------------------------------------------------------------------------------------------------
Para executar:  php artisan migrate
Vai dar um erro em razão do tamanho do campo que é resolvido aplicando a seguinte solução
    Editar o arquivo:   AppServiceProvider.php 
    Incluir:            use Illuminate\Support\Facades\Schema;
                        public function boot()
                        {
                            Schema::defaultStringLength(191);
                        }
------------------------------------------------------------------------------------------------------
Se quiser adicionar uma coluna (Pra mim é melhor fazer a porra toda novamente mas...)
php artisan  make:migration add_column_posts_slug --table=posts
public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->string('slug')->unique()->after('title');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
------------------------------------------------------------------------------------------------------
Criar o model categorias com o controlador resources (métidos e o migrate)
php artisan make:model Categories -rm

Criar um relacionamento separado da tabela (Eu prefiro tudo junto)
php artisan make:migration constraint_posts_categories --table=posts
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->unsignedInteger('category');

            $table->foreign('category')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropForeign('category');
            $table->dropColumn('category'); 
        });
    }
------------------------------------------------------------------------------------------------------
Criando o usuário admim do seu sistema
php artisan make:migration insert_user_admin

No arquivo .env criar as seguites linhas 
ADMIN_EMAIL=admin@admin.com.br 
ADMIN_PASS=admin

Colocar no .env de exemplo também com dados falsos.

    public function up()
    {
        $email = env('ADMIN_EMAIL', 'admin@admim.com.br'); //O segundo parâmetro estou colocando só pra saber que existe. Não usar
        $pass = bcrypt(env('ADMIN_PASS'));
        DB::table('users')->insert([
            'name' => 'Administrador',
            'email' => $email,
            'password' => $pass            
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $email = env('ADMIN_EMAIL');
        DB::delete('DELETE FROM users WHERE email = ?', [$email]);
    }
------------------------------------------------------------------------------------------------------
Rollback = php artisan migrate:rollback --step=1
Refresh  = php artisan migrate:refresh (Faz todos rollbacks (executando todos os migrates down) e todos ups (migrate))
Fresh    = php artisan migrate:fresh (dropa tudo e cria tudo)
------------------------------------------------------------------------------------------------------
Criando Seeders (semeando)
Documentação sobre o seeders https://laravel.com/docs/6.x/seeding

php artisan make:seeder UsersTableSeeder
    public function run()
    {
        DB::table('users')->insert([
            'name' => str_random(10),
            'email' => str_random(10) . '@docs.com.br',
            'password' => bcrypt('demo')
        ]);
    }

Para executar a seed que criamos, descomentar a linha do arquiov criado automaticamente DatabaseSeeder.php 
class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(UsersTableSeeder::class);
    }
}
Depois executar o seguinte comando

php artisan db:seed ou se quiser rodar apenas um seeder onde houver mais do que 1
php artisan db:seed --class=UsearsTableSeeder

NOTA: PARA RODAR O SEED APOS UM FRESH OU REFRESH DO MIGRAGTION ACRECENTAR NO MIGRATION O PARAMETRO --seed
php artisan migrate:refresh --seed
------------------------------------------------------------------------------------------------------
Criando Factories
Documentação sobre o seeders https://laravel.com/docs/6.x/seeding#using-model-factories
Documentação sobre o Faker https://github.com/fzaninotto/Faker

php artisan make:factory PostFactory
$factory->define(Post::class, function (Faker $faker) {

    $title = $faker->sentence(10);
    return [
       'title' => $title,
       'slug' => str_slug($title),
       'subtitle' => $faker->sentence(10),
       'description' => $faker->paragraph(5),
       'publish_at' => $faker->dateTime(),
       'gategory' => function(){
           return factory(Categories::class)->create()->id;
       }
    ];
});

php artisan make:factoty CategoryFactory
$factory->define(Categories::class, function (Faker $faker) {

    $title = $faker->sentence(3);
    return [
        'title' => $title,
        'slug' => str_slug($title)
    ];
});

Para rodar as factory tem 2 formas. Aqui no curso ele explica com o Seed mas da pra fazer com o tinker
php artisan make:seeder PortsTableSeeder
class PostsTableSeeder extends Seeder
{
    public function run()
    {
        factory(Post::class, 10)->create();
    }
}
Depois disto executar no terminal 
php artisan db:seed --class=PostsTableSeed

------------------------------------------------------------------------------------------------------
--- ELOQUENT
------------------------------------------------------------------------------------------------------
Foram fornecidos pelo treinamento alguns arquivos (Views, migrations, Factory e seeds).
Para que o sistema tenha conhecimento deles é necessário executar o comando:

composer dump-autoload no terminal
------------------------------------------------------------------------------------------------------

No model é que existe a ligação do mesmo com a tabela no db
class Post extends Model
{
   protected $table = 'posts'; //Quando o nome é criado pelo Laravel ela já sabe o nome da tabela mas se precisar modificar é aqui que se faz
   protected $primaryKey = 'id'; //Idem
   public $timestamps = true;  //Se não quiser fazer uso deste recurso nesta tabela é só setar para false
   //    public const CREATED_AT = 'Criado_em';
   //    public const UPDATED_AT = 'Atualizado_em';
   //    Para usar as contantes acima, remover o <<timestamps>> da criação da tabela e criar duas colunas <<timestamp>> com os novos nomes. Atenção no plural

}
------------------------------------------------------------------------------------------------------
--- SOFTDELETE
------------------------------------------------------------------------------------------------------
Nativo do eloquente (lixeira)

Configurado no arquivo do Model

use Illuminate\Database\Eloquent\SoftDeletes;
class Post extends Model
{
    use SoftDeletes;
    ...

Acrescentar uma coluna na tabela, neste caso tabela posts
php artisan make:migration add_soft_deletes_posts --table=posts 
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->softDeletes();
        });
    }
//Pega somente os que estao marcados como deletados
$posts = Post::onlyTrashed()->get();
//traz para a vida algo que foi softdeleted
$post = Post::onlyTrashed()->where(['id' => $post])->first();
if($post->trashed()){
    $post->restore();
//Apaga definitivamente
Post::onlyTrashed()->where(['id' => $post])->forceDelete();
//Traz tudo Deletados e Vivos
$posts = Post::withTrashed()->get();
------------------------------------------------------------------------------------------------------
--- RELACIONAMENTO
------------------------------------------------------------------------------------------------------
// Estão nos comentários dos controller
------------------------------------------------------------------------------------------------------
--- POLIMORFISMO
------------------------------------------------------------------------------------------------------
Vamos usar a tabela existente (que será modificada) comments
Estrutura atual: id, post, user, content, createe_at, updated_at
Editar o migration da criação da tabela comments
Atual
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('post');
            $table->unsignedInteger('user');
            $table->text('content');

            $table->foreign('post')->references('id')->on('posts')->onDelete('cascade');
            $table->foreign('user')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
Nova 
       Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            // $table->unsignedInteger('post');
            // $table->unsignedInteger('user');
            $table->text('content');
            $table->morphs('item');

            // $table->foreign('post')->references('id')->on('posts')->onDelete('cascade');
            // $table->foreign('user')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });

A tabela comments será criada com 2 campos relacionados ao morphs:
    item_type do tipo VARCHAR  (vai armazenar o nome do modelo de está sendo usado ARTIGO, IMOVEL, CATEGORIA, USUARIO, ETC. )
    item_id   do tipo BIGINT   (vai salvar o id do modelo que estamos referenciando id do ARTIGO, IMOVEL, CATEGORIA, USUARIO, ETC.)

Para que isso funcione é preciso parametrizar os modelos que o usarão. Por exemplo:
No modelo Comment:
class Comment extends Model
{
    protected $fillable = ['content'];
    //é o mesmo nome do campo criado lá na tabela comments
    public function item() 
    {
        return $this->morphTo();
    }
}
Se a tabela Posts for usar a tabela comentário, criar no modelo Post:

    public function comments() 
    {
        return $this->morphToMany(Comment::class, 'item');
    }

Se a tabela Usuarios for usar a tabela comentário, criar no modelo Post:

    public function comments() 
    {
        return $this->morphToMany(Comment::class, 'item');
    }
------------------------------------------------------------------------------------------------------
--- DEFININDO SCOPO
------------------------------------------------------------------------------------------------------
Segrega informações baseadas em um campo da tabela. Por exemplo a tabela de usuários tem uma coluna 
denominada 'level' do tipo inteira que vai de 1 até 10. De 1 até 8 são usuários comuns e acima de 8
são os administradores. No modelo User então criar 2 metodos denominados scopeUsuarios e scopeAdmin.
Note que a palavra scope no ínico é obritória.

No Modelo
    public function scopeUsuarios($query) 
    {
        return $query->where('level', '<=', 8);
    }

    public function scopeAdmins($query) 
    {
        return $query->where('level', '>', 8);
    }

No controller
        $admins = User::admins()->get();
        if($admins){
            echo "<h1>Admins do Sistema</h1><br>";
            foreach($admins as $admin){
                echo "Nome do usuário : {$admin->name}<br>";
                echo "Email do usuário: {$admin->email}<hr>";
            }
        }
------------------------------------------------------------------------------------------------------
--- ACESSOR E MUTATOR   get e set
------------------------------------------------------------------------------------------------------
GET
No Modelo Post - Notar que get e Attribute são obrigatórios. Você vai chamar apenas CreatedBr
    public function getCreatedBrAttribute() 
    {
        return date('d/m/Y H:i', strtotime($this->created_at));
    }

Outra forma de usar com FirstName e LastName. Poderia criar um getFullnameAttributte

No Controller
        echo "Quando :<b> {$post->createdBr}</b><hr>";

SET 
No Modelo Post - Notar que set e Attribute são obrigatórios. Você vai chamar apenas CreatedBr
    public function setTitleAttribute($value) 
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = str_slug($value);
        
    }

No Controller
        $post->title = 'Título de teste do meu artigo notório!';
        $post->save(); 
Notar que o save() vai chamar automaticamente o setTitleAttibute
------------------------------------------------------------------------------------------------------
--- Collections
------------------------------------------------------------------------------------------------------
https://laravel.com/docs/6.x/collections
https://laravel.com/docs/5.7/eloquent-collections
https://laravel.com/docs/6.x/eloquent-collections
------------------------------------------------------------------------------------------------------
--- Serialização de modelo
------------------------------------------------------------------------------------------------------
Os testes serão feitos com o modelo User
        $users = User::all();
        var_dump($users->toArray());
        var_dump($users->toJson(JSON_PRETTY_PRINT));

Notar que algumas informações são escondidas. Isso se deve a configuração feita no modelo
    protected $fillable = [
        'name', 'email', 'password',
    ];
    //Esconde as colunas definidas
    protected $hidden = [
        'password', 'remember_token',
    ];
    //Só mostra as colunas definidas e despresa o Hidden
    protected $visible = [
        'name', 'email', admin
    ];
    
    public function getAdminAttribute() 
    {
        return ($this->attributes['level'] > 8 ? true : false);
    }

Resultado da página http://localhost:8000/users/1
{
    "name": "Emerson Williamson",
    "email": "rodger91@example.net",
    "admin": true
}

   public function getAdminAttribute() 
    {
        return ($this->attributes['level'] > 8 ? 'Rogério' : 'Picillli');
    }
Resultado da página http://localhost:8000/users/1
    {
        "name": "Miracle Macejkovic",
        "email": "gust.orn@example.net",
        "admin": "Picilli"
    },
    {
        "name": "Elian Wunsch",
        "email": "timmy.ohara@example.net",
        "admin": "Rogerio"
    }

No controller
        $users = User::all();
        var_dump($users->toArray());
        var_dump($users->toJson(JSON_PRETTY_PRINT));
        var_dump($users->makeVisible('created_at')->toJson(JSON_PRETTY_PRINT));

Resultado na pagina
    {
        "name": "Miracle Macejkovic",
        "email": "gust.orn@example.net",
        "created_at": "2020-02-25 14:19:15",
        "admin": false
    },
    {
        "name": "Elian Wunsch",
        "email": "timmy.ohara@example.net",
        "created_at": "2020-02-25 14:19:15",
        "admin": true




