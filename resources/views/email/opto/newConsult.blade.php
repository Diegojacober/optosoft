@component('mail::message')
Olá

Você tem uma nova consulta agendada.

@component('mail::button', ['url' => 'http://optosoft.com.br/agenda'])
Clique aqui e veja
@endcomponent

{{ config('app.name') }}
@endcomponent
