<?php

namespace App\Request\Channel;

use App\Request\AbstractRequest;
use Fesor\RequestObject\PayloadResolver;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class CreateChannelRequest
 * @package App\Request\Channel
 */
class CreateChannelRequest extends AbstractRequest implements PayloadResolver
{
	public function resolvePayload(Request $request)
	{
		return $request->query->all();
	}

	public function rules()
	{
		return new Assert\Collection([
			'code' => [
				new Assert\NotBlank(),
				new Assert\Type('string')
			],
			'state' => [
				new Assert\NotBlank(),
				new Assert\Type('string')
			]
		]);
	}
}