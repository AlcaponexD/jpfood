@extends('adminlte::page')

@section('title', 'Todos os planos')

@section('content_header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{route('profiles.index')}}">Perfis</a></li>
            <li class="breadcrumb-item active">Permissoes do perfil -> {{$profile->name}} </li>
        </ol>
    </nav>
    <h1>Detalhes do perfil -> {{$profile->name}} <a  href="{{route('permission.profile.avaliable',['id' => $profile->id])}}" class="float-right btn btn-dark">Vincular mais permissões <i class="far fa-plus-square"></i></a></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <table class="table table-condensed">
                <thead>
                <tr>
                    <th>Nome</th>
                    <th>Ações</th>
                </tr>
                </thead>
                <tbody>
                    @if(count($permissions))
                        @foreach($permissions as $permission)
                            <tr>
                                <td>{{$permission->name}}</td>
                                <td style="width: 150px">
                                    <form action="{{route('permission.profile.detach',['id' => $profile->id,'idpermission' => $permission->id])}}" method="post" onsubmit="return confirm('Você realmente deseja deletar?');" >
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger">Desvincular</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="500">
                                <div class="alert alert-default-warning text-center">Nenhuma permissão vinculada</div>
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