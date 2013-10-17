function setUserSearches(element, user_id){
    var description = new Element('div', {class: 'search_description'});
    new Ajax.Request(
        'http://wowinteractive.com.mx/inmobiliaria_zumo/index.php/UserSearch/getSearchesByUser.json', {
            parameters: {user_id: user_id},
            onSuccess: function(response) {  
                obj = response.responseJSON;                   
                $(obj).each(function(search){
                    search = JSON.parse(search);
                    var item = new Element('div', {class: 'search_item'});
                    item.insert({
                        bottom: new Element('label').update(search.date).observe('click', function(){
                            description.update('');
                            description.insert(new Element('p').update(search.description));
                            description.setStyle({top: (Element.cumulativeOffset(item).top - 110) + 'px'});
                            item.insert(description);
                        })
                    });
                    item.insert({
                        bottom: new Element('img').observe('click', function(){
                            new Ajax.Request(
                                'http://wowinteractive.com.mx/inmobiliaria_zumo/index.php/UserSearch/delete.json', {
                                parameters: {user_search_id: search.id},
                                onSuccess: function(response) {                                      
                                    item.remove();
                                },
                                onFailure: function(){
                                    alert('Ocurrio un problema, intente de nuevo.');
                                }
                            });
                        })
                    });
                    element.insert(item);
                });
            }
        }
    );
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

function setAdder(adder, model, number){
    model['number'] = typeof number != 'undefined' ? number : 0;
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
        if(model.field == 'image' && $('PropertyUserIdDropbox').value.trim().length == 0){
            alert('Debe ingresar el Dropbox ID.');
            $('PropertyUserIdDropbox').focus();
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
        if(model.field == 'image'){
            subAdder.insert({
                top: new Element('input', {
                    type: 'hidden',
                    name: name, 
                    id:   id_text                    
                })
            });
            subAdder.insert({
                top: new Element('a',{
                    href: "#",
                    class: "dropbox-dropin-btn dropbox-dropin-default"                
                }).setStyle({position: 'absolute', top: '0px', width: '86px', 'font-weight': '100'})
                .observe('click', function(){
                    var options = {
                        success: function(files) {                            
                            $(id_text).value = 'https://dl.dropboxusercontent.com/u/'+$('PropertyUserIdDropbox').value+'/'+files[0].name;                            
                            $(id_text + 'imageName').value = files[0].name;
                        },
                        linkType: "direct",
                        multiselect: false,
                        extensions: ['.bmp', '.cr2', '.gif', '.ico', '.ithmb', '.jpeg', '.jpg', '.nef', '.png', '.raw', '.svg', '.tif', '.tiff', '.wbmp', '.webp']
                    };
                    Dropbox.choose(options);
                }).update("Seleccionar").insert({ 
                    top: new Element('span',{
                        class: "dropin-btn-status"
                    })
                })
            });
        }
        subAdder = subAdder.insert({
            top: new Element('input', {
                type:           typeof model.field_type != 'undefined' ? model.field_type : 'text', 
                name:           typeof model.child != 'undefined' || model.field == 'image' ? '' : name, 
                id:             model.field == 'image' ? id_text + 'imageName' : id_text,
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

function createNearPlace(container, newNearPlace){

    var nearPlace = new Element('div', {
        class: 'nearPlace'
    })
    nearPlace.insert({
        bottom: new Element('img', {
            src: newNearPlace.image            
        }).setStyle({position: 'relative'})
    }).insert({
        bottom: new Element('input', {            
            type: 'text',
            placeholder: 'Ingrese el tipo de lugar',
            name: 'data[PropertyNearPlace][' + newNearPlace.number + '][type]',
            id: 'PropertyNearPlace' + newNearPlace.number + 'Type',
            class: 'largeText'
        }).setStyle({top: '-30px', position: 'relative'})
    }).insert({
        bottom: new Element('input', {            
            type: 'text',
            placeholder: 'Ingrese el nombre de lugar',
            name: 'data[PropertyNearPlace][' + newNearPlace.number + '][name]',
            id: 'PropertyNearPlace' + newNearPlace.number + 'Name',
            class: 'largeText'
        }).setStyle({position: 'relative', left: '-312px', top: '-10px'})
    }).insert({
        bottom: new Element('textarea', {            
            type: 'text',
            placeholder: 'Ingrese alguna descripción',
            name: 'data[PropertyNearPlace][' + newNearPlace.number + '][description]',
            id: 'PropertyNearPlace' + newNearPlace.number + 'Description',
            class: 'largeText'
        }).setStyle({position: 'relative', left: '31px', top: '-14px', height: '50px'})
    }).insert({
        bottom: new Element('img', {
            src: 'http://wowinteractive.com.mx/inmobiliaria_zumo/app/webroot/css/img/close_delete.png',
        }).setStyle({
            position: 'relative', 
            left: '340px', top: '-108px', 
            cursor: 'pointer'
        }).observe('click', function(){
            nearPlace.remove();
            newNearPlace.marker.setMap(null);
        })
    }).insert({
        bottom: new Element('input', {
            type: 'hidden',
            name: 'data[PropertyNearPlace][' + newNearPlace.number + '][latitude]',
            id: 'PropertyNearPlace' + newNearPlace.number + 'Latitude',
            value: newNearPlace.latitude
        })
    }).insert({
        bottom: new Element('input', {
            type: 'hidden',
            name: 'data[PropertyNearPlace][' + newNearPlace.number + '][longitude]',
            id: 'PropertyNearPlace' + newNearPlace.number + 'Longitude',
            value: newNearPlace.longitude
        })
    });
    container.insert({bottom: nearPlace});
    new ZumoCompleter('PropertyNearPlace' + newNearPlace.number + 'Type', 
        "autocomplete_types", 
        "http://wowinteractive.com.mx/inmobiliaria_zumo/index.php/PropertyNearPlace/getNearPlaceTypes.json",
        {
        indicator: "indicator1",
        paramName: "type",
        minChars:  1
    });
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

var ZumoSpiner = Class.create();

ZumoSpiner.prototype = {
    step:1,
    element:null,
    initialize: function(element) {
        this.element = element;
        if ($(element).hasAttribute('step')){
            this.step = Number($(element).readAttribute('step'));
        }
        var that = this;
        $(element).select('.spinerControl').each(function(control){
            if($(control).hasClassName('up')){

            $(control).observe('click',function(){
                that.calculateSpiner(that.step);
            });
            }
            if($(control).hasClassName('down')){
                $(control).observe('click',function(){
                    that.calculateSpiner(-that.step);
                });
            }
        });
    },
    calculateSpiner:function(valueToAdd){
        value = Number($(this.element).select('input')[0].value);
        if(value + valueToAdd > 0){
            $(this.element).select('input')[0].value = value + valueToAdd;            
        }
    }
};

var ZumoGridElement = Class.create();

ZumoGridElement.prototype = {
    image:null,
    effect:null,
    initialize: function(element) {
        this.element = element;
        this.image = $(element).select('img')[0];
        var that = this;
        $(element).observe('mouseover',function(){
           if(that.effect!=null) that.effect.cancel();
           that.effect = Effect.Fade(that.image,{ from: 1.0, to: 0.0, duration: 0.5 });
           //$(that.image).({ from: 1.0, to: 0.0, duration: 0.5 });
        });
        $(element).observe('mouseleave',function(){
            if(that.effect!=null) that.effect.cancel();
            $(that.image).setStyle({display:''});
            //Effect.BlindDown(that.image, { duration: 0.3 });
            that.effect = Effect.Fade(that.image,{ from: 0.0, to: 1.0, duration: 0.5 });
        });
    },
}

var ZumoSlider = Class.create();

ZumoSlider.prototype = {
    element:null,
    slider : null, // Scriptaculus slider
    inputs : null, // must be 2 inputs
    options : null,
    initialize:function(element,inputs,options){
        this.element = element;
        this.inputs = inputs;
        this.options = options;
        var that = this;
        this.slider = new Control.Slider($(element).select('.handle'), element, {
            range: $R(0, 8), 
            increment: 1,
            sliderValue: [0, 8],
            onSlide: function(values) {
                valMin = (values.map(Math.round)[0] - this.range.start) / (this.range.end - this.range.start);
                valMin = $(that.element).getWidth() * valMin;
                valMax = (values.map(Math.round)[1] - this.range.start) / (this.range.end - this.range.start);
                valMax = $(that.element).getWidth() * valMax;
                
                id_range.setStyle({
                    'margin-left': valMin + 'px',
                    'width': (valMax - valMin) + 'px'
                });

                for(i=0;i<that.inputs.length;i++){
                    switch(values.map(Math.round)[i]){
                        case this.range.start:
                            $(that.inputs[i]).value = that.options.minLabel;
                        break;
                        case this.range.end:
                            $(that.inputs[i]).value = that.options.maxLabel;
                        break;
                        default:
                            $(that.inputs[i]).value = that.getCurrencyValue(that.options.rangeValues[values.map(Math.round)[i]]);
                        break;
                    }
                }
            },
            restricted: true
        });
    },
    setRangeValues:function(newValue){
       this.options.rangeValues = newValue;
    },
    setConcurrency:function(newValue){
        this.options.concurrency = newValue;
    },
    resetSlider:function(){
        this.slider.setValue(0, 0);
        this.slider.setValue(9, 1);
    },
    getCurrencyValue:function(number){
        return this.options.concurrency.coinSimbol +" "+ number + this.options.concurrency.sufijo;
    }
}
ZumoFirstCheckOnlyElement = Class.create();

ZumoFirstCheckOnlyElement.prototype = {
    firstChecked : true,
    container : null,
    firstElement : null,
    initialize:function(container,firstElement){
        var that = this;
        this.container = container;
        this.firstElement = firstElement;
        $(container).select('input').each(function(element){
            if(element.id!=firstElement){
                $(element).observe('change',function(event){
                    $(firstElement).writeAttribute('checked','');
                    //that.verifySomeOneChecked();
                    that.firstChecked = false;
                });
            }
        });
        $(firstElement).observe('click',function(event){
            if(that.firstChecked){
                event.preventDefault();
            }
            that.firstChecked = true;
            if($(this).readAttribute('checked')){
                $(this).up().select("input").each(function(element){
                    if(element.id!=firstElement)
                        $(element).writeAttribute('checked',"");
                        
                });
            }
        });
    }
}


ZumoTabComponent = Class.create();
ZumoTabComponent.prototype = {
    container:null,
    elementFunctions:null,
    initialize:function(container,functions){
        this.container = container;
        this.elementFunctions = functions;
        var that = this;
        $(container).select('.tab').each(function(tab){

            $(tab).observe('click',function(){
                
                that.updateTabContent(this);

            });
        });
        $(container).select('.tabContent').each(function(tabContent){

            buttonClose = new Element('a', {class: 'closeContainer'});
            $(buttonClose).observe('click',function(){
                that.closeTabs(true);
            });
            $(tabContent).insert( {top:buttonClose });
            $(tabContent).hide();
        });
    },
    updateTabContent:function(element){
        if($(element).hasClassName('active')) return;
        var tabOpenId = $(element).readAttribute('for');
        this.closeTabs(false);
        $(element).addClassName('active');
        $(tabOpenId).addClassName('active');
        Effect.SlideDown(tabOpenId,{ duration: 0.5 });
        if(typeof this.elementFunctions[tabOpenId]!= "undefined")
            this.elementFunctions[tabOpenId].response();
    },
    closeTabs:function(slideUp){
        
        $$('.tab').each(function(t){
            $(t).removeClassName("active");
        });
        $(this.container).select('.tabContent').each(function(tab){
            console.log(tab);
            if(slideUp){
                if($(tab).hasClassName('active'))
                    Effect.SlideUp(tab,{ duration: 0.5 });
            }
            else{
                $(tab).hide();
            }
            $(tab).removeClassName('active');
            
        });
    }
}

ZumoExpander = Class.create();
ZumoExpander.prototype = {
    initialize:function(trigger,expandElement,show,expandEvent){

        $(trigger).observe('click',function(event){
            if($(this).hasClassName('active')){
                $(this).removeClassName('active');
                Effect.SlideUp(expandElement,{ duration: 0.5 });
                event.expanded = false;
            }else{
                $(this).addClassName('active');
                Effect.SlideDown(expandElement,{ duration: 0.5 });
                event.expanded = true;
            }
            if(typeof expandEvent!='undefined')
                expandEvent(event);
        });

        if(!show){
            $(expandElement).hide();
        }
    }
}