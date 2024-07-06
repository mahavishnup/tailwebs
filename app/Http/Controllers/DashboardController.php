<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        $students = Student::query()
            ->with(['user'])
            ->where('user_id', @Auth::user()->id)
            ->get();

        return Inertia::render('Dashboard', compact('students'));
    }
}
