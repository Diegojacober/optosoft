@component('mail::message')
Uma consulta foi cancelada.

@component('mail::button', ['url' => 'http://localhost/agenda'])
Clique aqui e confira
@endcomponent

Obrigado,<br>
{{ config('app.name') }}
@endcomponent
