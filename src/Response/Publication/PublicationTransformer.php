<?php

namespace App\Response\Publication;

use App\Entity\Publication;
use Doctrine\Common\Collections\Collection;
use League\Fractal\TransformerAbstract;

/**
 * Class PublicationTransformer
 * @package App\Response\Publication
 */
class PublicationTransformer extends TransformerAbstract
{
	public function transform(Publication $publication): array
	{
		return [
			'id' => $publication->getId(),
			'success' => $publication->getSuccess(),
			'facebook_id' => $publication->getFacebookId(),
			'error_message' => $publication->getErrorMessage(),
			'created_at' => $publication->getCreatedAt()
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