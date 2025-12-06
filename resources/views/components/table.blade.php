<div class="card shadow-sm border-0 mb-4 rounded-3">

    <div class="table-responsive">
        <table class="table table-hover table-sm align-middle mb-0">
            
            {{-- Encabezado --}}
            <thead class="table-primary text-white text-center">
                {{ $head }}
            </thead>

            {{-- Cuerpo --}}
            <tbody>
                {{ $body }}
            </tbody>
        </table>
    </div>
</div>

{{-- Estilos adicionales para mejorar apariencia --}}
<style>
    /* Hover suave sobre filas */
    .table-hover tbody tr:hover {
        background-color: #cce5ff; /* azul suave */
        transition: background-color 0.3s;
    }

    /* Bordes redondeados en las celdas de encabezado */
    .table thead th:first-child {
        border-top-left-radius: 0.5rem;
    }
    .table thead th:last-child {
        border-top-right-radius: 0.5rem;
    }

    /* Sombra sutil para las filas de acción */
    .table tbody td .btn {
        transition: transform 0.2s;
    }
    .table tbody td .btn:hover {
        transform: translateY(-2px);
    }

    /* Padding más compacto para la tabla */
    .table td, .table th {
        padding: 0.4rem 0.8rem;
    }

    /* Truncado de texto largo para algunas columnas */
    .table td.text-truncate {
        max-width: 120px; /* ajusta según la columna */
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
</style>

