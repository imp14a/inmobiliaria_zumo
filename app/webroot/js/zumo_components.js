
function createSlider(slider,options,onChangeEvent){    

    return new Control.Slider(slider.select('.handle'), slider, {
        range: $R(options.min, options.max),
        increment: options.step,
        sliderValue: [options.min, options.max],
        onChange: onChangeEvent,
        onSlide: function(values) {

            valMin = values.map(Math.round)[0] - this.range.start;
            valMin = valMin / (this.range.end - this.range.start);
            valMin = $(slider).getWidth() * valMin;

            valMax = values.map(Math.round)[1] - this.range.start;
            valMax = valMax / (this.range.end - this.range.start);
            valMax = $(slider).getWidth() * valMax;

            
            id_range.setStyle({
                'margin-left': valMin + 'px',
                'width': (valMax - valMin) + 'px'
            });
        },
        restricted: true
    });

}