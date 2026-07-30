@extends('Layout.admin')

@section('content')
<style>
    /* ===== MODERN DARK BLUE THEME ===== */
    .edit-card {
        border: none;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
        overflow: hidden;
        margin-top: 10px;
        background: #f8faff;
    }

    .edit-card .card-header {
        background: linear-gradient(135deg, #0f1a2e 0%, #1a2a4a 100%);
        padding: 18px 28px;
        border: none;
    }

    .edit-card .card-header h5 {
        color: #ffffff;
        font-weight: 600;
        font-size: 1rem;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .edit-card .card-header h5 i {
        color: #60a5fa;
        font-size: 1.2rem;
    }

    .edit-card .card-header .badge-header {
        background: rgba(255, 255, 255, 0.12);
        color: #93bbfc;
        font-size: 0.65rem;
        font-weight: 500;
        padding: 4px 14px;
        border-radius: 20px;
        margin-left: auto;
        letter-spacing: 0.3px;
    }

    .edit-card .card-body {
        padding: 28px;
        background: #f8faff;
    }

    /* Form Labels */
    .form-label-modern {
        font-weight: 600;
        font-size: 0.82rem;
        color: #1a2a4a;
        margin-bottom: 5px;
        display: block;
    }

    .form-label-modern .required {
        color: #ef4444;
        margin-left: 2px;
    }

    .form-label-modern .label-icon {
        width: 18px;
        color: #1a2a4a;
        margin-right: 4px;
    }

    /* Form Controls */
    .form-control-modern {
        background: #ffffff;
        border: 1.5px solid #e2e8f0;
        border-radius: 10px;
        padding: 9px 16px;
        font-size: 0.88rem;
        color: #1a2a4a;
        width: 100%;
        transition: all 0.25s ease;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.02);
        height: 42px;
    }

    .form-control-modern:focus {
        border-color: #1a2a4a;
        box-shadow: 0 0 0 4px rgba(26, 42, 74, 0.08);
        outline: none;
    }

    .form-control-modern.is-invalid {
        border-color: #ef4444;
    }

    .form-control-modern::placeholder {
        color: #94a3b8;
        font-size: 0.84rem;
    }

    select.form-control-modern {
        appearance: none;
        -webkit-appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%231a2a4a' d='M6 8L1 3h10z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 14px center;
        padding-right: 40px;
        cursor: pointer;
        color: #1a2a4a;
    }

    select.form-control-modern option {
        color: #1a2a4a;
        background: #ffffff;
        padding: 8px;
    }

    textarea.form-control-modern {
        resize: vertical;
        min-height: 60px;
        height: auto;
    }

    /* Info Section */
    .info-section {
        background: #ffffff;
        border: 1.5px solid #e8edf5;
        border-radius: 12px;
        padding: 20px 24px;
        margin-bottom: 20px;
    }

    .info-section .section-title {
        font-weight: 700;
        font-size: 0.9rem;
        color: #1a2a4a;
        margin-bottom: 16px;
        padding-bottom: 10px;
        border-bottom: 2px solid #eef2f8;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .info-section .section-title i {
        color: #1a2a4a;
    }

    /* Visitor Box */
    .visitor-box {
        background: #ffffff;
        border: 1.5px solid #e8edf5;
        border-radius: 12px;
        padding: 18px 20px;
        margin-bottom: 12px;
        transition: all 0.25s ease;
        width: 100%;
    }

    .visitor-box:hover {
        border-color: #1a2a4a;
        box-shadow: 0 4px 16px rgba(26, 42, 74, 0.06);
        transform: translateY(-1px);
    }

    .visitor-box .box-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 14px;
        padding-bottom: 10px;
        border-bottom: 1.5px dashed #eef2f8;
        flex-wrap: wrap;
        gap: 8px;
    }

    .visitor-box .box-header .title {
        font-weight: 700;
        font-size: 0.88rem;
        color: #1a2a4a;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .visitor-box .box-header .title i {
        color: #1a2a4a;
        font-size: 1rem;
    }

    .visitor-box .box-header .badge-primary {
        background: #1a2a4a;
        color: #fff;
        font-size: 0.58rem;
        font-weight: 600;
        padding: 2px 14px;
        border-radius: 20px;
        letter-spacing: 0.4px;
        text-transform: uppercase;
    }

    .visitor-box .box-header .badge-additional {
        background: #eef2f8;
        color: #5a6a8a;
        font-size: 0.58rem;
        font-weight: 600;
        padding: 2px 14px;
        border-radius: 20px;
        letter-spacing: 0.4px;
        text-transform: uppercase;
    }

    .visitor-box .form-label-modern {
        font-size: 0.74rem;
        color: #4a5a7a;
    }

    .visitor-box .form-control-modern {
        padding: 7px 14px;
        font-size: 0.84rem;
        height: 38px;
    }

    .visitor-box .row {
        margin-left: -6px;
        margin-right: -6px;
    }

    .visitor-box .row>[class*="col-"] {
        padding-left: 6px;
        padding-right: 6px;
    }

    /* Buttons */
    .btn-add-visitor {
        background: #1a2a4a;
        color: #ffffff;
        border: none;
        padding: 6px 20px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 0.82rem;
        transition: all 0.25s ease;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        white-space: nowrap;
        box-shadow: 0 2px 8px rgba(26, 42, 74, 0.15);
        height: 36px;
    }

    .btn-add-visitor:hover {
        background: #0f1a2e;
        color: #ffffff;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(26, 42, 74, 0.2);
    }

    .btn-add-visitor i {
        font-size: 0.9rem;
    }

    .btn-remove {
        background: #fef2f2;
        color: #ef4444;
        border: 1.5px solid #ef4444;
        padding: 3px 14px;
        border-radius: 8px;
        font-size: 0.7rem;
        font-weight: 600;
        transition: all 0.25s ease;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        height: 30px;
    }

    .btn-remove:hover {
        background: #ef4444;
        color: #ffffff;
        transform: scale(1.02);
    }

    .btn-remove i {
        font-size: 0.7rem;
    }

    .btn-back {
        background: #f1f4f9;
        color: #1a2a4a;
        border: none;
        padding: 10px 28px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 0.85rem;
        transition: all 0.25s ease;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        height: 44px;
    }

    .btn-back:hover {
        background: #e5e9f0;
        color: #0f1a2e;
        text-decoration: none;
        transform: translateY(-1px);
    }

    .btn-save-modern {
        background: linear-gradient(135deg, #1a2a4a 0%, #0f1a2e 100%);
        color: #ffffff;
        border: none;
        padding: 10px 32px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 0.85rem;
        transition: all 0.25s ease;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        flex: 1;
        justify-content: center;
        box-shadow: 0 2px 12px rgba(26, 42, 74, 0.15);
        height: 44px;
    }

    .btn-save-modern:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 24px rgba(26, 42, 74, 0.25);
        color: #ffffff;
    }

    /* Counter */
    .visitor-counter {
        background: #eef2f8;
        color: #1a2a4a;
        padding: 0px 12px;
        border-radius: 20px;
        font-size: 0.7rem;
        font-weight: 700;
        margin-left: 6px;
        display: inline-block;
        min-width: 24px;
        text-align: center;
        height: 22px;
        line-height: 22px;
    }

    /* Action Row */
    .action-row {
        display: flex;
        gap: 14px;
        margin-top: 6px;
        flex-wrap: wrap;
    }

    /* Small Text */
    .text-danger {
        color: #ef4444 !important;
    }

    .small {
        font-size: 0.72rem;
    }

    .mt-1 {
        margin-top: 4px;
    }

    /* Hide remove button for primary visitor */
    .visitor-box:first-child .removeVisitorBtn {
        display: none !important;
    }

    /* Form group */
    .form-group {
        margin-bottom: 1.5rem;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .edit-card .card-body {
            padding: 18px;
        }

        .info-section {
            padding: 16px 18px;
        }

        .visitor-box {
            padding: 14px 16px;
        }

        .visitor-box .box-header {
            flex-wrap: wrap;
            gap: 8px;
        }

        .action-row {
            flex-direction: column;
        }

        .btn-save-modern {
            flex: none;
            width: 100%;
            justify-content: center;
        }

        .btn-back {
            width: 100%;
            justify-content: center;
        }

        .btn-add-visitor {
            font-size: 0.75rem;
            padding: 5px 14px;
        }

        .edit-card .card-header .badge-header {
            display: none;
        }

        .edit-card .card-header {
            padding: 14px 20px;
        }

        .visitor-box .row>[class*="col-"] {
            flex: 0 0 100% !important;
            max-width: 100% !important;
        }
    }
