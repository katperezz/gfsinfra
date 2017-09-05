var itemsPerPage=25;
Ext.create('Ext.data.Store',{
	id:'cpuStore',
	autoLoad:true,
	fields:[
		{name:'id',mapping:'id'},
		{name:'custodian',mapping:'custodian'},
		{name:'location',mapping:'location'},
		{name:'asst_tag_no',mapping:'asst_tag_no'},
		{name:'serial_no',mapping:'serial_no'},
		{name:'model',mapping:'model'},
		{name:'brand',mapping:'brand'},
		{name:'specification',mapping:'specification'},
		{name:'mac_addr_lan',mapping:'mac_addr_lan'},
		{name:'mac_addr_wan',mapping:'mac_addr_wan'},
		{name:'os',mapping:'os'},
		{name:'win10_os_license',mapping:'win10_os_license'},
		{name:'win7_os_license',mapping:'win7_os_license'},
		{name:'acquisition_date',mapping:'acquisition_date'},
		{name:'LTTPS',mapping:'LTTPS'},
		{name:'NBD',mapping:'NBD'},
		{name:'POW',mapping:'POW'},
		{name:'proSupport_IT_tech',mapping:'proSupport_IT_tech'},
		{name:'remarks',mapping:'remarks'}
	],
	pageSize:25,
	proxy:{
		type:'ajax',
		timeout:2000000,
		url:'../data/cpu/get_cpu_list.php',
		actionMethods:'POST',
		extraParams:{search_value:''},
		reader:{type:'json',rootProperty:'data',totalProperty:'total',successProperty:'success'},
		writer:{type:'json',rootProperty:'data',encode:true}		
	}
});

Ext.create('Ext.data.Store',{
    id:'cpuLogsStore',
    autoLoad:false,
    fields:[
        {name:'id',mapping:'id'},
        {name:'action',mapping:'action'},
        {name:'type',mapping:'type'},
        {name:'item_id',mapping:'item_id'},
        {name:'field',mapping:'field'},
        {name:'value_old',mapping:'value_old'},
        {name:'value_new',mapping:'value_new'},
        {name:'user',mapping:'user'},
        {name:'timestamp',mapping:'timestamp'}
        ],
    pageSize:25,
    proxy:{
        type:'ajax',
        timeout:2000000,
        url:'../data/cpu/get_cpu_logs.php',
        actionMethods:'POST',
        extraParams:{search_value:''},
        reader:{type:'json',rootProperty:'data',totalProperty:'total',successProperty:'success'},
        writer:{type:'json',rootProperty:'data',encode:true}        
    }
});

Ext.create('Ext.data.Store',{
	id 	 	:'location',
	fields 	: ['dept'],
	data  	: [
		{"dept":"DEV"},
		{"dept":"IT"},
		{"dept":"MKTG"}
	]
});

