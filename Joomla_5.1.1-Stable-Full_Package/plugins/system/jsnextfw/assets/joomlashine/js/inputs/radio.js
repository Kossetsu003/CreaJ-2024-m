var InputRadio=api.InputRadio=api.extendReactClass('MixinInput',{render:function(){var options=[],name=this.props.setting,className,checked;this.props.control.options.forEach(option=>{var optionLabel=api.Text.parse(option.label);className=(this.props.control.inline?'':'form-check ')+(option['class']||option.className||'');if(option.requires&&!this.props.form.isVisible(option.requires)){className+=' hidden';}checked=this.state.value==option.value?true:false;var optionTooltip;if(option.hint){optionTooltip=React.createElement(api.ElementTooltip,{hint:api.Text.parse(option.hint)});}if(this.props.control.inline){options.push(React.createElement('label',{className:className},React.createElement('input',{type:'radio',name:name,value:option.value,checked:checked,onClick:this.change}),optionLabel,optionTooltip));}else{options.push(React.createElement('div',{className:className},React.createElement('label',{className:'form-check-label'+(checked?' active':'')},React.createElement('input',{type:'radio',name:name,value:option.value,checked:checked,onClick:this.change,className:'form-check-input'}),optionLabel,optionTooltip)));}});return React.createElement('div',{className:'form-group '+(this.props.control['class']||this.props.control.className||'')},React.createElement('label',{className:this.props.control.labelClass||''},this.label,this.tooltip),React.createElement('div',{className:(this.props.control.inline?'form-check ':'form-control ')+(this.props.control.inputClass||'')},options));}});