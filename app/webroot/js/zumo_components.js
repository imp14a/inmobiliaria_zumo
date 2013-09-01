
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

function setAdder(adder, model){
    model['number'] = 0;
    var id_text1;
    var id_text;
    var addDiv = new Element('div', {class: 'addDiv', 'style': model.isChild ? 'margin-left: 10px' : 'margin-left: 0px'}).insert({
        bottom: new Element('label', {}).update(model.label)
    });
    addDiv.observe('click', function(){
        if(model.isChild && $(model.parent.id).value.trim().length == 0){
            alert('Debe ingresar el nombre de la categoría.');
            $(model.parent.id).focus();
            return;
        }
        var name = 'data[' + model.name + '][' + model.number + '][' + model.field + ']';
        var id_text_aux = model.field.split('_');
        id_text = model.name + model.number;
        id_text_aux.each(function(value){
            id_text += value.substr(0,1).toUpperCase() + value.substr(1,value.length).toLowerCase();
        });
        id_text += typeof model.child != 'undefined' ? '_parent' : '';
        model['id'] = id_text;
        var subAdder = new Element('div', {class: typeof model.class != 'undefined' ? model.class : 'addText'});
        if(typeof model.parent != 'undefined'){
            var name1 = 'data[' + model.parent.name + '][' + model.number + '][' + model.parent.field + ']';
            var id_text_aux1 = model.parent.field.split('_');
            id_text1 = model.parent.name + model.number;
            id_text_aux1.each(function(value){
                id_text1 += value.substr(0,1).toUpperCase() + value.substr(1,value.length).toLowerCase();
            });
            subAdder.insert({
                top: new Element('input',{
                    type: 'hidden', 
                    name: name1, 
                    id:   id_text1
                })
            });
        }  
        subAdder = subAdder.insert({
            top: new Element('input', {
                type:           typeof model.field_type != 'undefined' ? model.field_type : 'text', 
                name:           typeof model.child != 'undefined' ? '' : name, 
                id:             id_text,
                placeholder:    typeof model.placeholder != 'undefined' ? model.placeholder : '', 
                bro_id:         typeof model.parent != 'undefined' ? id_text1 : '',
                parent_id:      typeof model.parent != 'undefined' ? model.parent.id : ''
            }).observe('change', function(){
                if(typeof model.parent != 'undefined'){
                    $(this.readAttribute('bro_id')).value = $(this.readAttribute('parent_id')).value;
                }   
            })                                   
        }).insert({
            bottom: new Element('img', {
                src: 'http://wowinteractive.com.mx/inmobiliaria_zumo/app/webroot/css/img/close_delete.png'
                }).observe('click', function(){
                    subAdder.remove();
                })
            });             
        if(typeof model.field_type != 'undefined' && model.field_type == 'file'){
            subAdder.insert({
                top: new Element('label', {for: id_text}).update('Seleccione')
            });
        }
        if(typeof model.child != null && typeof model.child != 'undefined'){
            model.child['isChild'] = true;
            model.child['parent'] = model;
            setAdder(subAdder, model.child)
        }
        adder.insert({bottom: subAdder});
        //  Autocompleters
        if(typeof model.autocomplete_srv != 'undefined'){
            new ZumoCompleter(id_text, model.autocomplete_id, 
            "http://wowinteractive.com.mx/inmobiliaria_zumo/index.php/" + model.autocomplete_srv + ".json", {
                indicator: model.autocomplete_indicator,
                paramName: model.autocomplete_paramName,
                minChars:  1
            });
        } 
        model.number++;        
    });
    adder.insert({bottom: addDiv});
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

var ZumoCompleter = Class.create(Ajax.Autocompleter, {

    initialize: function($super, id_search, id_list, url, options) {
        $super(id_search, id_list, url, options);
    },

    onComplete: function(response) {
        var text = response.responseText;
        if (text.isJSON()) {
            this.handleJSON(text.evalJSON());
        }
    },

    handleJSON: function(json) {
        var htmlStr = '<ul>';
        json.each(function(item) {
            htmlStr += '<li>';
            htmlStr += item;
            htmlStr += '</li>';
        });
        htmlStr += '</ul>';
        this.updateChoices(htmlStr);
    }

});