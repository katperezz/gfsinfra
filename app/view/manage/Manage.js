Ext.define('GfsInfra.view.manage.Manage',{
	extend 	 	: 'Ext.Panel',
	title 	 	: 'Manage',
	xtype 	 	: 'manage',
    requires 	:[
	    'Ext.grid.selection.Replicator',
	    'Ext.grid.plugin.Clipboard',
	    'Ext.toolbar.Paging',
	    'GfsInfra.view.manage.manageController'    
    ],
    controller  :'manage',

	closable 	:true,
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
        items 	:[
        {
            xtype      		 : 'combo',
            fieldLabel    	 : 'Account name',
            displayField 	 : 'companyname',
            valueField   	 : 'companyid',
            emptyText    	 :'Select account',
            width     		 :400,
            editable  		 :false,
            name         	 :'companyname',
            id           	 :'prin_companyname',
            triggerAction 	 : 'all',
            // store         	 : 'Get_acc_list',
            afterLabelTextTpl: [
                '<span style="color:red;font-weight:bold" data-qtip="Required">*</span>'
            ],
            listeners     	 :{
                select   	 :'onPrinSelectAccount'                                
            }
        },
        {xtype:'button',text:'Export',margin:'0 5 0 5',ui:'soft-green',handler:'onPrinExportXLS'},
       	{xtype:'panel',defaults:{labelStyle:'font-size:25px;font-style :font-weight:bold;font-face:arial',fieldStyle:'font-size:25px;font-weight:bold;font-face:arial'},items:[{xtype:'displayfield',fieldLabel:'TOTAL',labelWidth:85,margin:'0 0 0 5',id:'principal_total'}]}
        ]
	},
	{xtype:'label',style:'font-weight:bold;font-size:11px;font-face:arial',html:'NOTE : <span style="color:#2f9fe9;font-weight:bold;font-face:arial;font-size:11px;font-style:oblique;">Double click row to view Principal information or click the group icon to view Principal Dependent/s</span>'}
	// {xtype:'label',style:'color:#57b3cb;font-size:11px;font-weight:bold;font-style:oblique;font-face:arial',text:'Double click row to view Principal information or click the group icon to view Principal Dependent/s'}
	]},
	'->',
	{
		xtype 		:'panel',
		reference   :'notif_panel',
		layout  	:'hbox',
		items  	 	:[]
	},
	{xtype:'textfield',id:'prin_search_value',emptyText:'Search Employee',enableKeyEvents:true,
	triggers:{prin_search_value:{cls:Ext.baseCSSPrefix+'form-search-trigger',handler:'onPrinSearchEmp'}},
	inputAttrTpl:" data-qtip='Search Value: <br> • emp_number <br> • lastname <br> • firstname <br> • middlename'",listeners:{keyup:'onPrinSearchEmp_enter'}}
	]},
	items 		:[
	{
		xtype 		 :'grid',
		id 			 :'principal_grid',
		border 		 :false,
		autoScroll 	 :true,
		columnLines  :false,
		// store        :'principalStore',
		headerBorders:false,
		rowLines     :true,
		plugins 	 : [
			'gridfilters',
			'clipboard',
			'selectionreplicator',
			'rowexpander'
		],
		animCollapse:true,
		plugins: [{
			ptype 				: 'rowexpander',
			rowBodyTpl: new Ext.XTemplate('<p>&nbsp;</p>'),
			expandOnDblClick 	:false
		}],
		layout:{
			type:'fit',
			align:'stretch',
			pack:'start'
		},
		onRowExpand : function(rowNode, record, expandRow, body,expandNode) {
        	var waitMsg = Ext.MessageBox.wait('Processing your request. Please wait...');
        	var theTd =  Ext.get(expandRow); // Here I get the td
	        theTd.mask('Loading...'); // I mask it, in case the process takes long

			Ext.Ajax.request({
			url:'../data/get_pmember_adddetails.php',
			method:'GET',
			params :{p_al_id:record.get('activelink_id'), acc_id:Ext.getCmp('prin_companyname').getValue()},
			success: function ( result, request ) {
			    var jsonData = Ext.util.JSON.decode(result.responseText);
				if(jsonData.success==true){
				    console.log(jsonData.data[0].lname);
				    // myTemplate.overwrite(body, email,address,contact1);
					theTd.update(myTemplate.apply({
						email  			  : jsonData.data[0].email,
						address1  		  : jsonData.data[0].address1,
				    	contact1 		  : jsonData.data[0].contact1,
				    	contact2 		  : jsonData.data[0].contact2,
				    	inclusion_date 	  : jsonData.data[0].inclusion_date,
				    	deactivation_date : jsonData.data[0].deactivation_date
					}));
					waitMsg.hide();				
				}else{
					waitMsg.hide();
					theTd.update(myTemplate.apply({
					}));
					theTd.unmask();
		            Ext.MessageBox.show({title:'WARNING', msg:jsonData.message, icon:Ext.Msg.WARNING, closable:false, buttonText:{ok:'OK'}});
				}
			},
			failure: function ( result, request) {
				waitMsg.hide();
				theTd.update(myTemplate.apply({
				}));
				theTd.unmask();
				Ext.MessageBox.show({title:'WARNING', msg:result.responseText, icon:Ext.Msg.WARNING, closable:false, buttonText:{ok:'OK'}});
			    return false;
			}
			});
		},

		selModel: {
			type 		: 'spreadsheet',
			columnSelect: true,
			pruneRemoved: false,
			extensible 	: 'y'
		},
		viewConfig   :{
			preserveScrollOnRefresh :true,
			preserveScrollOnReload 	:true,
			deferEmptyText 			:true,
			emptyText 				:'<h1>No data found</h1>',
			// trackOver: false,

			getRowClass 			:function(record,index){
				var c 	=record.get('email');
				if(c=='' || c=='-' || c=='-_DEL'){
					return 'empty'
				}else{
					return 'valid'
				}
			}
		},	
		columns 	 : [
		    {xtype:'rownumberer', width:45},
		    {header:'ActiveLink ID',dataIndex:'activelink_id',filter:{type:'string',itemDefaults:{emptyText:'Search for...'}}},
		    {header:'Employee no',dataIndex:'empid',filter:{type:'string',itemDefaults:{emptyText:'Search for...'}}},
			{header:'Full Name', dataIndex:'fullname', flex:1, filter:{type:'string', itemDefaults:{emptyText:'Search for...'}}},			    
			{header:'Age',width:80, filter:'list',
			renderer : function(value, metaData, record, rowIdx, colIdx, store, view){
                    return calcAge(record.get('birthdate'));
                }
			},
			// {header:'Email', dataIndex:'email', flex:1},
		    {header:'HMO/Job level',dataIndex:'plan_id',width:120,filter:'list'},
		    {header:'Branch ID',dataIndex:'branch_id',filter:'list'},
		    {header:'Status',dataIndex:'mbr_status',filter:'list'},
			{header:'BMB Registration', width:125,tdCls:'x-change-cell',
				renderer : function(value, metaData, record, rowIdx, colIdx, store, view){
					var email 	=record.get('email');
					if(email=='' || email=='-' || email=='-_DEL'){
						return 'UNREGISTERED'
					}else{
						return 'REGISTERED'
					}
				}

			}
		],
		listeners 	:{
			beforerender 	:function(form,btn){
				Ext.getCmp('principal_grid').getStore().removeAll();
				console.log(window.console);if(window.console||window.console.firebug){console.clear()}
			},
			afterrender: function(me) {
				me.getView().on('expandbody', me.onRowExpand);
			},
			rowdblclick:'onPrincipalDetails'
		},
		dockedItems 	: [{
				xtype 	 	: 'pagingtoolbar',
				dock 	 	: 'bottom',
				// store 		:'principalStore',
	    		displayInfo : true,
				moveNext : function(){
					var search_value 	   = Ext.getCmp('prin_search_value').getValue(),
						me  			   = this,
						total  			   = me.getPageData().pageCount,
						next  			   = me.store.currentPage + 1;

						console.log(next);
					if (next <= total) {
					    if (me.fireEvent('beforechange', me, next) !== false) {	        
					        me.store.nextPage({params:{search_value:search_value}});
					    }
					}
				},
				movePrevious:function(){
					var search_value 	   = Ext.getCmp('prin_search_value').getValue(),
						me  			   = this,
						total  			   = me.getPageData().pageCount,
						previous  		   = me.store.currentPage - 1;

						console.log(previous);
					if (previous <= total) {
					    if (me.fireEvent('beforechange', me, previous) !== false) {
					        me.store.previousPage({params:{search_value:search_value}});
					    }
					}
				},
				moveFirst:function(){
					var search_value 	   = Ext.getCmp('prin_search_value').getValue(),
						me  			   = this;

					me.store.getProxy().extraParams = {search_value:search_value};
					me.store.loadPage(1);
				},
				moveLast:function(){
					var search_value 	   = Ext.getCmp('prin_search_value').getValue(),
						me  			   = this,
						total  			   = me.getPageData().pageCount;

					me.store.getProxy().extraParams = {search_value:search_value};
					me.store.loadPage(total);
				},

				doRefresh : function(){
					var search_value 	   = Ext.getCmp('prin_search_value').getValue(),
						me  			   = this,
						total  			   = me.getPageData().pageCount,
						current 		   = me.store.currentPage;

					console.log(current)
					if (me.fireEvent('beforechange', me, current) !== false) {
						me.store.getProxy().extraParams = {search_value:search_value};
						me.store.loadPage(current);
					}
				}
			}]
		}]
});