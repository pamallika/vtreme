<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'expire_hours'
    ];
    public $timestamps = false;

    public function getId(): int
    {
        return $this->getAttribute('id');
    }

    public function getName(): string
    {
        return $this->getAttribute('name');
    }

    public function getExpireHours(): int
    {
        return $this->getAttribute('expire_hours');
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
