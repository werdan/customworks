(function ($) {
  Drupal.behaviors.customWorksGmap = {
    attach: function(context, settings) {
        // Map options.
        // This custom javascript files builds the Google Map using the Google
        // Maps Javascript API v3. Google Maps options
        // (https://developers.google.com/maps/documentation/javascript/reference)
        // and examples
        // (https://developers.google.com/maps/documentation/javascript/examples/)
        // are available on the official page
        // (https://developers.google.com/maps/documentation/javascript/).
        var map;
        var latitude = parseFloat($('#contact-popup').data('latitude'));
        var longitude = parseFloat($('#contact-popup').data('longitude'));
        var location = new google.maps.LatLng(latitude, longitude);

        var featureOpts = [
          {
            // featureType: 'administrative.locality',
            elementType: 'labels',
            stylers: [
              { color: '#ffffff' }
            ]
          },
          {
            elementType: 'labels.icon',
            stylers: [
              { visibility: 'off' }
            ]
          },
          {
            elementType: 'labels.text.stroke',
            stylers: [
              { visibility: 'off' }
            ]
          },
          {
            featureType: 'all',
            elementType: 'all',
            stylers: [
              { hue: '#000000' },
              { saturation: '-100' },
              { lightness: '-12' },
              { gamma: 0.1 }
            ]
          }
        ];
        var mapOptions = {
          zoom: 15,
          scrollwheel : true,
          center: location,
          mapTypeControlOptions: {
            mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'custom_style']
          },
          mapTypeId: 'custom_style',
          disableDefaultUI: true
        };

        // Build the map and marker.
        map = new google.maps.Map(document.getElementById("contact-map"), mapOptions);
        var styledMapOptions = {
          name: 'Custom Style'
        };
        var customMapType = new google.maps.StyledMapType(featureOpts, styledMapOptions);
        map.mapTypes.set('custom_style', customMapType);
        map.setMapTypeId('custom_style');
        var infoText = '<div class="infobubble">';
            infoText += '<div class="outerContainer">';
            infoText += '<div class="innerContainer">';
            infoText += $('#contact-popup').html();
            infoText += '</div>';
            infoText += '</div>';
            infoText += '</div>';

        var infoBubble = new InfoBubble({
          map: map,
          content: infoText,
          position: location,
          hideCloseButton: true,
          shadowStyle: 0,
          padding: 0,
          borderRadius: 0,
          borderWidth: 0,
          arrowSize: 0,
          maxWidth: 216,
          minWidth: 216,
          maxHeight: 273,
          minHeight: 273,
          arrowPosition: 50 + '%',
          backgroundColor: 'transparent'
          // borderColor: 'transparent'
        });

        if (!infoBubble.isOpen()) {
          infoBubble.open();
        }
    }
  };
})(jQuery);
