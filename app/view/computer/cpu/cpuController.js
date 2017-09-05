
Ext.create('Ext.data.Store',{
    id      :'location',
    fields  : ['dept'],
    data    : [
        {"dept":"DEV"},
        {"dept":"IT"},
        {"dept":"MKTG"}
    ]
});

Ext.define('GfsInfra.view.computer.cpu.cpuController', {
    extend  : 'Ext.app.ViewController',
    alias   : 'controller.cpu',

    requires: [
        'Ext.util.TaskRunner',        
        'Ext.form.action.StandardSubmit'
    ],
    
    addCPU:function(){

        if(Ext.getCmp('form_submit')){
          Ext.getCmp('form_submit').destroy();
        }

        var win    =   new Ext.Window({
            title       :'Add CPU record',
            width       :'70%',
            height      :'85%',
            modal       :true,
            closeAction :'hide',
            bodyPadding :5,
            autoScroll  :true,           
            items       :[
            {
                xtype         :'form',
                id            :'form_submit',
                defaultType   :'textfield',
                bodyPadding   :5,
                defaults      :{anchor:'80%',labelWidth:200,fieldStyle:'font-size:12px;',labelStyle:'font-size:12px;'},
                items         :[
                {fieldLabel:'Custodian', name:'custodian', reference:'custodian',allowBlank:false},                {
                  xtype        :'combobox',
                  fieldLabel   :'Location',
                  name         :'location',
                  store        :'location',
                  valueField   :'dept',
                  displayField :'dept',
                  editable     :false,
                  triggerAction:'all',
                  allowBlank   :false
                },
                {fieldLabel:'Asset tag number', name:'asst_tag_no', reference:'asst_tag_no'},
                {fieldLabel:'Serial number', name:'serial_no', reference:'serial_no'},
                {fieldLabel:'Model', name:'model', reference:'model'},
                {fieldLabel:'Brand', name:'brand', reference:'brand'},
                {fieldLabel:'Specification', name:'specification', reference:'specification'},
                {fieldLabel:'Mac address LAN', name:'mac_addr_lan', reference:'mac_addr_lan'},
                {fieldLabel:'Mac address WAN', name:'mac_addr_wan', reference:'mac_addr_wan'},
                {fieldLabel:'OS', name:'os', reference:'os'},
                {fieldLabel:'Win10 OS license', name:'win10_os_license', reference:'win10_os_license'},
                {fieldLabel:'Win7 OS license', name:'win7_os_license', reference:'win7_os_license'},
                {fieldLabel:'Acquisition Date', name:'acquisition_date', reference:'acquisition_date'},
                {fieldLabel:'LTTPS', name:'LTTPS', reference:'LTTPS'},
                {fieldLabel:'NBD', name:'NBD', reference:'NBD'},
                {fieldLabel:'POW', name:'POW', reference:'POW'},
                {fieldLabel:'ProSupport IT tech', name:'proSupport_IT_tech', reference:'proSupport_IT_tech'},
                {fieldLabel:'Remarks', name:'remarks', reference:'remarks',xtype:'textareafield'}
                ]
            }],
            buttons     :{
              layout  :'hbox',
                items:[
                '->',
                {
                  text   :'Save',
                  ui     :'soft-purple',
                  margin :'10 25 10 10',
                  handler:function(){
                    // var form  =this.up('form').getForm();
                    var form = Ext.getCmp('form_submit').getForm();
                    var values=form.getValues();
                    var user  =localStorage.getItem('gfsUserDetails'),
                        obj   =JSON.parse(user);

                    if(form.isValid()){
                      form.submit({
                        params          :{user:obj['email']},
                        wait            :true,url:'../data/cpu/add_cpu_details.php',
                        waitMsg         :'Processing your request',
                        waitConfig      :{duration:3000,increment:3,text:'Loading...',scope:this,fn:function(){Ext.MessageBox.hide()}},
                        submitEmptyText :false,
                        success         :function(){
                          Ext.MessageBox.show({title:'UPS',msg:'Success',closable:false,icon:Ext.Msg.INFO,buttonText:{ok:'OK'}});
                          Ext.getCmp('cpu_grid').getStore().load();
                          form.reset();
                          win.close();
                        },failure:function(form,action){
                          Ext.MessageBox.show({title:'CPU',msg:'Failed',closable:false,icon:Ext.Msg.WARNING,buttonText:{ok:'OK'}});
                        }
                      });

                    }else{

                      Ext.MessageBox.show({title:'WARNING',msg:'Please check form values',closable:false,icon:Ext.Msg.WARNING,buttonText:{ok:'OK'}})
                    }
                  }
                }           
                ]}
        });win.show(this);
    },

    showCPULogs:function(grid, rowIndex, colIndex){
        var rec  = grid.getStore().getAt(rowIndex),
            id   = rec.get('asst_tag_no');
        var g    = Ext.getCmp('cpu_grid');                                
        var user = localStorage.getItem('gfsUserDetails'),
            obj  = JSON.parse(user);                    
        var me                = this;

        console.log(id)
        if(Ext.getCmp('info_thread')){
          Ext.getCmp('info_thread').destroy();
        }

        var win           = new Ext.Window({
            closeAction   :'hide',
            width         :'50%',
            height        :600,
            overflowY    :'scroll',
            overflowX    :'none',
            layout        :'fit',
            title         :'Logs for '+rec.get('asst_tag_no'),
            controller    :'cpu',
            scope         :this,
            initCenter    :true,
            autoShow      :true,
            autoScroll    :true,
            titleAlign    :'center',
            closable      :true,
            items         :[
            {
                  xtype       :'panel',
                  layout      :'fit',
                  id          :'info_thread',
                  listeners   :{
                      beforerender :function(btn){
                          console.log(btn.up('panel'))
                          var info_thread      = Ext.getCmp('info_thread'),
                              logs_store        = this.logs_store=Ext.create('GfsInfra.store.logs.Get_logs'),
                              i                       = 1;

                          console.log(logs_store.data);
                          logs_store.removeAll();

                          logs_store.getProxy().extraParams = {id:id};                       
                          logs_store.on('load',function(store,record,successful,eOpts){
                            logs_store.each(function(record){
                              var action    = record.get('action'),
                                  user      = record.get('user'),
                                  date      = Ext.Date.format(new Date(record.get('timestamp')), 'F d, Y g:i a');

                                  info_thread.add({
                                      xtype :'label',
                                      margin :'0 10',
                                      html :'<p style="color:#3AB09E;font-weight:bold;font-face:arial;margin-top: 5px;margin-left:5px;">'+action+'<br>'+user+'<br>'+date+'<hr align=2><br>'
                                  });                                                                       
                              i++
                            });
                              
                          });
                          logs_store.load();
                      }
                  }                        
              }
            ]
        });

    },

    cpu_logs_AjaxRequest_getId:function(ids,total_count,rec){
        var me               = this,
            monit_note_thread =Ext.getCmp('cpu_note_thread');  
            var win = Ext.WindowManager.getActive();

            console.log(rec)
            var action    = rec['action'],
                user      = rec['user'],
                date      = rec['timestamp'];

        console.log(rec);
    		win.add({
    			xtype :'label',
    			html :'<p style="color:#3AB09E;font-weight:bold;font-face:arial;margin-top: 5px;margin-left:5px;">'+user+'<br>'+action
    		});        
        console.log(this.cpu_logs_store.load())
    }

 });