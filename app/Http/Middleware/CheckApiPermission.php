<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckApiPermission
{
    private const ROUTE_PERMISSIONS = [
        'GET' => [
            'dashboard/kpi' => 'dashboard.read',
            'me' => null,
            'categories' => 'categories.read',
            'categories/*' => 'categories.read',
            'email-templates' => 'email-templates.read',
            'email-templates/*' => 'email-templates.read',
            'newsletter/subscribers' => 'newsletter.read',
            'contact-messages' => 'contact.read',
            'contact-messages/*' => 'contact.read',
            'pages/*/versions' => 'pages.read',
        ],
        'POST' => [
            'logout' => null,
            'projects' => 'projects.create',
            'posts' => 'posts.create',
            'gallery' => 'gallery.create',
            'categories' => 'categories.create',
            'media/upload' => 'media.upload',
            'navigation' => 'navigation.create',
            'email-templates' => 'email-templates.create',
            'email-templates/*/send' => 'email-templates.send',
        ],
        'PUT' => [
            'projects/*' => 'projects.update',
            'posts/*' => 'posts.update',
            'gallery/*' => 'gallery.update',
            'categories/*' => 'categories.update',
            'pages/*' => 'pages.update',
            'settings' => 'settings.update',
            'settings/visibility' => 'settings.update',
            'navigation/*' => 'navigation.update',
            'navigation/order' => 'navigation.update',
            'email-templates/*' => 'email-templates.update',
            'contact-messages/*/read' => 'contact.update',
        ],
        'DELETE' => [
            'projects/*' => 'projects.delete',
            'posts/*' => 'posts.delete',
            'gallery/*' => 'gallery.delete',
            'categories/*' => 'categories.delete',
            'navigation/*' => 'navigation.delete',
            'email-templates/*' => 'email-templates.delete',
            'newsletter/subscribers/*' => 'newsletter.delete',
            'contact-messages/*' => 'contact.delete',
        ],
    ];

    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (!$user) {
            return response()->json(['message' => 'Non authentifie'], 401);
        }

        if ($user->isAdmin()) {
            return $next($request);
        }

        $permissions = $user->role()->first()?->permissions ?? [];
        if (in_array('*', $permissions, true)) {
            return $next($request);
        }

        $required = $this->resolvePermission($request);

        if ($required === null || $this->hasPermission($permissions, $required)) {
            return $next($request);
        }

        return response()->json(['message' => 'Acces refuse.'], 403);
    }

    private function resolvePermission(Request $request): ?string
    {
        $method = strtoupper($request->method());
        $path = trim($request->path(), '/');
        $path = str_starts_with($path, 'api/') ? substr($path, 4) : $path;

        $map = self::ROUTE_PERMISSIONS[$method] ?? [];

        foreach ($map as $pattern => $permission) {
            if ($this->matchesPattern($path, $pattern)) {
                return $permission;
            }
        }

        $resource = explode('/', $path)[0] ?? '';
        $action = match ($method) {
            'GET' => 'read',
            'POST' => 'create',
            'PUT', 'PATCH' => 'update',
            'DELETE' => 'delete',
            default => 'read',
        };

        return $resource ? "{$resource}.{$action}" : null;
    }

    private function matchesPattern(string $path, string $pattern): bool
    {
        $regex = '#^' . str_replace('\*', '[^/]+', preg_quote($pattern, '#')) . '$#';

        return (bool) preg_match($regex, $path);
    }

    private function hasPermission(array $permissions, string $required): bool
    {
        foreach ($permissions as $permission) {
            if ($permission === $required) {
                return true;
            }

            if (str_ends_with($permission, '.*')) {
                $prefix = substr($permission, 0, -1);
                if (str_starts_with($required, $prefix)) {
                    return true;
                }
            }
        }

        return false;
    }
}
