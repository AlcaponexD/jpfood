@extends('adminlte::page')

@section('title', 'Todos os planos')

@section('content_header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{route('plans.index')}}">Planos</a></li>
            <li class="breadcrumb-item active">Vincular perfil para o plano >> {{$plan->name}} </li>
        </ol>
    </nav>
    <h1>Perfis disponivels para o plano >> {{$plan->name}} <a  href="{{route('profiles.create')}}" class="float-right btn btn-dark">Adicionar novo perfil <i class="far fa-plus-square"></i></a></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <table class="table table-condensed">
                <thead>
                <tr>
                    <th width="50">#</th>
                    <th>Nome</th>
                </tr>
                </thead>
                <tbody>
                <form action="{{route('plan.profile.attach',$plan->id)}}" method="post">
                    @csrf
                    @foreach($profiles as $profile)
                        <tr>
                            <td><input type="checkbox" name="profiles[]" value="{{$profile->id}}"></td>
                            <td>{{$profile->name}}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="500">
                            <button class="btn btn-success">Vincular</button>
                        </td>
                    </tr>
                </form>
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if(isset($filters))
                {!! $profiles->appends($filters)->links() !!}
            @else
                {!! $profiles->links() !!}
            @endif
        </div>
    </div>
@stop

@section('css')
    {{--<link rel="stylesheet" href="/css/admin_custom.css">--}}
@stop

@section('js')
    <script>
        @if(Session::has('message'))
          $(document).Toasts('create', {
            class: 'bg-{{ Session::get('type') }}',
            title: 'Perfis',
            body: '{{ Session::get('message') }}.'
        })
        @endif
    </script>
@stop