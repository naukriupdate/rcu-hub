<?php

namespace App\Services;

use App\Models\AuditLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class AuditService
{
    public static function log(string $action, ?string $description = null, $entity = null): void
    {
        try {
            AuditLog::create([
                'user_id' => Auth::id(),
                'action' => $action,
                'entity_type' => $entity ? get_class($entity) : null,
                'entity_id' => $entity ? ($entity->id ?? null) : null,
                'description' => $description ?: $action,
                'ip_address' => Request::ip(),
                'user_agent' => substr(Request::userAgent() ?? '', 0, 500),
            ]);
        } catch (\Throwable $e) {
            // Failsafe so audit log issues never crash normal requests
        }
    }
}
