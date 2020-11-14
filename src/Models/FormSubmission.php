<?php

namespace ModernMcGuire\Headstart\Models;

use App\Form;
use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;

class FormSubmission extends Model
{
    use HasUuid;

    protected $guarded = [];

    protected $casts = [
        'data' => 'array',
    ];

    public function form()
    {
        return $this->belongsTo(Form::class);
    }
}
