<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Sales; // Importe o modelo apropriado

class EnsureResourceExists
{
    public function handle(Request $request, Closure $next, $resource)
    {
        $modelClass = "App\\Models\\" . ucfirst($resource);

        if (!class_exists($modelClass)) {
            abort(500, "Invalid resource class.");
        }

        $resourceId = $request->route('saleId');
        // dd($resourceId);

        $resourceInstance = $modelClass::find($resourceId);

        if (!$resourceInstance) {
            abort(404, ucfirst($resource) . " not found.");
        }

        return $next($request);
    }
}
