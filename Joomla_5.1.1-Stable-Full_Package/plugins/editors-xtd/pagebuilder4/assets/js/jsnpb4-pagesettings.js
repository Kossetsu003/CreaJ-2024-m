/**
 * @version    $Id$
 * @package    JSN_PageBuilder_4
 * @author     JoomlaShine Team <support@joomlashine.com>
 * @copyright  Copyright (C) 2012 JoomlaShine.com. All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 *
 * Websites: http://www.joomlashine.com
 * Technical Support:  Feedback - http://www.joomlashine.com/contact-us/get-support.html
 */
window.JSNPB4PageSettings = { 
	extension: "",
	updatePageSettings: function(type, value) {
		
		switch(this.extension) {
			case "com_content":
				this.updateArticlePageSettings(type, value);
				break;
			case "com_k2":
				this.updateK2PageSettings(type, value);
				break;
			case "com_modules":				
				this.updateModulePageSettings(type, value);
				break;			
			default:
				this.updatePlaceHolderPageSettings(type, value);
			break;
		}	
	},
	updatePlaceHolderPageSettings: function (type, value) {
		return;
	},
	updateModulePageSettings: function (type, value) {
		switch(type) {
			case "title":
				var titleField = document.getElementById('jform_title');
				titleField.value = value;
				break;
			case "header-class":
				var headerClassField = document.getElementById('jform_params_header_class');
				headerClassField.value = value;
				break;
			case "moduleclass-sfx":
				var classSuffixField = document.getElementById('jform_params_moduleclass_sfx');
				classSuffixField.value = value;
				break;				
			case "show-title":
			    var showTitleRadios = document.getElementsByName('jform[showtitle]');
			    var showTitleRadiosChecked = 0;
			    for (var j = 0; j < showTitleRadios.length; j++) {
			        if (showTitleRadios[j].value == value) {
			        	showTitleRadios[j].checked = true;			        	
			        	showTitleRadiosChecked = j;
			            break;
			        }
			    }
			    
			    for (var j = 0; j < showTitleRadios.length; j++) 
			    {
			    	var nextSibling = showTitleRadios[j].nextSibling;
			    	
			    	while(nextSibling && nextSibling.nodeType != 1) {
			    	    nextSibling = nextSibling.nextSibling
			    	}
			    	
			    	if (nextSibling.tagName == 'LABEL' )
			    	{
				    	if (showTitleRadiosChecked == j && value == 1)
			    		{
				    		nextSibling.className = 'btn active btn-success';
			    		}
				    	else if (showTitleRadiosChecked == j && value == 0)
			    		{
				    		nextSibling.className = 'btn active btn-danger';
			    		}
				    	else
			    		{
				    		nextSibling.className = 'btn';
			    		}
			    	}
			    	
			    }    
				break;
			case "status":
				var statusField = document.getElementById('jform_published');
				var statusElField = 0;
				for (var i = 0; i < statusField.options.length; i++)
				{
					if (statusField.options[i].value == value){
						statusElField = i;
						break;
					}
				}
				statusField.selectedIndex = statusElField;
				
				try 
				{
					document.getElementById("jform_published").dispatchEvent(new Event("liszt:updated"));
					document.getElementById("jform_published").dispatchEvent(new Event("change"));
				}
				catch(err) {
					//do nothing
				}
				
				break;		
			case "position":
				var positionField = document.getElementById('jform_position');
				var positionElField = 0;
				
				for (var i = 0; i < positionField.options.length; i++)
				{
					if (positionField.options[i].value == value){
						positionElField = i;
						break;
					}
				}
				
				positionField.selectedIndex = positionElField;
				
				try 
				{
					document.getElementById("jform_position").dispatchEvent(new Event("liszt:updated"));
					document.getElementById("jform_position").dispatchEvent(new Event("change"));
				}
				catch(err) {
					//do nothing
				}
				
				break;				
			case "access":
				var accessField = document.getElementById('jform_access');
				var accessElField = 0;
				for (var i = 0; i < accessField.options.length; i++)
				{
					if (accessField.options[i].value == value){
						accessElField = i;
						break;
					}
				}
				
				accessField.selectedIndex = accessElField;
				
				try 
				{
					document.getElementById("jform_access").dispatchEvent(new Event("liszt:updated"));
					document.getElementById("jform_access").dispatchEvent(new Event("change"));
				}
				catch(err) {
					//do nothing
				}
				
				break;
			case "prepare-content":
			    var prepareContentRadios = document.getElementsByName('jform[params][prepare_content]');
			    var prepareContentRadiosChecked = 0;
			    for (var j = 0; j < prepareContentRadios.length; j++) {
			        if (prepareContentRadios[j].value == value) {
			        	prepareContentRadios[j].checked = true;
			        	prepareContentRadiosChecked = j;
			            break;
			        }
			    }
			    
			    for (var j = 0; j < prepareContentRadios.length; j++) 
			    {
			    	var nextSibling = prepareContentRadios[j].nextSibling;
			    	
			    	while(nextSibling && nextSibling.nodeType != 1) {
			    	    nextSibling = nextSibling.nextSibling
			    	}
			    	
			    	if (nextSibling.tagName == 'LABEL')
			    	{
				    	if (prepareContentRadiosChecked == j && value == 1)
			    		{
				    		nextSibling.className = 'btn active btn-success';
			    		}
				    	else if (prepareContentRadiosChecked == j && value == 0)
			    		{
				    		nextSibling.className = 'btn active btn-danger';
			    		}
				    	else
			    		{
				    		nextSibling.className = 'btn';
			    		}
			    	}
			    	
			    }	    
				break;				
			default:
				// do nothing
			break;
		}		
	},
	
	updateK2PageSettings: function (type, value) {
		switch(type) {
			case "title":
				var titleField = document.getElementById('title');
				titleField.value = value;
				break;
			case "alias":
				var aliasField = document.getElementById('alias');
				aliasField.value = value;
				break;
			case "status":
			    var statusRadios = document.getElementsByName('published');
			    var statusRadiosChecked = 0;
			    for (var j = 0; j < statusRadios.length; j++) {
			        if (statusRadios[j].value == value) {
			        	statusRadios[j].checked = true;
			        	statusRadiosChecked = j;
			            break;
			        }
			    }
			    
			    for (var j = 0; j < statusRadios.length; j++) 
			    {
			    	var closestElement = statusRadios[j].closest('label');
			    	if (closestElement.tagName == 'LABEL')
			    	{
				    	if (statusRadiosChecked == j && value == 1)
			    		{
				    		closestElement.className = 'radio isChecked';
			    		}
				    	else if (statusRadiosChecked == j && value == 0)
			    		{
				    		closestElement.className = 'radio isChecked';
			    		}
				    	else
			    		{
				    		closestElement.className = 'radio';
			    		}	
			    	}
			    }
				
				break;	
			case "category":
				var categoryField = document.getElementById('catid');
				var categoryElField = 0;
				
				for (var i = 0; i < categoryField.options.length; i++)
				{
					if (categoryField.options[i].value == value){
						categoryElField = i;
						break;
					}
				}
				
				categoryField.selectedIndex = categoryElField;
				
				try 
				{
					document.getElementById("catid").dispatchEvent(new Event("liszt:updated"));
					document.getElementById("catid").dispatchEvent(new Event("change"));
				}
				catch(err) {
					//do nothing
				}
				
				break;
			case "featured":
			    var featuredRadios = document.getElementsByName('featured');
			    var featuredRadiosChecked = 0;
			    for (var j = 0; j < featuredRadios.length; j++) {
			        if (featuredRadios[j].value == value) {
			        	featuredRadios[j].checked = true;
			        	featuredRadiosChecked = j;
			            break;
			        }
			    }
			    
			    for (var j = 0; j < featuredRadios.length; j++) 
			    {
			    	var closestElement = featuredRadios[j].closest('label');
			    	
			    	if (closestElement.tagName == 'LABEL')
			    	{
				    	if (featuredRadiosChecked == j && value == 1)
			    		{
				    		closestElement.className = 'radio isChecked';
			    		}
				    	else if (featuredRadiosChecked == j && value == 0)
			    		{
				    		closestElement.className = 'radio isChecked';
			    		}
				    	else
			    		{
				    		closestElement.className = 'radio';
			    		}			    		
			    		
			    	}
			    }		    
				break;
			case "access":
				var accessField = document.getElementById('access');
				var accessElField = 0;
				for (var i = 0; i < accessField.options.length; i++)
				{
					if (accessField.options[i].value == value){
						accessElField = i;
						break;
					}
				}
				
				accessField.selectedIndex = accessElField;
				
				try 
				{
					document.getElementById("access").dispatchEvent(new Event("liszt:updated"));
					document.getElementById("access").dispatchEvent(new Event("change"));
				}
				catch(err) {
					//do nothing
				}
				
				break;
			case "intro_image":
				document.getElementById('existingImageValue').value = value;
				break;	
			case "intro_image_alt_text":
			case "intro_image_alt_caption":
				document.getElementsByName('image_caption')[0].value = value;
				break;	
			case "metadata-description":
				document.getElementsByName('metadesc')[0].value = value;
				break;	
			case "metadata-keywords":
				document.getElementsByName('metakey')[0].value = value;
				break;				
			default:
				// do nothing
			break;
		}		
	},
	
	updateArticlePageSettings: function (type, value) {
		switch(type) {
			case "title":
				var titleField = document.getElementById('jform_title');
				titleField.value = value;
				break;
			case "alias":
				var aliasField = document.getElementById('jform_alias');
				aliasField.value = value;
				break;
			case "status":
				var statusField = document.getElementById('jform_state');
				var statusElField = 0;
				for (var i = 0; i < statusField.options.length; i++)
				{
					if (statusField.options[i].value == value){
						statusElField = i;
						break;
					}
				}
				statusField.selectedIndex = statusElField;
				
				try 
				{
					document.getElementById("jform_state").dispatchEvent(new Event("liszt:updated"));
					document.getElementById("jform_state").dispatchEvent(new Event("change"));
				}
				catch(err) {
					//do nothing
				}
				
				break;	
			case "category":
				var categoryField = document.getElementById('jform_catid');
				var categoryElField = 0;
				
				for (var i = 0; i < categoryField.options.length; i++)
				{
					if (categoryField.options[i].value == value){
						categoryElField = i;
						break;
					}
				}
				
				categoryField.selectedIndex = categoryElField;
				
				try 
				{
					document.getElementById("jform_catid").dispatchEvent(new Event("liszt:updated"));
					document.getElementById("jform_catid").dispatchEvent(new Event("change"));
				}
				catch(err) {
					//do nothing
				}
				
				break;
			case "featured":
			    var featuredRadios = document.getElementsByName('jform[featured]');
			    var featuredRadiosChecked = 0;
			    for (var j = 0; j < featuredRadios.length; j++) {
			        if (featuredRadios[j].value == value) {
			        	featuredRadios[j].checked = true;
			        	featuredRadiosChecked = j;
			            break;
			        }
			    }
			    
			    for (var j = 0; j < featuredRadios.length; j++) 
			    {
			    	var nextSibling = featuredRadios[j].nextSibling;
			    	
			    	while(nextSibling && nextSibling.nodeType != 1) {
			    	    nextSibling = nextSibling.nextSibling
			    	}
			    	
			    	if (nextSibling.tagName == 'LABEL')
			    	{
				    	if (featuredRadiosChecked == j && value == 1)
			    		{
				    		nextSibling.className = 'btn active btn-success';
			    		}
				    	else if (featuredRadiosChecked == j && value == 0)
			    		{
				    		nextSibling.className = 'btn active btn-danger';
			    		}
				    	else
			    		{
				    		nextSibling.className = 'btn';
			    		}
			    	}
			    	
			    }		    
				break;
			case "access":
				var accessField = document.getElementById('jform_access');
				var accessElField = 0;
				for (var i = 0; i < accessField.options.length; i++)
				{
					if (accessField.options[i].value == value){
						accessElField = i;
						break;
					}
				}
				
				accessField.selectedIndex = accessElField;
				
				try 
				{
					document.getElementById("jform_access").dispatchEvent(new Event("liszt:updated"));
					document.getElementById("jform_access").dispatchEvent(new Event("change"));
				}
				catch(err) {
					//do nothing
				}
				
				break;
			case "intro_image":
				document.getElementById('jform_images_image_intro').value = value;
				break;	
			case "intro_image_alt_text":
				document.getElementById('jform_images_image_intro_alt').value = value;
				break;	
			case "intro_image_alt_caption":
				document.getElementById('jform_images_image_intro_caption').value = value;
				break;	
			case "metadata-description":
				document.getElementById('jform_metadesc').value = value;
				break;	
			case "metadata-keywords":
				document.getElementById('jform_metakey').value = value;
				break;				
			default:
				// do nothing
			break;
		}		
	},
	
	prepareDataPageSettings: function() {
		
		switch(this.extension) {
			case "com_content":
				this.prepareArticleDataPageSettings();
				break;
			case "com_k2":
				this.prepareK2DataPageSettings();
				break;
			case "com_modules":				
				this.prepareModuleDataPageSettings();
				break;			
			default:
				this.preparePlaceHolderDataPageSettings();
			break;
		}	
	},
	preparePlaceHolderDataPageSettings: function () {
		return;
	},
	

	prepareK2DataPageSettings: function () {
		try 
		{
			JSNPB4Params.pageSettings.com_k2.title = document.getElementById('title').value;
			JSNPB4Params.pageSettings.com_k2.category = document.getElementById('catid').value;
			JSNPB4Params.pageSettings.com_k2.access = document.getElementById('access').value;
			
		    JSNPB4Params.pageSettings.com_k2.images.image_intro = document.getElementById('existingImageValue').value;
		    JSNPB4Params.pageSettings.com_k2.images.image_intro_alt = document.getElementsByName('image_caption')[0].value;
		    JSNPB4Params.pageSettings.com_k2.images.image_intro_caption = document.getElementsByName('image_caption')[0].value;
		    
		    JSNPB4Params.pageSettings.com_k2.metadata.metadesc = document.getElementsByName('metadesc')[0].value;
		    JSNPB4Params.pageSettings.com_k2.metadata.metakey = document.getElementsByName('metakey')[0].value;	
		    
		    var statusRadios = document.getElementsByName('published');
		    for (var j = 0; j < statusRadios.length; j++) {
		        if (statusRadios[j].checked) {
		        	JSNPB4Params.pageSettings.com_k2.status = statusRadios[j].value;
		            break;
		        }
		    }
		    
		    var featuredRadios = document.getElementsByName('featured');
		    for (var j = 0; j < featuredRadios.length; j++) {
		        if (featuredRadios[j].checked) {
		        	JSNPB4Params.pageSettings.com_k2.featured = featuredRadios[j].value
		            break;
		        }
		    }		    
			
		}
		catch(err) {
			//do nothing
		}    
	},
	
	prepareModuleDataPageSettings: function () {
		try 
		{
			JSNPB4Params.pageSettings.com_modules.title = document.getElementById('jform_title').value;
			JSNPB4Params.pageSettings.com_modules.header_class = document.getElementById('jform_params_header_class').value;
			JSNPB4Params.pageSettings.com_modules.moduleclass_sfx = document.getElementById('jform_params_moduleclass_sfx').value;
			JSNPB4Params.pageSettings.com_modules.access = document.getElementById('jform_access').value;
			JSNPB4Params.pageSettings.com_modules.position = document.getElementById('jform_position').value;
			JSNPB4Params.pageSettings.com_modules.status = document.getElementById('jform_published').value;
			
		    var prepareContentRadios = document.getElementsByName('jform[params][prepare_content]');
		    
		    for (var j = 0; j < prepareContentRadios.length; j++) {
		        if (prepareContentRadios[j].checked) {
		        	JSNPB4Params.pageSettings.com_modules.prepare_content = prepareContentRadios[j].value
		            break;
		        }
		    }		
			 
		    var showTitleRadios = document.getElementsByName('jform[showtitle]');
		    
		    for (var j = 0; j < showTitleRadios.length; j++) {
		        if (showTitleRadios[j].checked) {
		        	JSNPB4Params.pageSettings.com_modules.show_title = showTitleRadios[j].value;
		            break;
		        }
		    }	
		}
		catch(err) {
			//do nothing
		}    
	},
	
	prepareArticleDataPageSettings: function () {
		try 
		{
			JSNPB4Params.pageSettings.com_content.title = document.getElementById('jform_title').value;
			JSNPB4Params.pageSettings.com_content.status = document.getElementById('jform_state').value;
			
		    var featuredRadios = document.getElementsByName('jform[featured]');
		    for (var j = 0; j < featuredRadios.length; j++) {
		        if (featuredRadios[j].checked) {
		        	JSNPB4Params.pageSettings.com_content.featured = featuredRadios[j].value;
		            break;
		        }
		    }
		    
		    JSNPB4Params.pageSettings.com_content.category = document.getElementById('jform_catid').value;
		    JSNPB4Params.pageSettings.com_content.access = document.getElementById('jform_access').value;
		    JSNPB4Params.pageSettings.com_content.images.image_intro = document.getElementById('jform_images_image_intro').value;
		    JSNPB4Params.pageSettings.com_content.images.image_intro_alt = document.getElementById('jform_images_image_intro_alt').value;
		    JSNPB4Params.pageSettings.com_content.images.image_intro_caption = document.getElementById('jform_images_image_intro_caption').value;
		    
		    JSNPB4Params.pageSettings.com_content.metadata.metadesc = document.getElementById('jform_metadesc').value;
		    JSNPB4Params.pageSettings.com_content.metadata.metakey = document.getElementById('jform_metakey').value;	
		}
		catch(err) {
			//do nothing
		}		
	},	
}