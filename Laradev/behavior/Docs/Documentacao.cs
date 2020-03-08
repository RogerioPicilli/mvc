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
------------------------------------------------------------------------------------------------------
--- Email - app.sendgrid.com  -  rpicilli  -  padrão 13
------------------------------------------------------------------------------------------------------
docsemailapi = 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
Install the package
The recommended installation requires Composer. Add the following to your composer.json file:
{
  "require": {
    "sendgrid/sendgrid": "~7"
  }
}
Send your first email
The following is the minimum needed code to send an email:
<?php
require 'vendor/autoload.php'; // If you're using Composer (recommended)
// Comment out the above line if not using Composer
// require("<PATH TO>/sendgrid-php.php");
// If not using Composer, uncomment the above line and
// download sendgrid-php.zip from the latest release here,
// replacing <PATH TO> with the path to the sendgrid-php.php file,
// which is included in the download:
// https://github.com/sendgrid/sendgrid-php/releases

$email = new \SendGrid\Mail\Mail(); 
$email->setFrom("test@example.com", "Example User");
$email->setSubject("Sending with SendGrid is Fun");
$email->addTo("test@example.com", "Example User");
$email->addContent("text/plain", "and easy to do anywhere, even with PHP");
$email->addContent(
    "text/html", "<strong>and easy to do anywhere, even with PHP</strong>"
);
$sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));
try {
    $response = $sendgrid->send($email);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: '. $e->getMessage() ."\n";
}
------------------------------------------------------------------------------------------------------
--- Email - app.sendgrid.com  -  rpicilli  -  padrão 13  -  Usando SMTP
------------------------------------------------------------------------------------------------------
Create an API key
This allows your application to authenticate to our API and send mail. You can enable or disable additional permissions on the API keys page.

 "docsemailsendgrid" was successfully created and added to the next step.
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
Configure your application
Configure your application with the settings below.

Server	smtp.sendgrid.net
Ports	
25, 587	(for unencrypted/TLS connections)
465	(for SSL connections)
Username	apikey
Password	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
------------------------------------------------------------------------------------------------------
--- Email - Criando e Enviando
------------------------------------------------------------------------------------------------------
php artisan make:mail welcomeLaradev
Este comando irá criar um objeto dentro do app com nome Mail\welcomeLaradev
Nesta classe tem um método build que é onde fazemos algumas configurações
    public function build()
    {
        $this->subject('Seja benvindo à Docs Ti Brasil');

        return $this->view('mail.welcomeLaradev');
    }
Neste teste estamos enviando pelo web.php numa função anonima que usa a pagina welcomeLaradev
------------------------------------------------------------------------------------------------------
--- Componentes pre formatados
------------------------------------------------------------------------------------------------------
O Laravel disponibiliza alguns componentes. Por exemplo:
No objeto email que foi criado, mais precisamente na View se iniciarmos o arquivo .blade.php com o 
@component('mail::message') e terminarmos com @endcomponent ele format o email que fica bem 
profissional. Para tanto, no controller onde está o metodo build também precisa mudar, onde está view
colocar markdown
    public function build()
    {
        $this->subject('Seja benvindo à Docs Ti Brasil');
        $this->to($this->user->email, $this->user->name);
        return $this->markdown('mail.welcomeLaradev')->with(['user' => $this->user, 'order' =>$this->order]);
    }

Para carregar para o aplicativo todos os componentes

PS C:\wamp64\www\Laradev\behavior> php artisan vendor:publish --tag=laravel-mail
Copied Directory [\vendor\laravel\framework\src\Illuminate\Mail\resources\views] To [\resources\views\vendor\mail]
Publishing complete.

Dá pra ver que foi copiado todo o conteúdo de um local para outro que fica dentro de nossa diretorio views\vendor

O markdown é parecido com o html ou outra linguagem de marcação. Para aprender ou consultar https://dillinger.io

------------------------------------------------------------------------------------------------------
--- Colocando tarefas em filas para processamento - Por exemplo Envio de Email em Background
------------------------------------------------------------------------------------------------------
Lista de Processamento  e  Processamento Agendado
======================     ======================
Ideal para baixar o tempo de processamento. 
Uma cron para enviar email de Feliz Aniversario diariamente as 08:00 horas

No arquivo de configuração .env existe uma entrada QUEUE_CONNECTION que por padrão está em sync que deverá ser alterado
Acessar na pasta config o arquivo queue.php que mostra todas as operações

Primerio criar  uma tabela no terminal:
=>php artisan queue:table ==> isto irá criar uma migration
=>php artisan migrate

A mesma função que estamos usando para teste e está enviando email no web.php foi duplicada e mudado o methodo send para queue

**NAO ESQUECER DE RESTART O LOCALHOST:8000. O .ENV SO É LIDO NO COMEÇO
No arquivo .env mudar o QUEUE_CONNECTION de sinc para database
                                            ====      ======== 
Isto já faz com que o usuário não fique esperando o envio do email, MAS O EMAIL NÃO FOI ENVIADO AINDA!!! Ele foi gravado na 
tabela jobs que criamos. Para executar é necessário lançar um serviço no Laravel com o seguinte comando no terminal
=>php artisan queue:work

Para parar o monitoramento Ctrl+C

Existe uma outra forma que não precisa mudar o send para queue. Para isso editar a classe welcomeLaradev.php
=>mudar de class welcomeLaradev extends Mailable   para  class welcomeLaradev extends Mailable implements ShouldQueue

