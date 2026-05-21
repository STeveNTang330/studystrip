@extends('layouts.master-guru')

@section('pageTitle', 'Unggah Komik')

@section('content')
<div class="row mb-4 align-items-center">
    <div class="col-md-8">
        <h4>Studio Perakitan Komik</h4>
        <p class="text-muted mb-0">Rancang bab komik interaktif menggunakan skenario (prompt) dan aset visual pilihan.</p>
    </div>
    <div class="col-md-4 text-md-end mt-3 mt-md-0">
        <a href="{{ route('dashboard') }}" class="btn btn-light border shadow-sm"><i class="fa-solid fa-arrow-left me-2"></i> Kembali</a>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card p-4 p-md-5 border-0 shadow-sm" style="border-radius: 16px;">
            
            @if($errors->any())
                <div class="alert alert-danger rounded-3" style="font-size: 14px;">
                    <ul class="mb-0 ps-3">
                        @foreach($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('comic.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <h5 class="fw-bold mb-4 border-bottom pb-2">1. Informasi Dasar Bab</h5>
                
                <div class="row g-3 mb-4">
                    <div class="col-md-3">
                        <label class="form-label fw-bold text-muted small">Nomor Bab</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="fa-solid fa-hashtag"></i></span>
                            <input type="number" name="chapter_number" class="form-control" placeholder="Contoh: 1" required>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <label class="form-label fw-bold text-muted small">Judul Materi</label>
                        <input type="text" name="title" class="form-control" placeholder="Contoh: Menjelajah Hukum Newton" required>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold text-muted small">Deskripsi / Sinopsis</label>
                    <textarea name="description" class="form-control" rows="3" placeholder="Tuliskan ringkasan cerita atau materi fisika yang akan dibahas..." required></textarea>
                </div>

                <h5 class="fw-bold mb-4 mt-5 border-bottom pb-3 text-primary"><i class="fa-solid fa-vector-square me-2"></i> 2. Penyusunan Panel Visual (Drag & Drop)</h5>

                <div class="row g-4">
                    <!-- ASSET LIBRARY -->
                    <div class="col-lg-4">
                        <div class="card border-0 shadow-sm" style="border-radius: 18px;">
                            <div class="card-body p-4">
                                <h6 class="fw-bold mb-3 d-flex align-items-center">
                                    <i class="fa-solid fa-layer-group text-primary me-2"></i> Pustaka Aset
                                </h6>
                                <p class="text-muted small mb-3">Unggah & atur halaman komik Anda dengan drag-drop.</p>

                                <div id="dropArea" class="border border-2 border-dashed rounded-4 p-4 text-center mb-4 position-relative" style="cursor: pointer; background: linear-gradient(135deg, rgba(99,102,241,0.05), rgba(139,92,246,0.05)); min-height: 140px; display: flex; flex-direction: column; justify-content: center; align-items: center; transition: all 0.3s ease;">
                                    <i class="fa-solid fa-cloud-arrow-up text-primary mb-2" style="font-size: 2.5rem;"></i>
                                    <p class="fw-semibold mb-1" style="color: #1f2946;">Tarik file di sini</p>
                                    <p class="text-muted small mb-3">atau</p>
                                    <button type="button" id="browseFiles" class="btn btn-primary btn-sm fw-bold" style="border-radius: 10px; padding: 8px 18px;">
                                        <i class="fa-solid fa-folder-open me-1"></i> Pilih File
                                    </button>
                                    <input type="file" name="visual_assets[]" class="d-none" id="assetUpload" accept="image/*" multiple>
                                </div>

                                <div id="assetLibrary" class="d-flex flex-column gap-2"></div>
                            </div>
                        </div>
                    </div>

                    <!-- STORYBOARD -->
                    <div class="col-lg-8">
                        <div class="card border-0 shadow-sm" style="border-radius: 18px;">
                            <div class="card-body p-4">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h6 class="fw-bold mb-0 d-flex align-items-center">
                                        <i class="fa-solid fa-film text-success me-2"></i> Story Board
                                    </h6>
                                    <button type="button" id="resetStoryboard" class="btn btn-outline-danger btn-sm" title="Reset semua panel">
                                        <i class="fa-solid fa-rotate-left"></i>
                                    </button>
                                </div>
                                <p class="text-muted small mb-4">Setiap panel akan menjadi halaman dalam komik. Atur urutan dengan cara seret-seret asset.</p>

                                <div id="storyboard" class="row row-cols-auto g-3"></div>
                                
                                <div class="mt-4 p-3 rounded-3 bg-light" style="border-left: 4px solid #6366f1;">
                                    <small class="text-muted">
                                        <i class="fa-solid fa-circle-info me-2"></i>
                                        <strong>Tip:</strong> Drag aset dari library atau klik untuk auto-assign ke panel kosong pertama.
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <input type="hidden" name="prompt_script" id="prompt_script" value="Auto-generated from storyboard">

                <div class="d-flex justify-content-end gap-2 mt-5">
                    <button type="reset" class="btn btn-light border fw-bold px-4">Bersihkan</button>
                    <button type="submit" class="btn btn-primary fw-bold px-4" style="background-color: #F9A826; border: none; color: white;">
                        <i class="fa-solid fa-cloud-arrow-up me-2"></i> Rakit & Simpan Komik
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script>
    const dropArea = document.getElementById('dropArea');
    const fileInput = document.getElementById('assetUpload');
    const browseFiles = document.getElementById('browseFiles');
    const assetLibrary = document.getElementById('assetLibrary');
    const storyboard = document.getElementById('storyboard');
    const resetBtn = document.getElementById('resetStoryboard');
    
    let selectedFiles = [];
    let storySlots = {};
    let draggedAssetIndex = null;

    function formatFileSize(bytes) {
        if (bytes < 1024) return bytes + ' B';
        if (bytes < 1048576) return (bytes / 1024).toFixed(1) + ' KB';
        return (bytes / 1048576).toFixed(1) + ' MB';
    }

    function renderAssetLibrary() {
        assetLibrary.innerHTML = '';
        
        selectedFiles.forEach((file, index) => {
            const assignedSlot = Object.values(storySlots).indexOf(index);
            const item = document.createElement('div');
            item.className = 'asset-item d-flex align-items-center p-3 bg-white rounded-3 border shadow-sm';
            item.style.cursor = 'grab';
            item.style.transition = 'all 0.2s ease';
            item.dataset.index = index;
            item.draggable = true;
            
            item.innerHTML = `
                <div class="position-relative flex-shrink-0 me-3" style="width: 60px; height: 60px; border-radius: 12px; overflow: hidden; background: linear-gradient(135deg, #f3f4f6, #e5e7eb);">
                    <img src="${URL.createObjectURL(file)}" alt="${file.name}" style="width: 100%; height: 100%; object-fit: contain; padding: 4px;">
                </div>
                <div class="flex-grow-1" style="overflow: hidden;">
                    <div class="fw-semibold text-dark" style="font-size: 0.9rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">${file.name}</div>
                    <div class="text-muted small">${formatFileSize(file.size)}</div>
                    ${assignedSlot !== -1 ? `<span class="badge bg-success mt-1" style="font-size: 11px;">Panel ${assignedSlot + 1}</span>` : ''}
                </div>
                <button type="button" class="btn btn-sm btn-outline-danger flex-shrink-0 ms-2 btn-delete-asset" data-index="${index}" title="Hapus">
                    <i class="fa-solid fa-trash"></i>
                </button>
            `;
            
            item.addEventListener('dragstart', onAssetDragStart);
            item.addEventListener('dragend', onAssetDragEnd);
            item.addEventListener('mouseover', () => item.style.backgroundColor = '#f8f9fa');
            item.addEventListener('mouseout', () => item.style.backgroundColor = '#ffffff');
            
            assetLibrary.appendChild(item);
        });

        assetLibrary.querySelectorAll('.btn-delete-asset').forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.stopPropagation();
                const index = Number(btn.dataset.index);
                selectedFiles.splice(index, 1);
                Object.keys(storySlots).forEach(slot => {
                    if (storySlots[slot] === index) delete storySlots[slot];
                    if (storySlots[slot] > index) storySlots[slot]--;
                });
                renderAll();
            });
        });
    }

    function renderStoryboard() {
        storyboard.innerHTML = '';
        
        for (let i = 0; i < Math.max(6, selectedFiles.length); i++) {
            const panel = document.createElement('div');
            panel.className = 'col';
            panel.dataset.slotIndex = i; // Store slot index for easier access
            
            panel.innerHTML = `
                <div class="story-panel card border-0 h-100 position-relative overflow-hidden" data-slot="${i}" 
                     style="border-radius: 16px; background: #f8fafc; cursor: grab; transition: all 0.3s ease; min-height: 200px; display: flex; flex-direction: column;">
                    <div class="d-flex justify-content-between align-items-center p-3" style="background: rgba(99,102,241,0.05); border-bottom: 1px solid rgba(99,102,241,0.1);">
                        <span class="fw-bold text-dark" style="font-size: 0.95rem;">Panel ${i + 1}</span>
                        <span class="badge bg-secondary-subtle text-secondary" style="font-size: 10px;">Drop here</span>
                    </div>
                    <div class="story-dropzone flex-grow-1 d-flex flex-column justify-content-center align-items-center text-center p-3" 
                         style="border: 2px dashed #cbd5e1; border-radius: 12px; margin: 12px; position: relative; background: #ffffff; transition: all 0.2s ease;">
                        <i class="fa-solid fa-image text-secondary-subtle" style="font-size: 2rem; margin-bottom: 8px; opacity: 0.5;"></i>
                        <div class="text-muted small">Drag asset ke sini</div>
                    </div>
                </div>
            `;
            
            storyboard.appendChild(panel);
            
            const dropzone = panel.querySelector('.story-dropzone');
            
            // Attach drop zone events
            dropzone.addEventListener('dragover', (e) => onPanelDragOver(e, i));
            dropzone.addEventListener('dragleave', (e) => onPanelDragLeave(e, i));
            dropzone.addEventListener('drop', (e) => onPanelDrop(e, i));
            
            // Also allow drag over the entire panel
            panel.addEventListener('dragover', (e) => onPanelDragOver(e, i));
        }

        Object.entries(storySlots).forEach(([slot, fileIndex]) => {
            if (selectedFiles[fileIndex]) {
                const file = selectedFiles[fileIndex];
                const panel = storyboard.querySelector(`[data-slot="${slot}"]`);
                if (panel) {
                    const dropzone = panel.querySelector('.story-dropzone');
                    dropzone.innerHTML = `
                        <div class="position-relative w-100 h-100 d-flex flex-column justify-content-center align-items-center">
                            <img src="${URL.createObjectURL(file)}" alt="panel" style="max-width: 95%; max-height: 95%; object-fit: contain; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                            <div class="position-absolute top-0 end-0 p-2">
                                <button type="button" class="btn btn-sm btn-danger btn-remove-panel" data-slot="${slot}" style="border-radius: 50%; width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; padding: 0;">
                                    <i class="fa-solid fa-xmark"></i>
                                </button>
                            </div>
                        </div>
                    `;
                }
            }
        });

        document.querySelectorAll('.btn-remove-panel').forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.stopPropagation();
                delete storySlots[btn.dataset.slot];
                renderAll();
            });
        });

        syncInputFiles();
    }

    function onAssetDragStart(e) {
        draggedAssetIndex = Number(e.currentTarget.dataset.index);
        e.dataTransfer.effectAllowed = 'move';
        e.dataTransfer.setData('text/plain', String(draggedAssetIndex));
        e.currentTarget.style.opacity = '0.5';
        document.querySelectorAll('.story-dropzone').forEach(zone => {
            zone.style.borderColor = '#6366f1';
            zone.style.backgroundColor = 'rgba(99,102,241,0.05)';
        });
    }

    function onAssetDragEnd(e) {
        e.currentTarget.style.opacity = '1';
        document.querySelectorAll('.story-dropzone').forEach(zone => {
            zone.style.borderColor = '#cbd5e1';
            zone.style.backgroundColor = '#ffffff';
        });
    }

    function onPanelDragOver(e, slotIndex) {
        e.preventDefault();
        e.stopPropagation();
        e.dataTransfer.dropEffect = 'move';
        const dropzone = e.currentTarget.closest('.story-dropzone') || e.currentTarget.querySelector('.story-dropzone');
        if (dropzone) {
            dropzone.style.transform = 'scale(1.02)';
            dropzone.style.borderColor = '#10b981';
            dropzone.style.backgroundColor = 'rgba(16,185,129,0.08)';
        }
    }

    function onPanelDragLeave(e, slotIndex) {
        e.stopPropagation();
        const dropzone = e.currentTarget.closest('.story-dropzone') || e.currentTarget.querySelector('.story-dropzone');
        if (dropzone && e.currentTarget === dropzone) {
            dropzone.style.transform = 'scale(1)';
            dropzone.style.borderColor = '#cbd5e1';
            dropzone.style.backgroundColor = '#ffffff';
        }
    }

    function onPanelDrop(e, slotIndex) {
        e.preventDefault();
        e.stopPropagation();
        
        try {
            const fileIndex = parseInt(e.dataTransfer.getData('text/plain')) || draggedAssetIndex;
            
            if (fileIndex === null || fileIndex === undefined || isNaN(fileIndex)) {
                console.error('Invalid file index');
                return;
            }
            
            // Remove file from any other slot
            Object.keys(storySlots).forEach(key => {
                if (storySlots[key] === fileIndex) delete storySlots[key];
            });
            
            // Assign to current slot
            storySlots[slotIndex] = fileIndex;
            
            // Reset visual feedback
            document.querySelectorAll('.story-dropzone').forEach(zone => {
                zone.style.transform = 'scale(1)';
                zone.style.borderColor = '#cbd5e1';
                zone.style.backgroundColor = '#ffffff';
            });
            
            renderAll();
        } catch (err) {
            console.error('Drop error:', err);
        }
    }

    function renderAll() {
        renderAssetLibrary();
        renderStoryboard();
    }

    function handleFiles(files) {
        const acceptedTypes = ['image/jpeg','image/jpg','image/png','image/svg+xml','image/webp','image/gif'];
        const validFiles = Array.from(files).filter(file => acceptedTypes.includes(file.type));
        selectedFiles.push(...validFiles);
        renderAll();
    }

    function syncInputFiles() {
        const dataTransfer = new DataTransfer();
        const assignedIndexes = new Set(Object.values(storySlots));
        const orderedFiles = [];
        
        Object.keys(storySlots).sort((a, b) => Number(a) - Number(b)).forEach(slot => {
            if (storySlots[slot] !== undefined && storySlots[slot] !== null) {
                orderedFiles.push(selectedFiles[storySlots[slot]]);
            }
        });
        
        selectedFiles.forEach((file, index) => {
            if (!assignedIndexes.has(index)) {
                orderedFiles.push(file);
            }
        });
        
        orderedFiles.forEach(file => dataTransfer.items.add(file));
        fileInput.files = dataTransfer.files;
    }

    // Event Listeners
    dropArea.addEventListener('dragover', e => e.preventDefault());
    dropArea.addEventListener('drop', e => {
        e.preventDefault();
        dropArea.style.backgroundColor = '';
        handleFiles(e.dataTransfer.files);
    });
    
    dropArea.addEventListener('dragenter', () => {
        dropArea.style.backgroundColor = 'rgba(99,102,241,0.1)';
    });
    
    dropArea.addEventListener('dragleave', () => {
        dropArea.style.backgroundColor = '';
    });

    browseFiles.addEventListener('click', () => fileInput.click());
    fileInput.addEventListener('change', e => handleFiles(e.target.files));

    resetBtn.addEventListener('click', () => {
        if (confirm('Hapus semua panel?')) {
            storySlots = {};
            renderAll();
        }
    });

    document.querySelector('form').addEventListener('submit', e => {
        if (selectedFiles.length === 0) {
            e.preventDefault();
            alert('Minimal tambahkan 1 aset sebelum menyimpan.');
        }
    });

    // Initialize
    renderAll();
</script>
@endsection