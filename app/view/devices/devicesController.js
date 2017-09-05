Ext.define('GfsInfra.view.devices.devicesController', {
    extend  : 'Ext.app.ViewController',
    alias   : 'controller.devices',

    requires: [
        'Ext.util.TaskRunner',        
        'Ext.form.action.StandardSubmit'
    ]
 });