@component('mail::message')
# ¡Hola, {{ $nombre }}!

Nos alegra darte la bienvenida a nuestro CRM universitario.  
Tu solicitud para **{{ $carrera }}** ha sido aceptada y tu proceso ha comenzado.

@component('mail::button', ['url' => route('dashboard')])
Ir al Panel
@endcomponent

Si tienes alguna duda, ¡responde a este correo!

Gracias,<br>
**Equipo CRM Universidad**
@endcomponent
