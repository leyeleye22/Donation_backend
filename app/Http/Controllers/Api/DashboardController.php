<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DashboardKpiResource;
use App\Models\ContactMessage;
use App\Models\Donation;
use App\Models\GalleryItem;
use App\Models\NewsletterSubscriber;
use App\Models\Post;
use App\Models\Project;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
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
            $monthStart = now()->startOfMonth();
            $monthEnd = now()->endOfMonth();
            $donationsThisMonthCount = Donation::where('status', 'completed')
                ->whereBetween('created_at', [$monthStart, $monthEnd])
                ->count();
            $donationsThisMonthAmount = (int) Donation::where('status', 'completed')
                ->whereBetween('created_at', [$monthStart, $monthEnd])
                ->sum('amount');
            $newsletterSubscribers = NewsletterSubscriber::where('is_active', true)->count();
            $unreadContactMessages = ContactMessage::where('is_read', false)->count();

            $projectsByTheme = Project::query()
                ->select('theme', DB::raw('count(*) as count'))
                ->groupBy('theme')
                ->orderByDesc('count')
                ->get()
                ->map(fn ($row) => [
                    'theme' => $row->theme,
                    'count' => (int) $row->count,
                ])
                ->values()
                ->all();

            $recentActivity = Post::query()
                ->where('is_published', true)
                ->orderByDesc('published_at')
                ->limit(5)
                ->get()
                ->map(function (Post $post) {
                    $title = is_array($post->title) ? ($post->title['fr'] ?? reset($post->title)) : $post->title;

                    return [
                        'title' => $title ?: 'Publication',
                        'detail' => 'Article publie dans le journal',
                        'time' => $post->published_at?->diffForHumans() ?? 'Recemment',
                        'href' => '/dashboard/journal',
                    ];
                })
                ->values()
                ->all();

            $donationsByProject = Project::query()
                ->withCount(['donations as completed_donations_count' => fn ($q) => $q->where('status', 'completed')])
                ->withSum(['donations as donations_amount' => fn ($q) => $q->where('status', 'completed')], 'amount')
                ->orderByDesc('donations_amount')
                ->get()
                ->map(function (Project $project) {
                    $title = is_array($project->title)
                        ? ($project->title['fr'] ?? reset($project->title))
                        : $project->title;
                    $goal = max(1, (int) $project->goal_amount);
                    $donationsAmount = (int) ($project->donations_amount ?? 0);

                    return [
                        'id' => $project->id,
                        'slug' => $project->slug,
                        'title' => $title ?: 'Projet',
                        'theme' => $project->theme,
                        'status' => $project->status,
                        'goal_amount' => (int) $project->goal_amount,
                        'collected_amount' => (int) $project->collected_amount,
                        'donations_count' => (int) ($project->completed_donations_count ?? 0),
                        'donations_amount' => $donationsAmount,
                        'progress' => (int) round(((int) $project->collected_amount / $goal) * 100),
                    ];
                })
                ->values()
                ->all();

            $priorityProjects = Project::query()
                ->where('status', 'ongoing')
                ->orderBy('collected_amount')
                ->limit(5)
                ->get()
                ->map(function (Project $project) {
                    $title = is_array($project->title)
                        ? ($project->title['fr'] ?? reset($project->title))
                        : $project->title;
                    $goal = max(1, (int) $project->goal_amount);

                    return [
                        'id' => $project->id,
                        'slug' => $project->slug,
                        'title' => $title ?: 'Projet',
                        'theme' => $project->theme,
                        'status' => $project->status,
                        'goal_amount' => (int) $project->goal_amount,
                        'collected_amount' => (int) $project->collected_amount,
                        'progress' => (int) round(((int) $project->collected_amount / $goal) * 100),
                        'funding_gap' => max(0, (int) $project->goal_amount - (int) $project->collected_amount),
                        'beneficiary_label' => is_array($project->beneficiary_label)
                            ? ($project->beneficiary_label['fr'] ?? reset($project->beneficiary_label))
                            : ($project->beneficiary_label ?: null),
                    ];
                })
                ->sortBy('progress')
                ->values()
                ->take(4)
                ->all();

            $lastPublishedPost = Post::query()
                ->where('is_published', true)
                ->orderByDesc('published_at')
                ->value('published_at');

            $daysSinceLastPost = $lastPublishedPost
                ? now()->diffInDays($lastPublishedPost)
                : null;

            $fundingGap = max(0, (int) $totalGoal - (int) $totalCollected);
            $galleryItems = GalleryItem::count();
            $totalContactMessages = ContactMessage::count();
            $postsDraft = Post::where('is_published', false)->count();

            $operationalChecklist = [
                [
                    'id' => 'projects',
                    'title' => 'Projets actifs visibles',
                    'description' => 'Des campagnes en cours doivent etre suivies et mises a jour.',
                    'status' => $ongoingProjects > 0 ? 'ok' : 'warning',
                    'metric' => "{$ongoingProjects} en cours",
                    'href' => '/dashboard/projects',
                ],
                [
                    'id' => 'journal',
                    'title' => 'Journal de terrain alimente',
                    'description' => 'Publier regulierement pour documenter l\'impact sur le terrain.',
                    'status' => ($publishedPosts > 0 && ($daysSinceLastPost === null || $daysSinceLastPost <= 30)) ? 'ok' : 'warning',
                    'metric' => $publishedPosts > 0
                        ? ($daysSinceLastPost === 0 ? 'Publie aujourd\'hui' : "Dernier article il y a {$daysSinceLastPost} j")
                        : 'Aucune publication',
                    'href' => '/dashboard/journal',
                ],
                [
                    'id' => 'messages',
                    'title' => 'Messages visiteurs traites',
                    'description' => 'Repondre aux demandes recues via le formulaire de contact.',
                    'status' => $unreadContactMessages === 0 ? 'ok' : 'critical',
                    'metric' => $unreadContactMessages > 0
                        ? "{$unreadContactMessages} non lu(s)"
                        : "{$totalContactMessages} message(s) au total",
                    'href' => '/dashboard/messages',
                ],
                [
                    'id' => 'collecte',
                    'title' => 'Transparence financiere',
                    'description' => 'Suivre la collecte par rapport aux objectifs des projets actifs.',
                    'status' => $totalGoal > 0 && ($totalCollected / max(1, $totalGoal)) >= 0.5 ? 'ok' : 'info',
                    'metric' => $totalGoal > 0
                        ? round(($totalCollected / $totalGoal) * 100) . '% de l\'objectif global'
                        : 'Objectifs a definir',
                    'href' => '/dashboard/projects',
                ],
                [
                    'id' => 'galerie',
                    'title' => 'Preuves visuelles du terrain',
                    'description' => 'Photos et medias qui credibilisent les actions aupres des donateurs.',
                    'status' => $galleryItems >= 5 ? 'ok' : 'info',
                    'metric' => "{$galleryItems} media(s) en galerie",
                    'href' => '/dashboard/gallery',
                ],
            ];

            $data = [
                'total_projects' => $totalProjects,
                'ongoing_projects' => $ongoingProjects,
                'completed_projects' => $completedProjects,
                'total_goal' => $totalGoal,
                'total_collected' => $totalCollected,
                'funding_gap' => $fundingGap,
                'collected_percentage' => $totalGoal > 0 ? round(($totalCollected / $totalGoal) * 100) : 0,
                'published_posts' => $publishedPosts,
                'posts_draft' => $postsDraft,
                'total_donations' => $totalDonations,
                'total_donation_amount' => $totalDonationAmount,
                'donations_this_month' => [
                    'count' => $donationsThisMonthCount,
                    'amount' => $donationsThisMonthAmount,
                    'month_label' => now()->locale('fr')->isoFormat('MMMM YYYY'),
                ],
                'donations_by_project' => $donationsByProject,
                'newsletter_subscribers' => $newsletterSubscribers,
                'unread_contact_messages' => $unreadContactMessages,
                'total_contact_messages' => $totalContactMessages,
                'gallery_items' => $galleryItems,
                'projects_by_theme' => $projectsByTheme,
                'recent_activity' => $recentActivity,
                'priority_projects' => $priorityProjects,
                'operational_checklist' => $operationalChecklist,
                'days_since_last_post' => $daysSinceLastPost,
            ];

            return response()->json(new DashboardKpiResource($data));
        } catch (\Throwable $e) {
            Log::error('DashboardController@kpi: ' . $e->getMessage());
            return response()->json(['message' => 'Erreur lors du chargement des indicateurs.'], 500);
        }
    }
}
