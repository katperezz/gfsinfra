Ext.define('GfsInfra.view.computer.Computer',{
    extend      : 'Ext.tab.Panel',
	title 	 	: 'Monitor',
	xtype 	 	: 'computer',
    requires 	:[
	    'Ext.grid.selection.Replicator',
	    'Ext.grid.plugin.Clipboard',
	    'Ext.toolbar.Paging',
	    'GfsInfra.view.computer.computerController',
        'GfsInfra.view.computer.monitor.Monitor',
        'GfsInfra.view.computer.ups.UPS',
        'GfsInfra.view.computer.cpu.CPU'
    ],
    controller  :'computer',

	closable 	:true,
	layout 	  	:'fit',
	bodyPadding :1,

	items 		:[{
        title 	: 'Monitor',
        xtype 	:'monitor'
    },{
        title   : 'UPS',
        xtype   :'ups'
    },{
        title   : 'CPU',
        xtype   :'cpu'
    }
    ]
});