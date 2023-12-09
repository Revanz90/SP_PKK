<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Credit extends Model
{
    use HasFactory;

    public function getStatusCreditAttribute()
    {
        if (isset($this->attributes['status_credit']) && $this->attributes['status_credit']) {
            switch ($this->attributes['status_credit']) {
                case 'diterima':
                    return "badge-success";
                case 'ditolak':
                    return "badge-danger";
                case 'baru':
                    return "badge-primary";
            }
        }
        return 'badge-secondary';
    }
}
