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
        'invoice_no',
        'name',
        'email',
        'phone',
        'subject',
        'message',
        'status',
        'sale_date',
        'price',
        'expaire_date',
        'payment_method',
        'payment_status',
        'quantity',
        'discount',
        'tax',
        'total_price',
        'transaction_id',
        'notes',
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

    const PAYMENT_STATUSES = [
        'unpaid' => 'Unpaid',
        'partially-paid' => 'Partially Paid',
        'paid' => 'Paid',
        'cancelled' => 'Cancelled',
    ];

    const PAYMENT_METHODS = [
        'cash' => 'Cash',
        'bank-transfer' => 'Bank Transfer',
        'bkash' => 'bKash',
        'nagad' => 'Nagad',
        'rocket' => 'Rocket',
        'card' => 'Card',
        'other' => 'Other',
    ];

    public static function getStatuses()
    {
        return self::STATUSES;
    }

    public static function getPaymentStatuses()
    {
        return self::PAYMENT_STATUSES;
    }

    public static function getPaymentMethods()
    {
        return self::PAYMENT_METHODS;
    }

    protected static function booted()
    {
        static::creating(function ($sale) {
            // Generate invoice number
            if (empty($sale->invoice_no)) {
                $lastSale = self::where('created_at', '>=', now()->startOfDay())->latest()->first();
                $count = $lastSale ? ((int) substr($lastSale->invoice_no, -3)) + 1 : 1;
                $sale->invoice_no = 'INV-' . now()->format('Ymd') . '-' . str_pad($count, 3, '0', STR_PAD_LEFT);
            }

            // Set sale date if not set
            if (empty($sale->sale_date)) {
                $sale->sale_date = now()->toDateString();
            }

            // Calculate total price
            $sale->total_price = ($sale->price * $sale->quantity) - $sale->discount + $sale->tax;
        });

        static::updating(function ($sale) {
            $sale->total_price = ($sale->price * $sale->quantity) - $sale->discount + $sale->tax;
        });
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
