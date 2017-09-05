Ext.define('GfsInfra.view.login.Login',{
    extend: 'Ext.window.Window',
    xtype: 'login',

    requires: [
        'Ext.form.Panel',
        'GfsInfra.view.login.LoginController',
		'GfsInfra.view.login.WindowReg'
    ],

    // ui:'login',
    controller: 'login',
    ui:'login-window',
    // cls:'login',
    // bodyPadding: 10,
    border:false,
    title: 'IT Infra Support',
    closable: false,
    autoShow: true,
    draggable:false,
    width :380,
    items:{
        xtype       :'form',
        reference   :'form',
        id          :'login',
        bodyPadding :20,
        defaults    :{allowBlank:false,labelWidth:100, width:'95%'},
        cls         :'login',
        bodyStyle   :{"background-color":"#e6e6e6"},
        // ui:'paneltitle',
        items       :[
        {
            xtype:'label',
            margin :30,
            style:'color:#1a6a81;font-weight:bold;font-face:arial;margin-top: 5px;margin-bottom: 10px;',
            html:'Sign in to your account'
        },
        {
            xtype:'textfield',
            name:'email',
            margin:'15 0 0 0',
            fieldLabel:'Email'
        },{
            xtype:'textfield',
            name:'password',
            inputType:'password',
            fieldLabel:'Password'
        },{
            xtype:'displayfield',
            hideEmptyLabel:false,
            value:'Enter any non-blank password'
        }
        ],
        buttons:[
        {
            // ui:'action',
            text:'Login',
            formBind:true,
            listeners:{
                click:function(btn){

                    // var task = Ext.create('Ext.util.DelayedTask', function() {
                    //     Ext.Viewport.mask({ xtype: 'loadmask',
                    //     message: "Sending..." });
                    // }, this);
                    // task.delay(200);
                    // var myMask = new Ext.LoadMask(Ext.getBody(), {msg:"Please wait...", layout:'fit', region:'center'});
                    var myMask = new Ext.LoadMask({
                            msg    : 'Please wait...',
                            target : Ext.getCmp('login')
                    });
                    myMask.show();

                    var form=Ext.getCmp('login').getForm();
                    if(form.isValid()){

                        Ext.Ajax.request({
                            url:'../data/login.php',
                            method:'POST',
                            params :form.getValues(),
                            success:function(response){
                                var response = Ext.decode(response.responseText);
                                if(response.success==true){

                                    var data                = response.data;
                                    var details             = {};
                                        details.id          = '0001';
                                        details.email       = data[0].email; 
                                        details.fname       = data[0].fname;
                                        details.lname       = data[0].lname;
                                        
                                        localStorage.setItem("gfsLogin",true);
                                        localStorage.setItem("gfsUserDetails",Ext.encode(details));
                                        loggedIn = localStorage.getItem("gfsLogin");
                                        btn.up('window').hide();
                                        myMask.hide();
                                        // myMask.destroy();
                                        console.log('true :' +loggedIn);
                                        Ext.Msg.alert('LOGIN SUCCESS',response.msg);
                                        form.reset();
                                        Ext.widget('main');                                    
                                }else{                                
                                    Ext.Msg.alert('LOGIN ERROR',response.msg);form.reset();
                                    myMask.hide();
                                }
                            
                            },
                            failure:function(response){
                                var response = Ext.decode(response.responseText);
                                Ext.Msg.alert('LOGIN ERROR',response.msg);form.reset();
                                myMask.hide();
                            }
                        });
                        // form.submit({
                        //     url:'../data/login.php',
                        //     method:'POST',
                        //     success:function(form,action){
                        //         // var response            = Ext.decode(response.responseText);
                        //     },failure:function(form,action){
                        //     }
                        // });
                    
                    }
                },
                beforerender:function(btn){
                    // Ext.Ajax.request({
                    //     url:'resources/data/log_proccess.php',
                    //     success:function(response){
                    //         var response=Ext.decode(response.responseText);
                    //         if(response.message=="ok"){
                    //             localStorage.setItem("TutorialLoggedIn",true);
                    //             btn.up('window').hide();
                    //             Ext.widget('app-main');
                    //         }
                    //     },failure:function(response){
                    //         var response=Ext.decode(response.responseText);
                    //         Ext.Msg.alert('LOGIN ERROR',response.message);
                    //         Ext.widget('logins');
                    //     }
                    // });
                }
            }
        },{
            text:'Register',
            // ui:'action',
            listeners:{click:function(btn){btn.up('window').close();Ext.widget('windowreg');}}
        }
        ]
    }
});