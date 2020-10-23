@include('admin.includes.alerts')
<div class="form-group">
    <label>Nome:</label>
    <input class="form-control" type="text" name="name" placeholder="Nome:" value="{{$plan->name ?? ''}}">
</div>
<div class="form-group">
    <label>Preço:</label>
    <input class="form-control" type="text" name="price" placeholder="Preço:" value="{{$plan->price ?? ''}}">
</div>
<div class="form-group">
    <label>Descrição:</label>
    <input class="form-control" type="text" name="description" placeholder="Descrição:" value="{{$plan->description ?? ''}}">
</div>
<button type="submit" class="btn btn-success">Enviar</button>