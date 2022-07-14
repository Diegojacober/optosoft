@component('mail::message')
# Olá

Seja muito bem vindo(a) ao sistema Optosoft!

Contatos: <br> +55 (19) 9983530073 <br> suporte@optosoft.com.br
@component('mail::button', ['url' => 'http://optosoft.com.br/home'])
Entrar
@endcomponent

Obrigado pela confiança,<br>
{{ config('app.name') }}
@endcomponent
