<?php

namespace App\Models;

use App\Enums\Grade;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $hero_id
 * @property int $skill_type_id
 * @property Grade $grade
 * @property string $name
 * @property string $description
 *
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property Hero $hero
 * @property SkillType $skillType
 */
class Power extends Model
{
    use HasFactory;

    protected $fillable = [
        'hero_id',
        'skill_type_id',
        'grade',
        'name',
        'description',
    ];

    protected $casts = [
        'grade' => Grade::class,
    ];

    public function hero(): BelongsTo
    {
        return $this->belongsTo(Hero::class);
    }

    public function skillType(): BelongsTo
    {
        return $this->belongsTo(SkillType::class);
    }

    public function powerEffects(): HasMany
    {
        return $this->hasMany(PowerEffect::class);
    }
}
