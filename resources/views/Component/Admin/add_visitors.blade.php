@extends('Layout.admin')

@section('content')
<style>
    /* ===== MODERN DARK BLUE THEME ===== */
    .visitor-card {
        border: none;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
        overflow: hidden;
        margin-top: 10px;
    }

    .visitor-card .card-header {
        background: linear-gradient(135deg, #0f1a2e 0%, #1a2a4a 100%);
        padding: 18px 28px;
        border: none;
    }

    .visitor-card .card-header h5 {
        color: #ffffff;
        font-weight: 600;
        font-size: 1rem;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .visitor-card .card-header h5 i {
        color: #60a5fa;
        font-size: 1.2rem;
    }

    .visitor-card .card-header .badge-header {
        background: rgba(255, 255, 255, 0.12);
        color: #93bbfc;
        font-size: 0.65rem;
        font-weight: 500;
        padding: 4px 14px;
        border-radius: 20px;
        margin-left: auto;
        letter-spacing: 0.3px;
    }

    .visitor-card .card-body {
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
    }

    textarea.form-control-modern {
        resize: vertical;
        min-height: 60px;
    }

    /* Visitor Box */
    .visitor-box {
        background: #ffffff;
        border: 1.5px solid #e8edf5;
        border-radius: 12px;
        padding: 18px 20px;
        margin-bottom: 12px;
        transition: all 0.25s ease;
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
    }

    .btn-remove:hover {
        background: #ef4444;
        color: #ffffff;
        transform: scale(1.02);
    }

    .btn-remove i {
        font-size: 0.7rem;
    }

    .btn-cancel-modern {
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
    }

    .btn-cancel-modern:hover {
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
    }

    /* Action Row */
    .action-row {
        display: flex;
        gap: 14px;
        margin-top: 6px;
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

    /* ===== RESPONSIVE ===== */
    @media (max-width: 768px) {
        .visitor-card .card-body {
            padding: 18px;
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

        .btn-cancel-modern {
            width: 100%;
            justify-content: center;
        }

        .btn-add-visitor {
            font-size: 0.75rem;
            padding: 5px 14px;
        }

        .visitor-card .card-header .badge-header {
            display: none;
        }

        .visitor-card .card-header {
            padding: 14px 20px;
        }
    }
</style>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="visitor-card card">
                <!-- Header -->
                <div class="card-header">
                    <h5>
                        <i class="fas fa-user-plus"></i>
                        Register Visitors
                        <span class="badge-header">
                            <i class="far fa-clock"></i> {{ now()->format('d M Y, h:i A') }}
                        </span>
                    </h5>
                </div>

                <!-- Body -->
                <div class="card-body">
                    <form action="{{ route('visitor.store') }}" method="POST" id="visitorForm">
                        @csrf

                        <!-- Student Selection -->
                        <div class="form-group mb-4">
                            <label class="form-label-modern">
                                <i class="fas fa-user-graduate label-icon"></i>
                                Select Student <span class="required">*</span>
                            </label>
                            <select class="form-control-modern @error('student_id') is-invalid @enderror"
                                    name="student_id" id="student_id" required>
                                <option value="">-- Select Student --</option>
                                @foreach($students as $student)
                                    <option value="{{ $student->id }}"
                                            {{ old('student_id') == $student->id ? 'selected' : '' }}>
                                        {{ $student->student_name }}
                                        @if($student->room_number)
                                            (Room: {{ $student->room_number }})
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                            @error('student_id')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Visitors List -->
                        <div class="form-group mb-4">
                            <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
                                <label class="form-label-modern mb-0">
                                    <i class="fas fa-users label-icon"></i>
                                    Visitors List
                                    <span class="visitor-counter" id="visitorCountDisplay">1</span>
                                </label>
                                <button type="button" class="btn-add-visitor" id="addVisitorBtn">
                                    <i class="fas fa-plus-circle"></i> Add Visitor
                                </button>
                            </div>

                            <div id="visitorsContainer">
                                <!-- Default Visitor (Always 1) -->
                                <div class="visitor-box" data-index="0">
                                    <div class="box-header">
                                        <span class="title">
                                            <i class="fas fa-user-circle"></i>
                                            Visitor #1
                                            <span class="badge-primary">Primary</span>
                                        </span>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label-modern">
                                                Full Name <span class="required">*</span>
                                            </label>
                                            <input type="text" class="form-control-modern" 
                                                   name="visitors[0][visitor_name]"
                                                   placeholder="Enter full name" 
                                                   value="{{ old('visitors.0.visitor_name') }}" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label-modern">
                                                Relationship <span class="required">*</span>
                                            </label>
                                            <select class="form-control-modern" 
                                                    name="visitors[0][relationship]" required>
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
                                                   name="visitors[0][cnic_number]"
                                                   placeholder="35201-1234567-8" 
                                                   value="{{ old('visitors.0.cnic_number') }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label-modern">
                                                <i class="fas fa-phone"></i> Phone
                                            </label>
                                            <input type="text" class="form-control-modern" 
                                                   name="visitors[0][phone_number]"
                                                   placeholder="0300-1234567" 
                                                   value="{{ old('visitors.0.phone_number') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" name="visitor_count" id="visitorCount" value="1">
                        </div>

                        <!-- Remarks -->
                        <div class="form-group mb-4">
                            <label class="form-label-modern">
                                <i class="fas fa-pen label-icon"></i> Remarks
                            </label>
                            <textarea class="form-control-modern @error('remarks') is-invalid @enderror"
                                      name="remarks" rows="2"
                                      placeholder="Any additional notes...">{{ old('remarks') }}</textarea>
                            @error('remarks')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Actions -->
                        <div class="action-row">
                            <a href="{{ route('visitors_records') }}" class="btn-cancel-modern">
                                <i class="fas fa-times"></i> Cancel
                            </a>
                            <button type="submit" class="btn-save-modern" id="submitBtn">
                                <i class="fas fa-save"></i> Save Record
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {

    var addBtn = document.getElementById('addVisitorBtn');
    var container = document.getElementById('visitorsContainer');
    var countInput = document.getElementById('visitorCount');
    var countDisplay = document.getElementById('visitorCountDisplay');

    if (!addBtn) return;

    // Add visitor
    addBtn.addEventListener('click', function(e) {
        e.preventDefault();
        e.stopPropagation();

        var currentBoxes = container.querySelectorAll('.visitor-box');
        var currentCount = currentBoxes.length;
        var newIndex = currentCount;
        var visitorNumber = currentCount + 1;

        var newBox = document.createElement('div');
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
        countInput.value = currentCount + 1;
        countDisplay.textContent = currentCount + 1;
    });

    // Remove visitor - using event delegation
    container.addEventListener('click', function(e) {
        var removeBtn = e.target.closest('.removeVisitorBtn');
        if (!removeBtn) return;

        e.preventDefault();
        e.stopPropagation();

        var box = removeBtn.closest('.visitor-box');
        var boxes = container.querySelectorAll('.visitor-box');

        if (boxes.length <= 1) {
            alert('At least one visitor is required.');
            return;
        }

        if (confirm('Remove this visitor?')) {
            box.remove();
            reindexVisitors();
        }
    });

    function reindexVisitors() {
        var boxes = container.querySelectorAll('.visitor-box');

        boxes.forEach(function(box, index) {
            var newIndex = index;
            var visitorNumber = index + 1;

            box.setAttribute('data-index', newIndex);

            var title = box.querySelector('.title');
            if (title) {
                var isPrimary = visitorNumber === 1;
                title.innerHTML = `
                    <i class="fas fa-user-circle"></i>
                    Visitor #${visitorNumber}
                    <span class="${isPrimary ? 'badge-primary' : 'badge-additional'}">
                        ${isPrimary ? 'Primary' : 'Additional'}
                    </span>
                `;
            }

            // Update the remove button
            var header = box.querySelector('.box-header');
            var existingRemoveBtn = header.querySelector('.removeVisitorBtn');
            
            if (isPrimary) {
                if (existingRemoveBtn) {
                    existingRemoveBtn.remove();
                }
            } else {
                if (!existingRemoveBtn) {
                    var removeBtn = document.createElement('button');
                    removeBtn.type = 'button';
                    removeBtn.className = 'btn-remove removeVisitorBtn';
                    removeBtn.innerHTML = '<i class="fas fa-trash-alt"></i> Remove';
                    header.appendChild(removeBtn);
                }
            }

            box.querySelectorAll('input, select').forEach(function(input) {
                var name = input.getAttribute('name');
                if (name) {
                    var newName = name.replace(/visitors\[\d+\]/g, 'visitors[' + newIndex + ']');
                    input.setAttribute('name', newName);
                }
            });
        });

        countInput.value = boxes.length;
        countDisplay.textContent = boxes.length;
    }

    // Format CNIC
    container.addEventListener('input', function(e) {
        if (e.target.classList.contains('form-control-modern') && e.target.placeholder && e.target.placeholder.includes('35201')) {
            var value = e.target.value.replace(/\D/g, '');
            if (value.length > 0) {
                if (value.length <= 5) {
                    e.target.value = value;
                } else if (value.length <= 12) {
                    e.target.value = value.slice(0, 5) + '-' + value.slice(5);
                } else {
                    e.target.value = value.slice(0, 5) + '-' + value.slice(5, 12) + '-' + value.slice(12, 13);
                }
            }
        }
    });

    // Format Phone
    container.addEventListener('input', function(e) {
        if (e.target.classList.contains('form-control-modern') && e.target.placeholder && e.target.placeholder.includes('0300')) {
            var value = e.target.value.replace(/\D/g, '');
            if (value.length > 0) {
                if (value.length <= 4) {
                    e.target.value = value;
                } else if (value.length <= 7) {
                    e.target.value = value.slice(0, 4) + '-' + value.slice(4);
                } else {
                    e.target.value = value.slice(0, 4) + '-' + value.slice(4, 7) + '-' + value.slice(7, 11);
                }
            }
        }
    });
});
</script>
@endpush