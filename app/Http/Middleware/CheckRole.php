<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Role;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $payload = auth()->payload();
        $roleId = $payload->get('role_id');
        $codeRole = Role::where('_id', $roleId)->value('name');
        if ($codeRole[0] == 'u') {
            return response()->json([
                [
                    'error' => 'Chỉ có admin có thể truy cập tài nguyên này',
                    // 'code' => $payload,
                    // 'role_id' => $roleId,
                    // 'codeRole' => $codeRole
                ],
            ], 401);
        }
        return $next($request);
    }
}