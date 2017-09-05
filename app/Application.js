/**
 * The main application class. An instance of this class is created by app.js when it
 * calls Ext.application(). This is the ideal place to handle application launch and
 * initialization details.
 */
Ext.define('GfsInfra.Application', {
    extend: 'Ext.app.Application',
    
    name: 'GfsInfra',

    stores: [
        // TODO: add global / shared stores here
    ],

    views: [
        'GfsInfra.view.login.Login',
        'GfsInfra.view.main.Main'
    ],
    
    launch: function () {
        // TODO - Launch the application
                // TODO - Launch the application
        var supportsLocalStorage = Ext.supports.LocalStorage, 
            loggedIn;

        if (!supportsLocalStorage) {
            // Alert the user if the browser does not support localStorage
            Ext.Msg.alert('Your Browser Does Not Support Local Storage');
            return;
        }

        loggedIn = localStorage.getItem("gfsLogin");
        console.log(loggedIn);


        if(loggedIn=='true'){
            // Ext.create('ActiveLink.view.viewport.ViewportController').onTrue();
            Ext.widget('main');
                        // TODO - Launch the application
        }else{
            console.log('false :' +loggedIn)
            Ext.widget('login');
        }

    },

    onAppUpdate: function () {
        Ext.Msg.confirm('Application Update', 'This application has an update, reload?',
            function (choice) {
                if (choice === 'yes') {
                    window.location.reload();
                }
            }
        );
    }
});
