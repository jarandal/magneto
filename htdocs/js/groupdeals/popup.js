var Popup = Class.create();
var resizeRunning = false;

Popup.prototype = {
	initialize: function(popupId, params){
        this.popupId = popupId;
		this.browserTypeIE = (navigator.userAgent.match(/msie/i) || navigator.userAgent.match(/trident/i)) ? true : false;
		this.browserVersion = jQueryGD.browser.version;
		this.runHidePopup = true;

        if (params) {
	        if (params.cityCount) {
		        this.cityCount = params.cityCount;
		    }
	        if (params.lastTab) {
	       		this.lastTab = params.lastTab;
	       	}       	
	        if (params.mainDealUrl) {
		        this.mainDealUrl = params.mainDealUrl;
		    }   	
	        if (params.universalUrl) {
		        this.universalUrl = params.universalUrl;
		    }
	    }
    },	
	
	showPopup: function(justResize){
		if (!this.cityCount || this.cityCount>1) {
			//reposition popup;
			if ($(this.popupId+'-popup-content')) {
				var block = $(this.popupId+'-popup-content');
				var blockContainer = $(this.popupId+'-popup-container');
				var viewport = document.viewport.getDimensions(); // Gets the viewport as an object literal
				var width = viewport.width; // Usable window width
				var height = viewport.height; // Usable window height
				
				var boxHeight = block.getHeight();
				var boxWidth = block.getWidth();
				
				var top = boxHeight/2;
			
			    if (boxHeight>=height){
			    	blockContainer.style.position = 'absolute';
			    	block.setStyle({'top' : '0%' });
			    	block.setStyle({'margin' : '50px auto 50px' });
	    			// jQueryGD('html,body').animate({ scrollTop: 0 }, 'slow');
	    			window.scrollTo(0,0);
					
					var documentHeight = jQueryGD(document).height();
					$(this.popupId+'-popup-container').setStyle({ "height" : documentHeight+"px" });
			    } else {
			    	blockContainer.style.position = 'fixed';
			    	block.setStyle({'top' : '50%', 'margin' : '-'+top+'px auto 0'});
					
					var documentHeight = jQueryGD(document).height();
					$(this.popupId+'-popup-container').setStyle({ "height" : 100+"%" });
				}	
				
				//show popup
				$(this.popupId+'-popup-container').setStyle({ "left" : '0' });
					
				//run scale up effect
				if (!justResize) {		
					if (!this.isMobile && !this.isTablet && (!this.browserTypeIE || (this.browserTypeIE && this.browserVersion == 10))) {	
				 		jQueryGD('#'+this.popupId+'-popup-content').addClass('grow');
				 		var self = this;
				 		setTimeout(function(){ jQueryGD('#'+self.popupId+'-popup-content').addClass('shrink-to-normal'); }, 200);
				 	} else if (this.isMobile || this.isTablet) {
					 	jQueryGD('#'+this.popupId+'-popup-content').addClass('grow-mobile');
				 	} else {
					 	jQueryGD('#'+this.popupId+'-popup-content').addClass('shrink-to-normal');
				 	}		 	
				    			 	
				 	//add popup background if enabled
					if (this.browserTypeIE && this.browserVersion <= 8) {					
				    	jQueryGD('#gd-popup-wrapper-bkg').show();
					} else {				
				    	jQueryGD('#gd-popup-wrapper-bkg').fadeIn(300);
					}
				}

				if (!resizeRunning) {
					var self = this;
					jQueryGD(window).resize(function() {
					 	resizeRunning = true;
					 	self.showPopup(true);
					});
				}
			}
		} else {
			window.location = this.mainDealUrl;
		}
	},

	hidePopup: function(){	
		if (this.runHidePopup) {			
		   	jQueryGD('#gd-popup-wrapper-bkg').hide();				
					
			jQueryGD('#'+this.popupId+'-popup-content').removeClass('grow');	
			jQueryGD('#'+this.popupId+'-popup-content').removeClass('grow-mobile');
			jQueryGD('#'+this.popupId+'-popup-content').removeClass('shrink-to-normal');
		 	$(this.popupId+'-popup-container').setStyle({ "left" : '-999999px' }); 
		} else {
			this.runHidePopup = true;
		}
	},
	
	//popup tab functions
	nextTab: function(tabName) {
		if ($(this.lastTab)) {
			$(this.lastTab).className = 'tab';			
			Element.addClassName(this.lastTab+'_data', 'hide');	
		}
		if ($('universal')) {
			$('universal').className = 'tab';
		}
		$(tabName).className='tab_hover';
		if (tabName!='universal') {
			Element.removeClassName(tabName+'_data','hide');
		}
		this.lastTab=tabName;

		jQueryGD('#countrySelect option[value="'+tabName+'"]').attr('selected', 'selected');
		
		if (tabName=='universal') {
			window.location.href = this.universalUrl;
		}

		this.showPopup(true);
	}
}

