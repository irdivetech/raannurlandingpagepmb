<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'contact_email',
        'reg_number',
        'status',
        'admin_notes',
        'notes',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function student()
    {
        return $this->hasOne(Student::class);
    }

    public function parent()
    {
        return $this->hasOne(StudentParent::class);
    }

    public function address()
    {
        return $this->hasOne(Address::class);
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }
}
