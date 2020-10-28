@extends('adminlte::page')

@section('title', 'profiles')

@section('content_header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Perfis</li>
        </ol>
    </nav>
    <h1>Planos <a  href="{{route('profiles.create')}}" class="float-right btn btn-dark">Adicionar novo perfil <i class="far fa-plus-square"></i></a></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{route('profiles.search')}}" class="form form-inline">
                @csrf
                <input type="search" class="form-control" name="filter" value="{{ $filters['filter'] ?? '' }}">
                <button class="btn btn-dark"><i class="fas fa-search"></i></button>
            </form>
        </div>
        <div class="card-body">
            <table class="table table-condensed">
                <thead>
                <tr>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Ações</th>
                </tr>
                </thead>
                <tbody>
                @if(count($profiles) > 0)
                    @foreach($profiles as $profile)
                        <tr>
                            <td>{{$profile->name}}</td>
                            <td>{{$profile->description}}</td>
                            <td style="width: 250px">
                                <a href="{{route('permission.profile',$profile->id)}}" class="btn btn-primary">Exibir permissões <i class="fas fa-lock"></i></a>
                                <form class="d-inline" action="{{route('profiles.destroy',['id' => $profile->id])}}" onsubmit="return confirm('Deseja realmente excluir o perfil?')" method="post">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="500">
                            <div class="alert alert-default-warning text-center">Nenhum perfil cadastrado</div>
                        </td>
                    </tr>
                @endif
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