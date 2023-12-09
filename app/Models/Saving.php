<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Saving extends Model
{
    use HasFactory;

    public function getStatusSavingMasukAttribute()
    {
        if (isset($this->attributes['status']) && $this->attributes['status']) {
            switch ($this->attributes['status']) {
                case 'baru':
                    return "badge-primary";
                case 'disimpan':
                    return "badge-secondary";
                case 'diterima':
                    return "badge-success";
                case 'ditolak':
                    return "badge-danger";

            }
        }
        return 'badge-primary';
    }
}
