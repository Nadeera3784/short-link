<?php

namespace App\Services\Link;

use App\Models\Link;
use Illuminate\Support\Str;

class LinkService
{
    public function create(array $data)
    {
        $data['identifier'] = Str::random(6);
        return Link::create($data);
    }

    public function getLinkByUrl(string $url)
    {
        return Link::getLinkByUrl($url)->first();
    }

    public function getLinkByIdentifier(string $identifier)
    {
        return Link::getLinkByIdentifier($identifier)->first();
    }
}
