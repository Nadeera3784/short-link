<?php

namespace App\Builders;

use Illuminate\Database\Eloquent\Builder;

class LinkQueryBuilder extends Builder
{
    public function getLinkByUrl(string $link)
    {
        return $this->where('url', $link);
    }

    public function getLinkByIdentifier(string $identifier)
    {
        return $this->where('identifier', $identifier);
    }
}
