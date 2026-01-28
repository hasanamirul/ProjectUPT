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
        $courses = Course::paginate(9);

        return view('courses.index', compact('courses'));
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
     * API: Search courses by name, code, or category
     */
    public function apiSearch(Request $request)
    {
        $query = $request->query('q', '');
        $category = $request->query('category', '');
        $page = $request->query('page', 1);
        $perPage = $request->query('per_page', 9);

        $courses = Course::query();

        if ($query) {
            $courses->where('name', 'LIKE', "%{$query}%")
                ->orWhere('course_code', 'LIKE', "%{$query}%")
                ->orWhere('description', 'LIKE', "%{$query}%");
        }

        if ($category) {
            $courses->where('category', $category);
        }

        $courses = $courses->paginate($perPage, ['*'], 'page', $page);

        return response()->json([
            'success' => true,
            'data' => $courses->items(),
            'pagination' => [
                'current_page' => $courses->currentPage(),
                'last_page' => $courses->lastPage(),
                'total' => $courses->total(),
                'per_page' => $courses->perPage(),
            ],
            'query' => $query,
            'category' => $category,
        ]);
    }
}