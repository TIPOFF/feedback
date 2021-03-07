<?php

declare(strict_types=1);

namespace Tipoff\Feedback\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Tipoff\Support\Models\BaseModel;
use Tipoff\Support\Traits\HasPackageFactory;

class Feedback extends BaseModel
{
    use HasPackageFactory;
    use SoftDeletes;

    protected $table = 'feedbacks';

    protected $casts = [
        'emailed_at' => 'datetime',
        'opened_at' => 'datetime',
        'clicked_negative_at' => 'datetime',
        'clicked_semi_negative_at' => 'datetime',
        'clicked_semi_positive_at' => 'datetime',
        'clicked_positive_at' => 'datetime',
        'redirected_at' => 'datetime',
        'clicked_review_at' => 'datetime',
        'submitted_at' => 'datetime',
        'date' => 'date',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($feedback) {
            if (empty($feedback->token)) {
                $feedback->token = $feedback->location_id . 'L' . mt_rand(1000, 9999) . 'TGER' . mt_rand(1, 999999);
            }
        });
    }

    public function getRouteKeyName()
    {
        return 'token';
    }

    public function participant()
    {
        return $this->belongsTo(app('participant'));
    }

    public function location()
    {
        return $this->belongsTo(app('location'));
    }
}
