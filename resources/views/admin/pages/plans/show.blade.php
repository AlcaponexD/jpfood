@extends('adminlte::page')

@section('title', 'Detalhes do plano '.$plan->name)

@section('content_header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{route('plans.index')}}">Planos</a></li>
            <li class="breadcrumb-item active">Mostrar plano</li>
        </ol>
    </nav>
    <h1>Detalhes do plano <strong>{{$plan->name}}</h1></strong>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <ul>
                <li>
                    <strong>Nome : </strong> {{$plan->name}}
                </li>
                <li>
                    <strong>URL : </strong> {{$plan->url}}
                </li>
                <li>
                    <strong>Preço : </strong> {{number_format($plan->price,2,',','.')}}
                </li>
                <li>
                    <strong>Descrição : </strong> {{$plan->description}}
                </li>
            </ul>
            <form action="{{route('plans.destroy',$plan->url)}}" method="post" onsubmit="return confirm('Você realmente deseja deletar esse plano?');">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger">DELETAR <i class="fas fa-trash"></i></button>
            </form>
        </div>
    </div>
@stop

@section('css')
    {{--<link rel="stylesheet" href="/css/admin_custom.css">--}}
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop