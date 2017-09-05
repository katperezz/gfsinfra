/**
 * This class is the controller for the main view for the application. It is specified as
 * the "controller" of the Main view class.
 *
 * TODO - Replace this content of this view to suite the needs of your application.
 */
Ext.define('GfsInfra.view.main.MainController', {
    extend: 'Ext.app.ViewController',

    alias: 'controller.main',

    onMain_render:function(){
        var gfsUserDetails    = localStorage.getItem("gfsUserDetails"),
            obj            = JSON.parse(gfsUserDetails);

        console.log(obj.email)
        Ext.getCmp('username').setText('<div class="image-wrapper"><p>'+obj.fname+' '+obj.lname+'</p></div>');
        Ext.getCmp('user_email').setValue(obj.email);

    },

    showDashboard: function(){
        var tabpanel = Ext.getCmp("gfs_tabpanel");
        var pTabId   = "gfs-tab-dashboard";
        
        if(Ext.getCmp(pTabId)){
            tabpanel.setActiveTab(pTabId);
        }else{
            tabpanel.add({id:pTabId,xtype:'dashboard'});
            tabpanel.setActiveTab(pTabId);    
        }
    },

    showManage:function(){
        var tabpanel = Ext.getCmp("gfs_tabpanel");
        var pTabId   = "gfs-tab-manage";
        
        if(Ext.getCmp(pTabId)){
            tabpanel.setActiveTab(pTabId);
        }else{
            tabpanel.add({id:pTabId,xtype:'manage'});
            tabpanel.setActiveTab(pTabId);    gfs_tabpanel
        }
    },

    showMonitor:function(){
        var tabpanel = Ext.getCmp("gfs_tabpanel");
        var pTabId   = "gfs-tab-monitor";
        
        if(Ext.getCmp(pTabId)){
            tabpanel.setActiveTab(pTabId);
        }else{
            tabpanel.add({id:pTabId,xtype:'monitor'});
            tabpanel.setActiveTab(pTabId);    gfs_tabpanel
        }
    },

    showComputer:function(){
        var tabpanel = Ext.getCmp("gfs_tabpanel");
        var pTabId   = "gfs-tab-computer";
        
        if(Ext.getCmp(pTabId)){
            tabpanel.setActiveTab(pTabId);
        }else{
            tabpanel.add({id:pTabId,xtype:'computer'});
            tabpanel.setActiveTab(pTabId);    gfs_tabpanel
        }
    },

    showDevices:function(){
        var tabpanel = Ext.getCmp("gfs_tabpanel");
        var pTabId   = "gfs-tab-devices";
        
        if(Ext.getCmp(pTabId)){
            tabpanel.setActiveTab(pTabId);
        }else{
            tabpanel.add({id:pTabId,xtype:'devices'});
            tabpanel.setActiveTab(pTabId);    gfs_tabpanel
        }
    },

    showPrinter:function(){
        var tabpanel = Ext.getCmp("gfs_tabpanel");
        var pTabId   = "gfs-tab-print";
        
        if(Ext.getCmp(pTabId)){
            tabpanel.setActiveTab(pTabId);
        }else{
            tabpanel.add({id:pTabId,xtype:'print'});
            tabpanel.setActiveTab(pTabId);    gfs_tabpanel
        }
    },

    showNetwork:function(){
        var tabpanel = Ext.getCmp("gfs_tabpanel");
        var pTabId   = "gfs-tab-network";
        
        if(Ext.getCmp(pTabId)){
            tabpanel.setActiveTab(pTabId);
        }else{
            tabpanel.add({id:pTabId,xtype:'network'});
            tabpanel.setActiveTab(pTabId);    gfs_tabpanel
        }
    }

});
