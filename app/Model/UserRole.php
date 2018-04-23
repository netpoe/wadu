<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    protected $table = 'user_role';

    public $timestamps = false;

    const CUSTOMER = 1;
    const EMPLOYEE = 2;
    const BUSINESS_OWNER = 3;

    const DATA = [
        self::CUSTOMER => [
            'id' => self::CUSTOMER,
            'value' => 'customer',
            'description' => 'Customer'
        ],
        self::EMPLOYEE => [
            'id' => self::EMPLOYEE,
            'value' => 'employee',
            'description' => 'Employee'
        ],
        self::BUSINESS_OWNER => [
            'id' => self::BUSINESS_OWNER,
            'value' => 'business_owner',
            'description' => 'Business owner'
        ],
    ];
}
