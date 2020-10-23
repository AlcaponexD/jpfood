@include('admin.includes.alerts')
<div class="form-group">
    <label>Nome:</label>
    <input class="form-control" type="text" name="name" placeholder="Nome:" value="{{$detail->name ?? ''}}">
</div>
<button type="submit" class="btn btn-success">Enviar</button>