</style>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-10 mx-auto">
            <div class="edit-card card">
                <!-- Header -->
                <div class="card-header">
                    <h5>
                        <i class="fas fa-edit"></i>
                        Edit Visitor Record
                        <span class="badge-header">
                            <i class="far fa-clock"></i> {{ now()->format('d M Y, h:i A') }}
                        </span>
                    </h5>
                </div>

                <div class="card-body">
                    <form action="{{ route('visitor.update', $visitor->id) }}" method="POST" id="editVisitorForm">
                        @csrf
                        @method('PUT')

                        <!-- Student Information -->
                        <div class="info-section">
                            <div class="section-title">
                                <i class="fas fa-user-graduate"></i>
                                Student Information
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label-modern">
                                        Student Name <span class="required">*</span>
                                    </label>
                                    <input type="text" class="form-control-modern @error('student_name') is-invalid @enderror"
                                           name="student_name" 
                                           value="{{ old('student_name', $visitor->student_name) }}" 
                                           placeholder="Enter student name" required>
                                    @error('student_name')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label-modern">
                                        Room Number
                                    </label>
                                    <input type="text" class="form-control-modern @error('student_room') is-invalid @enderror"
                                           name="student_room" 
                                           value="{{ old('student_room', $visitor->student_room) }}" 
                                           placeholder="e.g., 101">
                                    @error('student_room')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label-modern">
                                        Phone
                                    </label>
                                    <input type="text" class="form-control-modern @error('student_phone') is-invalid @enderror"
                                           name="student_phone" 
                                           value="{{ old('student_phone', $visitor->student_phone) }}" 
                                           placeholder="0300-1234567">
                                    @error('student_phone')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label-modern">
                                        CNIC
                                    </label>
                                    <input type="text" class="form-control-modern @error('student_cnic') is-invalid @enderror"
                                           name="student_cnic" 
                                           value="{{ old('student_cnic', $visitor->student_cnic) }}" 
                                           placeholder="35201-1234567-8">
                                    @error('student_cnic')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Visitors List -->
                        <div class="info-section">
                            <div class="section-title">
                                <i class="fas fa-users"></i>
                                Visitors List
                                <span class="visitor-counter" id="visitorCountDisplay">{{ count($visitorDetails) }}</span>
                            </div>

                            <div class="d-flex flex-wrap justify-content-end align-items-center mb-3">
                                <button type="button" class="btn-add-visitor" id="addVisitorBtn">
                                    <i class="fas fa-plus-circle"></i> Add Visitor
                                </button>
                            </div>

                            <div id="visitorsContainer">
                                @php
                                    $visitorDetails = old('visitors', $visitorDetails);
                                @endphp

                                @foreach($visitorDetails as $index => $detail)
                                    <div class="visitor-box" data-index="{{ $index }}">
                                        <div class="box-header">
                                            <span class="title">
                                                <i class="fas fa-user-circle"></i>
                                                Visitor #{{ $index + 1 }}
                                                <span class="{{ $index == 0 ? 'badge-primary' : 'badge-additional' }}">
                                                    {{ $index == 0 ? 'Primary' : 'Additional' }}
                                                </span>
                                            </span>
                                            @if($index > 0)
                                                <button type="button" class="btn-remove removeVisitorBtn">
                                                    <i class="fas fa-trash-alt"></i> Remove
                                                </button>
                                            @endif
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="form-label-modern">
                                                    Full Name <span class="required">*</span>
                                                </label>
                                                <input type="text" class="form-control-modern @error('visitors.'.$index.'.visitor_name') is-invalid @enderror"
                                                       name="visitors[{{ $index }}][visitor_name]"
                                                       placeholder="Enter full name"
                                                       value="{{ $detail['visitor_name'] ?? '' }}" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label-modern">
                                                    Relationship <span class="required">*</span>
                                                </label>
                                                <select class="form-control-modern @error('visitors.'.$index.'.relationship') is-invalid @enderror"
                                                        name="visitors[{{ $index }}][relationship]" required>
                                                    <option value="">Select</option>
                                                    <option value="Father" {{ ($detail['relationship'] ?? '') == 'Father' ? 'selected' : '' }}>Father</option>
                                                    <option value="Mother" {{ ($detail['relationship'] ?? '') == 'Mother' ? 'selected' : '' }}>Mother</option>
                                                    <option value="Brother" {{ ($detail['relationship'] ?? '') == 'Brother' ? 'selected' : '' }}>Brother</option>
                                                    <option value="Sister" {{ ($detail['relationship'] ?? '') == 'Sister' ? 'selected' : '' }}>Sister</option>
                                                    <option value="Uncle" {{ ($detail['relationship'] ?? '') == 'Uncle' ? 'selected' : '' }}>Uncle</option>
                                                    <option value="Aunt" {{ ($detail['relationship'] ?? '') == 'Aunt' ? 'selected' : '' }}>Aunt</option>
                                                    <option value="Cousin" {{ ($detail['relationship'] ?? '') == 'Cousin' ? 'selected' : '' }}>Cousin</option>
                                                    <option value="Friend" {{ ($detail['relationship'] ?? '') == 'Friend' ? 'selected' : '' }}>Friend</option>
                                                    <option value="Guardian" {{ ($detail['relationship'] ?? '') == 'Guardian' ? 'selected' : '' }}>Guardian</option>
                                                    <option value="Other" {{ ($detail['relationship'] ?? '') == 'Other' ? 'selected' : '' }}>Other</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label-modern">
                                                    <i class="far fa-id-card"></i> CNIC
                                                </label>
                                                <input type="text" class="form-control-modern @error('visitors.'.$index.'.cnic_number') is-invalid @enderror"
                                                       name="visitors[{{ $index }}][cnic_number]"
                                                       placeholder="35201-1234567-8"
                                                       value="{{ $detail['cnic_number'] ?? '' }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label-modern">
                                                    <i class="fas fa-phone"></i> Phone
                                                </label>
                                                <input type="text" class="form-control-modern @error('visitors.'.$index.'.phone_number') is-invalid @enderror"
                                                       name="visitors[{{ $index }}][phone_number]"
                                                       placeholder="0300-1234567"
                                                       value="{{ $detail['phone_number'] ?? '' }}">
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <input type="hidden" name="visitor_count" id="visitorCount" value="{{ count($visitorDetails) }}">
                        </div>

                        <!-- Remarks -->
                        <div class="info-section">
                            <div class="section-title">
                                <i class="fas fa-pen"></i>
                                Remarks
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <textarea class="form-control-modern @error('remarks') is-invalid @enderror"
                                              name="remarks" rows="2"
                                              placeholder="Any additional notes...">{{ old('remarks', $visitor->remarks) }}</textarea>
                                    @error('remarks')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="action-row">
                            <a href="{{ route('visitor.show', $visitor->id) }}" class="btn-back">
                                <i class="fas fa-times"></i> Cancel
                            </a>
                            <button type="submit" class="btn-save-modern" id="submitBtn">
                                <i class="fas fa-save"></i> Update Record
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    if (window._visitorEditFormInitialized) return;
    window._visitorEditFormInitialized = true;

    const addBtn = document.getElementById('addVisitorBtn');
    const container = document.getElementById('visitorsContainer');
    const countInput = document.getElementById('visitorCount');
    const countDisplay = document.getElementById('visitorCountDisplay');
    const form = document.getElementById('editVisitorForm');

    if (!addBtn || !container) return;

    function getVisitorCount() {
        return container.querySelectorAll('.visitor-box').length;
    }

    function updateCounter() {
        const count = getVisitorCount();
        if (countInput) countInput.value = count;
        if (countDisplay) countDisplay.textContent = count;
    }

    function updateRemoveButtons() {
        const boxes = container.querySelectorAll('.visitor-box');
        boxes.forEach((box, index) => {
            const removeBtn = box.querySelector('.removeVisitorBtn');
            if (index === 0) {
                if (removeBtn) removeBtn.style.display = 'none';
            } else {
                if (removeBtn) removeBtn.style.display = 'inline-flex';
            }
        });
    }

    function reindexVisitors() {
        const boxes = container.querySelectorAll('.visitor-box');
        boxes.forEach((box, index) => {
            const newIndex = index;
            const visitorNumber = index + 1;
            box.setAttribute('data-index', newIndex);
            
            const title = box.querySelector('.title');
            if (title) {
                const isPrimary = visitorNumber === 1;
                title.innerHTML = `
                    <i class="fas fa-user-circle"></i>
                    Visitor #${visitorNumber}
                    <span class="${isPrimary ? 'badge-primary' : 'badge-additional'}">
                        ${isPrimary ? 'Primary' : 'Additional'}
                    </span>
                `;
            }

            box.querySelectorAll('input, select').forEach(function(input) {
                const name = input.getAttribute('name');
                if (name) {
                    const newName = name.replace(/visitors\[\d+\]/g, 'visitors[' + newIndex + ']');
                    input.setAttribute('name', newName);
                }
            });

            const header = box.querySelector('.box-header');
            if (header) {
                let removeBtn = header.querySelector('.removeVisitorBtn');
                if (index === 0) {
                    if (removeBtn) removeBtn.style.display = 'none';
                } else {
                    if (!removeBtn) {
                        removeBtn = document.createElement('button');
                        removeBtn.type = 'button';
                        removeBtn.className = 'btn-remove removeVisitorBtn';
                        removeBtn.innerHTML = '<i class="fas fa-trash-alt"></i> Remove';
                        header.appendChild(removeBtn);
                    } else {
                        removeBtn.style.display = 'inline-flex';
                    }
                }
            }
        });
        updateCounter();
    }

    addBtn.addEventListener('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        const currentCount = container.querySelectorAll('.visitor-box').length;
        const newIndex = currentCount;
        const visitorNumber = currentCount + 1;

        const newBox = document.createElement('div');
        newBox.className = 'visitor-box';
        newBox.setAttribute('data-index', newIndex);
        newBox.innerHTML = `
            <div class="box-header">
                <span class="title">
                    <i class="fas fa-user-circle"></i>
                    Visitor #${visitorNumber}
                    <span class="badge-additional">Additional</span>
                </span>
                <button type="button" class="btn-remove removeVisitorBtn">
                    <i class="fas fa-trash-alt"></i> Remove
                </button>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label class="form-label-modern">
                        Full Name <span class="required">*</span>
                    </label>
                    <input type="text" class="form-control-modern"
                           name="visitors[${newIndex}][visitor_name]"
                           placeholder="Enter full name" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label-modern">
                        Relationship <span class="required">*</span>
                    </label>
                    <select class="form-control-modern"
                            name="visitors[${newIndex}][relationship]" required>
                        <option value="">Select</option>
                        <option value="Father">Father</option>
                        <option value="Mother">Mother</option>
                        <option value="Brother">Brother</option>
                        <option value="Sister">Sister</option>
                        <option value="Uncle">Uncle</option>
                        <option value="Aunt">Aunt</option>
                        <option value="Cousin">Cousin</option>
                        <option value="Friend">Friend</option>
                        <option value="Guardian">Guardian</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label-modern">
                        <i class="far fa-id-card"></i> CNIC
                    </label>
                    <input type="text" class="form-control-modern"
                           name="visitors[${newIndex}][cnic_number]"
                           placeholder="35201-1234567-8">
                </div>
                <div class="col-md-6">
                    <label class="form-label-modern">
                        <i class="fas fa-phone"></i> Phone
                    </label>
                    <input type="text" class="form-control-modern"
                           name="visitors[${newIndex}][phone_number]"
                           placeholder="0300-1234567">
                </div>
            </div>
        `;
        container.appendChild(newBox);
        updateCounter();
        updateRemoveButtons();
    });

    container.addEventListener('click', function(e) {
        const removeBtn = e.target.closest('.removeVisitorBtn');
        if (!removeBtn) return;
        e.preventDefault();
        e.stopPropagation();
        const box = removeBtn.closest('.visitor-box');
        const boxes = container.querySelectorAll('.visitor-box');
        if (boxes.length <= 1) {
            alert('At least one visitor is required.');
            return;
        }
        if (confirm('Remove this visitor?')) {
            box.remove();
            reindexVisitors();
            updateRemoveButtons();
        }
    });

    container.addEventListener('input', function(e) {
        const input = e.target;
        if (input.classList.contains('form-control-modern') && input.placeholder) {
            if (input.placeholder.includes('35201')) {
                let value = input.value.replace(/\D/g, '');
                if (value.length > 0) {
                    if (value.length <= 5) input.value = value;
                    else if (value.length <= 12) input.value = value.slice(0, 5) + '-' + value.slice(5);
                    else input.value = value.slice(0, 5) + '-' + value.slice(5, 12) + '-' + value.slice(12, 13);
                }
            } else if (input.placeholder.includes('0300')) {
                let value = input.value.replace(/\D/g, '');
                if (value.length > 0) {
                    if (value.length <= 4) input.value = value;
                    else if (value.length <= 7) input.value = value.slice(0, 4) + '-' + value.slice(4);
                    else input.value = value.slice(0, 4) + '-' + value.slice(4, 7) + '-' + value.slice(7, 11);
                }
            }
        }
    });

    if (form) {
        form.addEventListener('submit', function(e) {
            let isValid = true;
            container.querySelectorAll('.visitor-box').forEach(function(box) {
                const nameInput = box.querySelector('input[name*="[visitor_name]"]');
                const relationSelect = box.querySelector('select[name*="[relationship]"]');
                if (nameInput && !nameInput.value.trim()) {
                    isValid = false;
                    nameInput.classList.add('is-invalid');
                } else if (nameInput) {
                    nameInput.classList.remove('is-invalid');
                }
                if (relationSelect && !relationSelect.value) {
                    isValid = false;
                    relationSelect.classList.add('is-invalid');
                } else if (relationSelect) {
                    relationSelect.classList.remove('is-invalid');
                }
            });
            if (!isValid) {
                e.preventDefault();
                alert('Please fill in all required fields.');
            }
        });
    }

    updateCounter();
    updateRemoveButtons();
});
</script>
@endsection