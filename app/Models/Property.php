<?php

namespace App\Models;

use App\Models\User;
use App\Models\PropertyType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Property extends Model
{
    use HasFactory;
    protected $guarded = [];

    /**
     * Get the user that owns the Property
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(PropertyType::class, 'type_id', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'agent_id', 'id');
    }


    public function getRouteKeyName()
    {
        return 'property_slug';
    }
}
