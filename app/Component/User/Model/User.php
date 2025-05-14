<?php

declare(strict_types=1);

namespace App\Component\User\Model;

use App\Component\UniqueLink\Model\UniqueLink;
use Database\Factories\Component\User\Model\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Carbon;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * @property int $id
 * @property string $name
 * @property string $phone
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class User extends Authenticatable implements JWTSubject
{
    /** @use HasFactory<UserFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'phone',
    ];

    public function getJWTIdentifier(): mixed
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims(): array
    {
        return [];
    }

    public function uniqueLinks(): HasMany
    {
        return $this->hasMany(UniqueLink::class);
    }

    public function uniqueLinksWithTrashed(): HasMany
    {
        return $this->hasMany(UniqueLink::class)->withTrashed();
    }
}
