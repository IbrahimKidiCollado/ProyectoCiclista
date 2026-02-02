<!DOCTYPE html>
<html>
    <style>
        input:focus {
            border: 1px solid #d6d6d6 !important;
            outline: none;
        }
        #results {
            border: 1px solid #d6d6d6;
            /*display: inline-block;*/
            display: none;
            position: absolute;
            left: 8px;
            margin-top: 26px;
            width: 400px;
            padding: 10px;
            list-style: none;
            z-index: 1000;
            background-color: white;
            border-top-width: 0px;
            border-radius: 0 0 15px 15px;
        }

        #results li {
            padding: 10px;
        }

        #results li:hover {
            background-color: #d6d6d6;
        }
        #search {
            width: 400px;
            padding: 10px;
            border-radius: 15px;
            border: 1px solid #d6d6d6;
        }
        .column{
            display: table-cell;
            border: 1px solid gray;
            width: 45%;
            padding:15px;
        }
        body{
            padding:10px;
        }
        #detalle_titulo_articulo{
            color: #9d58c5;

        }
        .detalle_info{
            display: inline-block;
            color:black;
            font-style:italic;
            margin-left:5px;
            margin-right:5px;
        }
        #detalles_articulos{
            color:black;
            font-style:italic;
            
        }
        .card{
            margin: 10px;
            border-radius: 8px;
            transition: box-shadow 0.3s ease, transform 0.2s ease;
        }
        .card:hover{
            cursor:pointer;
            box-shadow:0 8px 24px rgba(0,0,0,0.2);
            transform:translateY(-2px)
        }

        
    </style>
    <script>
        let timeout = null;
        let index = 1;
        var numArticulos;
        var limit = 5;
        function init()
        {
            document.getElementById('search').addEventListener('input', function (e) {
                const query = e.target.value;

                clearTimeout(timeout);

                timeout = setTimeout(() => {
                    if (query.length < 2) {
                        document.getElementById('results').style.display="none";
                        document.getElementById('results').innerHTML = '';
                        return;
                    }

                    fetch(`/api/articles?q=${encodeURIComponent(query)}`)
                        .then(res => res.json())
                        .then(data => {
                            const ul = document.getElementById('results');
                            ul.innerHTML = '';

                            data.forEach(article => {
                                const li = document.createElement('li');
                                li.textContent = article.title;
                                ul.appendChild(li);
                            });
                            document.getElementById('results').style.display="inline-block";
                        });
                }, 300); // debounce 300ms
            });
            document.addEventListener('scrollend', function(e)
            {
                console.log('scroll')
                if(screen.height + window.scrollY >= document.body.offsetHeight -100){
                    //Añadir mas articulos
                    /*<div class="card mt-3">
                    <div class="card-body">
                    <h3><a href="{{ route('articles.show', $article ?? '') }}">{{ $article ?? ''->title }}</a></h3>
                    <p>{{ Str::limit($article ?? ''->content, 150) }}</p>
                    </div>
                    </div> */
                    var xhttp = new XMLHttpRequest();
                    xhttp.onreadystatechange = function() {
                        if (this.readyState == 4) {
                            if(this.status == 200){
                                // Dvuelve la lista de articulos como json
                                //recorremos la lista y por cada articulo llamara a la funcion pintarArticulo
                                var datos = JSON.parse(xhttp.responseText);
                                for(let dato in datos){
                                    pintarArticulo(datos[dato].id, datos[dato].title,datos[dato].content,datos[dato].autor);
                                }
                                
                            }else{
                                //la peticion ha terminado pero no ha devuelto un codigo 200
                                console.log("Error de peticion: " + this.status);
                            };
                        };
                    };
                    numArticulos = document.getElementsByClassName("card mt-3");
                    console.log(numArticulos.length);
                    xhttp.open("GET", `/api/articles?num=${numArticulos.length}&limit=${limit}`, true);
                    xhttp.send();

                    /*for(let i = 0; i<5; i++){

                        pintarArticulo("Titlo " + index, "contenido", "autor");
                        index++;
                        
                    }*/
                }
            })
            var elementos_card = document.getElementsByClassName("card");
            for (let i = 0; i < elementos_card.length; i++) {
                elementos_card[i].addEventListener('click', function(e){
                    var id_text = this.id;
                    
                    verDetalleArticulo(id_text.split("_")[1]);
                })
                let boton = elementos_card[i].querySelector('.btn-danger');
                boton.addEventListener('click', function(e){
                    var id_text = elementos_card[i].id;

                    e.stopPropagation(); 
                    borrarArticulo(id_text.split("_")[1])
                })
                
                
            }
        }
        function verDetalleArticulo(id){
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4) {
                    if(this.status == 200){
                        // Dvuelve la lista de articulos como json
                        //recorremos la lista y por cada articulo llamara a la funcion pintarArticulo
                        var articulo = JSON.parse(xhttp.responseText);
                        /*
                            {
                                "id": 1,
                                "title": "",    
                                "body": "", 
                                "autor": "", 
                                "published": "", 
                                "created": "", 
                            }
                        */
                       console.log(articulo);
                        document.getElementById("detalle_titulo_articulo").textContent = articulo.title;
                        document.getElementById("detalle_autor").textContent = articulo.autor;
                        document.getElementById("detalle_fecha_creacion").textContent = articulo.created;
                        document.getElementById("detalle_fecha_publicacion").textContent = articulo.published;
                        document.getElementById("detalle_contenido").textContent = articulo.body;


                    }else{
                        //la peticion ha terminado pero no ha devuelto un codigo 200
                        console.log("Error de peticion: " + this.status);
                    };
                };
            };
                numArticulos = document.getElementsByClassName("card mt-3");
                console.log(numArticulos.length);
                xhttp.open("GET", "/api/articles/" +id, true );
                xhttp.send();
           


        }
        function pintarArticulo(id, titulo, contenido, autor){
            let contenedor = document.getElementById('listadoArticulos');

            let articuloDiv = document.createElement('div');
            articuloDiv.classList.add('card', 'mt-3');
            articuloDiv.setAttribute('id', "articulo_"+id)

            let cardBody = document.createElement('div');
            cardBody.classList.add('card-body');
            let h3 = document.createElement('h3');

            let link = document.createElement('a');
            link.href = ''; 
            link.textContent = titulo + ", " + autor;

            let p = document.createElement('p');
            p.textContent = contenido;

            let boton= document.createElement('button');
            boton.textContent = 'ELIMINAR';
            boton.classList.add('btn', 'btn-danger', 'btn-sm', 'mt-2');

            boton.addEventListener('click', function(e){
                e.stopPropagation(); 
                borrarArticulo(id)
            })

            h3.appendChild(link);
            cardBody.appendChild(h3);
            cardBody.appendChild(p);
            cardBody.appendChild(boton);
            articuloDiv.appendChild(cardBody);
            contenedor.appendChild(articuloDiv);

            articuloDiv.addEventListener('click', function(e){
                    verDetalleArticulo(id);
                })
        }
        function borrarArticulo(id){
            //console.log("EStamos dentro de borrar artuclo funcion")
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4) {
                    if(this.status >=200 && this.status < 300){
                        
                        let articulo = document.getElementById('articulo_' + id);
                        if (articulo) {
                            articulo.remove();
                        }

                    }else{
                        //la peticion ha terminado pero no ha devuelto un codigo 200
                        console.log("Error de peticion: " + this.status);
                    };
                };
            };
                
            xhttp.open("DELETE", "/api/articles/" +id, true );
            xhttp.send();
           
        }

    </script>

<head>
    <meta charset="UTF-8">
    <title>Mi Aplicación</title>

    {{-- aquí puedes cargar CSS, Bootstrap, Vite, etc --}}
</head>
<body onload="init()">
    <header>
        <h1>Mi Web</h1>
        {{-- Menú, navbar, etc --}}
    </header>

    <main class="container">
        @yield('content')   {{-- → Aquí se insertan las vistas hijas --}}
    </main>

    <footer>
        <p>Footer aquí</p>
    </footer>
</body>
</html>