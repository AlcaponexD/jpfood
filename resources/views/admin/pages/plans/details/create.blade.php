@extends('adminlte::page')

@section('title', 'Criando um novo plano')

@section('content_header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{route('plans.index')}}">Planos</a></li>
            <li class="breadcrumb-item"><a href="{{route('plans.show',['url' => $plan->url])}}">Plano {{$plan->name}}</a></li>
            <li class="breadcrumb-item active">Criar detalhes do plano {{$plan->name}}</li>
        </ol>
    </nav>
    <h1>Novo detalhe do plano</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{route('plans.details.store',['url' => $plan->url])}}" method="post">
                @csrf
                @include('admin.pages.plans.details._form')
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