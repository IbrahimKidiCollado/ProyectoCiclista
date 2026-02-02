@extends('layouts.app')
@section('content')

<input type="text" id="search" placeholder="Buscar artículos...">
<ul id="results"></ul>

<div class="container" id="container">
    <div id="listadoArticulos" class="column">
        <h1>Artículos</h1>
        <a href="{{ route('articles.create') }}" class="btn btn-primary">Crear artículo</a>
        @foreach($articles as $article)
        <div class="card mt-3" id="articulo_{{$article->id}}">
            <div class="card-body">
                <h3><a href="{{ route('articles.show', $article) }}">{{ $article->title }}</a></h3>
                <p>{{ Str::limit($article->content, 150) }}</p>
            </div>
            <button class='btn btn-danger btn-sm mt-2'>ELIMINAR</button>
        </div>
        @endforeach
         <div class="mt-3">
        </div>

    </div>
    <div id="detallleArticulo" class="column">
        <h1 id="detalle_titulo_articulo">Hola</h1>
        <div id="detalles_articulos">
            <div class="detalle_info"><p id="detalle_autor">Iker Martin</p></div>
            <div class="detalle_info"><p id="detalle_fecha_creacion">6473838</p></div>
            <div class="detalle_info"><p id="detalle_fecha_publicacion">736372</p></div>
        </div>
        <p id="detalle_contenido">Esto es el artiulos</p>

    </div>

</div>
@endsection