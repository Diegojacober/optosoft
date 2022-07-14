@component('mail::message')
Olá

Você tem uma nova consulta agendada.

@component('mail::button', ['url' => 'http://localhost/agenda'])
Clique aqui e veja
@endcomponent

{{ config('app.name') }}
@endcomponent
