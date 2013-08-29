
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
    $(state).observe('change',function(){
        var parametersForState = null;
        if(typeof showAll!='undefined')
            parametersForState = {state: $(state).value,showAll:true};
        else
            parametersForState = {state: $(state).value};
        
        new Ajax.Request(
            'http://wowinteractive.com.mx/inmobiliaria_zumo/index.php/PropertyAddress/getMunicipalityForState.json', {
                parameters: parametersForState,
                onSuccess: function(response) {                                        
                    obj = response.responseJSON;                   
                    $(municipality).update();
                    if(typeof quarter!='undefined' && quarter!=null)
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

function setAdder(adder, label, model){
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
        var subAdder = new Element('div', {class: typeof model.class != 'undefined' ? 'upload' : 'addText'});
        adder.insert({bottom: subAdder.insert({
            top: new Element('input', {type: typeof model.field_type != 'undefined' ? model.field_type : 'text', name:name, id:id_text})}).insert({
                    bottom: new Element('img', {
                        src: 'http://wowinteractive.com.mx/inmobiliaria_zumo/app/webroot/css/img/close_delete.png'
                    }).observe('click', function(){
                        $(id_text).remove();
                        this.remove();
                    })
                })
            });
            model.number++;
            if(typeof model.field_type != 'undefined' && model.field_type == 'file'){
                subAdder.insert({
                    top: new Element('label').update('Seleccione')
                });
            }
        });
    adder.insert({top: addDiv});
}

function createFirstCheckOnlyElement(container,firstElement){
    $(container).select('input').each(function(element){
        if(element.id!=firstElement){
            $(element).observe('change',function(){
                $(firstElement).writeAttribute('checked','');
            });
        }
    });

    $(firstElement).observe('change',function(){
        if($(this).readAttribute('checked')){
            $(this).up().select("input").each(function(element){
                if(element.id!=firstElement)
                    $(element).writeAttribute('checked','');
            });
        }
    });
}

function createExpandElement(button,expandElement,show,expandEvent){
    $(button).observe('click',function(event){
        if($(this).hasClassName('active')){
            $(this).removeClassName('active');
            Effect.SlideUp(expandElement);
            event.expanded = false;
        }else{
            $(this).addClassName('active');
            Effect.SlideDown(expandElement);
            event.expanded = true;
        }
        expandEvent(event);
    });

    if(!show){
        $(expandElement).hide();
    }
}