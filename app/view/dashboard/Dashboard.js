Ext.define('GfsInfra.view.dashboard.Dashboard',{
	extend 	 		:'Ext.Panel',
	xtype 	 		:'dashboard',
	defaults 		:{margin:10},
	title           : 'Dashboard',
	headerPosition  : 'top',
	bodyPadding     :20, 
	bbar 	  		:[
		{xtype:'displayfield', fieldStyle:'font-size:16px;font-face:arial', value	:'<b>Today : </b>'+Ext.Date.format(new Date(),'F j, Y')}
	],
	items 	:[

    {
        xtype       :'component',
        html        :'<div class="main-logo"><img src="resources/images/AL_header.png"></div>'
    },
    {
        xtype       : 'panel',
        layout      : 'fit',
        ui 			:'light',
        margin      :'11 0 0 0',
        items 		:[
        {xtype:'label',style:'color:#2f9fe9;font-weight:bold;font-face:arial', margin:5,html:'• Use this module for principal/dependent update, user reset and HMO deletion. <br>• User can also modified required documents by dependent. <br>• You may also use this for batch upload. <br>• All action was recorded to database and it is available on OMM logs tab.',iconCls:'x-fa fa-info-circle'}
        ]
    }
	],
	listeners:{
		beforerender:function(){
			// dash_panel.setHtml("<div class='tableauPlaceholder' style='width: 1173px; height: 863px;'><object class='tableauViz' width='1173' height='863' style='display:none;'><param name='host_url' value='https%3A%2F%2Freports.benefitsmadebetter.com%2F' /> <param name='site_root' value='&#47;t&#47;EXL' /><param name='name' value='EXLReportAsofOctober052016HMOProposalMasterlist&#47;EXLProposalSummary' /><param name='tabs' value='no' /><param name='toolbar' value='yes' /><param name='showShareOptions' value='true' /></object></div>")
		}

	}// beforerender :'onDashBeforerender'
});

