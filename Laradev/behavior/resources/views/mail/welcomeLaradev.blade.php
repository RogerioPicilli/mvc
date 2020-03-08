@component('mail::message')
<h1>Parabéns por fazer parte de nossa família de clientes</h1>

<p>Para fazer login no Aplicativo GED - MaxiDoc use seu e-mail {{ $user->email }} com a senha que você cadastrou no sistema.</p>

@component('mail::button', ['url' => 'https://www.maxidoc.com.br'])
    Confirmar Contratação
@endcomponent

<p>Para garantir que o preço não mude, faça sua inscrição até {{ date('d/m/Y', strtotime($order->vencimento)) }}, pagando somente R$ {{ number_format($order->value,2,',','.') }}</p>
@endcomponent
<!-- 
o arroba component é o laravel e formata o email se no metodo for chamado como markdown, ou seja,

return view()   virará    return markdown() -->