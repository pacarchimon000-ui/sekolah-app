<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'ticket_number',
        'type',
        'category',
        'subject',
        'description',
        'is_anonymous',
        'status',
        'attachment_path',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getTypeLabelAttribute(): string
    {
        return match ($this->type) {
            'aspirasi' => 'Aspirasi & saran',
            'pengaduan' => 'Pengaduan aman',
            'lost_found' => 'Barang hilang & temuan',
            default => ucfirst((string) $this->type),
        };
    }

    protected function casts(): array
    {
        return [
            'is_anonymous' => 'boolean',
        ];
    }
}