<?php

namespace App\Response\Theme;

use App\Entity\Theme;
use Doctrine\Common\Collections\Collection;
use League\Fractal\TransformerAbstract;

/**
 * Class PostTransformer
 * @package App\Response\Post
 */
class ThemeTransformer extends TransformerAbstract
{
    public function transform(Theme $theme): array
    {
        return [
            'id' => $theme->getId(),
            'title' => $theme->getTitle()
        ];
    }

    public function transformCollection(Collection $collection): array
    {
        $result = [];
        foreach ($collection as $item) {
            $result[] = $this->transform($item);
        }
        return $result;
    }
}