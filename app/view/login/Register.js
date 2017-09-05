Ext.define('GfsInfra.view.login.Register', {
    extend: 'Ext.form.Panel',
    xtype: 'register',

    require:[
        'Ext.form.*',
        'Ext.Img',
        'Ext.tip.QuickTipManager'
    ],

    id:'registrationform',
	renderTo: Ext.getBody(),
    frame: false,
    width: '100%',
    bodyPadding: 10,
    bodyBorder: false,
	closeAction: 'hide',
    cls         :'login',
    bodyStyle   :{"background-color":"#e6e6e6"},

    listeners: {
        fieldvaliditychange: function() {
            this.updateErrorState();
        },
        fielderrorchange: function() {
            this.updateErrorState();
        }
    },

    updateErrorState: function() {
    var me = this,
        errorCmp, fields, errors;

    if (me.hasBeenDirty || me.getForm().isDirty()) { //prevents showing global error when form first loads
        errorCmp = me.down('#formErrorState');
        fields = me.getForm().getFields();
        errors = [];
        fields.each(function(field) {
            Ext.Array.forEach(field.getErrors(), function(error) {
                errors.push({name: field.getFieldLabel(), error: error});
            });
        });
        errorCmp.setErrors(errors);
        me.hasBeenDirty = true;
    }
    },

    defaults: {
        anchor: '100%',
        labelWidth:120
    },
    fieldDefaults: {
        labelAlign: 'left',
        msgTarget: 'none',
        invalidCls: '' //unset the invalidCls so individual fields do not get styled as invalid
    },
    items: [
    {
        xtype: 'textfield',
        name: 'key',
        fieldLabel: 'Generated Key',
        allowBlank: false,
        maxLength:5

    },
    {
        xtype: 'textfield',
        name: 'fname',
        fieldLabel: 'First Name',
        allowBlank: false,
        maxLength:30

    },
    {
        xtype: 'textfield',
        name: 'lname',
        fieldLabel: 'Last Name',
        allowBlank: false,
        maxLength:30

    }, {
        xtype: 'textfield',
        name: 'email',
        fieldLabel: 'Email Address',
        vtype: 'email',
        allowBlank: false
    }, {
        xtype: 'textfield',
        name: 'password',
        fieldLabel: 'Password',
        inputType: 'password',
        style: 'margin-top:15px',
        allowBlank: false,
        minLength: 6
    }, {
        xtype: 'textfield',
        name: 'password2',
        fieldLabel: 'Repeat Password',
        inputType: 'password',
        allowBlank: false,
        validator: function(value) {
            var password1 = this.previousSibling('[name=password]');
            return (value === password1.getValue()) ? true : 'Passwords do not match.'
        }
    },

    {
        xtype: 'checkboxfield',
        name: 'acceptTerms',
        id:'acceptTerms',
        fieldLabel: 'Terms of Use',
        hideLabel: true,
        style: 'margin-top:15px',
        boxLabel: 'I have read and accept the <a href="https://www.benefitsmadebetter.com/page.php?page=terms" class="terms">Terms of Use</a>.',
        // Listener to open the Terms of Use page link in a modal window
        listeners: {
            click: {
                element: 'boxLabelEl',
                fn: function(e) {
                    var target = e.getTarget('.terms'),
                        win;
                    if (target) {
                        win = Ext.widget('window', {
                            title: 'Terms of Use',
                            modal: true,
                            html: '<iframe src="' + target.href + '" width="950" height="500" style="border:0"></iframe>'
                            // buttons: [{
                            //     text: 'Decline',
                            //     handler: function() {
                            //         var form = Ext.getCmp('registrationform').getForm();
                            //         this.up('window').close();
                            //         // console.log(form)
                            //         // Ext.getCmp('acceptTerms').setChecked(false)
                            //         // this.up('form').down('[name=acceptTerms]').setCheck(false);
                            //         console.log(Ext.getCmp('registrationform'));
                            //         console.log(Ext.getCmp('acceptTerms'));
                            //         Ext.getCmp('acceptTerms').setChecked(false);
                            //     }
                            // }, {
                            //     text: 'Accept',
                            //     handler: function() {
                            //         this.up('window').close();
                            //         formPanel.down('[name=acceptTerms]').setCheck(true);
                            //     }
                            // }]
                        });
                        win.show();
                        e.preventDefault();
                    }
                }
            }
        },

        // Custom validation logic - requires the checkbox to be checked
        getErrors: function() {
            return this.getValue() ? [] : ['You must accept the Terms of Use']
        }
    }],

    dockedItems: [
    {
        xtype: 'container',
        dock: 'bottom',
        layout: {type: 'hbox',align: 'middle'},
        // padding: '0px 0px 5px 0px',
        items: [{
            xtype: 'component',
            id: 'formErrorState',
            baseCls: 'form-error-state',
            flex: 1,
            validText: 'Input is valid',
            invalidText: 'Input has errors',
            tipTpl: Ext.create('Ext.XTemplate', '<ul><tpl for="."><li><span class="field-name">{name}</span>: <span class="error">{error}</span></li></tpl></ul>'),
            getTip: function() {
                var tip = this.tip;
                if (!tip) {
                    tip = this.tip = Ext.widget('tooltip', {                        
                        target: this.el,
                        title: '<font color= "red">Error Details:</font>',
                        autoHide: false,
                        anchor: 'top',
                        mouseOffset: [-11, -2],
                        closable: true,
                        constrainPosition: false
                        // cls: 'errors-tip'
                    });
                    tip.show();
                }
                return tip;
            },

            setErrors: function(errors) {
                var me = this,
                    baseCls = me.baseCls,
                    tip = me.getTip();

                errors = Ext.Array.from(errors);

                // Update CSS class and tooltip content
                if (errors.length) {
                    me.addCls(baseCls + '-invalid');
                    me.removeCls(baseCls + '-valid');
                    me.update(me.invalidText);
                    tip.setDisabled(false);
                    tip.update(me.tipTpl.apply(errors));
                } else {
                    me.addCls(baseCls + '-valid');
                    me.removeCls(baseCls + '-invalid');
                    me.update(me.validText);
                    tip.setDisabled(true);
                    tip.hide();
                }
            }
        }, {
            xtype: 'button',
            formBind: true,
            disabled: true,
            text: 'Submit Registration',
            width: 140,
            margin:5,
        	// margin:'10 0 10 0',
            handler: function() {
                var myMask = new Ext.LoadMask({
                            msg    : 'Please wait...',
                            target : Ext.getCmp('registrationform')
                    });
                    myMask.show();
                var form = Ext.getCmp('registrationform').getForm();
                if(form.isValid()) {
                    form.submit({
                        url : '../data/register.php',
                        method : 'POST',
                        success:function(form, action){ 
                            myMask.hide();
                            Ext.Msg.alert('REGISTER', action.result.message);
                            Ext.MessageBox.show({
                                title:'REGISTERED', 
                                msg:action.result.message, 
                                closable:false,
                                buttonText:{ok:'OK'},
                                fn:function(btn){
                                if(btn=='ok'){
                                    form.reset();
                                }}
                            });
                    //          window.location.reload()
                			 // btn.up('window').hide();
                    //          Ext.widget('logins');
                        },
                       failure: function(form, action) {
                        myMask.hide();
                        Ext.Msg.alert('REGISTER ERROR', action.result.message);
                     }
                    });       
                }
                }
        },
        {
            xtype:'button',
            text:'Login',
            width: 100,
            margin:5,
            listeners:{click:function(btn){btn.up('window').close();Ext.widget('login');}}
        }
        ]
    }
    ]







    });