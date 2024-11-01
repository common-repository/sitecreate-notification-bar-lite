/**!
 * wp-color-picker-alpha
 *
 * Overwrite Automattic Iris for enabled Alpha Channel in wpColorPicker
 * Only run in input and is defined data alpha in true
 *
 * Version: 1.2.2
 * https://github.com/23r9i0/wp-color-picker-alpha
 * Copyright (c) 2015 Sergio P.A. (23r9i0).
 * Licensed under the GPLv2 license.
 */
!function(t){var o="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAIAAAHnlligAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAHJJREFUeNpi+P///4EDBxiAGMgCCCAGFB5AADGCRBgYDh48CCRZIJS9vT2QBAggFBkmBiSAogxFBiCAoHogAKIKAlBUYTELAiAmEtABEECk20G6BOmuIl0CIMBQ/IEMkO0myiSSraaaBhZcbkUOs0HuBwDplz5uFJ3Z4gAAAABJRU5ErkJggg==",i='<a tabindex="0" class="wp-color-result" />',e='<div class="wp-picker-holder" />',r='<div class="wp-picker-container" />',a='<input type="button" class="button button-small hidden" />';Color.fn.toString=function(){if(this._alpha<1)return this.toCSS("rgba",this._alpha).replace(/\s+/g,"");var t=parseInt(this._color,10).toString(16);return this.error?"":(t.length<6&&(t=("00000"+t).substr(-6)),"#"+t)},t.widget("wp.wpColorPicker",t.wp.wpColorPicker,{_create:function(){if(t.support.iris){var n=this,s=n.element;t.extend(n.options,s.data()),n.close=t.proxy(n.close,n),n.initialValue=s.val(),s.addClass("wp-color-picker").hide().wrap(r),n.wrap=s.parent(),n.toggler=t(i).insertBefore(s).css({backgroundColor:n.initialValue}).attr("title",wpColorPickerL10n.pick).attr("data-current",wpColorPickerL10n.current),n.pickerContainer=t(e).insertAfter(s),n.button=t(a),n.options.defaultColor?n.button.addClass("wp-picker-default").val(wpColorPickerL10n.defaultString):n.button.addClass("wp-picker-clear").val(wpColorPickerL10n.clear),s.wrap('<span class="wp-picker-input-wrap" />').after(n.button),s.iris({target:n.pickerContainer,hide:n.options.hide,width:n.options.width,mode:n.options.mode,palettes:n.options.palettes,change:function(i,e){n.options.alpha?(n.toggler.css({"background-image":"url("+o+")"}).html("<span />"),n.toggler.find("span").css({width:"100%",height:"100%",position:"absolute",top:0,left:0,"border-top-left-radius":"3px","border-bottom-left-radius":"3px",background:e.color.toString()})):n.toggler.css({backgroundColor:e.color.toString()}),t.isFunction(n.options.change)&&n.options.change.call(this,i,e)}}),s.val(n.initialValue),n._addListeners(),n.options.hide||n.toggler.click()}},_addListeners:function(){var o=this;o.wrap.on("click.wpcolorpicker",function(t){t.stopPropagation()}),o.toggler.on("click",function(){o.toggler.hasClass("wp-picker-open")?o.close():o.open()}),o.element.on("change",function(i){(""===t(this).val()||o.element.hasClass("iris-error"))&&(o.options.alpha?(o.toggler.removeAttr("style"),o.toggler.find("span").css("backgroundColor","")):o.toggler.css("backgroundColor",""),t.isFunction(o.options.clear)&&o.options.clear.call(this,i))}),o.toggler.on("keyup",function(t){13!==t.keyCode&&32!==t.keyCode||(t.preventDefault(),o.toggler.trigger("click").next().focus())}),o.button.on("click",function(i){t(this).hasClass("wp-picker-clear")?(o.element.val(""),o.options.alpha?(o.toggler.removeAttr("style"),o.toggler.find("span").css("backgroundColor","")):o.toggler.css("backgroundColor",""),t.isFunction(o.options.clear)&&o.options.clear.call(this,i)):t(this).hasClass("wp-picker-default")&&o.element.val(o.options.defaultColor).change()})}}),t.widget("a8c.iris",t.a8c.iris,{_create:function(){if(this._super(),this.options.alpha=this.element.data("alpha")||!1,this.element.is(":input")||(this.options.alpha=!1),"undefined"!=typeof this.options.alpha&&this.options.alpha){var o=this,i=o.element,e='<div class="iris-strip iris-slider iris-alpha-slider"><div class="iris-slider-offset iris-slider-offset-alpha"></div></div>',r=t(e).appendTo(o.picker.find(".iris-picker-inner")),a=r.find(".iris-slider-offset-alpha"),n={aContainer:r,aSlider:a};"undefined"!=typeof i.data("custom-width")?o.options.customWidth=parseInt(i.data("custom-width"))||0:o.options.customWidth=100,o.options.defaultWidth=i.width(),(o._color._alpha<1||-1!=o._color.toString().indexOf("rgb"))&&i.width(parseInt(o.options.defaultWidth+o.options.customWidth)),t.each(n,function(t,i){o.controls[t]=i}),o.controls.square.css({"margin-right":"0"});var s=o.picker.width()-o.controls.square.width()-20,l=s/6,c=s/2-l;t.each(["aContainer","strip"],function(t,i){o.controls[i].width(c).css({"margin-left":l+"px"})}),o._initControls(),o._change()}},_initControls:function(){if(this._super(),this.options.alpha){var t=this,o=t.controls;o.aSlider.slider({orientation:"vertical",min:0,max:100,step:1,value:parseInt(100*t._color._alpha),slide:function(o,i){t._color._alpha=parseFloat(i.value/100),t._change.apply(t,arguments)}})}},_change:function(){this._super();var t=this,i=t.element;if(this.options.alpha){var e=t.controls,r=parseInt(100*t._color._alpha),a=t._color.toRgb(),n=["rgb("+a.r+","+a.g+","+a.b+") 0%","rgba("+a.r+","+a.g+","+a.b+", 0) 100%"],s=t.options.defaultWidth,l=t.options.customWidth,c=t.picker.closest(".wp-picker-container").find(".wp-color-result");e.aContainer.css({background:"linear-gradient(to bottom, "+n.join(", ")+"), url("+o+")"}),c.hasClass("wp-picker-open")&&(e.aSlider.slider("value",r),t._color._alpha<1?(e.strip.attr("style",e.strip.attr("style").replace(/rgba\(([0-9]+,)(\s+)?([0-9]+,)(\s+)?([0-9]+)(,(\s+)?[0-9\.]+)\)/g,"rgb($1$3$5)")),i.width(parseInt(s+l))):i.width(s))}var p=i.data("reset-alpha")||!1;p&&t.picker.find(".iris-palette-container").on("click.palette",".iris-palette",function(){t._color._alpha=1,t.active="external",t._change()})},_addInputListeners:function(t){var o=this,i=100,e=function(i){var e=new Color(t.val()),r=t.val();t.removeClass("iris-error"),e.error?""!==r&&t.addClass("iris-error"):e.toString()!==o._color.toString()&&("keyup"===i.type&&r.match(/^[0-9a-fA-F]{3}$/)||o._setOption("color",e.toString()))};t.on("change",e).on("keyup",o._debounce(e,i)),o.options.hide&&t.on("focus",function(){o.show()})}})}(jQuery),jQuery(document).ready(function(t){t(".color-picker").wpColorPicker()});

function scnb_makeid() {
  var text = "";
  var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

  for (var i = 0; i < 10; i++)
    text += possible.charAt(Math.floor(Math.random() * possible.length));

  return text;
}

jQuery(window).load(function() {

	jQuery('.wp-color-picker-field').wpColorPicker();

	jQuery(function() {  

	    jQuery('a.nav-tab').live('click', function(e) {
	    	e.preventDefault();
	    	var href = jQuery(this).attr('href');
	    	//console.log(href);
	    	jQuery('a.nav-tab').removeClass('active');
	    	jQuery(this).addClass('active');
	    	jQuery('#notifications, #settings, #social, #styling, #upgrade').fadeOut(300);
	    	jQuery('#sc-settings-wrapper').find(href).delay(301).fadeIn(300);
	    });

	    jQuery('#refresh-cookie').live('click', function(e) {
	    	e.preventDefault();
	    	var input = jQuery(this).parent().find('[name="sc_notification_options[cookie_name]"]');
	    	var randomID = scnb_makeid();
	    	jQuery(input).val('sc-notification-cookie-' + randomID);
	    });
	    
	});	    

});
