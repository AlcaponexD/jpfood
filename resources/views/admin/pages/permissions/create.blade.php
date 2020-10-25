@extends('adminlte::page')

@section('title', 'Criando um nova permissão')

@section('content_header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Criar nova permissão</li>
        </ol>
    </nav>
    <h1>Nova permissão</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{route('permissions.store')}}" method="post">
                @csrf
                @include('admin.pages.permissions.partials._form')
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