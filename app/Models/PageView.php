<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageView extends Model
{
    protected $fillable = ['page', 'ip_address', 'user_agent', 'referer', 'visited_at'];

    protected $casts = [
        'visited_at' => 'date',
    ];

    public static function recordVisit(string $page = 'home'): void
    {
        static::create([
            'page' => $page,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'referer' => request()->header('referer'),
            'visited_at' => now()->toDateString(),
        ]);
    }

    public static function getTotalVisitors(): int
    {
        return static::distinct('ip_address')->count('ip_address');
    }

    public static function getMonthlyData(): array
    {
        return static::selectRaw('DATE(visited_at) as date, COUNT(*) as count')
            ->where('visited_at', '>=', now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('count', 'date')
            ->toArray();
    }
}
