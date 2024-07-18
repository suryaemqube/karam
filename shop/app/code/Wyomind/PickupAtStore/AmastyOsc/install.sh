#!/usr/bin/env bash

APP_CODE="../../../Wyomind/PickupAtStore";
VENDOR="../../../wyomind/pickupatstore";

if [[ -e "${APP_CODE}" ]]; then
    cp "../view/frontend/layout/checkout_index_index.xml ${APP_CODE}/view/frontend/layout/checkout_index_index_backup.xml"
    cp "../view/frontend/layout/checkout_index_index_am_osc.xml ${APP_CODE}/view/frontend/layout/checkout_index_index.xml"
fi
if [[ -e "${VENDOR}" ]]; then
    cp "../view/frontend/layout/checkout_index_index.xml" "${VENDOR}/view/frontend/layout/checkout_index_index_backup.xml"
    cp "../view/frontend/layout/checkout_index_index_am_osc.xml" "${VENDOR}/view/frontend/layout/checkout_index_index.xml"
fi

APP_CODE="../../../Amasty/Checkout";
VENDOR="../../../amasty/module-single-step-checkout";
VERSION="_3.1.3";

# app/code
if [[ -e "${APP_CODE}" ]]; then
    # backup
    if [[ ! -f "${APP_CODE}/view/frontend/web/js/view/shipping-mixin_orig.js" ]]; then
        cp "${APP_CODE}/view/frontend/web/js/view/shipping-mixin.js" \
            "${APP_CODE}/view/frontend/web/js/view/shipping-mixin_orig.js"
    fi
    if [[ ! -f "${APP_CODE}/view/frontend/web/template/onepage/shipping/methods.html" ]]; then
        cp "${APP_CODE}/view/frontend/web/template/onepage/shipping/methods.html" \
            "${APP_CODE}/view/frontend/web/template/onepage/shipping/methods_orig.html"
    fi
    # copy new files
    cp "view/frontend/web/js/view/shipping-mixin${VERSION}.js" \
        "${APP_CODE}/view/frontend/web/js/view/shipping-mixin.js"
    cp "view/frontend/web/template/onepage/shipping/methods${VERSION}.html" \
        "${APP_CODE}/view/frontend/web/template/onepage/shipping/methods.html"
fi

# vendor
if [[ -e "${VENDOR}" ]]; then
    # backup
    if [[ ! -f "${VENDOR}/view/frontend/web/js/view/shipping-mixin_orig.js" ]]; then
        cp "${VENDOR}/view/frontend/web/js/view/shipping-mixin.js" \
            "${VENDOR}/view/frontend/web/js/view/shipping-mixin_orig.js"
    fi
    if [[ ! -f "${VENDOR}/view/frontend/web/template/onepage/shipping/methods.html" ]]; then
        cp "${VENDOR}/view/frontend/web/template/onepage/shipping/methods.html" \
            "${VENDOR}/view/frontend/web/template/onepage/shipping/methods_orig.html"
    fi
    # copy new files
    cp "view/frontend/web/js/view/shipping-mixin${VERSION}.js" \
        "${VENDOR}/view/frontend/web/js/view/shipping-mixin.js"
    cp "view/frontend/web/template/onepage/shipping/methods${VERSION}.html" \
        "${VENDOR}/view/frontend/web/template/onepage/shipping/methods.html"
fi


