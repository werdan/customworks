(function ($) {
  // Drupal.theme.prototype.cwExampleButton = function (path, title) {
  //   // Create an anchor element with jQuery.
  //   return $('<a href="' + path + '" title="' + title + '">' + title + '</a>');
  // };

  Drupal.behaviors.cwBehaviors = {
    attach: function (context, settings) {
      var animationSpeed = 300;
      // Reorder main menu and added click event.
      $('ul#main-menu.links li[class*="active"]', context)
        .prependTo('ul#main-menu.links')
        .find('> a').on('click', function(e) {
          var $this = $(this);
          var $listItems = $this.parents('ul').find('li:not([class*="active"])');
          $listItems.stop(true, true).toggle(200);
          $this.toggleClass('is-active');
          e.preventDefault();
        });
      $(window).resize(function(e) {
        $('ul#main-menu.links li:not([class*="active"])', context)
          .removeAttr('style');
        $('ul#main-menu.links a.is-active', context).removeClass('is-active');
      });

      // mobile main menu
      if (!$('#region-menu h2.mobile-title').get(0)) {
        var textMenuActiveLink = $('#main-menu a[class*="active"]', context).text();
        $('#mobile-main-menu', context)
          .before('<h2 class="mobile-title">' + textMenuActiveLink + '</h2>');
        $('#region-menu h2.mobile-title', context).on('click', function(e) {
          $('#mobile-main-menu a.menu', context).trigger('click');
          e.preventDefault();
        });
      }
      $('#mobile-main-menu a.menu', context).on('click', function(e) {
        $('#region-menu .navigation', context)
          .stop(true, true).slideToggle(animationSpeed);
        e.preventDefault();
      });

      // cycle 2
      if ($.fn.cycle) {
        // front page slider
        if ($('div.view-slider div.view-content').get(0)) {
          if ($('div.view-slider div.view-content > div.views-row', context).length > 1) {
            $('div.view-slider div.view-content', context)
              .after('<a href="#" class="prev">' + Drupal.t('Prev') + '</a>')
              .after('<a href="#" class="next">' + Drupal.t('Next') + '</a>');
          }
          $('div.view-slider div.view-content', context).cycle({
            fx : 'scrollHorz',
            slides : '> div.views-row',
            speed : animationSpeed,
            swipe : true,
            timeout : 7000,
            'autoHeight' : 'calc',
            pager : '#main-slider-pager',
            prev : 'div.view-slider a.prev',
            next : 'div.view-slider a.next',
            'log' : false,
            pauseOnHover: true
          });
        }

        // blog page slider
        if ($('#block-system-main div.field-name-field-blog-gallery').get(0)) {
          $('#block-system-main div.field-name-field-blog-gallery div.field-items', context)
            .cycle({
              fx : 'scrollHorz',
              speed : animationSpeed,
              swipe : true,
              timeout : 0,
              'autoHeight' : 'calc',
              pager : '#blog-gallery-pager',
              pagerActiveClass : 'active',
              pagerTemplate : '<a href="#" class="grid-6"><img src="{{src}}" alt="" /></a>',
              'log' : false
            });
        }

        // products slider
        if ($('#block-system-main div.field-name-field-product-gallery').get(0)) {
          var $gallery = $('#block-system-main div.field-name-field-product-gallery', context);
          $gallery.attr('id', 'product-gallery').appendTo('#zone-content-wrapper');
          $('#product-gallery').append('<div id="product-gallery-pager"><div class="container-24"><div class="grid-24"></div></div></div>');
          $('#block-system-main').after('<div id="product-nav"><a href="#" class="prev">prev</a><span class="caption"></span><a href="#" class="next">next</a><div class="field button clearfix"><a href="#">' + Drupal.t("To the description") + '</a></div></div>');
          $('#product-gallery').cycle({
            fx : 'scrollHorz',
            slides : '> div.field-items > div.field-item',
            speed : animationSpeed,
            swipe : true,
            timeout : 0,
            prev : '#product-nav a.prev',
            next : '#product-nav a.next',
            caption : '#product-nav span.caption',
            'autoHeight' : 'calc',
            pager : '#product-gallery-pager .grid-24',
            pagerActiveClass : 'active',
            'log' : false
          });
          $(window).load(function() {
            $('#product-gallery img').on('click', function() {
              if (!$('body').hasClass('wide-product-gallery')
                  && !$('body').hasClass('responsive-layout-mobile')) {
                $('#block-system-main').stop(true, true).fadeOut(animationSpeed);
                $('#product-gallery')
                  .stop(true, true).fadeOut(animationSpeed, function() {
                    $('body').addClass('wide-product-gallery');
                      $('#product-gallery').stop(true, true).fadeIn(animationSpeed);
                  });
              }
            });
          });
          $('#product-nav .field a').on('click', function(e) {
            $('#product-gallery').stop(true, true).fadeOut(animationSpeed, function() {
              $('body').removeClass('wide-product-gallery');
              $('#block-system-main').stop(true, true).fadeIn(animationSpeed);
              $('#product-gallery').stop(true, true).fadeIn(animationSpeed);
            });
            e.preventDefault();
          });
        }

        // copy social links in product page
        if ($('.node-product.node-full #social-holder').get(0)) {
          if (!$('.node-product.node-full #social-holder .block').get(0)) {
            $('#section-footer .block.social-links div.content')
              .clone().appendTo('.node-product.node-full #social-holder');
          }
        }
      }
    }
  };

})(jQuery);
