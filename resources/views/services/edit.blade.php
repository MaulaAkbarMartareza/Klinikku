@extends('layout.app_modern')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-lg">
                <div class="card-header bg-gradient-primary text-white py-3 d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <i class="ti ti-edit fs-4 me-2"></i>
                        <h5 class="card-title mb-0">Edit Layanan</h5>
                    </div>
                    <form action="{{ route('services.destroy', $service->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus layanan ini?')">
                            <i class="ti ti-trash me-1"></i>Hapus Layanan
                        </button>
                    </form>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('services.update', $service->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row g-4">
                            <!-- Preview Gambar Saat Ini -->
                            @if($service->image)
                            <div class="col-12">
                                <div class="position-relative">
                                    <img src="{{ asset('storage/' . $service->image) }}" 
                                         class="img-fluid rounded" 
                                         style="max-height: 200px; object-fit: cover;">
                                    <div class="position-absolute top-0 end-0 p-2">
                                        <button type="button" 
                                                class="btn btn-danger btn-sm rounded-circle"
                                                onclick="document.getElementById('remove_image').value = 1">
                                            <i class="ti ti-x"></i>
                                        </button>
                                    </div>
                                </div>
                                <input type="hidden" name="remove_image" id="remove_image" value="0">
                            </div>
                            @endif

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Nama Layanan</label>
                                    <input type="text" 
                                           class="form-control @error('name') is-invalid @enderror" 
                                           name="name" 
                                           value="{{ old('name', $service->name) }}" 
                                           required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Kategori</label>
                                    <select class="form-select @error('category') is-invalid @enderror" 
                                            name="category" required>
                                        <option value="">Pilih Kategori</option>
                                        @foreach(['umum', 'gigi', 'anak', 'spesialis'] as $category)
                                            <option value="{{ $category }}" 
                                                    {{ old('category', $service->category) == $category ? 'selected' : '' }}>
                                                {{ ucfirst($category) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Harga (Rp)</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="number" 
                                               class="form-control @error('price') is-invalid @enderror" 
                                               name="price" 
                                               value="{{ old('price', $service->price) }}" 
                                               required>
                                    </div>
                                    @error('price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Durasi (Menit)</label>
                                    <div class="input-group">
                                        <input type="number" 
                                               class="form-control @error('duration') is-invalid @enderror" 
                                               name="duration" 
                                               value="{{ old('duration', $service->duration) }}" 
                                               required>
                                        <span class="input-group-text">Menit</span>
                                    </div>
                                    @error('duration')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label">Deskripsi Layanan</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" 
                                              name="description" 
                                              rows="4" 
                                              required>{{ old('description', $service->description) }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label">Ganti Gambar</label>
                                    <input type="file" 
                                           class="form-control @error('image') is-invalid @enderror" 
                                           name="image" 
                                           accept="image/*">
                                    @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">
                                    <i class="ti ti-device-floppy me-2"></i>Simpan Perubahan
                                </button>
                                <a href="{{ route('services.show', $service->id) }}" class="btn btn-light ms-2">
                                    <i class="ti ti-arrow-left me-2"></i>Kembali
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.form-control, .form-select, .input-group-text {
    border-radius: 0.75rem;
    padding: 0.75rem 1rem;
    border: 1px solid rgba(0,0,0,0.1);
}

.input-group .form-control {
    border-radius: 0.75rem;
}

.input-group .input-group-text:first-child {
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;
}

.input-group .input-group-text:last-child {
    border-top-left-radius: 0;
    border-bottom-left-radius: 0;
}

.form-control:focus, .form-select:focus {
    border-color: #4466f2;
    box-shadow: 0 0 0 0.25rem rgba(68, 102, 242, 0.25);
}

.btn {
    padding: 0.75rem 1.5rem;
    border-radius: 0.75rem;
}

.btn-sm {
    padding: 0.5rem 1rem;
    border-radius: 0.5rem;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Preview gambar sebelum upload
    const imageInput = document.querySelector('input[type="file"]');
    imageInput.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.createElement('img');
                preview.src = e.target.result;
                preview.className = 'img-fluid rounded mt-2';
                preview.style.maxHeight = '200px';
                
                const previewContainer = imageInput.parentElement;
                const existingPreview = previewContainer.querySelector('img');
                if (existingPreview) {
                    existingPreview.remove();
                }
                previewContainer.appendChild(preview);
            }
            reader.readAsDataURL(file);
        }
    });
});
</script>
@endsection 