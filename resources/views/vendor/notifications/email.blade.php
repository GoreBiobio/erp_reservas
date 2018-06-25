@component('mail::message')
{{-- Greeting --}}
@if (! empty($greeting))
# {{ $greeting }}
@else
@if ($level == 'error')
# @lang('Error!')
@else
# @lang('Hola!')
@endif
@endif

{{-- Intro Lines --}}
@foreach ($introLines as $line)
{{ 'Usted está recibiendo este correo electrónico porque recibimos una solicitud de restablecimiento de contraseña para su cuenta.' }}

@endforeach

{{-- Action Button --}}
@isset($actionText)
<?php
    switch ($level) {
        case 'success':
            $color = 'green';
            break;
        case 'error':
            $color = 'red';
            break;
        default:
            $color = 'blue';
    }
?>
@component('mail::button', ['url' => $actionUrl, 'color' => $color])
{{ $actionText }}
@endcomponent
@endisset

{{-- Outro Lines --}}
@foreach ($outroLines as $line)
{{ 'Si no solicitó restablecer la contraseña, no se requieren más acciones.' }}

@endforeach

{{-- Salutation --}}
@if (! empty($salutation))
{{ $salutation }}
@else
@lang('Saludos'),<br>{{ config('app.name') }}
@endif

{{-- Subcopy --}}
@isset($actionText)
@component('mail::subcopy')
    @lang(
           "Si tiene problemas para hacer clic en \":actionText\" botón, copiar y pegar la URL a continuación\n".
           'en su navegador web: [:actionURL](:actionURL)',
           [
               'actionText' => $actionText,
               'actionURL' => $actionUrl
           ]
       )
@endcomponent
@endisset
@endcomponent
