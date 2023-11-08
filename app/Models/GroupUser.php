<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupUser extends Model
{
    protected $table = 'group_user';
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'user_id',
        'group_id',
        'expired_at',
    ];

    public function getUserId()
    {
        return $this->getAttribute('user_id');
    }

    public function getGroupId()
    {
        return $this->getAttribute('group_id');
    }

    public function getExpiredAt()
    {
        return $this->getAttribute('expired_at');
    }
}
