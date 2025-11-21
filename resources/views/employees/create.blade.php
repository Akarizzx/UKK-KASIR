@extends('layouts.app')

@section('title', 'Tambah Pegawai')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-8 mx-auto">
            <h2 class="mb-0">Tambah Pegawai Baru</h2>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <form action="{{ route('employees.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Photo Upload Section -->
                        <div class="mb-4">
                            <label class="form-label fw-bold">Foto Pegawai</label>
                            <div class="d-flex gap-3">
                                <div>
                                    <div class="bg-light rounded d-flex align-items-center justify-content-center" 
                                         id="photoPreview"
                                         style="width: 150px; height: 150px;">
                                        <i class="fas fa-user text-secondary" style="font-size: 3rem;"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <input type="file" 
                                           name="photo" 
                                           id="photo" 
                                           class="form-control @error('photo') is-invalid @enderror"
                                           accept="image/*">
                                    <small class="text-muted d-block mt-2">
                                        Format: JPEG, PNG, JPG, GIF<br>
                                        Ukuran maksimal: 2MB
                                    </small>
                                    @error('photo')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <hr>

                        <!-- Name -->
                        <div class="mb-3">
                            <label for="name" class="form-label fw-bold">Nama Pegawai</label>
                            <input type="text" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   id="name" 
                                   name="name" 
                                   placeholder="Masukkan nama pegawai"
                                   value="{{ old('name') }}" 
                                   required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label fw-bold">Email</label>
                            <input type="email" 
                                   class="form-control @error('email') is-invalid @enderror" 
                                   id="email" 
                                   name="email" 
                                   placeholder="Masukkan email"
                                   value="{{ old('email') }}" 
                                   required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Phone -->
                        <div class="mb-3">
                            <label for="phone" class="form-label fw-bold">No. Telepon</label>
                            <input type="text" 
                                   class="form-control @error('phone') is-invalid @enderror" 
                                   id="phone" 
                                   name="phone" 
                                   placeholder="Masukkan nomor telepon"
                                   value="{{ old('phone') }}" 
                                   required>
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Position -->
                        <div class="mb-3">
                            <label for="position" class="form-label fw-bold">Posisi</label>
                            <input type="text" 
                                   class="form-control @error('position') is-invalid @enderror" 
                                   id="position" 
                                   name="position" 
                                   placeholder="Masukkan posisi (misal: Manager, Kasir, dll)"
                                   value="{{ old('position') }}" 
                                   required>
                            @error('position')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Salary -->
                        <div class="mb-3">
                            <label for="salary" class="form-label fw-bold">Gaji</label>
                            <input type="number" 
                                   class="form-control @error('salary') is-invalid @enderror" 
                                   id="salary" 
                                   name="salary" 
                                   placeholder="Masukkan gaji"
                                   value="{{ old('salary') }}" 
                                   min="0"
                                   step="0.01"
                                   required>
                            @error('salary')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Hire Date -->
                        <div class="mb-3">
                            <label for="hire_date" class="form-label fw-bold">Tanggal Masuk</label>
                            <input type="date" 
                                   class="form-control @error('hire_date') is-invalid @enderror" 
                                   id="hire_date" 
                                   name="hire_date" 
                                   value="{{ old('hire_date') }}" 
                                   required>
                            @error('hire_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Address -->
                        <div class="mb-3">
                            <label for="address" class="form-label fw-bold">Alamat</label>
                            <textarea class="form-control @error('address') is-invalid @enderror" 
                                      id="address" 
                                      name="address" 
                                      rows="3"
                                      placeholder="Masukkan alamat">{{ old('address') }}</textarea>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div class="mb-4">
                            <label for="status" class="form-label fw-bold">Status</label>
                            <select class="form-select @error('status') is-invalid @enderror" 
                                    id="status" 
                                    name="status" 
                                    required>
                                <option value="">Pilih Status</option>
                                <option value="active" @selected(old('status') === 'active')>Aktif</option>
                                <option value="inactive" @selected(old('status') === 'inactive')>Nonaktif</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Buttons -->
                        <div class="d-flex gap-2 justify-content-end">
                            <a href="{{ route('employees.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Batal
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('photo').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('photoPreview').innerHTML = 
                    '<img src="' + e.target.result + '" style="width: 100%; height: 100%; object-fit: cover;" class="rounded">';
            };
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection
