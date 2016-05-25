<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['user_id', 'task', 'is_completed'];

    public function owner()
    {
        return $this->hasOne(User::class, 'user_id');
    }

    public function scopeOfUser($q, User $user = null)
    {
        if($user === null) {
            $user = auth()->user();
        }

        return $q->where('user_id', $user->id);
    }

    public function scopeCompleted($q)
    {
        return $q->where('is_completed', true);
    }

    public function scopeIncomplete($q)
    {
        return $q->where('is_completed', false);
    }

    public function complete()
    {
        $this->update(['is_completed' => true]);
    }

    public function incomplete()
    {
        $this->update(['is_completed' => false]);
    }
}
