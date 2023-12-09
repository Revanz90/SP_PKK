<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Saving extends Model
{
    use HasFactory;

    public function getStatusSavingAttribute()
    {
        if (isset($this->attributes['status_saving']) && $this->attributes['status_saving']) {
            switch ($this->attributes['status_saving']) {
                case 'diterima':
                    return "badge-success";
                case 'ditolak':
                    return "badge-danger";
                case 'baru':
                    return "badge-primary";
            }
        }
        return 'badge-primary';
    }
}
