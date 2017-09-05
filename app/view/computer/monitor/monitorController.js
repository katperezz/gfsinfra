
Ext.create('Ext.data.Store',{
    id      :'location',
    fields  : ['dept'],
    data    : [
        {"dept":"DEV"},
        {"dept":"IT"},
        {"dept":"MKTG"}
    ]
});

Ext.define('GfsInfra.view.computer.monitor.monitorController', {
    extend  : 'Ext.app.ViewController',
    alias   : 'controller.monitor',

    requires: [
        'Ext.util.TaskRunner',        
        'Ext.form.action.StandardSubmit'
    ],
    
    addMonitor:function(){

        if(Ext.getCmp('form_submit')){
          Ext.getCmp('form_submit').destroy();
        }

        var win    =   new Ext.Window({
            title       :'Add Monitor record',
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
                {fieldLabel:'Custodian', name:'custodian', reference:'custodian'},
                {
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
                {fieldLabel:'Asset tag number', name:'asst_tag_no', reference:'asst_tag_no',allowBlank:false},
                {fieldLabel:'Serial number', name:'serial_no', reference:'serial_no',allowBlank:false},
                {fieldLabel:'Model', name:'model', reference:'model',allowBlank:false},
                {fieldLabel:'Brand', name:'brand', reference:'brand',allowBlank:false},
                {fieldLabel:'Specification', name:'specification', reference:'specification'},
                {fieldLabel:'Acquisition date', name:'acquisition_date', reference:'acquisition_date', xtype:'datefield',editable:false},
                {fieldLabel:'Warranty', name:'warranty', reference:'warranty'},
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
                        wait            :true,url:'../data/monitor/add_monit_details.php',
                        waitMsg         :'Processing your request',
                        waitConfig      :{duration:3000,increment:3,text:'Loading...',scope:this,fn:function(){Ext.MessageBox.hide()}},
                        submitEmptyText :false,
                        success         :function(){
                          Ext.MessageBox.show({title:'Monitor',msg:'Success',closable:false,icon:Ext.Msg.INFO,buttonText:{ok:'OK'}});
                          Ext.getCmp('monit_grid').getStore().load();
                          form.reset();
                          win.close();
                        },failure:function(form,action){
                          Ext.MessageBox.show({title:'Monitor',msg:'Failed',closable:false,icon:Ext.Msg.WARNING,buttonText:{ok:'OK'}});
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

    showMonitLogs:function(grid, rowIndex, colIndex){
        var rec  = grid.getStore().getAt(rowIndex),
            id   = rec.get('asst_tag_no');
        var g    = Ext.getCmp('monit_grid');                                
        var user = localStorage.getItem('gfsUserDetails'),
            obj  = JSON.parse(user);                    
        var me                = this;

        console.log(rec)
        if(Ext.getCmp('logs_info_thread')){
          Ext.getCmp('logs_info_thread').destroy();
        }

        var win           = new Ext.Window({
            closeAction   :'hide',
            width         :'50%',
            height        :600,
            overflowY    :'scroll',
            overflowX    :'none',
            layout        :'fit',
            title         :'Logs for '+rec.get('asst_tag_no'),
            controller    :'monitor',
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
                  id          :'logs_info_thread',
                  listeners   :{
                      beforerender :function(btn){
                          console.log(btn.up('panel'))
                          var logs_info_thread      = Ext.getCmp('logs_info_thread'),
                              monit_logs_store        = this.monit_logs_store=Ext.create('GfsInfra.store.monitor.Get_monit_logs'),
                              i                       = 1;

                          console.log(monit_logs_store.data);
                          monit_logs_store.removeAll();

                          monit_logs_store.getProxy().extraParams = {id:id};                       
                          monit_logs_store.on('load',function(store,record,successful,eOpts){
                            monit_logs_store.each(function(record){
                              var action    = record.get('action'),
                                  user      = record.get('user'),
                                  date      = Ext.Date.format(new Date(record.get('timestamp')), 'F d, Y g:i a');

                                  logs_info_thread.add({
                                      xtype :'label',
                                      margin :'0 10',
                                      html :'<p style="color:#3AB09E;font-weight:bold;font-face:arial;margin-top: 5px;margin-left:5px;">'+action+'<br>'+user+'<br>'+date+'<hr align=2><br>'
                                  });                                                                       
                              i++
                            });
                              
                          });
                          monit_logs_store.load();
                      }
                  }                        
              }
            ]
        });

    },

    monit_logs_AjaxRequest_getId:function(ids,total_count,rec){
        var me               = this,
            monit_note_thread =Ext.getCmp('monit_note_thread');  
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
        console.log(this.monit_logs_store.load())
    }

 });