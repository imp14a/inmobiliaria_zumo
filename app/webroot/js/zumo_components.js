
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

function createUbicationAjaxSelects(state,municipality,quarter,showAll){


    var parametersForState = null;
    if(typeof showAll!='undefined')
        parametersForState = {state: $(state).value,showAll:true};
    else
        parametersForState = {state: $(state).value};

    $(state).observe('change',function(){
        new Ajax.Request(
            'http://wowinteractive.com.mx/inmobiliaria_zumo/index.php/PropertyAddress/getMunicipalityForState.json', {
                parameters: parametersForState,
                onSuccess: function(response) {
                    obj = response.responseJSON;
                    $(municipality).update();
                    $(quarter).update();

                    $(municipality).insert({
                        bottom: new Element('option', {value: ''}).update('')
                    });

                    $(obj).each(function(value){
                        $(municipality).insert({
                            bottom: new Element('option', {value: value}).update(value)
                        });
                    });
                }
            }
        );
    });

    if(typeof quarter!='undefined' && quarter!=null){
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
                            $(quarter).insert({
                                bottom: new Element('option', {value: value}).update(value)
                            });
                        });
                    }
                }
            );
        });
    }
    
}

function setAdder(adder, label, model, child){
    model['number'] = 0;
    var addDiv = new Element('div', {class: 'addDiv'}).insert({
        bottom: new Element('label', {}).update(label)
    });
    addDiv.observe('click', function(){
        var name = 'data[' + model.name + '][' + model.number + '][' + model.field + ']';
        var id_text_aux = model.field.split('_');
        var id_text = model.name + model.number;
        id_text_aux.each(function(value){
            id_text += value.substr(0,1).toUpperCase() + value.substr(1,value.length).toLowerCase();
        });
        adder.insert({bottom: new Element('div', {class: 'addText'}).insert({
            top: new Element('input', {type: 'text', name:name, id:id_text})}).insert({
                    bottom: new Element('img', {
                        src: 'http://wowinteractive.com.mx/inmobiliaria_zumo/app/webroot/css/img/close_delete.png'
                    }).observe('click', function(){
                        $(id_text).remove();
                        this.remove();
                    })
                })
            });
            model.number++;
        });
    adder.insert({top: addDiv});
}

function createExpandElement(button,expandElement,show){
    $(button).observe('click',function(){
        console.log('asdasdhajkdahlsjk');
    });
}