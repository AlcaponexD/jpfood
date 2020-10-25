@extends('adminlte::page')

@section('title', 'Todos as permissões')

@section('content_header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Permissões</li>
        </ol>
    </nav>
    <h1>Planos <a  href="{{route('permissions.create')}}" class="float-right btn btn-dark">Adicionar nova permisssão <i class="far fa-plus-square"></i></a></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{route('permissions.search')}}" class="form form-inline">
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
                @if(count($permissions) > 0)
                    @foreach($permissions as $permission)
                        <tr>
                            <td>{{$permission->name}}</td>
                            <td>{{$permission->description}}</td>
                            <td style="width: 250px">
                                <form action="{{route('permissions.destroy',['id' => $permission->id])}}" onsubmit="return confirm('Deseja realmente excluir o perfil?')" method="post">
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
                {!! $permissions->appends($filters)->links() !!}
            @else
                {!! $permissions->links() !!}
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