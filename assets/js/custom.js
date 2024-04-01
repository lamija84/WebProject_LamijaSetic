$(document).ready(function() {

  
    var app = $.spapp({pageNotFound : 'error_404'}); // initialize
  
    // define routes
    app.route({view: 'home', load: 'home.html' });
    app.route({view: 'about', load: 'about.html' });
    app.route({view: 'services', load: 'services.html' });
    app.route({view: 'departments', load: 'departments.html' });
    app.route({view: 'doctors', load: 'doctors.html' });
    app.route({view: 'contact', load: 'contact.html' });
    app.route({view: 'apointment', load: 'apointment.html' });

  
    // run app
    app.run();
  
  });