<?php

namespace App\Http\Services;

use App\Models\Activity;

class ActivityService
{
    public function getActivities($page = 1, $perPage = 50)
    {
        return Activity::orderBy('created_at', 'desc')->paginate($perPage, ['*'], 'page', $page);
    }
}
