<?php

namespace App\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use League\Fractal\Manager;
use League\Fractal\Serializer\DataArraySerializer;
use League\Fractal\Resource\Item;
use League\Fractal\Resource\Collection;
use League\Fractal\TransformerAbstract;

/**
 * Class BaseController
 * @package App\Controller
 */
abstract class BaseController extends FOSRestController
{
    protected function flush(): void
    {
        $this->get('doctrine.orm.default_entity_manager')->flush();
    }

    protected function item($data, TransformerAbstract $transformer): array
    {
        $manager = new Manager();
        $manager->setSerializer(new DataArraySerializer());
        return $manager->createData(new Item($data, $transformer, 'user'))->toArray();
    }

    protected function collection($data, TransformerAbstract $transformer): array
    {
        $manager = new Manager();
        $manager->setSerializer(new DataArraySerializer());
        return $manager->createData(new Collection($data, $transformer))->toArray();
    }
}