define(
    [
        'uiComponent',
        'Magento_Checkout/js/model/payment/renderer-list'
    ],
    function (
        Component,
        rendererList
    ) {
        'use strict';
        rendererList.push(
            {
                type: 'cbd',
                component: 'Karamcoffee_Cbd/js/view/payment/method-renderer/cbd'
            }
        );
        return Component.extend({});
    }
);