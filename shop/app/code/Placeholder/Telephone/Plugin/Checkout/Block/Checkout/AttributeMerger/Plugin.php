<?php
namespace Placeholder\Telephone\Plugin\Checkout\Block\Checkout\AttributeMerger;

class Plugin
{
  public function afterMerge(\Magento\Checkout\Block\Checkout\AttributeMerger $subject, $result)
  {
    if (array_key_exists('telephone', $result)) {
      $result['telephone']['placeholder'] = __('05XXXXXXXX');
    }

    return $result;
  }
}