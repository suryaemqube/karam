<?php
namespace Emqube\ShippingMethods\Plugin\Model;

class ShippingMethodManagement {

    public function afterEstimateByExtendedAddress($shippingMethodManagement, $output)
    {
        return $this->filterOutput($output);
    }
    private function filterOutput($output)
    {
        $free = [];
        foreach ($output as $shippingMethod) {
            if ($shippingMethod->getCarrierCode() == 'freeshipping' && $shippingMethod->getMethodCode() == 'freeshipping') {
                $free[] = $shippingMethod;
                if ($output[0]->getCarrierCode()!='flatrate' && $output[0]->getMethodCode() != 'flatrate') {
                    $free[]=$output[0]; // for storepickup
                }
                
            }
        }
        
        if ($free) {
            return $free;
        }
        return $output;
    }
}