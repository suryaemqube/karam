<?php
namespace Placeholder\Telephone\Plugin\Checkout\Block\Checkout\LayoutProcessor;

class Plugin
{
public function afterProcess(\Magento\Checkout\Block\Checkout\LayoutProcessor $subject, array $jsLayout) {
$billingConfiguration = &$jsLayout['components']['checkout']['children']['steps']['children']['billing-step']
['children']['payment']['children']['payments-list']['children'];

//Checks if billing step available.
if (isset($billingConfiguration)) {
//Iterate over billing forms.
foreach($billingConfiguration as $key => &$billingForm) {
//Exclude not billing forms
if (!strpos($key, '-form')) {
continue;
}
unset($billingForm['children']['form-fields']['children']['city']);
}
}

return $jsLayout;
}
}