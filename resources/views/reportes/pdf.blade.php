<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte General</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        h1 { text-align: center; }
        ul { list-style: none; padding: 0; }
        li { margin-bottom: 10px; font-size: 16px; }
    </style>
</head>
<body>
    <h1>Reporte General de Actividades</h1>
    <ul>
        <li><strong>Total comunicaciones:</strong> {{ $totalComunicaciones }}</li>
        <li><strong>Reportes generados este mes:</strong> {{ $reportesMes }}</li>
        <li><strong>Trámites completados:</strong> {{ $tramitesCompletados }}</li>
    </ul>
</body>
</html>
