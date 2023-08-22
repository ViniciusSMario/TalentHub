@component('mail::message')
    Olá, {{$nome_candidato}}. <br>
    A sua candidatura para a vaga <strong> {{$nome_vaga}} </strong> foi confirmada com sucesso! <br>
    Iremos analisar seu currículo e entraremos em contato novamente com novidades!<br>
    Em caso de dúvidas, estamos à disposição!
@endcomponent
