<?php

namespace ModernMcGuire\Headstart\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use HasUuid;

    protected $guarded = [];

    protected $casts = [
        'fields' => 'array',
    ];

    public function submissions()
    {
        return $this->hasMany(FormSubmission::class);
    }

    public function validationRules()
    {
        $rules = [];

        foreach($this->fields as $field) {
            if ( isset($field['required']) && $field['required'] == true ) {
                $rules['fields.' . $field['slug']][] = 'required';
            }
        }

        return $rules;
    }

    public function validationMessages()
    {
        $messages = [];

        foreach($this->fields as $field) {
            if ( isset($field['required']) && $field['required'] == true ) {
                $messages[$field['slug'] . '.required'][] = 'You must fill out the '.$field['title'].' field.';
            }
        }

        return $messages;
    }
}
