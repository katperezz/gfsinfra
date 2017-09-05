Ext.define('GfsInfra.view.main.Main', {
    extend      : 'Ext.container.Container',
    requires: [
        'Ext.plugin.Viewport',
        'GfsInfra.view.main.hidden.Logout_main',
        'GfsInfra.view.dashboard.Dashboard',
        'GfsInfra.view.manage.Manage'
        // 'GfsInfra.view.monitor.Monitor'
    ],
    plugins     : 'viewport',
    renderTo    : Ext.getBody(),
    controller  : 'main',      
    xtype       : 'main',
    id          :'main',
    layout      : {type: 'border'},
    // flex        :1,
    items: [
    {
        region      : 'north',
        height      :30,
        xtype       : 'container',
        bodyStyle   :{"background-color":"#e6e6e6"},
        items       :[

        {
            xtype   :'toolbar',
            cls     :'sencha-dash-dash-headerbar toolbar-btn-shadow',
            style   :{"background-color":"#e6e6e6"},
            itemId  :'headerBar',
            items   :[

            {
                xtype: 'component',
                cls         :'logo-cls',
                html:'<p style="margin:5px 10px 0px;"><br>Greatfeat Services Inc.',
                width: 250
            },
            {xtype  :'logout_main', hidden:true},
            {xtype:'tbspacer',flex:1},
            {
                    xtype       :'button',
                    reference   :'senchaLogo',
                    cls         :'north-toolbar',
                    width       :200,
                    id          :'username',
                    reference   :'username',
                    // iconCls     :'x-fa fa-user',
                    ui          :'light',
                    border      :false,
                    // text        :'Katrineperez@yahoo.com',
                    // html       :'<div class="image-wrapper"><i class="fa fa-user fa-2x c_icon"/></i><font size="2"><p>dasdasdasdas</div> ',
                    html       :'<div class="image-wrapper"><p>Katrine Perez</p></div> ',
                    menu        :[
                    {
                        xtype   :'panel',
                        width   :280,
                        height  :150,
                        layout  :{type:'vbox',pack:'center',align:'center'},
                        tbar    :[
                            {text:'Profile',ui:'gray',iconCls:'x-fa fa-th-large',href:'#profile',hrefTarget:'_self'},
                            '->',
                            {text:'Log Out',ui:'gray',iconCls:'x-fa fa-sign-out',
                            // listeners:{click:function(component){}}
                            handler:function(component){
                                    var user = localStorage.getItem('gfsUserDetails'),
                                        obj  = JSON.parse(user);

                                    console.log(component);
                                    var myMask = new Ext.LoadMask({
                                        msg    : 'Please wait...',
                                        target : Ext.getCmp('main')
                                    });
                                    myMask.show();
                                    var form = Ext.getCmp('logout_main').getForm();
                                    if(form.isValid()) {
                                        form.submit({
                                        // url : 'resources/data/logout.php',
                                        url : '../data/logout.php',
                                        method : 'POST',
                                        params :{email:obj['email']},
                                        //   waitMsg : 'Logging Out',
                                        success : function (response) {
                                            localStorage.removeItem('gfsLogin');
                                            window.location.reload()
                                            this.up('.window').close(); 
                                            Ext.widget('login');
                                            myMask.hide();
                                            // task.cancel();
                                        },failure:function(){
                                            myMask.hide();                                            
                                        }
                                        });
                                        }

                            }
                            }
                        ],
                        items   :[
                            {html:'<img src="resources/icons/userprofile.png"  height="60px" width="60px">'},
                            {xtype:'displayfield',id:'user_email'}
                        ]
                    }]
                }
            ]
            }
        ]
    },


    {
        xtype       : 'panel',
        reference   :'menu_main',
        region      : 'west',
        // html        : '<ul><li>This area is commonly used for navigation, for example, using a "tree" component.</li></ul>',
        width       : 95,
        margin      :'35 0 0 0',
        bodyStyle   :{"background-color":"#1a6a81"},
        layout      : 'vbox',
        // title       :'TEST',
        layoutConfig: {
            align   : 'stretch',
            pack    : 'center'
        },
        defaults    :{
        xtype:'button',
        width:95,
        height:70,
        // ui:'soft-menu',
        margin:'0 0 0 0',
        iconAlign: "top", 
        textAlign:'center',
        cls:'menu-button',
        pressedCls: 'my-btn-pressed'
        },// style:{"background-color":"#32404e"}
        items       :[      
        {text:'Dashboard', handler:'showDashboard',margin:'0 0 0 0', iconCls:'x-fa fa-tachometer fa-2x'},
        // {text:'Monitor',iconCls:'x-fa fa-desktop fa-2x',handler:'showMonitor'},
        // {text:'Laptop',iconCls:'x-fa fa-desktop fa-2x',handler:'showLaptop'}
        {text:'Computer',iconCls:'x-fa fa-desktop fa-2x',handler:'showComputer'},
        {text:'Devices',iconCls:'x-fa fa-tablet fa-2x',handler:'showDevices'},
        {text:'Printer',iconCls:'x-fa fa-print fa-2x',handler:'showPrinter'},
        {text:'Network',iconCls:'x-fa fa-phone fa-2x',handler:'showNetwork'}
        // {text:'Network device',iconCls:'x-fa fa-desktop fa-2x',handler:'showNetwork'},

        ]
    },{
        region  : 'center',
        xtype   : 'tabpanel',
        id      : 'gfs_tabpanel',
        layout  : 'fit',
        margin  :'30 0 0 0',
        ui      :'viewport-tab',
        closeAction: 'hide',
        items   :[
        {xtype:'dashboard'}
        ]
    }
    ],
    listeners:{
        beforerender:'onMain_render'
    }
});
