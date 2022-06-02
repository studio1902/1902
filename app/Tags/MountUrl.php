<?php

namespace App\Tags;

use Statamic\Facades\Collection;
use Statamic\Facades\Site;
use Statamic\Tags\Tags;

class MountUrl extends Tags
{
    /**
     * The {{ mount_url }} tag.
     *
     * @return string|array
     */
    public function index()
    {
        /*
        * Get the collection name from the tag
        */
        $collectionName  = $this->params->get('from');
        $collection = Collection::find($collectionName);
        return ($collection) ? $collection->url(Site::current()->handle()) : null;
    }
}