No tipo LIsta de Processamento que é a que estamos vendo até aqui, caso uma tarefa dê erro, ela ficará tentando enviar
pra sempre. Precisa configurar o número de vezes que se quer tentar uma tarefa, no caso, enviar o email antes de desconsiderá-lo 
Isto é feito criando-se um job que possui outras tantas opções como vemos a seguir.

=>php artisan make:job emailWelcome

Este comando irá criar uma pasta la no app com o nome jobs e  um arquivo com o nome emailWelcome com dois metodos:
__constructor e handle
Pegar o comando que envia email e está no arquivo web.php e colocar dentro do handle comentando o do web.php

 Mail::send(new \App\Mail\welcomeLaradev($user, $order));

 Depois de arrumar o arquivo job\emailWelcome (Variaveis, construct, etc.), voltar ao web.php e chamar esta classe

=>emailWelcome::dispatch($user, $order)->delay(now()->addSeconds(15));
Neste exemplo adicionei ->delay... para que o job seja executado em 15 segundos. Pode ser qualquer tempo. Estes dados
ficam no banco de dados.

------------------------------------------------------------------------------------------------------
--- Gerenciamento de Arquivos - Upload, etc.
------------------------------------------------------------------------------------------------------
A configuração está em \config\filesystem.php, o padrão é o local, possibilidades, S3, Cloud, etc..

Route::get('/files', function () {
    $files = Storage::files(''); //Não informado nada pega o rais que é storage\app
    $allFiles = Storage::allFiles(''); //Não informado nada pega o rais que é storage\app
    $directories = Storage::directories('');
    $allDirectories = Storage::allDirectories('');
    
    // Storage::makeDirectory('public/rogerio');
    // Storage::makeDirectory('public/picilli');
    // Storage::deleteDirectory('public/picilli');
    // storage::disk('public')->put('Meu Arquivo.txt', 'O melhor arquivo!');
    // echo storage::disk('public')->get('Meu Arquivo.txt');
    // var_dump($files, $allFiles, $directories, $allDirectories);

    // return Storage::disk('public')->download('Meu Arquivo.txt');

    // if(Storage::disk('public')->exists('Meu Arquivo1.txt')) {
    //     return Storage::disk('public')->download('Meu Arquivo.txt');
    // } else {
    //     echo "Arquivo não encontrado";   
    // };

    // echo "O tamanho do arquivo é => " . $size = Storage::disk('public')->size('Meu Arquivo.txt') . "<br>";
    // echo "A última modificação   => " . $size = Storage::disk('public')->lastModified('Meu Arquivo.txt') . "<br>";

    // Storage::disk('public')->prepend('Meu Arquivo.txt', 'São Paulo, 08 de março de 2.020');

    // Storage::disk('public')->append('Meu Arquivo.txt', 'Este arquivo foi apendado pelo Storage');

    // Storage::copy('public\Meu Arquivo.txt','Meu Arquivo.txt');
    // Storage::move('public\Meu Arquivo.txt','Meu Arquivo.txt');
    Storage::delete('public\Meu Arquivo.txt');
});
------------------------------------------------------------------------------------------------------
--- Upload
------------------------------------------------------------------------------------------------------

Criar um modelo
php artisan make:model Property -rm

Dentro do PropertyController + a view Properties.Create tem tudo para upload de um arquivo explicado.

Para ter um apontamento na pasta public do que tem na pasta storage que é privada issue o seguinte comando

=>php artisan storage:link
------------------------------------------------------------------------------------------------------
--- medleware
------------------------------------------------------------------------------------------------------
Qual é o objetivo do midleware? Interceptar requisições e ou respostas das mesmas.

Criar um middleware
=>php artisan make:middleware checkParam
Será criada uma classe em app\http\middleware\checkParam com apenas  um método denominado handle()

    public function handle($request, Closure $next)
    {
        return $next($request);
    }

Dentro do middleware pode-se fazer qualquer coisa antes de executar a função que o chamou ou mesmo depois.
Para fins de estudo vamos apenas logar algo no Log toda vez que uma ação passar por este middleware. O método ficará assim:

=>  public function handle($request, Closure $next)
=>  {
=>      Log::info("Foi invocado o meu primeiro middleware");
=>      //caso os checks acima permitam o metodo que foi originalmente requisitado será executado abaixo.
=>      return $next($request);
=>  }

O arquivo responsável parametrização dos middleware Http\kernel.php coloque o meu middleware e dei um nome testemiddleware
    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
        'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
        'testemiddleware' => \App\Http\Middleware\checkParam::class,
    ];

No PropertyController criei o methodo middle que uso no web.php
web.php
//Pode usar com o nome da classe e não esquecer to use lá emcima
// Route::get('teste-middleware', 'PropertyController@middle')->middleware(checkParam::class);
// ou usar o apelido que demos no arquivo Kernel, lembra?
Route::get('teste-middleware', 'PropertyController@middle')->middleware('testemiddlewarepic');

Controller
    public function middle() 
    {
        echo "Seja benvindo ao meu teste de middleware";
    }

Log[2020-03-08 17:17:55] local.INFO: Foi invocado o meu primeiro middleware  
------------------------------------------------------------------------------------------------------
--- Visão orquestrada
------------------------------------------------------------------------------------------------------
blade - Sem novidades

Master

ul.li*5>lorem10 => Duca
