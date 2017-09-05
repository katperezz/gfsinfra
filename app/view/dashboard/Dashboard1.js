Ext.define('GfsInfra.view.dashboard.Dashboard1',{
	extend      :'Ext.Panel',
    alias       : 'widget.dashboard',
    xtype       :'dashboard',
    requires    :[
    		'Ext.flash.Component'
    ],

    // activeTab   : 0,
    // closable    :true,
    title       :'Dashboard',
    layout      :'fit',
    items       :[],
    listeners:{
    	beforerender:function(){
    	}
    }
});