require([
        "jquery",
        "mage/mage"
    ], function($) {
        window.FORM_KEY = $('input[name="form_key"]').val();

        $().ready(function() {
            if (typeof rewardsDefaultTwitterText != 'undefined') {
                $('.mst-rewardssocial-tweet').attr('data-text', rewardsDefaultTwitterText);
            }

            if ($('.twitter-share-button.mst-rewardssocial-tweet').length) {
                $("body").on("click", "a.twitter-share-button.mst-rewardssocial-tweet", function(e) {
                    e.preventDefault();
                    tweet();
                    window.location = $(this).attr('href');
                });
            }
            $('div.column.main, div.page-wrapper').on('contentUpdated', function () {
                if (typeof rewardsDefaultTwitterText != 'undefined' && typeof fbLocaleCode != 'undefined') {
                    $('.mst-rewardssocial-tweet').attr('data-text', rewardsDefaultTwitterText);
                }  else {
                  $('.buttons-twitter-like').remove();
                }
                if (typeof window.twttr != 'undefined' && typeof window.twttr.widgets != 'undefined') {
                    window.twttr.widgets.load();
                }
                if ($('.buttons-facebook-like').length && typeof FB == 'undefined') {
                    // facebook
                    (function(d, s, id) {
                      if (typeof fbLocaleCode != 'undefined') {
                        if (d.getElementById(id)) { // reinit FB on Magento cache load
                            d.getElementById(id).remove();
                            delete FB;
                        }
                        var js, fjs = d.getElementsByTagName(s)[0];
                        if (d.getElementById(id)) {return;}
                        js = d.createElement(s); js.id = id;
                        js.src = "//connect.facebook.net/" + fbLocaleCode + "/all.js#xfbml=1&appId=" + fbAppId +
                            "&version=" + rewardsFacebookApiVersion;
                        fjs.parentNode.insertBefore(js, fjs);

                      } else {
                        $('.buttons-facebook-like').remove();
                        $('.buttons-fb-share').remove();
                      }
                    }  (document, 'script', 'facebook-jssdk'));
                }
            });
            if ($('.buttons-twitter-like').length || $('.twitter-share-button').length) {
                window.twttr = (function (d, s, id) {
                    var js, fjs = d.getElementsByTagName(s)[0],
                        t = window.twttr || {};
                    if (d.getElementById(id)) {
                        return t;
                    }
                    js = d.createElement(s);
                    js.id = id;
                    js.async = 1;
                    js.src = "https://platform.twitter.com/widgets.js";
                    fjs.parentNode.insertBefore(js, fjs);

                    t._e = [];
                    t.ready = function (f) {
                        t._e.push(f);
                    };

                    return t;
                }(document, "script", "twitter-wjs"));

                if (typeof window.twttr.ready != "undefined") {
                    twttr.ready(function (twttr) {
                        twttr.events.bind('tweet', function (a) {
                            if (!a) {
                                return;
                            }
                            if ($(a.target).parents('.rewardssocial-buttons').length) {
                                tweet();
                            }
                        });
                    });
                }
            }
            // pinterest
            $("body").on("click", "#buttons-pinterest-pin a", pinIt);
            $("body").on("click", "#rewards_fb_share", function(e) {
                if (!fbShareClicked) {
                    fbShareClicked = true;
                    fbUi();
                }
            });
            $("body").on("mouseup", "#rewards_fb_share", function(e) {
                if (!fbShareClicked) {
                    fbUi();
                } else {
                    fbShareClicked = false;
                }
            });
            $("body").on("touchend", "#rewards_fb_share", function(e) {
                if (!fbShareClicked) {
                    fbUi();
                } else {
                    fbShareClicked = false;
                }
            });
        });
    }
);

let fbShareClicked = false;
function fbUi() {
    FB.ui({
        method:  'share',
        display: 'popup',
        href:    rewardsShareCurrentUrl,
    }, function (response) {
        if (typeof response !== 'undefined') {
            fbShare();
        }
    });
}

var addToAnyTimerCounter = 0;
var addToAnyTimer = setInterval( function() {
    addToAnyTimerCounter++;
    if ( typeof addtoany !== 'undefined' ) {
        clearInterval( addToAnyTimer );
        addtoany.addEventListener('addtoany.menu.share', addtoanyShare);
    } else if (addToAnyTimerCounter > 40) { // wait 4sec
        clearInterval( addToAnyTimer );
    }
}, 100 );

function fbShare() {
    jQuery.ajax({
        url: window.fbShareUrl + '?url=' + rewardsCurrentUrl,
        type: 'POST',
        dataType: 'JSON',
        complete: function (data) {
            jQuery('#status-message').html(data.responseText);
            jQuery('#facebook-share-message').html('');
        }
    });
}

function tweet() {
    jQuery.ajax({
        url: window.rewardsTwitterUrl + '?url=' + rewardsCurrentUrl,
        type: 'POST',
        dataType: 'JSON',
        complete: function (data) {
            jQuery('#status-message').html(data.responseText);
            jQuery('#twitter-message').html('');
        }
    });
}

function pinIt() {
    jQuery.ajax({
        url: window.rewardsPinUrl + '?url=' + rewardsCurrentUrl,
        type: 'POST',
        dataType: 'JSON',
        complete: function (data) {
            jQuery('#status-message').html(data.responseText);
            jQuery('#pinterest-message').html('');
        }
    });
}

function addtoanyShare(e) {
    if (e.type == 'addtoany.menu.share') {
        switch (e.data.service) {
            case "twitter":
                tweet();
                break;
            case "pinterest_share":
                pinIt();
                break;
        }
    }
}
