Ext.define('GfsInfra.view.network.Network',{
    extend      : 'Ext.tab.Panel',
	title 	 	: 'network',
	xtype 	 	: 'network',
    requires 	:[
	    'Ext.grid.selection.Replicator',
	    'Ext.grid.plugin.Clipboard',
	    'Ext.toolbar.Paging',
	    'GfsInfra.view.network.networkController'
    ],
    controller  :'computer',

	closable 	:true,
	layout 	  	:'fit',
	bodyPadding :1,

	items 		:[{
        title 	: 'NetWork Device'
    },{
        title 	: 'Pocket Wifi'
    },{
    	title :'Periphirals and Consumable'
    },{
    	title :'Dongle'
    },{
    	title :'USB Multiport'
    }
    ]
});