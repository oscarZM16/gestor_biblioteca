<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Estado</th>
            <th>Cantidad</th>
            <th>Fecha de Creación</th>
        </tr>
    </thead>
    <tbody>
        @foreach($insumos as $libro)
            <tr>
                <td>{{ $libro->nombre }}</td>
                <td>{{ $libro->descripcion }}</td>
                <td>{{ $libro->estado }}</td>
                <td>{{ $libro->cantidad }}</td>
                <td>{{ $libro->created_at }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
