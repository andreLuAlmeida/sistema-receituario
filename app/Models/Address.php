<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    public $email;
    public $name;

    public function __construct($email, $name)
    {
        $this->email = $email;
        $this->name = $name;
    }
}
