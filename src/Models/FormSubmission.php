<?php

namespace ModernMcGuire\Headstart\Models;


use Illuminate\Database\Eloquent\Model;
use ModernMcGuire\Headstart\Models\Form;
use ModernMcGuire\Headstart\Traits\HasUuid;

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
