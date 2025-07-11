<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clearance extends Model
{
    protected $fillable = [
        'clearance_type',
        'firstName',
        'lastName',
        'middleName',
        'provincialAddress',
        'yearsInTagaytay',
        'presentAddress',
        'contactNumber',
        'civilStatus',
        'citizenship',
        'birthdate',
        'birthplace',
        'age',
        'occupation',
        'companyName',
        'spouseName',
        'spouseOccupation',
        'fatherName',
        'fatherOccupation',
        'motherName',
        'motherOccupation',
        'additional_data',
        'status'
    ];

    protected $casts = [
        'additional_data' => 'array',
        'birthdate' => 'date',
        'yearsInTagaytay' => 'integer',
        'age' => 'integer'
    ];

    // Accessors
    public function getFullNameAttribute()
    {
        return trim("{$this->firstName} {$this->middleName} {$this->lastName}");
    }

    public function getFormattedStatusAttribute()
    {
        return strtolower($this->status);
    }

    public function getFormattedTypeAttribute()
    {
        $type = $this->clearance_type;
        $businessType = $this->additional_data['business_clearance_type'] ?? null;

        return match($type) {
            'barangay_clearance' => 'Barangay',
            'business_clearance' => $businessType === 'new' ? 'New Business'
                               : ($businessType === 'renewal' ? 'Renewal' : 'Business'),
            'fencing_clearance' => 'Fencing',
            'indigency_clearance' => 'Indigency',
            'water_and_electrical_clearance' => 'Water & Electrical',
            'working_clearance' => 'Working',
            default => ucwords(str_replace('_', ' ', $type))
        };
    }

    // Scopes
    public function scopePending($query)
    {
        return $query->where('status', 'Pending');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'Completed');
    }

    public function scopeRejected($query)
    {
        return $query->where('status', 'Reject');
    }
}
