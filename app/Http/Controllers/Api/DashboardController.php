<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DashboardKpiResource;
use App\Models\Donation;
use App\Models\Post;
use App\Models\Project;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function kpi(): JsonResponse
    {
        try {
            $totalProjects = Project::count();
            $ongoingProjects = Project::where('status', 'ongoing')->count();
            $completedProjects = Project::where('status', 'completed')->count();
            $totalGoal = Project::sum('goal_amount');
            $totalCollected = Project::sum('collected_amount');
            $publishedPosts = Post::where('is_published', true)->count();
            $totalDonations = Donation::count();
            $totalDonationAmount = Donation::where('status', 'completed')->sum('amount');

            $data = [
                'total_projects' => $totalProjects,
                'ongoing_projects' => $ongoingProjects,
                'completed_projects' => $completedProjects,
                'total_goal' => $totalGoal,
                'total_collected' => $totalCollected,
                'collected_percentage' => $totalGoal > 0 ? round(($totalCollected / $totalGoal) * 100) : 0,
                'published_posts' => $publishedPosts,
                'total_donations' => $totalDonations,
                'total_donation_amount' => $totalDonationAmount,
            ];

            return response()->json(new DashboardKpiResource($data));
        } catch (\Throwable $e) {
            Log::error('DashboardController@kpi: ' . $e->getMessage());
            return response()->json(['message' => 'Erreur lors du chargement des indicateurs.'], 500);
        }
    }
}
