<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pinjamans extends Model
{
    use HasFactory;

    protected $fillable = [
        'belum_lunas',
    ];

    public function getStatusCreditMasukAttribute()
    {
        if (isset($this->attributes['status_credit']) && $this->attributes['status_credit']) {
            switch ($this->attributes['status_credit']) {
                case 'baru':
                    return "badge-primary";
                case 'aktif':
                    return "badge-success";
                case 'ditolak':
                    return "badge-danger";
                case 'lunas':
                    return "badge-info";
            }
        }
        return 'badge-primary';
    }
}
