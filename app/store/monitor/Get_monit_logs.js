Ext.define('GfsInfra.store.monitor.Get_monit_logs', {
    extend  : 'Ext.data.ArrayStore',
    alias   : 'GfsInfra.get_monit_logs',
    storeId :'gridstore',
    sorters     :[{property:'id',direction:'ASC'}],
    sortRoot    :'id',
    sortOnLoad  :true,
    // model   : 'GfsInfra.model.principal.PrincipalDependentModel',
    proxy   : {
        type    : 'ajax',
        timeout :2000000,
        api     : {
            read:'../data/monitor/get_monit_logs.php'
        },
        actionMethods   : 'GET',
        extraParams     : {
            prin_al_id  : ''
        },
        reader          : {
            type            : 'json',
            rootProperty    : 'data',
            totalProperty   : 'total',
            successProperty : 'success'
        },
        writer         : {
            type        : 'json',
            rootProperty: 'data',
            encode      : true
        }
    }
});