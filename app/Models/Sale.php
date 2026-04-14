<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'product_id',
        'plan_id',
        'source',
        'customer_ip',
        'name',
        'email',
        'phone',
        'subject',
        'message',
        'status',
    ];

    const STATUSES = [
        'new' => 'New',
        'call' => 'Call',
        'processing' => 'Processing',
        'hold' => 'Hold',
        'testing' => 'Testing',
        'deployment' => 'Deployment',
        'handover' => 'Handover',
    ];

    public static function getStatuses()
    {
        return self::STATUSES;
    }

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function plan()
    {
        return $this->belongsTo(PricePlan::class, 'plan_id');
    }
}