Ext.define('GfsInfra.view.computer.cpu.CPU',{
	extend 	 	: 'Ext.Panel',
	title 	 	: 'CPU',
	xtype 	 	: 'cpu',
    requires 	:[
	    'Ext.grid.selection.Replicator',
	    'Ext.grid.plugin.Clipboard',
	    'Ext.toolbar.Paging',
	    'GfsInfra.view.computer.cpu.cpuController'  
    ],
    controller  :'cpu',

	layout 	  	:'fit',
	bodyPadding :1,

	tbar:{

		items:[
		{
		xtype 	:'panel',
		items 	:[
		{
	        xtype 	:'panel',
	        defaults:{anchor:'100%',labelWidth:110,fieldStyle:'font-size:12px;',labelStyle:'font-size:12px;'},
	        layout 	:'hbox',
	        margin 	:'10 0',
	        items 	:[
	        {xtype:'button',text:'Add',margin:'0 5 0 5',ui:'soft-green',handler:'addCPU'}
	        ]
		},
		{xtype:'label',style:'font-weight:bold;font-size:11px;font-face:arial',html:'NOTE : <span style="color:#2f9fe9;font-weight:bold;font-face:arial;font-size:11px;font-style:oblique;">Double click row to view baptismal information</span>'}
		]},
		'->',
		{xtype:'textfield',id:'cpu_search_value',emptyText:'Search',enableKeyEvents:true,
		triggers:{prin_search_value:{cls:Ext.baseCSSPrefix+'form-search-trigger',handler:'onPrinSearchEmp'}},
		inputAttrTpl:" data-qtip='Search Value: <br> • asst_tag_no'"}
		]
	},

	items 		:[

	{
		xtype 		 :'grid',
		id 			 :'cpu_grid',
		border 		 :false,
		autoScroll 	 :true,
		columnLines  :false,
		store        :'cpuStore',
		headerBorders:false,
		rowLines     :true,
		plugins 	 : [
			'gridfilters',
			'clipboard',
			'selectionreplicator',
			'rowexpander'
		],
		animCollapse:true,
		plugins: {
			ptype: 'rowediting',
			clicksToEdit: 2
		},
		layout:{
			type:'fit',
			align:'stretch',
			pack:'start'
		},
		viewConfig   :{
			preserveScrollOnRefresh :true,
			preserveScrollOnReload 	:true,
			deferEmptyText 			:true,
			emptyText 				:'<h1>No data found</h1>'
		},	
		columns 	 : [
			{xtype:'rownumberer', width:45},	    
			{header:'custodian',dataIndex:'custodian',flex:2,editor: 'textfield',filter:'list'},
		    {header:'location',dataIndex:'location',filter:'list',
			editor: {
			    xtype: 'combobox',
			    editable: false,
			    triggerAction: 'all',
			    allowBlank: false,
				valueField:'dept',
				displayField:'dept',
			    store: 'location'
			}
			},
			{header:'asst_tag_no',dataIndex:'asst_tag_no',flex:2,editor: 'textfield',filter:'list'},
			{header:'serial_no',dataIndex:'serial_no',flex:2,editor: 'textfield',filter:'list'},
			{header:'model',dataIndex:'model',flex:2,editor: 'textfield',filter:'list'},
			{header:'brand',dataIndex:'brand',flex:2,editor: 'textfield',filter:'list'},
			{header:'specification',dataIndex:'specification',flex:2,editor: 'textfield',filter:'list'},
			{header:'mac_addr_lan',dataIndex:'mac_addr_lan',flex:2,editor: 'textfield',filter:'list'},
			{header:'mac_addr_wan',dataIndex:'mac_addr_wan',flex:2,editor: 'textfield',filter:'list'},
			{header:'os',dataIndex:'os',flex:2,editor: 'textfield',filter:'list'},
			{header:'win10_os_license',dataIndex:'win10_os_license',flex:2,editor: 'textfield',filter:'list'},
			{header:'win7_os_license',dataIndex:'win7_os_license',flex:2,editor: 'textfield',filter:'list'},
			{header:'acquisition_date',dataIndex:'acquisition_date',flex:2,editor: 'textfield',filter:'list'},
			{header:'LTTPS',dataIndex:'LTTPS',flex:2,editor: 'textfield',filter:'list'},
			{header:'NBD',dataIndex:'NBD',flex:2,editor: 'textfield',filter:'list'},
			{header:'POW',dataIndex:'POW',flex:2,editor: 'textfield',filter:'list'},
			{header:'proSupport_IT_tech',dataIndex:'proSupport_IT_tech',flex:2,editor: 'textfield',filter:'list'},
			{header:'remarks',dataIndex:'remarks',flex:2,editor: 'textfield',filter:'list'},
		    {
			    xtype 	:'actioncolumn', 
			    width 	:30,
			    items 	: [
			    {
			        iconCls: 'x-fa fa-eye',
			        width  :30,
			        tooltip: 'Show Logs',
			        handler :'showCPULogs'
			    }
			    ]
			},
			{
			    xtype 	:'actioncolumn', 
			    width 	:30,
			    items 	: [
			    {
			        iconCls: 'x-fa fa-minus-circle',
			        width  :30,
			        tooltip: 'Delete',
			        handler: function(grid, rowIndex, colIndex) {
			        var rec  = grid.getStore().getAt(rowIndex);
					var g    = Ext.getCmp('cpu_grid');				                    
					var user = localStorage.getItem('gfsUserDetails'),
					 	obj  = JSON.parse(user);					
						
						Ext.Msg.confirm('GreatFeat','Are you sure you want to delete record '+ rec.get('asst_tag_no'), function(answer){
						    if(answer=='yes'){
						        var waitMsg = Ext.MessageBox.wait('Processing your request. Please wait...');

								Ext.Ajax.request({
								    url: '../data/cpu/delete_cpu_details.php',
								    params: { id:rec.get('id'), user:obj['email']},
								    success :function(response){
								    	var response = response.responseText;

										waitMsg.hide();
										g.store.load();
										Ext.MessageBox.show({title:'SUCCESS', msg:'Record deleted', icon:Ext.Msg.INFO, closable:false, buttonText:{ok:'OK'}});

								    },failure:function(response){
								    	var response = response.responseText;

										waitMsg.hide();
										g.store.load();
										Ext.MessageBox.show({title:'FAILED', msg:'Something went wrong. Please try again', icon:Ext.Msg.INFO, closable:false, buttonText:{ok:'OK'}});

								    }
								});									        

					       }
						});

			        }                
			    }
			    ]
			}

	    ],
		listeners 	:{
			beforerender 	:function(form,btn){
				Ext.getCmp('cpu_grid').getStore().removeAll();
				console.log(window.console);if(window.console||window.console.firebug){console.clear()}
				console.log(Ext.getCmp('cpu_grid').getStore().load())
			},
			// edit: function(editor, context, eOpts) {
			edit:function(row, r, tr, rowIndex, e, eOpts,grid,record,colIndex){
				console.log(r.record.data);
			    var record = r.record.data;
			    console.log(Ext.encode(record))

			    var user = localStorage.getItem('gfsUserDetails'),
			    	obj  = JSON.parse(user);

			    console.log(obj['email'])
			    //do your processing here, e.g.:
			    Ext.Ajax.request({
			        url 	:'../data/cpu/edit_cpu_details.php',
			        method 	:'POST',
			        params 	:{ record:Ext.encode(record),user:obj['email']},
			        success :function(response){
			        	var response = response.responseText;
						Ext.getCmp('cpu_grid').getStore().load();
			        	alert('Success');
			        },failure:function(response){
			        	var response = response.responseText;
			        	alert('Failed','Something went wrong. Please try again')

			        }
			    });
			}
		},
		dockedItems 	: []
		}
	]
});