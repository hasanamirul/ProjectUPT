<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CourseController extends Controller
{
    /**
     * Display a listing of all courses.
     */
    public function index(): View
    {
        return view('courses.index');
    }

    /**
     * Display the specified course.
     */
    public function show(Course $course): View
    {
        return view('courses.show', compact('course'));
    }

    /**
     * API: Get all courses with pagination
     */
    public function apiIndex(Request $request)
    {
        $perPage = $request->query('per_page', 9);
        $page = $request->query('page', 1);

        $courses = Course::paginate($perPage, ['*'], 'page', $page);

        return response()->json([
            'success' => true,
            'data' => $courses->items(),
            'pagination' => [
                'current_page' => $courses->currentPage(),
                'last_page' => $courses->lastPage(),
                'total' => $courses->total(),
                'per_page' => $courses->perPage(),
            ],
        ]);
    }

    /**
     * API: Search & Filter courses
     */
  public function apiSearch(Request $request)
{
    $query = $request->q;
    $category = $request->category;
    $perPage = $request->per_page ?? 9;

    $courses = Course::query();

    if (!empty($query)) {
        $courses->where(function ($q) use ($query) {
            $q->where('name', 'like', "%$query%")
              ->orWhere('course_code', 'like', "%$query%")
              ->orWhere('lecturer', 'like', "%$query%");
        });
    }

    if (!empty($category)) {
        $courses->where('category', $category);
    }

    $courses = $courses->paginate($perPage);

    return response()->json([
        'success' => true,
        'data' => $courses->items(),
        'pagination' => [
            'current_page' => $courses->currentPage(),
            'last_page' => $courses->lastPage(),
            'total' => $courses->total(),
            'per_page' => $courses->perPage(),
        ]
    ]);
}

}