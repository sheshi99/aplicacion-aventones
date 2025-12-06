<div class="card shadow-sm border-0 mb-4 rounded-3">

    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            
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

    /* Ajuste de padding para que la tabla respire */
    .table td, .table th {
        padding: 0.75rem 1rem;
    }
</style>

