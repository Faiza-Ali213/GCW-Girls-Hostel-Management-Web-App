@extends('Layout.admin')

@section('content')
<style>
    .visitor-form-container {
        max-width: 800px;
        margin: 0 auto;
        background: white;
        border-radius: 16px;
        padding: 30px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.05);
        border: 1px solid #f0f2f5;
    }
    .visitor-form-container h4 {
        color: #0b1a33;
        font-weight: 700;
        margin-bottom: 5px;
    }
    .visitor-form-container .sub-title {
        color: #94a3b8;
        font-size: 0.95rem;
        margin-bottom: 25px;
    }
    .form-label {
        font-weight: 600;
        color: #0b1a33;
        font-size: 0.9rem;
    }
    .form-control {
        border: 2px solid #e2e8f0;
        border-radius: 10px;
        padding: 10px 14px;
        font-size: 0.95rem;
        transition: all 0.2s ease;
    }
    .form-control:focus {
        border-color: #4F46E5;
        box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.06);
    }
    .form-control.is-invalid {
        border-color: #EF4444;
    }
    .invalid-feedback {
        font-size: 0.8rem;
        color: #EF4444;
        margin-top: 4px;
    }
    .btn-submit {
        background: linear-gradient(135deg, #4F46E5 0%, #4338CA 100%);
        color: white !important;
        border: none;
        padding: 12px 30px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 1rem;
        width: 100%;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(79, 70, 229, 0.25);
    }
    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(79, 70, 229, 0.35);
        color: white !important;
    }
    .btn-cancel {
        background: #f1f3f5;
        color: #495057 !important;
        border: none;
        padding: 12px 30px;
        border-radius: 10px;
        font-weight: 600;
        width: 100%;
        transition: all 0.2s ease;
        text-decoration: none;
        display: inline-block;
        text-align: center;
    }
    .btn-cancel:hover {
        background: #e9ecef;
        color: #2c3e50 !important;
        text-decoration: none;
    }
    .btn-add-visitor {
        background: linear-gradient(135deg, #10B981 0%, #059669 100%);
        color: white !important;
        border: none;
        padding: 10px 20px;
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-size: 0.9rem;
        box-shadow: 0 4px 15px rgba(16, 185, 129, 0.25);
        cursor: pointer;
    }
    .btn-add-visitor:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(16, 185, 129, 0.35);
        color: white !important;
    }
    .btn-remove-visitor {
        background: #FEF2F2;
        color: #EF4444 !important;
        border: 2px solid #EF4444;
        padding: 8px 16px;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 0.85rem;
    }
    .btn-remove-visitor:hover {
        background: #EF4444;
        color: white !important;
        transform: translateY(-2px);
    }

    .form-section {
        background: #f8fafc;
        border-radius: 12px;
        padding: 18px 20px;
        margin-bottom: 20px;
        border: 1px solid #eef2f6;
    }
    .form-section .section-title {
        font-weight: 600;
        color: #0b1a33;
        font-size: 0.9rem;
        margin-bottom: 12px;
    }
    .form-section .section-title i {
        color: #4F46E5;
        margin-right: 8px;
    }
    .required-star {
        color: #EF4444;
        margin-left: 2px;
    }
    .visitor-card {
        background: white;
        border-radius: 12px;
        padding: 18px 20px;
        margin-bottom: 15px;
        border: 1px solid #e2e8f0;
        position: relative;
        transition: all 0.3s ease;
    }
    .visitor-card:hover {
        border-color: #4F46E5;
        box-shadow: 0 2px 8px rgba(79, 70, 229, 0.08);
    }
    .visitor-card .visitor-number {
        font-weight: 700;
        color: #4F46E5;
        font-size: 0.85rem;
        margin-bottom: 12px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .visitor-card .visitor-number .badge {
        background: #EEF2FF;
        color: #4F46E5;
        padding: 2px 12px;
        border-radius: 12px;
        font-size: 0.75rem;
    }
    .visitor-card .row {
        margin-bottom: 0;
    }
    .visitor-card .col-md-6 {
        margin-bottom: 10px;
    }

    .selected-student-info {
        background: #EEF2FF;
        border-radius: 10px;
        padding: 12px 16px;
        border: 1px solid #4F46E5;
        display: none;
    }
    .selected-student-info .info-label {
        font-size: 0.7rem;
        color: #94a3b8;
        text-transform: uppercase;
        font-weight: 600;
    }
    .selected-student-info .info-value {
        font-weight: 600;
        color: #0b1a33;
    }

    .section-header-actions {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
    }

    .form-actions {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }
    .form-actions .btn {
        flex: 1;
        min-width: 150px;
    }

    @media (max-width: 768px) {
        .visitor-form-container {
            padding: 20px;
        }
        .visitor-card .col-md-6 {
            margin-bottom: 8px;
        }
        .btn-add-visitor {
            width: 100%;
            justify-content: center;
        }
        .btn-remove-visitor {
            width: 100%;
            justify-content: center;
        }
        .selected-student-info .row {
            flex-direction: column;
            gap: 8px;
        }
        .section-header-actions {
            flex-direction: column;
            width: 100%;
        }
        .section-header-actions .btn-add-visitor {
            width: 100%;
        }
        .form-actions {
            flex-direction: column;
        }
        .form-actions .btn {
            width: 100%;
        }
    }
</style>

<div class="visitor-form-container">
    <div>
        <h4><i class="fas fa-user-plus text-primary"></i> Add New Visitor</h4>
        <div class="sub-title">Register a new visitor entry for a student</div>
    </div>

    <form action="{{ route('visitor.store') }}" method="POST" id="addVisitorForm">
        @csrf

        <!-- Student Information (Dropdown) -->
        <div class="form-section">
            <div class="section-title">
                <i class="fas fa-user-graduate"></i> Student Information
            </div>
            <div class="row">
                <div class="col-12 mb-3">
                    <label for="student_id" class="form-label">Select Student <span class="required-star">*</span></label>
                    <select class="form-control @error('student_id') is-invalid @enderror" 
                            id="student_id" name="student_id" required>
                        <option value="">-- Select Student --</option>
                        @foreach($students as $student)
                            <option value="{{ $student->id }}" 
                                    data-name="{{ $student->student_name }}"
                                    data-room="{{ $student->room_number ?? 'N/A' }}"
                                    data-phone="{{ $student->phone_number ?? 'N/A' }}"
                                    data-cnic="{{ $student->cnic_number ?? 'N/A' }}"
                                    {{ old('student_id') == $student->id ? 'selected' : '' }}>
                                {{ $student->student_name }} 
                                @if($student->father_name)
                                    ({{ $student->father_name }})
                                @endif
                                @if($student->room_number)
                                    - Room: {{ $student->room_number }}
                                @endif
                            </option>
                        @endforeach
                    </select>
                    @error('student_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="selected-student-info" id="selectedStudentInfo" 
                 style="display:{{ old('student_id') ? 'block' : 'none' }};">
                <div class="row">
                    <div class="col-md-3 col-6">
                        <div class="info-label">Student Name</div>
                        <div class="info-value" id="displayStudentName">
                            {{ old('student_id') ? $students->firstWhere('id', old('student_id'))->student_name ?? '-' : '-' }}
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="info-label">Room</div>
                        <div class="info-value" id="displayStudentRoom">
                            {{ old('student_id') ? $students->firstWhere('id', old('student_id'))->room_number ?? 'N/A' : 'N/A' }}
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="info-label">Phone</div>
                        <div class="info-value" id="displayStudentPhone">
                            {{ old('student_id') ? $students->firstWhere('id', old('student_id'))->phone_number ?? 'N/A' : 'N/A' }}
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="info-label">CNIC</div>
                        <div class="info-value" id="displayStudentCnic">
                            {{ old('student_id') ? $students->firstWhere('id', old('student_id'))->cnic_number ?? 'N/A' : 'N/A' }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Visitors List -->
        <div class="form-section">
            <div class="section-title">
                <div class="section-header-actions">
                    <span><i class="fas fa-users"></i> Visitors List</span>
                    <button type="button" class="btn-add-visitor" id="addVisitorBtn">
                        <i class="fas fa-plus-circle"></i> Add Visitor
                    </button>
                </div>
            </div>

            <div id="visitorsContainer">
                <!-- Visitor 1 (Default) -->
                <div class="visitor-card visitor-item" data-index="0">
                    <div class="visitor-number">
                        <span><i class="fas fa-user"></i> Visitor #1</span>
                        <span class="badge">Primary</span>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <label class="form-label" style="font-size:0.85rem;">Visitor Name <span class="required-star">*</span></label>
                            <input type="text" class="form-control visitor-name" 
                                   name="visitors[0][visitor_name]" 
                                   placeholder="Enter visitor name" 
                                   value="{{ old('visitors.0.visitor_name') }}" required>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="form-label" style="font-size:0.85rem;">Relationship <span class="required-star">*</span></label>
                            <select class="form-control visitor-relationship" 
                                    name="visitors[0][relationship]" required>
                                <option value="">Select</option>
                                <option value="Father" {{ old('visitors.0.relationship') == 'Father' ? 'selected' : '' }}>Father</option>
                                <option value="Mother" {{ old('visitors.0.relationship') == 'Mother' ? 'selected' : '' }}>Mother</option>
                                <option value="Brother" {{ old('visitors.0.relationship') == 'Brother' ? 'selected' : '' }}>Brother</option>
                                <option value="Sister" {{ old('visitors.0.relationship') == 'Sister' ? 'selected' : '' }}>Sister</option>
                                <option value="Uncle" {{ old('visitors.0.relationship') == 'Uncle' ? 'selected' : '' }}>Uncle</option>
                                <option value="Aunt" {{ old('visitors.0.relationship') == 'Aunt' ? 'selected' : '' }}>Aunt</option>
                                <option value="Cousin" {{ old('visitors.0.relationship') == 'Cousin' ? 'selected' : '' }}>Cousin</option>
                                <option value="Friend" {{ old('visitors.0.relationship') == 'Friend' ? 'selected' : '' }}>Friend</option>
                                <option value="Guardian" {{ old('visitors.0.relationship') == 'Guardian' ? 'selected' : '' }}>Guardian</option>
                                <option value="Relative" {{ old('visitors.0.relationship') == 'Relative' ? 'selected' : '' }}>Relative</option>
                                <option value="Other" {{ old('visitors.0.relationship') == 'Other' ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="form-label" style="font-size:0.85rem;">CNIC Number</label>
                            <input type="text" class="form-control visitor-cnic" 
                                   name="visitors[0][cnic_number]" 
                                   placeholder="35201-1234567-8" 
                                   value="{{ old('visitors.0.cnic_number') }}">
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="form-label" style="font-size:0.85rem;">Phone Number</label>
                            <input type="tel" class="form-control visitor-phone" 
                                   name="visitors[0][phone_number]" 
                                   placeholder="0300-1234567" 
                                   value="{{ old('visitors.0.phone_number') }}">
                        </div>
                    </div>
                    <div class="text-end mt-2" style="display:none;">
                        <button type="button" class="btn-remove-visitor removeVisitorBtn">
                            <i class="fas fa-trash"></i> Remove
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Remarks -->
        <div class="form-section">
            <div class="section-title">
                <i class="fas fa-sticky-note"></i> Additional Notes
            </div>
            <div class="row">
                <div class="col-12 mb-3">
                    <label for="remarks" class="form-label">Remarks</label>
                    <textarea class="form-control @error('remarks') is-invalid @enderror" 
                              id="remarks" name="remarks" rows="2" 
                              placeholder="Any additional notes...">{{ old('remarks') }}</textarea>
                    @error('remarks')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Form Actions -->
        <div class="row mt-3">
            <div class="col-md-12 mb-2">
                <div class="form-actions">
                    <a href="{{ route('visitors_records') }}" class="btn btn-cancel">
                        <i class="fas fa-arrow-left"></i> Cancel
                    </a>
                    <button type="submit" class="btn btn-submit" id="submitBtn">
                        <i class="fas fa-save"></i> Save Record
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection

@push('scripts')
<script>
$(document).ready(function() {
    console.log('✅ Add Visitor page loaded');

    // ============================================
    // STUDENT SELECT - UPDATE DISPLAY
    // ============================================
    $('#student_id').on('change', function() {
        var selected = $(this).find('option:selected');
        var studentName = selected.data('name') || '-';
        var studentRoom = selected.data('room') || 'N/A';
        var studentPhone = selected.data('phone') || 'N/A';
        var studentCnic = selected.data('cnic') || 'N/A';
        
        $('#displayStudentName').text(studentName);
        $('#displayStudentRoom').text(studentRoom);
        $('#displayStudentPhone').text(studentPhone);
        $('#displayStudentCnic').text(studentCnic);
        
        if ($(this).val()) {
            $('#selectedStudentInfo').show();
        } else {
            $('#selectedStudentInfo').hide();
        }
    });

    // ============================================
    // ADD VISITOR - FIXED
    // ============================================
    $('#addVisitorBtn').on('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        console.log('✅ Add Visitor button clicked');
        
        // Get the current count of visitor cards
        var totalVisitors = $('.visitor-item').length;
        var newIndex = totalVisitors; // This will be the next index
        
        console.log('Current visitors:', totalVisitors, 'New index:', newIndex);
        
        var visitorNumber = totalVisitors + 1;
        var badgeText = visitorNumber === 1 ? 'Primary' : 'Additional';
        
        var newVisitor = `
            <div class="visitor-card visitor-item" data-index="${newIndex}">
                <div class="visitor-number">
                    <span><i class="fas fa-user"></i> Visitor #${visitorNumber}</span>
                    <span class="badge">${badgeText}</span>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <label class="form-label" style="font-size:0.85rem;">Visitor Name <span class="required-star">*</span></label>
                        <input type="text" class="form-control visitor-name" 
                               name="visitors[${newIndex}][visitor_name]" 
                               placeholder="Enter visitor name" required>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label class="form-label" style="font-size:0.85rem;">Relationship <span class="required-star">*</span></label>
                        <select class="form-control visitor-relationship" 
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
                            <option value="Relative">Relative</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label class="form-label" style="font-size:0.85rem;">CNIC Number</label>
                        <input type="text" class="form-control visitor-cnic" 
                               name="visitors[${newIndex}][cnic_number]" 
                               placeholder="35201-1234567-8">
                    </div>
                    <div class="col-md-6 mb-2">
                        <label class="form-label" style="font-size:0.85rem;">Phone Number</label>
                        <input type="tel" class="form-control visitor-phone" 
                               name="visitors[${newIndex}][phone_number]" 
                               placeholder="0300-1234567">
                    </div>
                </div>
                <div class="text-end mt-2">
                    <button type="button" class="btn-remove-visitor removeVisitorBtn">
                        <i class="fas fa-trash"></i> Remove
                    </button>
                </div>
            </div>
        `;
        
        $('#visitorsContainer').append(newVisitor);
        
        // Auto-capitalize name for the new visitor
        $('.visitor-name').last().on('blur', function() {
            $(this).val($(this).val().toUpperCase());
        });
        
        console.log('✅ Visitor added, total:', $('.visitor-item').length);
    });

    // ============================================
    // REMOVE VISITOR
    // ============================================
    $(document).on('click', '.removeVisitorBtn', function(e) {
        e.preventDefault();
        var card = $(this).closest('.visitor-card');
        var count = $('.visitor-item').length;
        
        if (count <= 1) {
            alert('At least one visitor is required.');
            return;
        }
        
        if (confirm('Remove this visitor?')) {
            card.fadeOut(300, function() {
                $(this).remove();
                // Update indices after removal
                updateVisitorIndices();
            });
        }
    });

    // ============================================
    // UPDATE VISITOR INDICES - FIXED
    // ============================================
    function updateVisitorIndices() {
        $('.visitor-item').each(function(index) {
            var newIndex = index;
            var visitorNumber = index + 1;
            
            // Update data-index
            $(this).attr('data-index', newIndex);
            
            // Update visitor number display
            $(this).find('.visitor-number span:first').html('<i class="fas fa-user"></i> Visitor #' + visitorNumber);
            
            // Update badge
            if (visitorNumber === 1) {
                $(this).find('.visitor-number .badge').text('Primary').show();
            } else {
                $(this).find('.visitor-number .badge').text('Additional');
            }
            
            // Update all input names to match new index
            $(this).find('input, select').each(function() {
                var name = $(this).attr('name');
                if (name) {
                    var newName = name.replace(/visitors\[\d+\]/g, 'visitors[' + newIndex + ']');
                    $(this).attr('name', newName);
                    console.log('Updated name:', name, '→', newName);
                }
            });
        });
        
        console.log('✅ Visitor indices updated, total:', $('.visitor-item').length);
    }

    // ============================================
    // AUTO-CAPITALIZE VISITOR NAME
    // ============================================
    $(document).on('blur', '.visitor-name', function() {
        $(this).val($(this).val().toUpperCase());
    });

    // ============================================
    // FORMAT CNIC
    // ============================================
    $(document).on('input', '.visitor-cnic', function() {
        var value = $(this).val().replace(/\D/g, '');
        if (value.length > 0) {
            if (value.length <= 5) {
                $(this).val(value);
            } else if (value.length <= 12) {
                $(this).val(value.slice(0, 5) + '-' + value.slice(5));
            } else {
                $(this).val(value.slice(0, 5) + '-' + value.slice(5, 12) + '-' + value.slice(12, 13));
            }
        }
    });

    // ============================================
    // FORMAT PHONE
    // ============================================
    $(document).on('input', '.visitor-phone', function() {
        var value = $(this).val().replace(/\D/g, '');
        if (value.length > 0) {
            if (value.length <= 4) {
                $(this).val(value);
            } else if (value.length <= 7) {
                $(this).val(value.slice(0, 4) + '-' + value.slice(4));
            } else {
                $(this).val(value.slice(0, 4) + '-' + value.slice(4, 7) + '-' + value.slice(7, 11));
            }
        }
    });

    // ============================================
    // FORM SUBMISSION VALIDATION
    // ============================================
    $('#addVisitorForm').on('submit', function(e) {
        // Check if student is selected
        if (!$('#student_id').val()) {
            e.preventDefault();
            alert('Please select a student from the dropdown.');
            $('#student_id').focus();
            return false;
        }

        var hasError = false;
        var firstError = null;

        // Validate each visitor
        $('.visitor-item').each(function() {
            var name = $(this).find('.visitor-name').val().trim();
            var relationship = $(this).find('.visitor-relationship').val();
            
            if (!name) {
                hasError = true;
                if (!firstError) firstError = $(this).find('.visitor-name');
                $(this).find('.visitor-name').addClass('is-invalid');
            } else {
                $(this).find('.visitor-name').removeClass('is-invalid');
            }
            
            if (!relationship) {
                hasError = true;
                if (!firstError) firstError = $(this).find('.visitor-relationship');
                $(this).find('.visitor-relationship').addClass('is-invalid');
            } else {
                $(this).find('.visitor-relationship').removeClass('is-invalid');
            }
        });

        if (hasError) {
            e.preventDefault();
            alert('Please fill in all required fields for each visitor.');
            if (firstError) {
                firstError.focus();
            }
        }
    });
});
</script>
@endpush