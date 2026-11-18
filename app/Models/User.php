<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable([
    'name',
    'email',
    'password',
    'role',
    'profile_photo',
])]
#[Hidden(['password'])]
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    const UPDATED_AT = null;

    public function articles(): HasMany
    {
        return $this->hasMany(Article::class, 'user_id');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, 'user_id');
    }

    public function authorApplications(): HasMany
    {
        return $this->hasMany(AuthorApplication::class);
    }

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }
}
