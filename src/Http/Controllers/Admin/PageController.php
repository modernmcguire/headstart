<?php

namespace ModernMcGuire\Headstart\Http\Controllers\Admin;

use App\Enums\PageStatus;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use BenSampo\Enum\Rules\EnumKey;
use BenSampo\Enum\Rules\EnumValue;
use ModernMcGuire\Headstart\Models\Page;
use ModernMcGuire\Headstart\Http\Controllers\Controller;

class PageController extends Controller
{
    public function list()
    {
    	return view('admin.page.list', [
    		'pages' => Page::all(),
    	]);
    }

    public function create()
    {
    	return redirect(route('admin.page.edit', [
    		'page' => Page::create([
    			'title' => 'A Brand New Page',
    			'author_id' => auth()->id(),
    		]),
    	]));
    }

    public function edit(Page $page)
    {
    	if (!$page) {
    		$page = Page::make();
    	}

    	return view('admin.page.edit', [
    		'page' => $page,
            'active_tab' => session('flash.active_tab', 'settings'),
    	]);
    }

    public function store(Request $request, Page $page=null)
    {
    	// For each block...
    	foreach ($page->contentBlocks as $block) {
    		$blockRequest = request('blocks.'.$block->uuid);

    		// Handle any repeater deletions
    		foreach ($block->getInfo('fields')->where('type', 'repeater') as $field) {
    			$unset_key = isset($blockRequest['data'][$field['slug']]['__unset']) ? $blockRequest['data'][$field['slug']]['__unset'] : false;

    			if ($unset_key !== false) {
    				unset($blockRequest['data'][$field['slug']][$unset_key]);
    				unset($blockRequest['data'][$field['slug']]['__unset']);
    			}

    			// TODO after deleting... field data is not an array anymore?
    		}

    		// Validate block
    		// TODO

    		// Handle repeater additions
    		foreach ($block->getInfo('fields')->where('type', 'repeater') as $field) {
    			if (isset($blockRequest['data'][$field['slug']]['__append'])) {
    				$blockRequest['data'][$field['slug']][] = [];
    				unset($blockRequest['data'][$field['slug']]['__append']);
    			}
    		}

    		// Set block data
    		$block->sort_order = @$blockRequest['sort_order'];
    		$block->enabled = @$blockRequest['enabled'] ?? false;
    		$block->data = @$blockRequest['data'];

    		// Save
    		$block->save();
    	}

    	// Validate page meta
        $slug_rules = ['required'];

        if ($page->slug != request('slug')) {
            $slug_rules[] = Rule::unique('pages')->ignore($page->id)->whereNull('deleted_at');
        }

    	$request->validateWithBag('settings', [
            'title' => ['required'],
            'slug' => $slug_rules,
            'status' => ['required', new EnumValue(PageStatus::class)],
        ]);

    	// Save page metadata
    	$page->title = request('title');
        $page->slug = request('slug');
        $page->status = request('status');
    	$page->save();

    	// Handle any block detachments
    	if (request('detach_block')) {
    		$page->contentBlocks()->whereUuid(request('detach_block'))->delete();
    	}

    	// Handle any block attachments
    	if (request('attach_block')) {
    		// Check that the block exists
    		$block = app('block')->get(request('attach_block'));

    		if ($block) {
    			$page->contentBlocks()->create([
    				'type' => $block['class'],
    				'sort_order' => ($page->contentBlocks->max('sort_order') + 1),
                    'data' => [],
    			]);
    		}
    	}

    	return redirect(route('admin.page.edit', [$page]))
            ->with('flash.success', "<i class='fa fa-check-circle text-success mr-1'></i> The page has been saved.")
            ->with('flash.active_tab', request('active_tab'));
    }

    public function destroy(Page $page)
    {
        $page->delete();

        return redirect(route('admin.page.list'))->with('flash.success', "<i class='fa fa-check-circle text-success mr-1'></i> The page has been deleted.");
    }
}
