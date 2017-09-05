Ext.define('GfsInfra.view.print.printController', {
    extend  : 'Ext.app.ViewController',
    alias   : 'controller.print',

    requires: [
        'Ext.util.TaskRunner',        
        'Ext.form.action.StandardSubmit'
    ]
 });