/**
 * This class is the controller for the main view for the application. It is specified as
 * the "controller" of the Main view class.
 *
 * TODO - Replace this content of this view to suite the needs of your application.
 */
Ext.define('CIS.view.laptop.laptopController', {
    extend: 'Ext.app.ViewController',

    alias: 'controller.laptop',



    addLaptop:function(){

        var win    =   new Ext.Window({
            width       :'70%',
            height      :'90%',
            modal       :true,
            maximizable :true,
            resizable   :false,
            closeAction :'hide',
            bodyPadding :10,
            title       :'Add Laptop record',
            overflowY   :'scroll', 			                   
            items       :[
            {
                xtype         :'form',
                defaultType   :'textfield',
                bodyPadding   :5,
                defaults      :{anchor:'80%',labelWidth:200,fieldStyle:'font-size:12px;',labelStyle:'font-size:12px;'},
                items           :[
                {fieldLabel:'custodian', name:'custodian', reference:'custodian'},
                {fieldLabel:'location', name:'location', reference:'location',allowBlank:false},
                {fieldLabel:'asst_tag_no', name:'asst_tag_no', reference:'asst_tag_no',allowBlank:false},
                {fieldLabel:'serial_no', name:'serial_no', reference:'serial_no',allowBlank:false},
                {fieldLabel:'model', name:'model', reference:'model',allowBlank:false},
                {fieldLabel:'brand', name:'brand', reference:'brand',allowBlank:false},
                {fieldLabel:'mac_address_lan', name:'mac_address_lan', reference:'mac_address_lan',allowBlank:false},
                {fieldLabel:'mac_address_wan', name:'mac_address_wan', reference:'mac_address_wan',allowBlank:false},
                {fieldLabel:'specification', name:'specification', reference:'specification',allowBlank:false},
                {fieldLabel:'OS', name:'OS', reference:'OS',allowBlank:false},
                {fieldLabel:'OS_license', name:'OS_license', reference:'OS_license',allowBlank:false},
                {fieldLabel:'acquisition_date', name:'acquisition_date', reference:'acquisition_date'},
                {fieldLabel:'LTTPS', name:'LTTPS', reference:'LTTPS'},
                {fieldLabel:'NBD', name:'NBD', reference:'NBD'},
                {fieldLabel:'POW', name:'POW', reference:'POW'},
                {fieldLabel:'proSupport_IT_tech', name:'proSupport_IT_tech', reference:'proSupport_IT_tech'},
                {fieldLabel:'remarks', name:'remarks', reference:'remarks'}
                ]
            }],
            buttons     :{
            	layout 	:'hbox',
                items:[
                '->',
			     {
                    text    :'Save',
                    ui      :'soft-purple',
                    margin 	:'10 25 10 10',
                    handler :function(){
                        var form    = this.up('form').getForm();
                        var values  = form.getValues();                             
                        var user    = localStorage.getItem('gfsUserDetails'),
                            obj     = JSON.parse(user);

                        if(form.isValid()){   
                            form.submit({                                  
                                params           :{user:obj['email'] },
                                wait             :true,
                                url              :'../data/laptop/add_laptop_details.php',
                                waitMsg          :'Processing your request',
                                waitConfig       :{duration:3000, increment:3, text:'Loading...', scope:this, fn:function(){Ext.MessageBox.hide();}},
                                submitEmptyText  :false,
                                success          :function(){
                                    Ext.MessageBox.show({title:'Monitor',msg:'Success',closable:false,icon:Ext.Msg.INFO,buttonText:{ok:'OK'}});
                                    Ext.getCmp('monit_grid').getStore().load();
                                    form.reset();
                                },
                                failure          :function(form, action){
                                    Ext.MessageBox.show({title:'Monitor',msg:'Failed',closable:false,icon:Ext.Msg.WARNING,buttonText:{ok:'OK'}});
                               
                                }
                            
                            });
                        
                        }else{Ext.MessageBox.show({title:'WARNING',msg:'Please check form values',closable:false,icon:Ext.Msg.WARNING,buttonText:{ok:'OK'}});}
                    }
                }
                ]}
        });win.show(this);
    },

    showLaptopLogs:function(grid, rowIndex, colIndex){
        var rec  = grid.getStore().getAt(rowIndex),
            id   = rec.get('asst_tag_no');
        var g    = Ext.getCmp('laptop_grid');                                
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
            controller    :'laptop',
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

    }


});
