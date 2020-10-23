@include('admin.includes.alerts')
<div class="form-group">
    <label>Nome:</label>
    <input class="form-control" type="text" name="name" placeholder="Nome:" value="{{$profile->name ?? ''}}">
</div>
<div class="form-group">
    <label>Descrição:</label>
    <input class="form-control" type="text" name="description" placeholder="Nome:" value="{{$profile->description ?? ''}}">
</div>
<button type="submit" class="btn btn-success">Enviar</button>