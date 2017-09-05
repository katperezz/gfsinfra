Ext.define('GfsInfra.view.login.WindowReg', {
    extend: 'Ext.window.Window',
    xtype:'windowreg',
	requires:[
	'GfsInfra.view.login.Register'
	],
	
    reference: 'popupWindow',

    title: 'Accout Registration',
    width: 400,
    ui:'login-window',
    border:false,
    autoShow: true,
	frame: true,
	border:true,
	resizable: true,
	closable:false,
    closeAction: 'destroy',
	items: [
		{xtype:'register'}
	]
});