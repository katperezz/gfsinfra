Ext.define('GfsInfra.view.main.hidden.Logout_main', {
    extend: 'Ext.form.Panel',
	
   xtype:'logout_main',
     id:'logout_main',
    items:[ {
        xtype: 'hiddenfield',
        name: 'logout',
        value: 'logout'
    }]
  
});
