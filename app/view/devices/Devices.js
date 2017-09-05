Ext.define('GfsInfra.view.devices.Devices',{
    extend      : 'Ext.tab.Panel',
	title 	 	: 'devices',
	xtype 	 	: 'devices',
    requires 	:[
	    'Ext.grid.selection.Replicator',
	    'Ext.grid.plugin.Clipboard',
	    'Ext.toolbar.Paging',
	    'GfsInfra.view.devices.devicesController',
        'GfsInfra.view.devices.laptop.Laptop'
    ],
    controller  :'computer',

	closable 	:true,
	layout 	  	:'fit',
	bodyPadding :1,

	items 		:[{
        title 	: 'Laptop',
        xtype   :'laptop'
    },{
        title 	: 'Mobile Phone'
    },{
        title 	: 'IDCall Phone'
    }
    ]
});