(function() {
    var slider = $('slider');
    var id_range = $('id_range');
    var max;
    var min; 

    new Control.Slider(slider.select('.handle'), slider, {
      range: $R(0, 255),
      sliderValue: [0, 255],
      onSlide: function(values) {
        max = values.map(Math.round)[1] >= values.map(Math.round)[0] ? values.map(Math.round)[1] : values.map(Math.round)[0];
        min = values.map(Math.round)[1] <= values.map(Math.round)[0] ? values.map(Math.round)[1] : values.map(Math.round)[0];
    id_range.setStyle({
      'margin-left': min + 'px',
      'width': (max - min) + 'px'
    });
      }
    });
  })();