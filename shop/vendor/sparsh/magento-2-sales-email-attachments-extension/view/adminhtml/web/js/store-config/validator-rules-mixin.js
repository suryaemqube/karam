define([
 'jquery'
], function ($) {
    'use strict';
    return function (target) {
        $.validator.addMethod(
            'validate-file',
            function (value) {
                if(value != ''){
                 var ext = value.match(/\.(.+)$/)[1];
                switch (ext) {
                    case 'pdf': return true;
                    case 'doc': return true;
                    case 'docx': return true;
                    case 'txt': return true;
                }
                }
                else
                {
                    return true;
                }

            },
            $.mage.__('Please select a valid file type.')
        );
        return target;
    };
});