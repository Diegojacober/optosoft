@component('mail::message')
Você tem uma consulta confirmada.

@component('mail::button', ['url' => 'http://localhost/agenda'])
Clique aqui e confira
@endcomponent

Obrigado,<br>
{{ config('app.name') }}
@endcomponent
