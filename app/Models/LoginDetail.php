<?php

namespace App\Models;

use CodeIgniter\Model;

class LoginDetail extends Model
{

    protected $table = 'admin';

    protected $allowedFields = ['admin_id', 'admin_email', 'admin_password'];

}