@extends('layout.app_modern', ['title' => 'Tambah Data Pasien'])

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card border-0 shadow-lg">
                <div class="card-header bg-gradient-primary p-4">
                    <h3 class="text-white mb-0">
                        <i class="ti ti-user-plus me-2"></i>Tambah Data Pasien
                    </h3>
                </div>
                <div class="card-body p-5">
                    <form action="{{ route('pasien.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-4">
                            <!-- Foto Pasien -->
                            <div class="col-md-12 mb-4">
                                <div class="form-group">
                                    <label class="form-label fw-bold mb-3">Foto Pasien</label>
                                    <div class="drop-zone @error('foto') is-invalid @enderror">
                                        <span class="drop-zone__prompt">
                                            <i class="ti ti-upload fs-2 mb-2"></i>
                                            <br>Drag & drop foto di sini atau klik untuk memilih
                                        </span>
                                        <input type="file" name="foto" class="drop-zone__input" accept="image/*">
                                    </div>
                                    <small class="text-muted mt-2 d-block">Format: JPG, JPEG, PNG (Maks. 2MB)</small>
                                    @error('foto')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Form Fields -->
                            <div class="col-md-6">
                                <div class="floating-label-group">
                                    <input type="text" class="form-control floating-input @error('no_pasien') is-invalid @enderror" 
                                           id="no_pasien" name="no_pasien" value="{{ old('no_pasien') }}" placeholder=" ">
                                    <label class="floating-label">Nomor Pasien</label>
                                    <i class="ti ti-id input-icon"></i>
                                    @error('no_pasien')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="floating-label-group">
                                    <input type="text" class="form-control floating-input @error('nama') is-invalid @enderror" 
                                           id="nama" name="nama" value="{{ old('nama') }}" placeholder=" ">
                                    <label class="floating-label">Nama Lengkap</label>
                                    <i class="ti ti-user input-icon"></i>
                                    @error('nama')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="floating-label-group">
                                    <input type="number" class="form-control floating-input @error('umur') is-invalid @enderror" 
                                           id="umur" name="umur" value="{{ old('umur') }}" placeholder=" ">
                                    <label class="floating-label">Umur</label>
                                    <i class="ti ti-calendar input-icon"></i>
                                    @error('umur')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold mb-3">Jenis Kelamin</label>
                                <div class="gender-selector">
                                    <div class="gender-option">
                                        <input type="radio" name="jenis_kelamin" id="laki_laki" value="Laki-laki" 
                                               {{ old('jenis_kelamin') === 'Laki-laki' ? 'checked' : '' }}>
                                        <label for="laki_laki">
                                            <i class="ti ti-mars"></i>
                                            Laki-laki
                                        </label>
                                    </div>
                                    <div class="gender-option">
                                        <input type="radio" name="jenis_kelamin" id="perempuan" value="Perempuan" 
                                               {{ old('jenis_kelamin') === 'Perempuan' ? 'checked' : '' }}>
                                        <label for="perempuan">
                                            <i class="ti ti-venus"></i>
                                            Perempuan
                                        </label>
                                    </div>
                                </div>
                                @error('jenis_kelamin')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-12">
                                <div class="floating-label-group">
                                    <textarea class="form-control floating-input @error('alamat') is-invalid @enderror" 
                                              id="alamat" name="alamat" rows="3" placeholder=" ">{{ old('alamat') }}</textarea>
                                    <label class="floating-label">Alamat Lengkap</label>
                                    <i class="ti ti-map-pin input-icon"></i>
                                    @error('alamat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end mt-5">
                            <a href="{{ route('pasien.index') }}" class="btn btn-light btn-lg me-3">
                                <i class="ti ti-arrow-left me-2"></i>Kembali
                            </a>
                            <button type="submit" class="btn btn-primary btn-lg px-5">
                                <i class="ti ti-device-floppy me-2"></i>Simpan Data
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Modern Form Styling */
.floating-label-group {
    position: relative;
    margin-bottom: 1rem;
}

.floating-input {
    height: 3.5rem;
    padding: 1rem 1rem 1rem 3rem;
    font-size: 1rem;
    border-radius: 1rem;
    border: 2px solid #e0e0e0;
    background: #f8f9fa;
    transition: all 0.2s ease;
}

.floating-input:focus {
    border-color: #4e73df;
    background: white;
    box-shadow: 0 0 0 0.25rem rgba(78, 115, 223, 0.1);
}

.floating-label {
    position: absolute;
    top: 1rem;
    left: 3rem;
    color: #6c757d;
    pointer-events: none;
    transition: all 0.2s ease;
}

.floating-input:focus ~ .floating-label,
.floating-input:not(:placeholder-shown) ~ .floating-label {
    top: -0.5rem;
    left: 1rem;
    font-size: 0.875rem;
    padding: 0 0.5rem;
    background: white;
    color: #4e73df;
}

.input-icon {
    position: absolute;
    left: 1rem;
    top: 1.1rem;
    color: #6c757d;
    font-size: 1.2rem;
}

/* Drop Zone Styling */
.drop-zone {
    width: 100%;
    height: 200px;
    padding: 25px;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    background: #f8f9fa;
    cursor: pointer;
    border: 2px dashed #e0e0e0;
    border-radius: 1rem;
    transition: all 0.2s ease;
}

.drop-zone:hover {
    background: #fff;
    border-color: #4e73df;
}

.drop-zone__input {
    display: none;
}

.drop-zone__prompt {
    color: #6c757d;
}

/* Gender Selector Styling */
.gender-selector {
    display: flex;
    gap: 1rem;
}

.gender-option {
    flex: 1;
}

.gender-option input[type="radio"] {
    display: none;
}

.gender-option label {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    padding: 1rem;
    background: #f8f9fa;
    border: 2px solid #e0e0e0;
    border-radius: 1rem;
    cursor: pointer;
    transition: all 0.2s ease;
}

.gender-option input[type="radio"]:checked + label {
    background: #4e73df;
    border-color: #4e73df;
    color: white;
}

/* Textarea Styling */
textarea.floating-input {
    height: auto;
    min-height: 100px;
}

/* Button Styling */
.btn {
    padding: 0.8rem 1.5rem;
    border-radius: 1rem;
    transition: all 0.2s ease;
}

.btn:hover {
    transform: translateY(-2px);
}

.btn-primary {
    background: #4e73df;
    border: none;
}

.btn-light {
    background: #f8f9fa;
    border: 2px solid #e0e0e0;
}
</style>

<script>
document.querySelectorAll('.drop-zone__input').forEach(inputElement => {
    const dropZoneElement = inputElement.closest('.drop-zone');

    dropZoneElement.addEventListener('click', e => {
        inputElement.click();
    });

    inputElement.addEventListener('change', e => {
        if (inputElement.files.length) {
            updateThumbnail(dropZoneElement, inputElement.files[0]);
        }
    });

    dropZoneElement.addEventListener('dragover', e => {
        e.preventDefault();
        dropZoneElement.classList.add('drop-zone--over');
    });

    ['dragleave', 'dragend'].forEach(type => {
        dropZoneElement.addEventListener(type, e => {
            dropZoneElement.classList.remove('drop-zone--over');
        });
    });

    dropZoneElement.addEventListener('drop', e => {
        e.preventDefault();

        if (e.dataTransfer.files.length) {
            inputElement.files = e.dataTransfer.files;
            updateThumbnail(dropZoneElement, e.dataTransfer.files[0]);
        }

        dropZoneElement.classList.remove('drop-zone--over');
    });
});

function updateThumbnail(dropZoneElement, file) {
    let thumbnailElement = dropZoneElement.querySelector('.drop-zone__thumb');

    if (dropZoneElement.querySelector('.drop-zone__prompt')) {
        dropZoneElement.querySelector('.drop-zone__prompt').remove();
    }

    if (!thumbnailElement) {
        thumbnailElement = document.createElement('div');
        thumbnailElement.classList.add('drop-zone__thumb');
        dropZoneElement.appendChild(thumbnailElement);
    }

    thumbnailElement.dataset.label = file.name;

    if (file.type.startsWith('image/')) {
        const reader = new FileReader();

        reader.readAsDataURL(file);
        reader.onload = () => {
            thumbnailElement.style.backgroundImage = `url('${reader.result}')`;
        };
    }
}
</script>
@endsection