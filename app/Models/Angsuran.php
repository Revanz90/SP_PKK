<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Angsuran extends Model
{
    use HasFactory;

    public function getStatusAngsuranMasukAttribute()
    {
        if (isset($this->attributes['status']) && $this->attributes['status']) {
            switch ($this->attributes['status']) {
                case 'baru':
                    return "badge-primary";
                case 'diterima':
                    return "badge-success";
                case 'ditolak':
                    return "badge-danger";
            }
        }
        return 'badge-secondary';
    }
}
