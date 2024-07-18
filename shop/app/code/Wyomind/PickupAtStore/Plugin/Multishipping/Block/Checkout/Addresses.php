<?php

namespace Wyomind\PickupAtStore\Plugin\Multishipping\Block\Checkout;

use Wyomind\Framework\Helper\Module;
use Wyomind\PickupAtStore\Block\PickupAtStore;
use Wyomind\PickupAtStore\Helper\Data;
class Addresses
{
    public $dataHelper;
    public $pasBlock;
    public $framework;
    public function __construct(\Wyomind\PickupAtStore\Helper\Delegate $wyomind)
    {
        $wyomind->constructor($this, $wyomind, __CLASS__);
    }
    protected $posList = [];
    public function afterGetAddressOptions($subject, $options)
    {
        if (!count($this->posList)) {
            $pos = $this->pasBlock->getPickupPlaces();
            foreach ($pos as $place) {
                $this->posList[] = ['value' => "pickup_" . $place->getPlaceId(), 'label' => $this->framework->getStoreConfig('carriers/pickupatstore/title') . ": " . $place->getName()];
            }
            $options = array_merge($options, $this->posList);
            $subject->setData('address_options', $options);
        }
        return $options;
    }
}