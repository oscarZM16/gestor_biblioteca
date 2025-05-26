<table>
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Cantidad</th>
        </tr>
    </thead>
    <tbody>
        @foreach($libros as $libro)
            <tr>
                <td>{{ $libro->nombre }}</td>
                <td>{{ $libro->descripcion }}</td>
                <td>{{ $libro->cantidad }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
