Ext.define('GfsInfra.view.print.Print',{
    extend      : 'Ext.tab.Panel',
	title 	 	: 'print',
	xtype 	 	: 'print',
    requires 	:[
	    'Ext.grid.selection.Replicator',
	    'Ext.grid.plugin.Clipboard',
	    'Ext.toolbar.Paging',
	    'GfsInfra.view.devices.devicesController'
    ],
    controller  :'computer',

	closable 	:true,
	layout 	  	:'fit',
	bodyPadding :1,

	items 		:[{
        title 	: 'Printer'
    },{
        title 	: 'Scanner'
    }
    ]
});