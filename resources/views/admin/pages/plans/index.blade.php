@extends('adminlte::page')

@section('title', 'Todos os planos')

@section('content_header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Planos</li>
        </ol>
    </nav>
    <h1>Planos <a  href="{{route('plans.create')}}" class="float-right btn btn-dark">Adicionar novo plano <i class="far fa-plus-square"></i></a></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{route('plans.search')}}" class="form form-inline">
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
                    <th>Preço</th>
                    <th>Ações</th>
                </tr>
                </thead>
                <tbody>
                    @if(count($plans) > 0)
                        @foreach($plans as $plan)
                            <tr>
                                <td>{{$plan->name}}</td>
                                <td>R${{number_format($plan->price,2,',','.')}}</td>
                                <td style="width: 400px">
                                    <a href="{{route('plan.profile',$plan->id)}}" class="btn btn-primary">Exibir perfis <i class="fas fa-lock"></i></a>
                                    <a href="{{route('plans.details.index',['url' => $plan->url])}}" class="btn btn-dark">Detalhes <i class="fas fa-eye"></i></a>
                                    <a href="{{route('plans.edit',['url' => $plan->url])}}" class="btn btn-success"><i class="fas fa-edit"></i></a>
                                    <a href="{{route('plans.show',['url' => $plan->url])}}" class="btn btn-primary"><i class="fas fa-expand-alt"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="500">
                                <div class="alert alert-default-warning text-center">Nenhum plano cadastrado</div>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if(isset($filters))
                {!! $plans->appends($filters)->links() !!}
            @else
                {!! $plans->links() !!}
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