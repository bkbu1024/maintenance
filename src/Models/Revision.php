<?php

namespace Stevebauman\Maintenance\Models;

use Stevebauman\Revision\Traits\RevisionTrait;
use Illuminate\Database\Eloquent\Model;

class Revision extends Model
{
    use RevisionTrait;

    /**
     * The revisions table.
     *
     * @var string
     */
    protected $table = 'revisions';

    /**
     * The belongsTo user relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}