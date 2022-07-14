@component('mail::message')
Uma consulta foi cancelada.

@component('mail::button', ['url' => 'http://optosoft.com.br/agenda'])
Clique aqui e confira
@endcomponent

Obrigado,<br>
{{ config('app.name') }}
@endcomponent
