@extends('layouts.app')

@section('title', 'Detail Pegawai')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-8 mx-auto">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="mb-0">Detail Pegawai</h2>
                <div>
                    <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-warning">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <a href="{{ route('employees.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <div class="row mb-4">
                        <div class="col-md-4 text-center">
                            @if ($employee->photo)
                                <img src="{{ asset('storage/' . $employee->photo) }}" 
                                     alt="{{ $employee->name }}" 
                                     class="img-fluid rounded"
                                     style="max-width: 250px; max-height: 250px; object-fit: cover;">
                            @else
                                <div class="bg-light rounded d-flex align-items-center justify-content-center mx-auto"
                                     style="width: 250px; height: 250px;">
                                    <i class="fas fa-user text-secondary" style="font-size: 5rem;"></i>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-8">
                            <h4>{{ $employee->name }}</h4>
                            <p class="text-muted">
                                <i class="fas fa-briefcase"></i> {{ $employee->position }}
                            </p>
                            <hr>
                            <div class="row mb-2">
                                <div class="col-md-4">
                                    <strong>Email</strong>
                                </div>
                                <div class="col-md-8">
                                    <a href="mailto:{{ $employee->email }}">{{ $employee->email }}</a>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-4">
                                    <strong>No. Telepon</strong>
                                </div>
                                <div class="col-md-8">
                                    <a href="tel:{{ $employee->phone }}">{{ $employee->phone }}</a>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-4">
                                    <strong>Status</strong>
                                </div>
                                <div class="col-md-8">
                                    <span class="badge @if($employee->status === 'active') bg-success @else bg-danger @endif">
                                        {{ $employee->status === 'active' ? 'Aktif' : 'Nonaktif' }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p class="text-muted mb-1">Gaji</p>
                            <h5>Rp {{ number_format($employee->salary, 0, ',', '.') }}</h5>
                        </div>
                        <div class="col-md-6">
                            <p class="text-muted mb-1">Tanggal Masuk</p>
                            <h5>{{ $employee->hire_date->format('d M Y') }}</h5>
                        </div>
                    </div>

                    @if ($employee->address)
                        <div class="mt-4">
                            <p class="text-muted mb-1">Alamat</p>
                            <p>{{ $employee->address }}</p>
                        </div>
                    @endif

                    <hr>

                    <div class="text-muted small">
                        <p class="mb-1">Dibuat: {{ $employee->created_at->format('d M Y H:i') }}</p>
                        <p>Diperbarui: {{ $employee->updated_at->format('d M Y H:i') }}</p>
                    </div>

                    <!-- Delete Button -->
                    <form action="{{ route('employees.destroy', $employee->id) }}" 
                          method="POST" 
                          class="mt-4"
                          onsubmit="return confirm('Yakin ingin menghapus pegawai ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger w-100">
                            <i class="fas fa-trash"></i> Hapus Pegawai
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
