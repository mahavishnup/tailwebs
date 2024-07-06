<?php

namespace App\Http\Controllers;

use App\Http\Resources\StudentResource;
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

        //        dd($students);

        return Inertia::render('Dashboard', [
            'students' => StudentResource::collection($students),
        ]);
    }
}
