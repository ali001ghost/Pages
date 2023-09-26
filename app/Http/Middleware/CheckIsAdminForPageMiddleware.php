<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\PageUser;

class CheckIsAdminForPageMiddleware
{
    public function handle($request, Closure $next)
    {
        $user = $request->user();
        $pageId = $request->page_id;

        $isAdminForPage = PageUser::where('user_id', $user->id)
            ->where('page_id', $pageId)
            ->where('isAdmin', 1)
            ->exists();

        if (!$isAdminForPage) {
            return response()->json([
                $data = 'Unauthorized',
            ], 401);
        }

        return $next($request);
    }
}
