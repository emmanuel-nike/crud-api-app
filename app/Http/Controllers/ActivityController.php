<?php

namespace App\Http\Controllers;

use App\Http\Services\ActivityService;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    private ActivityService $activityService;

    public function __construct(ActivityService $activityService)
    {
        $this->activityService = $activityService;
    }

    /**
     * Get all activities
     */
    public function index(Request $request)
    {
        $activities = $this->activityService->getActivities($request->input('page', 1), $request->input('per_page', 50));

        return response()->json($activities, 200);
    }
}
