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
            return response()->json(['error' => ucfirst($resource) . " not found."], 500);
        }

        $resourceId = $request->route('saleId');

        $resourceInstance = $modelClass::find($resourceId);

        if (!$resourceInstance) {
            return response()->json(['error' => ucfirst($resource) . " not found with invalid Id"], 404);
        }

        return $next($request);
    }
}
