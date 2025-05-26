<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <style>
            .nav{
                background-color: #343a40;
                color: white;
                width: 100%;
                padding:auto;
                text-align: center;
                margin-bottom: 80px;
                
            }
        
            .contenedor {
                width: 100%;
                max-width: 1200px;
                margin: 0 auto;
                padding: 1rem;
            }

            h3.text-center {
                text-align: center;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 685px;
                
            }

            table th,
            table td {
                border: 1px solid #000;
                text-align: center;
            }

            thead {
                background-color: #343a40;
                color: white;
            }
            footer {
                background-color: #343a40;
                padding: 5px;
                
            }
        </style>
    </head>
    <body>
        
        <div class="contenedor">
            <nav class="nav">
                <h3>Biblioteca municipal Jorge Eliecer Gaitán</h3>
            </nav>
            <h3>Ánalisis de Libros existentes</h3>
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Cantidad</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($insumos as $insumo)
                        
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $insumo->nombre }}</td>
                            <td>{{ $insumo->descripcion }}</td>
                            <td>{{ $insumo->cantidad }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <footer>

            </footer>
        </div>

    </body>
</html>
    
    
    


    
