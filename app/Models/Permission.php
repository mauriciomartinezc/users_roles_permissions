<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
    ];

    /**
     * @param array $attributes
     * @return array
     */
    public function setDataCreate(array $attributes): array
    {
        $data['name'] = $attributes['name'];
        return $data;
    }

    /**
     * @param array $attributes
     * @return $this
     */
    public function setDataUpdate(array $attributes): Permission
    {
        $this->name = $attributes['name'];
        return $this;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }
}
