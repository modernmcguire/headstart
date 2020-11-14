<?php

namespace ModernMcGuire\Headstart\Http\Controllers\Admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use ModernMcGuire\Headstart\Http\Controllers\Controller;

class ResourceController extends Controller
{
    public $type;
    public $resource;

    public function __construct()
    {
    	$this->type = request('resource_type');

    	$this->resource = app('resource')->getClass($this->type);

    	if (!$this->resource) {
    		abort(404, "This resource type couldn't be found.");
    	}
    }

    public function list()
    {
    	return view('admin.resource.list', [
    		'resource' => $this->resource,
    		'entities' => $this->resource::all(),
    	]);
    }

    public function create()
    {
    	return redirect(route('admin.resource.edit', [
    		'resource_type' => $this->type,
    		'entity' => $this->resource::create([
    			$this->resource->title_column => 'Untitled',
    			'user_id' => auth()->id(),
    		]),
    	]));
    }

    public function edit()
    {
    	$entity = $this->resource::whereSlug(request('entity'))->firstOrFail();

    	return view('admin.resource.edit', [
    		'entity' => $entity,
    	]);
    }

    public function store(Request $request, $resource_type, $entity)
    {
        $entity = $this->resource::whereSlug(request('entity'))->firstOrNew();
        $request->validate( $entity->exists ? $entity->updateRules() : $entity->createRules(), $entity->messages() );

        if ( ! empty($request->files) ) {
            foreach($request->files as $file) {
                foreach($file as $field => $the_file) {
                    if ( is_array($the_file) ) {
                        $images = [];
                        foreach($the_file as $index => $array_file) {
                            $images[] = $request->file('data.' . $field . '.' . $index)->store('public');
                        }

                        $entity->{$field} = $images;
                    } else {
                        $entity->{$field} = $request->file('data.' . $field)->store('public');
                    }
                }
            }
        }

        $data = $request->data;

        // Handle repeater deletions and additions
        foreach (collect($entity->fields())->where('type', 'repeater') as $field) {
            // Handle repeater deletions
            $unset_key = isset($data[$field['slug']]['__unset']) ? $data[$field['slug']]['__unset'] : false;

            if ($unset_key !== false) {
                unset($data[$field['slug']][$unset_key]);
                unset($data[$field['slug']]['__unset']);
            }

            // Handle repeater additions
            if (isset($data[$field['slug']]['__append'])) {
                $data[$field['slug']][] = [];
                unset($data[$field['slug']]['__append']);
            }
        }

        // wipe out empty multiselects
        foreach(collect($entity->fields())->where('type', 'select_multiple') as $multiselect) {
            if ( ! $request->has('data.' . $multiselect['slug'] )) {
                $entity->{$multiselect['slug']} = null;
                $entity->save();
            }
        }

        // If checkboxes are unchecked, they won't be included in the request
        // So here we'll stuff the "false" value into the request so it
        // gets saved accordingly.
        foreach(collect($entity->fields())->where('type', 'boolean') as $boolean) {
            if (!$request->has('data.'.$boolean['slug'])) {
                $data[$boolean['slug']] = 0;
            }
        }

        $request->data = $data;

        $entity->fill($request->data)->save();

        return redirect(route('admin.resource.edit', [
    		'resource_type' => $this->type,
    		'entity' => $entity,
    	]))->with('flash.success', Str::title($resource_type) . ' updated.');
    }

    public function destroy($resource_type, $entity)
    {
        $entity = $this->resource::whereSlug(request('entity'))->firstOrFail();

        $entity->delete();

        return redirect(route('admin.resource.list', [
            'resource_type' => $resource_type,
        ]))->with('flash.success', "<i class='fa fa-check-circle text-success mr-1'></i> The ".strtolower($entity->resourceName())." has been deleted.");
    }
}
