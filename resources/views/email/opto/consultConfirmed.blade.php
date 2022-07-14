@component('mail::message')
Você tem uma consulta confirmada.

@component('mail::button', ['url' => 'http://optosoft.com.br/agenda'])
Clique aqui e confira
@endcomponent

Obrigado,<br>
{{ config('app.name') }}
@endcomponent
