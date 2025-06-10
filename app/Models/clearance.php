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
    ];

    protected $casts = [
        'additional_data' => 'array',
        'birthdate' => 'date',
    ];

}
