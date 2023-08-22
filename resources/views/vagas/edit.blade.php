@extends('layouts.app')

@section('content')
    <div class="container">
        <div  class="pageLoader" id="pageLoader"></div>
        <div class="row">
            <div class="col-md-12">
                @if ($message = Session::get('error'))
                    <div class="alert alert-danger">
                        <p>{{ $message }}</p>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="text-center">
                    <h2 class="section-title">Editando Vaga: {{$vaga->nome}}</h2>
                </div>
                <div>
                    <form action="{{route('vagas_update')}}" method="POST" class="form-group card card-body bg-white">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" id="id" value="{{$vaga->id}}">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="nome">Nome da vaga:</label>
                                <input type="text" required name="nome" id="nome" class="form-control" value="{{$vaga->nome}}">
                            </div>
                            <div class="col-md-6">
                                <label for="nome">Tipo da vaga:</label>
                                <select name="tipo_vaga" required id="tipo_vaga" class="form-control">
                                    <option value="">Selecione...</option>
                                    <option value="presencial" {{ $vaga->tipo_vaga == 'presencial' ? 'selected' : '' }}>Presencial</option>
                                    <option value="remoto" {{ $vaga->tipo_vaga == 'remoto' ? 'selected' : '' }}>Remoto</option>
                                    <option value="hibrido" {{ $vaga->tipo_vaga == 'hibrido' ? 'selected' : '' }}>Híbrido</option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="descricao">Descrição da vaga:</label>
                                <textarea name="descricao" required id="descricao" class="form-control" cols="30" rows="2">{{$vaga->descricao}}</textarea>
                            </div>
                            <div class="col-md-6">
                                <label for="atividades">Atividades da vaga:</label>
                                <textarea name="atividades" required id="atividades" class="form-control" cols="30" rows="2">{{$vaga->atividades}}</textarea>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="pre_requisitos">Pré-requistos da vaga:</label>
                                <textarea name="pre_requisitos" required id="pre_requisitos" class="form-control" cols="30" rows="2">{{$vaga->pre_requisitos}}</textarea>
                            </div>
                            <div class="col-md-6">
                                <label for="beneficios">Benefícios da vaga:</label>
                                <textarea name="beneficios" required id="beneficios" class="form-control" cols="30" rows="2"> {{$vaga->beneficios}}</textarea>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="remuneracao">Remuneração da vaga:</label>
                                <input type="number" required placeholder="0.00" value="{{$vaga->remuneracao}}" step=".01" name="remuneracao" id="remuneracao" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="nivel">Nível:</label>
                                <input type="text" required name="nivel" id="nivel" value="{{$vaga->nivel}}" class="form-control">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="empresa">Empresa:</label>
                                <input type="text" name="empresa" id="empresa" value="{{$vaga->empresa}}" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="datahora_fechamento">Data e hora do fechamento da vaga:</label>
                                <input type="datetime-local" required name="datahora_fechamento" value="{{$vaga->datahora_fechamento}}" id="datahora_fechamento" class="form-control">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <input type="submit" value="Editar Vaga" class="btn btn-block btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $(window).on('beforeunload', function(){
        $('#pageLoader').show();
    });

    $(function () {
        $('#pageLoader').hide();
    })
});
</script>
