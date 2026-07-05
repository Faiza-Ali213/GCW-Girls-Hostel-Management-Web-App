<?php
// app/Http/Controllers/FeeRecordController.php

namespace App\Http\Controllers;

use App\Models\FeeRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FeeRecordController extends Controller
{
    /**
     * Display a listing of the fee records.
     */
    public function index(Request $request)
    {
        $query = FeeRecord::query();

        // Search
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('student_name', 'LIKE', "%{$search}%")
                  ->orWhere('room_no', 'LIKE', "%{$search}%")
                  ->orWhere('phone_number', 'LIKE', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->has('status') && !empty($request->status)) {
            $query->where('fee_status', $request->status);
        }

        $feeRecords = $query->orderBy('created_at', 'desc')->paginate(10);
        
        // Get statistics
        $totalRecords = FeeRecord::count();
        $totalPaid = FeeRecord::where('fee_status', 'paid')->count();
        $totalUnpaid = FeeRecord::where('fee_status', 'unpaid')->count();
        $totalPartial = FeeRecord::where('fee_status', 'partial')->count();

        

        // Filter by status
        if ($request->has('status') && !empty($request->status)) {
            $query->where('fee_status', $request->status);
        }

        $feeRecords = $query->orderBy('created_at', 'desc')->paginate(10);
        
        if ($request->ajax()) {
            return response()->json([
                'data' => $feeRecords,
                'statuses' => FeeRecord::getStatuses()
            ]);
        }

        return view('Pages.Admin.fee_record', compact(
            'feeRecords', 
            'totalRecords', 
            'totalPaid', 
            'totalUnpaid', 
            'totalPartial'
        ));
    }

    /**
     * Show the form for creating a new fee record.
     */
    public function create()
    {
        return view('Component.Admin.add_fees');
    }

    /**
     * Store a newly created fee record.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'student_name' => 'required|string|max:255',
            'room_no' => 'required|string|max:50',
            'phone_number' => 'required|string|max:20',
            'fee_amount' => 'required|numeric|min:0',
            'paid_amount' => 'nullable|numeric|min:0',
            'payment_date' => 'nullable|date',
            'payment_method' => 'nullable|string|max:50',
            'remarks' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $feeRecord = FeeRecord::create([
                'student_name' => $request->student_name,
                'room_no' => $request->room_no,
                'phone_number' => $request->phone_number,
                'fee_amount' => $request->fee_amount,
                'paid_amount' => $request->paid_amount ?? 0,
                'payment_date' => $request->payment_date,
                'payment_method' => $request->payment_method,
                'remarks' => $request->remarks,
            ]);

            return redirect()->route('fee_record')
                ->with('success', 'Fee record created successfully!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to create fee record: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified fee record.
     */
    public function show($id)
    {
          try {
        $feeRecord = FeeRecord::findOrFail($id);
        return view('Component.Admin.view_fee', compact('feeRecord'));
    } catch (\Exception $e) {
        return redirect()->route('fee_record')
            ->with('error', 'Fee record not found');
    }
    }

    /**
     * Show the form for editing the specified fee record.
     */
    public function edit($id)
    {
         $feeRecord = FeeRecord::findOrFail($id);
    return view('Component.Admin.edit_fee', compact('feeRecord'));
    }

    /**
     * Update the specified fee record.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'student_name' => 'required|string|max:255',
            'room_no' => 'required|string|max:50',
            'phone_number' => 'required|string|max:20',
            'fee_amount' => 'required|numeric|min:0',
            'paid_amount' => 'nullable|numeric|min:0',
            'payment_date' => 'nullable|date',
            'payment_method' => 'nullable|string|max:50',
            'remarks' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $feeRecord = FeeRecord::findOrFail($id);
            
            $feeRecord->update([
                'student_name' => $request->student_name,
                'room_no' => $request->room_no,
                'phone_number' => $request->phone_number,
                'fee_amount' => $request->fee_amount,
                'paid_amount' => $request->paid_amount ?? 0,
                'payment_date' => $request->payment_date,
                'payment_method' => $request->payment_method,
                'remarks' => $request->remarks,
            ]);

            return redirect()->route('fee_record')
                ->with('success', 'Fee record updated successfully!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to update fee record: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified fee record.
     */
    public function destroy($id)
    {
        try {
            $feeRecord = FeeRecord::findOrFail($id);
            $feeRecord->delete();

            if (request()->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Fee record deleted successfully!'
                ]);
            }

            return redirect()->route('fee_record')
                ->with('success', 'Fee record deleted successfully!');

        } catch (\Exception $e) {
            if (request()->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to delete fee record: ' . $e->getMessage()
                ], 500);
            }

            return redirect()->route('fee_record')
                ->with('error', 'Failed to delete fee record: ' . $e->getMessage());
        }
    }

    /**
     * Update fee status only.
     */
    public function updateStatus(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'fee_status' => 'required|in:paid,unpaid,partial',
            'paid_amount' => 'nullable|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $feeRecord = FeeRecord::findOrFail($id);
            $feeRecord->fee_status = $request->fee_status;
            
            if ($request->has('paid_amount')) {
                $feeRecord->paid_amount = $request->paid_amount;
            }
            
            $feeRecord->save();

            return response()->json([
                'success' => true,
                'message' => 'Fee status updated successfully!',
                'data' => $feeRecord
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update status: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get summary statistics.
     */
    public function getSummary()
    {
        $totalRecords = FeeRecord::count();
        $totalPaid = FeeRecord::where('fee_status', FeeRecord::STATUS_PAID)->count();
        $totalUnpaid = FeeRecord::where('fee_status', FeeRecord::STATUS_UNPAID)->count();
        $totalPartial = FeeRecord::where('fee_status', FeeRecord::STATUS_PARTIAL)->count();
        $totalAmount = FeeRecord::sum('fee_amount');
        $totalPaidAmount = FeeRecord::sum('paid_amount');
        $totalPendingAmount = FeeRecord::sum('pending_amount');

        return response()->json([
            'success' => true,
            'data' => [
                'total_records' => $totalRecords,
                'total_paid' => $totalPaid,
                'total_unpaid' => $totalUnpaid,
                'total_partial' => $totalPartial,
                'total_amount' => $totalAmount,
                'total_paid_amount' => $totalPaidAmount,
                'total_pending_amount' => $totalPendingAmount,
            ]
        ]);
    }
}