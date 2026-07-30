/**
 * Store a newly created complaint.
 */
public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        'student_name' => 'required|string|max:255',
        'student_email' => 'nullable|email|max:255',
        'title' => 'required|string|max:255',
        'description' => 'required|string|min:10',
        'room_number' => 'nullable|string|max:50',
        'contact_number' => 'nullable|string|max:20',
        'complaint_by' => 'nullable|string|max:255',
        'priority' => 'nullable|in:low,medium,high',
    ]);

    if ($validator->fails()) {
        return redirect()->back()
            ->withErrors($validator)
            ->withInput();
    }

    try {
        // If user is logged in, use their email
        $email = $request->student_email;
        if (!$email && auth()->check()) {
            $email = auth()->user()->email;
        }

        Complaint::create([
            'student_name' => $request->student_name,
            'student_email' => $email,
            'title' => $request->title,
            'description' => $request->description,
            'room_number' => $request->room_number,
            'contact_number' => $request->contact_number,
            'complaint_by' => $request->complaint_by ?? $request->student_name,
            'priority' => $request->priority ?? 'medium',
            'status' => 'pending',
        ]);

        return redirect()->route('complaint.registration')
            ->with('success', 'Your complaint has been submitted successfully! We will review it shortly.');

    } catch (\Exception $e) {
        return redirect()->back()
            ->with('error', 'Failed to submit complaint: ' . $e->getMessage())
            ->withInput();
    }
}