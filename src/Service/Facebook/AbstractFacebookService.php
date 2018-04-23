<?php

namespace App\Service\Facebook;

use Facebook\Facebook;

/**
 * Class AbstractFacebookService
 * @package App\Service\Facebook
 */
abstract class AbstractFacebookService
{
	/**
	 * @var Facebook
	 */
	protected $facebook;

	abstract protected function setFacebook(array $params): void;
}