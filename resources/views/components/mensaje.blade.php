

{{-- Mensaje de éxito --}}
@if(session('success'))
    <div class="alert alert-success bg-white border-0 shadow-sm p-3 rounded-4 d-flex align-items-center"
         role="alert" style="border-left: 6px solid #198754;">
        <i class="bi bi-check-circle text-success fs-3 me-3"></i>
        <span class="fw-semibold text-success">{{ session('success') }}</span>
    </div>
@endif

{{-- Mensaje de error --}}
@if(session('error'))
    <div class="alert alert-danger bg-white border-0 shadow-sm p-3 rounded-4 d-flex align-items-center"
         role="alert" style="border-left: 6px solid #dc3545;">
        <i class="bi bi-x-circle text-danger fs-3 me-3"></i>
        <span class="fw-semibold text-danger">{{ session('error') }}</span>
    </div>
@endif

{{-- Mensaje de información / status --}}
@if(session('status'))
    <div class="alert alert-info bg-white border-0 shadow-sm p-3 rounded-4 d-flex align-items-center"
         role="alert" style="border-left: 6px solid #0dcaf0;">
        <i class="bi bi-info-circle text-info fs-3 me-3"></i>
        <span class="fw-semibold text-info">{{ session('status') }}</span>
    </div>
@endif

