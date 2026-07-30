@extends('Layout.admin')

@section('content')
<style>
    /* Same CSS as before */
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

    .visitor-counter {
        display: inline-block;
        margin-left: 10px;
        padding: 5px 12px;
        background: #4F46E5;
        color: white;
        border-radius: 20px;
        font-size: 0.8rem;
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

        <!-- Student Information -->
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
                        <div class="info-value" id="displayStudentName">-</div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="info-label">Room</div>
                        <div class="info-value" id="displayStudentRoom">N/A</div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="info-label">Phone</div>
                        <div class="info-value" id="displayStudentPhone">N/A</div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="info-label">CNIC</div>
                        <div class="info-value" id="displayStudentCnic">N/A</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Visitors List -->
        <div class="form-section">
            <div class="section-title">
                <div class="section-header-actions">
                    <span>
                        <i class="fas fa-users"></i> Visitors List 
                        <span class="visitor-counter" id="visitorCounter">
                            {{ old('visitor_count', 1) }}
                        </span>
                    </span>
                    
                    <!-- This button submits the form with a parameter to add more visitors -->
                    <button type="submit" name="add_more" value="1" class="btn-add-visitor" id="addVisitorBtn">
                        <i class="fas fa-plus-circle"></i> Add Visitor
                    </button>
                </div>
            </div>

            <div id="visitorsContainer">
                @php
                    // Get the number of visitors from old input or default to 1
                    $visitorCount = old('visitor_count', 1);
                    
                    // If there are validation errors, use the count from the request
                    if (old('visitors')) {
                        $visitorCount = count(old('visitors'));
                    }
                @endphp

                @for($i = 0; $i < $visitorCount; $i++)
                    <div class="visitor-card visitor-item" data-index="{{ $i }}">
                        <div class="visitor-number">
                            <span><i class="fas fa-user"></i> Visitor #{{ $i + 1 }}</span>
                            <span class="badge">{{ $i == 0 ? 'Primary' : 'Additional' }}</span>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label class="form-label" style="font-size:0.85rem;">Visitor Name <span class="required-star">*</span></label>
                                <input type="text" class="form-control visitor-name @error('visitors.'.$i.'.visitor_name') is-invalid @enderror" 
                                       name="visitors[{{ $i }}][visitor_name]" 
                                       placeholder="Enter visitor name" 
                                       value="{{ old('visitors.'.$i.'.visitor_name') }}" required>
                                @error('visitors.'.$i.'.visitor_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="form-label" style="font-size:0.85rem;">Relationship <span class="required-star">*</span></label>
                                <select class="form-control visitor-relationship @error('visitors.'.$i.'.relationship') is-invalid @enderror" 
                                        name="visitors[{{ $i }}][relationship]" required>
                                    <option value="">Select</option>
                                    <option value="Father" {{ old('visitors.'.$i.'.relationship') == 'Father' ? 'selected' : '' }}>Father</option>
                                    <option value="Mother" {{ old('visitors.'.$i.'.relationship') == 'Mother' ? 'selected' : '' }}>Mother</option>
                                    <option value="Brother" {{ old('visitors.'.$i.'.relationship') == 'Brother' ? 'selected' : '' }}>Brother</option>
                                    <option value="Sister" {{ old('visitors.'.$i.'.relationship') == 'Sister' ? 'selected' : '' }}>Sister</option>
                                    <option value="Uncle" {{ old('visitors.'.$i.'.relationship') == 'Uncle' ? 'selected' : '' }}>Uncle</option>
                                    <option value="Aunt" {{ old('visitors.'.$i.'.relationship') == 'Aunt' ? 'selected' : '' }}>Aunt</option>
                                    <option value="Cousin" {{ old('visitors.'.$i.'.relationship') == 'Cousin' ? 'selected' : '' }}>Cousin</option>
                                    <option value="Friend" {{ old('visitors.'.$i.'.relationship') == 'Friend' ? 'selected' : '' }}>Friend</option>
                                    <option value="Guardian" {{ old('visitors.'.$i.'.relationship') == 'Guardian' ? 'selected' : '' }}>Guardian</option>
                                    <option value="Relative" {{ old('visitors.'.$i.'.relationship') == 'Relative' ? 'selected' : '' }}>Relative</option>
                                    <option value="Other" {{ old('visitors.'.$i.'.relationship') == 'Other' ? 'selected' : '' }}>Other</option>
                                </select>
                                @error('visitors.'.$i.'.relationship')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="form-label" style="font-size:0.85rem;">CNIC Number</label>
                                <input type="text" class="form-control visitor-cnic @error('visitors.'.$i.'.cnic_number') is-invalid @enderror" 
                                       name="visitors[{{ $i }}][cnic_number]" 
                                       placeholder="35201-1234567-8" 
                                       value="{{ old('visitors.'.$i.'.cnic_number') }}">
                                @error('visitors.'.$i.'.cnic_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="form-label" style="font-size:0.85rem;">Phone Number</label>
                                <input type="tel" class="form-control visitor-phone @error('visitors.'.$i.'.phone_number') is-invalid @enderror" 
                                       name="visitors[{{ $i }}][phone_number]" 
                                       placeholder="0300-1234567" 
                                       value="{{ old('visitors.'.$i.'.phone_number') }}">
                                @error('visitors.'.$i.'.phone_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        @if($i > 0)
                            <div class="text-end mt-2">
                                <button type="submit" name="remove_visitor" value="{{ $i }}" class="btn-remove-visitor">
                                    <i class="fas fa-trash"></i> Remove
                                </button>
                            </div>
                        @endif
                    </div>
                @endfor
            </div>
            
            <!-- Hidden field to track visitor count -->
            <input type="hidden" name="visitor_count" value="{{ $visitorCount }}">
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
// Simple JavaScript just for student selection display (no jQuery)
document.addEventListener('DOMContentLoaded', function() {
    var studentSelect = document.getElementById('student_id');
    if (studentSelect) {
        studentSelect.addEventListener('change', function() {
            var selected = this.options[this.selectedIndex];
            document.getElementById('displayStudentName').textContent = selected.dataset.name || '-';
            document.getElementById('displayStudentRoom').textContent = selected.dataset.room || 'N/A';
            document.getElementById('displayStudentPhone').textContent = selected.dataset.phone || 'N/A';
            document.getElementById('displayStudentCnic').textContent = selected.dataset.cnic || 'N/A';
            
            document.getElementById('selectedStudentInfo').style.display = this.value ? 'block' : 'none';
        });
    }
});
</script>
@endpush