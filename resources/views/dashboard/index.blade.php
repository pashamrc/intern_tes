@extends('layouts.app')

@section('content')

<div class="row g-4 mb-4">

    <div class="col-md-4">
        <div class="card-modern d-flex align-items-center justify-content-between">
            <div>
                <div class="stat-label">Total Customer</div>
                <div class="stat-number">{{ $totalCustomer }}</div>
            </div>
            <div class="bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center rounded-3" style="width: 48px; height: 48px;">
                <i class="bi bi-people fs-4"></i>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card-modern d-flex align-items-center justify-content-between">
            <div>
                <div class="stat-label">New Customer</div>
                <div class="stat-number">{{ $newCustomer }}</div>
            </div>
            <div class="bg-info bg-opacity-10 text-info d-flex align-items-center justify-content-center rounded-3" style="width: 48px; height: 48px;">
                <i class="bi bi-person-plus fs-4"></i>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card-modern d-flex align-items-center justify-content-between">
            <div>
                <div class="stat-label">Loyal Customer</div>
                <div class="stat-number">{{ $loyalCustomer }}</div>
            </div>
            <div class="bg-success bg-opacity-10 text-success d-flex align-items-center justify-content-center rounded-3" style="width: 48px; height: 48px;">
                <i class="bi bi-patch-check fs-4"></i>
            </div>
        </div>
    </div>

</div>

<div class="card-modern">
    <div class="d-flex align-items-center gap-2 mb-3">
        <i class="bi bi-pie-chart text-muted fs-5"></i>
        <h5 class="mb-0 fw-semibold" style="font-size: 16px; color: var(--text-main);">Customer Statistics</h5>
    </div>
    
    <div class="pt-3 border-top" style="border-color: var(--border-color) !important;">
        <div class="position-relative mx-auto" style="max-height: 320px; max-width: 320px;">
            <canvas id="customerChart"></canvas>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('customerChart');
    
    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['NEW CUSTOMER', 'LOYAL CUSTOMER'],
            datasets: [{
                data: [{{ $newCustomer }}, {{ $loyalCustomer }}],
                backgroundColor: [
                    '#4f46e5', // Indigo modern untuk New Customer
                    '#10b981'  // Emerald green untuk Loyal Customer
                ],
                borderWidth: 4,
                borderColor: '#ffffff', // Membuat batas antar potongan donat lebih bersih
                borderRadius: 4, // Membuat sudut potongan lingkaran sedikit tumpul (modern)
                hoverOffset: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 20,
                        font: {
                            family: "'Plus Jakarta Sans', sans-serif",
                            size: 12,
                            weight: 500
                        },
                        color: '#64748b',
                        usePointStyle: true, // Mengubah kotak legenda menjadi lingkaran kecil yang estetik
                        pointStyle: 'circle'
                    }
                },
                tooltip: {
                    backgroundColor: '#1e293b',
                    padding: 12,
                    bodyFont: {
                        family: "'Plus Jakarta Sans', sans-serif"
                    },
                    titleFont: {
                        family: "'Plus Jakarta Sans', sans-serif"
                    }
                }
            },
            cutout: '75%' // Membuat lingkaran tengah donat lebih tipis dan elegan
        }
    });
</script>
@endpush