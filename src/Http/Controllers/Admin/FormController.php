<?php

namespace ModernMcGuire\Headstart\Http\Controllers\Admin;

use Illuminate\Http\Request;
use ModernMcGuire\Headstart\Models\Form;
use ModernMcGuire\Headstart\Models\FormSubmission;
use ModernMcGuire\Headstart\Http\Controllers\Controller;

class FormController extends Controller
{
    public function allSubmissions()
    {
        $submissions = FormSubmission::with('form')->latest()->paginate();

    	return view('admin.forms.all_submissions', [
            'submissions' => $submissions,
        ]);
    }

    public function showSubmission(Form $form, FormSubmission $submission)
    {
        if ( $submission->status == "New" ) {
            $submission->status = "Viewed";
            $submission->save();
        }

        return view('admin.forms.show.submission', [
            'form' => $form,
            'submission' => $submission,
        ]);
    }
}
