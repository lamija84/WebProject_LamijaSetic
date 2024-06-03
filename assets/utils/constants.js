
var Constants = {
    get_api_base_url: function () {
      if(location.hostname == 'localhost'){
        return "http://localhost/WebProject_LamijaSetic_new/";
      } else {
        return "https://king-prawn-app-yg9m8.ondigitalocean.app/";
      }
    }
  };