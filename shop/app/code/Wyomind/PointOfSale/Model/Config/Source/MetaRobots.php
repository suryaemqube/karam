<?php
/**
 * Copyright © 2019 Wyomind. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace Wyomind\PointOfSale\Model\Config\Source;

use Magento\Framework\Option\ArrayInterface;

/**
 * Class UnitSystem
 * @package Wyomind\PointOfSale\Model\Config\Source
 */
class MetaRobots implements ArrayInterface
{

    /**
     * @return array
     */
    public function toOptionArray()
    {
        return [
            ['label' => 'NO INDEX, NO FOLLOW', 'value' => 'NO INDEX, NO FOLLOW'],
            ['label' => 'NO INDEX, FOLLOW', 'value' => 'NO INDEX, FOLLOW'],
            ['label' => 'INDEX, FOLLOW', 'value' => 'INDEX, FOLLOW'],
            ['label' => 'INDEX, NO FOLLOW', 'value' => 'INDEX, NO FOLLOW'],
        ];
    }
}
