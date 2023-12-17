<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enrollment;
use App\Models\Course;

class EnrollmentController extends Controller
{
    public function index()
    {
        $enrollments = Enrollment::all();
        return view('enrollments.index', compact('enrollments'));
    }

    public function show($id)
    {
        $enrollment = Enrollment::findOrFail($id);
        return view('enrollments.show', compact('enrollment'));
    }

    public function enroll($courseId)
    {
        // Find the course
        $course = Course::find($courseId);

        // Check if the course was not found
        if (!$course) {
            return response()->json(['error' => 'Course not found'], 404);
        }

        try {
            // Create enrollment
            $enrollment = auth()->user()->enrollments()->create([
                'course_id' => $course->id,
                'study_load' => 0,
                // Add other attributes as needed
            ]);

            session()->flash('success', 'Enrolled successfully');

            // Redirect to the course index
            return redirect()->route('courses.index');
        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('Enrollment error: ' . $e->getMessage() . "\n" . $e->getTraceAsString());

            session()->flash('error', 'Internal Server Error');

            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function unenroll($courseId)
    {
        $course = Course::findOrFail($courseId);
        $enrollment = auth()->user()->enrollments()->where('course_id', $course->id)->first();

        if ($enrollment) {
            $enrollment->delete();

            session()->flash('success', 'Unenrolled successfully');

            return redirect()->back();
        }

        session()->flash('error', 'Enrollment not found');

        return redirect()->back();
    }

}
