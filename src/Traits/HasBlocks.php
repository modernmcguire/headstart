<?php

namespace ModernMcGuire\Headstart\Traits;

use App\ContentBlock;

trait HasBlocks
{
    public function getBlocks()
    {
    	if (property_exists($this, 'blocks')) {
    		$blocks = [];

    		foreach($this->blocks as $block) {
    			$blocks[] = app('block')->get(class_basename($block));
    		}

    		return $blocks;
    	}

    	return app('block')->all();
    }

    public function contentBlocks()
    {
        return $this->morphMany(ContentBlock::class, 'blockable')->orderBy('sort_order');
    }

    public function visibleContentBlocks()
    {
    	return $this->contentBlocks()->where('enabled', true)->get();
    }

    public function renderBlocks()
    {
        $output = '';

        foreach ($this->visibleContentBlocks() as $block) {
            $output .= $block->render();
        }

        return $output;
    }

    public function canEditBlocks()
    {
    	return $this->contentBlocks->count();
    }
}





