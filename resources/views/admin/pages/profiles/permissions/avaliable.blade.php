@extends('adminlte::page')

@section('title', 'Todos os planos')

@section('content_header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{route('profiles.index')}}">Perfis</a></li>
            <li class="breadcrumb-item active">Vincular permissoes para o perfil >> {{$profile->name}} </li>
        </ol>
    </nav>
    <h1>Permissões disponiveis do perfil >> {{$profile->name}} <a  href="{{route('permissions.create')}}" class="float-right btn btn-dark">Adicionar nova permissão <i class="far fa-plus-square"></i></a></h1>
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
                <form action="{{route('permission.profile.attach',$profile->id)}}" method="post">
                    @csrf
                    @foreach($permissions as $permission)
                        <tr>
                            <td><input type="checkbox" name="permissions[]" value="{{$permission->id}}"></td>
                            <td>{{$permission->name}}</td>
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