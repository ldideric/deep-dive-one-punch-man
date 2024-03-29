<?php

namespace App\Models;

use App\Enums\Association;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasName;
use Filament\Panel;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property int $id
 * @property string $legal_name
 * @property string $alias
 * @property Association $association
 * @property string $email
 * @property string $phone
 * @property string $password
 * @property Carbon $date_of_birth
 * @property string $backstory
 * @property string $motivation
 * @property Carbon $email_verified_at
 * @property string $remember_token
 * @property bool $is_admin
 *
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property Collection|Power[] $powers
 * @property Statistic $statistic
 * @property Collection|BattleRequest[] $battle_requests
 * @property Collection|Availability[] $availabilities
 * @property ApiKey $api_key
 * @property Collection|Battle[] $battles
 */
class User extends Authenticatable implements FilamentUser, HasName
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;

    protected $fillable = [
        'legal_name',
        'alias',
        'association',
        'email',
        'phone',
        'password',
        'date_of_birth',
        'backstory',
        'motivation',
        'is_admin',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'association' => Association::class,
    ];

    public function powers(): HasMany
    {
        return $this->hasMany(Power::class);
    }

    public function statistic(): HasOne
    {
        return $this->hasOne(Statistic::class);
    }

    public function battleRequests(): HasMany
    {
        return $this->hasMany(BattleRequest::class);
    }

    public function availabilities(): HasMany
    {
        return $this->hasMany(Availability::class);
    }

    public function apiKey(): HasOne
    {
        return $this->hasOne(ApiKey::class);
    }

    public function battles(): HasMany
    {
        return $this->hasMany(Battle::class, 'hero_id')
            ->orWhere('monster_id', $this->id);
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return true;
    }

    public function getFilamentName(): string
    {
        return $this->alias;
    }
}
