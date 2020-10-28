@extends('adminlte::page')

@section('title', 'Todos os planos')

@section('content_header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{route('plans.index')}}">Planos</a></li>
            <li class="breadcrumb-item active">Perfis do plano -> {{$plan->name}} </li>
        </ol>
    </nav>
    <h1>Detalhes do perfil -> {{$plan->name}} <a  href="{{route('plan.profile.avaliable',['id' => $plan->id])}}" class="float-right btn btn-dark">Vincular mais perfis <i class="far fa-plus-square"></i></a></h1>
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
                    @if(count($profiles))
                        @foreach($profiles as $profile)
                            <tr>
                                <td>{{$profile->name}}</td>
                                <td style="width: 150px">
                                    <form action="{{route('plan.profile.detach',['id' => $plan->id,'idplan' => $profile->id])}}" method="post" onsubmit="return confirm('Você realmente deseja deletar?');" >
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
                                <div class="alert alert-default-warning text-center">Nenhum perfil vinculado</div>
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