var Gift = Class.create();
Gift.prototype = {
	initialize: function(form, urls){
        this.form = form;
        this.saveUrl = urls.saveUrl;
        this.failureUrl = urls.failureUrl;
        this.onSave = this.save.bindAsEventListener(this);
        
        if ($(this.form)) {
            $(this.form).observe('submit', function(event){this.saveGift();Event.stop(event);}.bind(this));
        }
        
        if ($('coupon_to_email') && $('coupon_to_email').value=='' && $('coupon_from').value!=''){
			$('email_radio2').checked='checked';
			$('coupon_to_email').disabled='disabled';
			$('coupon_to_email').removeClassName('required-entry');
		}
    },	

	enableEmail: function() {
		$('coupon_to_email').disabled='';
		$('coupon_to_email').addClassName('required-entry');
		$('coupon_to_email').addClassName('validate-email'); 	
		$('gift-email-to').show();
	},	

	disableEmail: function() {
		$('coupon_to_email').disabled='disabled';
		$('coupon_to_email').removeClassName('required-entry'); 
		$('coupon_to_email').removeClassName('validate-email'); 		
		if ($('advice-required-entry-coupon_to_email')) {
			$('advice-required-entry-coupon_to_email').style.display='none';
		}
		$('coupon_to_email').value = '';
		$('gift-email-to').hide();
	},	
	
	checkMaxLength: function(Object, MaxLen) {
        if (Object.value.length > MaxLen-1) {
            Object.value = Object.value.substr(0, MaxLen);
        }
        return 1;
    },
	
	updateButtons: function(){	
		Element.show('gift-buttons');
		jQueryGD('#gift-please-wait').hide();	
		Element.show('gift-link');
		jQueryGD('#gift-link-please-wait').hide();	
	},
        
	save: function(transport){
		if (transport && transport.responseText){
            try{
                response = eval('(' + transport.responseText + ')');
            }
            catch (e) {
            	alert(e);
                response = {};
            }
        }

        if (response.error){
            alert(response.message);				
            this.updateButtons();
            return false;
        }
        
        if (this.type=='remove') {
			$('coupon_from').value='';
			$('coupon_to').value='';
			$('coupon_to_email').value='';
			$('coupon_message').value='';
		}
		
		if (response.update_section) {
			$(response.update_section.name).update(response.update_section.html);
		}
							
        this.updateButtons();	
		giftPopup.hidePopup();
	},	
	
	failure: function(){	
		location.href = this.failureUrl;
	},
	
	removeGift: function(){
		var params = new Array();
	    params['coupon_from'] = '';
	    params['coupon_to'] = '';
	    params['coupon_to_email'] = '';
	    params['coupon_message'] = '';
	    this.type = 'remove';
		Element.hide('gift-link');
		jQueryGD('#gift-link-please-wait').show();
        var request = new Ajax.Request(
        	this.saveUrl,
        	{
    	        method:'post',
    	        onSuccess: this.onSave,
    	        onFailure: this.failure.bind(this),
    	        parameters: params
    	    }
    	);    	
    },
	
	saveGift: function(){
        var validator = new Validation(this.form);
        if (validator.validate()) {
			Element.hide('gift-buttons');
			jQueryGD('#gift-please-wait').show();	
			this.type = 'save';
        	var request = new Ajax.Request(
        	    this.saveUrl,
        	    {
        	        method:'post',
        	        onSuccess: this.onSave,
        	        onFailure: this.failure.bind(this),
        	        parameters: Form.serialize(this.form)
        	    }
        	);
        }
    }
}

