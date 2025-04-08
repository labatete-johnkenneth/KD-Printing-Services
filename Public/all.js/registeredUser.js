var formatBlock = function() {
    return {
        message: 'Please Wait <img style="display:inline;width:20px;height:20px;" src="public/img/loader.gif"/>',
        css: {
            border: 'none',
            padding: '15px',
            backgroundColor: '#000',
            '-webkit-border-radius': '10px',
            '-moz-border-radius': '10px',
            opacity: .5,
            color: '#fff'
        }
    };
}


 var registeredUserTable = function(){
      var userTable = $('#example').DataTable({
        // "ordering": false, 
        "sAjaxSource":  "fetch_users.php",
        "sAjaxDataProp": "value",
        
              "aoColumns": [{
                "mDataProp": "Firstname",
            },{
                "mDataProp": "Lastname",
                 },{
                "mDataProp": "Email",
                 },{
                "mDataProp": "Username",
                 },{
                "mDataProp": "Password",
            }]
            });
 
}



var RegisteredUser = function() {
    "use strict";
    
    return {
        init: function() {
          registeredUserTable();
        
        }
    }
}
