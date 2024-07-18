require([
      'jquery',
  ], function ($) 
  {

    $(window).on('load', function(){
      $('.preloader').fadeOut();

      if(jQuery('.product-options-wrapper .fieldset .configurable.required').length > 1) {
        jQuery('body').addClass('subscribe-wrapp');
      }

      if(jQuery('.catalog-product-view .product-options-bottom .box-tocart').hasClass('other-subscribe-btn')){
        jQuery('body').addClass('subscribe-ext-btn-add');
      }

    });

    $(document).ready(function(){
      // $('.toggle-menu').on("click", function(){
      //   if($(this).hasClass('open')){
      //     $(this).removeClass('open');
          
      //     setTimeout(function() {
      //       $('.top-menu-wrapper').removeClass('open');
      //       $('header').removeClass('hide');
      //      }, 500);
      //   }
      //   else{

      //     $(this).addClass('open');
      //     $('.top-menu-wrapper').addClass('open');
      //     setTimeout(function() {
      //       $('header').addClass('hide');
      //      }, 10);
      //   }
      // });

      $('.toggle-menu').on("click", function(){
          if($(this).hasClass('open')){
       
            // setTimeout(function() {
              $(this).removeClass('open');
            // }, 1000);
            
            setTimeout(function() {
              $('.top-menu-wrapper').removeClass('open');
              $('.mobile-menu-wrapper').removeClass('open');
              setTimeout(function() {
                $('#maincontent').removeClass('hide');
              }, 1000);
              $('header').removeClass('hide');
             }, 500);
          }
          else{
       
            // setTimeout(function() {
              $(this).addClass('open');
            // }, 1000);
            $('.top-menu-wrapper').addClass('open');
            $('.mobile-menu-wrapper').addClass('open');
            // setTimeout(function() {
              $('#maincontent').addClass('hide');
            // }, 1000);
            setTimeout(function() {
              $('header').addClass('hide');
             }, 10);
          }
        });

      $('.acc').on('click', function(){
        $('.acc-link').toggleClass('show');
      });
      $('main').click(function(){
        if($('.acc-link').hasClass('show')){
          $('.acc-link').removeClass('show')
        }
      });


      $('.tabs-nav a').click(function() {

        // Check for active
        $('.tabs-nav li').removeClass('active');
        $(this).parent().addClass('active');

        // Display active tab
        let currentTab = $(this).attr('href');
        $('.tabs-content div').hide();
        $(currentTab).show();

        return false;
        });

    });

    $(document).ready(function(){

      if($(window).width() < 768){
          $('.label-express').click(function() {
          $('.filter-div-container').slideToggle('slow');
        });

        $('.open-filter').on("click", function(){
          $('.filter-open').removeClass('hide');
        });
        $('.filter-open .close-btn').on("click", function(){
          $('.filter-open').addClass('hide');
        });
      }

      // if($(window).width() > 767){
    
        // if($('.catalog-product-view .product-info-main.eng').hasClass('coffee-description')){
        //   $('.catalog-product-view .detail-wrapper').addClass('cofee-desc-btm');
        // }
      // }
      if($('.catalog-product-view .product-info-main.eng').hasClass('coffee-description')){
        $('.catalog-product-view .detail-wrapper').addClass('cofee-desc-vat-info');
      }
      if($('.catalog-product-view .product.attribute').hasClass('overview')){
        $('.catalog-product-view .detail-wrapper').addClass('cofee-desc-short-desc-wrapp');
      }
      if($('.catalog-product-view .product-options-bottom .box-tocart .actions button').hasClass('subscribetocart')){
        $('.catalog-product-view .detail-wrapper').addClass('subscribe-btn-add');
      }

      if(jQuery('.catalog-product-view .product-info-main.ar .content').hasClass('coffee-equip-ar-description')){
        console.log('ar description');
        jQuery(this).parent().find('.catalog-product-view .product-info-main.ar').addClass('coffee-equip-ar-description-wrapp');
      }
      if($('.catalog-product-view .product-info-main.eng').hasClass('coffee-equip-description')){
        console.log('test');
        $('.catalog-product-view .detail-wrapper').addClass('cofee-desc-vat-info');
        $('.catalog-product-view .detail-wrapper').addClass('ar-desc');
      }

      if($('.catalog-product-view .product-options-bottom .small-txt').hasClass('subscription-note')){
        $('.catalog-product-view .product-options-bottom').addClass('extra-text-wrapp');
        $('.catalog-product-view .detail-wrapper').addClass('subscribe-note-wrapp');
      }
      
    });

  });





