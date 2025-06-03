
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Libro</th>
                <th>Solicitado por</th>
                <th>Fecha Inicio</th>
                <th>Fecha Fin</th>
                <th>Estado</th>
                <th>Fecha de solicitud</th>
            </tr>
        </thead>
        <tbody>
            @foreach($prestamos as $prestamo)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $prestamo->insumo->nombre }}</td>
                    <td>{{ $prestamo->user->name }}</td>
                    <td>{{ $prestamo->fecha_inicio }}</td>
                    <td>{{ $prestamo->fecha_devolucion }}</td>
                    <td>{{ ucfirst($prestamo->estado) }}</td>
                    <td>{{ $prestamo->created_at->format('Y-m-d H:i') }}</td>
                </tr>
                
            @endforeach
        </tbody>
    </table>
    
