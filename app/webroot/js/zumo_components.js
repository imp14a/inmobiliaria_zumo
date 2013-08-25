
function createSlider(slider,options,onChangeEvent){    

    return new Control.Slider(slider.select('.handle'), slider, {
        range: $R(options.min, options.max),
        increment: options.step,
        sliderValue: [options.min, options.max],
        //onChange: onChangeEvent,
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
            onChangeEvent(values);
        },
        restricted: true
    });

}

function createUbicationAjaxSelects(state,municipality,quarter){

    $(state).observe('change',function(){
        new Ajax.Request(
            'http://wowinteractive.com.mx/inmobiliaria_zumo/index.php/PropertyAddress/getMunicipalityForState.json', {
                parameters: {state: $(state).value},
                onSuccess: function(response) {
                    obj = response.responseJSON;
                    $(municipality).update();
                    $(quarter).update();

                    $(municipality).insert({
                        bottom: new Element('option', {value: ''}).update('')
                    });

                    $(obj).each(function(value){
                        console.log(value);
                        $(municipality).insert({
                            bottom: new Element('option', {value: value}).update(value)
                        });
                    });
                }
            }
        );
    });

    $(municipality).observe('change',function(){
        new Ajax.Request(
            'http://wowinteractive.com.mx/inmobiliaria_zumo/index.php/PropertyAddress/getQuartersForMunicipality.json', {
                parameters: {municipality: $(municipality).value},
                onSuccess: function(response) {
                    obj = response.responseJSON;
                    $(quarter).update();
                    $(quarter).insert({
                        bottom: new Element('option', {value: ''}).update('')
                    });

                    $(obj).each(function(value){
                        console.log(value);
                        $(quarter).insert({
                            bottom: new Element('option', {value: value}).update(value)
                        });
                    });
                }
            }
        );
    });
}