var InputCheckbox=api.InputCheckbox=api.extendReactClass('MixinInput',{render:function(){var options=[],name=this.props.setting,className,checked;this.props.control.options.forEach(option=>{var optionLabel=api.Text.parse(option.label);className=(this.props.control.inline?'':'form-check ')+(option['class']||option.className||'');if(option.requires&&!this.props.form.isVisible(option.requires)){className+=' hidden';}if(this.props.control['multiple']===undefined||this.props.control['multiple']){checked=this.state.value.indexOf(option.value)>-1?true:false;}else{checked=this.state.value==option.value?true:false;}var optionTooltip;if(option.hint){optionTooltip=React.createElement(api.ElementTooltip,{hint:api.Text.parse(option.hint)});}var fieldName=name;if(this.props.control['multiple']===undefined||this.props.control['multiple']){fieldName+='[]';}if(this.props.control.inline){options.push(React.createElement('label',{className:className},React.createElement('input',{type:'checkbox',name:fieldName,value:option.value,checked:checked,onClick:this.change}),optionLabel,optionTooltip));}else{options.push(React.createElement('div',{className:className},React.createElement('label',{className:'form-check-label'+(checked?' active':'')},React.createElement('input',{type:'checkbox',name:fieldName,value:option.value,checked:checked,onClick:this.change,className:'form-check-input'}),optionLabel,optionTooltip)));}});return React.createElement('div',{className:'form-group '+(this.props.control['class']||this.props.control.className||'')},React.createElement('label',{className:this.props.control.labelClass||''},this.label,this.tooltip),React.createElement('div',{className:(this.props.control.inline?'form-check ':'form-control ')+(this.props.control.inputClass||'')},options));},change:function(event){this.parent();if(this.props.control['check-none']!==undefined&&!this.props.control['check-none']){var checkBoxes=ReactDOM.findDOMNode(this).querySelectorAll('input'),checked=0;for(var i=0,n=checkBoxes.length;i<n;i++){if(checkBoxes[i].checked){checked++;}}for(var i=0,n=checkBoxes.length;i<n;i++){if(checkBoxes[i].checked){checkBoxes[i].disabled=checked==1?true:false;}}}}});