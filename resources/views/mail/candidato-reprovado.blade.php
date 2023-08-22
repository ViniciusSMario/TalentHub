@component('mail::message')
    Olá, {{$nome_candidato}}. <br>
    Infelizmente você não foi selecionado para a vaga {{$nome_vaga}}.<br>
    Agradecemos sua participação em nosso processo seletivo e manteremos seu currículo em nossa base de dados.<br>
    Fique atento as demais vagas ofertadas pela empresa.<br>
    Em caso de dúvidas, estamos à disposição!
@endcomponent
