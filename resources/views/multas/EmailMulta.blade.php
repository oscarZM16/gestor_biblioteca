<!DOCTYPE html>
<html>
<head>
    <title>Notificación de multa</title>
</head>
<body>
    <p>Hola {{ $prestamo->nombre }},</p>

    <p>Te informamos que tienes una multa pendiente de <strong>${{ number_format($prestamo->multa, 2) }}</strong>.</p>
    
    <p>Con el libro: <strong>{{ $prestamo->insumo->nombre }}</strong></p>

    </p>

    <p>Por favor, realiza el pago lo antes posible.</p>

    <p>Gracias.</p>
</body>
</html>
