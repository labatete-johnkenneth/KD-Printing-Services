// Get the element where you want to display the date.
const dateElement = document.getElementById('date');

// Function to update the date.
function updateDate() {
  const today = new Date();
  const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
  const formattedDate = today.toLocaleDateString('en-US', options);
  dateElement.textContent = formattedDate;
}

// Call the updateDate function initially to set the date.
updateDate();

// You can also call updateDate function periodically to keep the date updated.
// For example, you could call it every second:
setInterval(updateDate, 1000);



var formatBlock = function(blockmsg) {
  return {
      message: blockmsg,
      css: {
          border: 'none',
          padding: '15px',
          backgroundColor: '#000',
          '-webkit-border-radius': '10px',
          '-moz-border-radius': '10px',
          opacity: .5,
          color: '#fff',
          width: '200px'
      }
  };
}

var checkSession = function() {
  $.get('checksession.php', function(data) {
      var sessiondata = $.parseJSON(data);
      if(!sessiondata.isSuccess) {
          $(location).attr('href','login.html');
      } else {
              loadFirst();
      }
  });
};


var loadFirst = function() {
  setTimeout(function() {
      $('#core').removeClass('hidden');
      // $('#loader').addClass('hidden');
  }, 1000);
};


  $("#signups").click(function(){
      var blockmsg = 'Please wait <img style="display:inline;width:20px;height:20px;" src="public/img/loader.gif"/>';

      $('#main-content').block(formatBlock(blockmsg));
      $('#main-content').fadeOut('400', function() {
          
          
          $.get('registeredUser.html', function(data) {
              $('#main-content').html(data);
              $('#viewstitle').html('');
              $('#main-content').fadeIn('400');
              $('#main-content').unblock();
          });   
      });
  });




   
  $('#logout').click(function(){
      $.get('logout.php', function(data) {
          checkSession();
      });    
  });
  
 



  

  $("#registeredUser").click(function(){
      var blockmsg = 'Please wait <img style="display:inline;width:20px;height:20px;" src="public/img/loader.gif"/>';

      $('#main-content').block(formatBlock(blockmsg));
      $('#main-content').fadeOut('400', function() {
          
          $.get('registeredUser.html', function(data) {
              $('#main-content').html(data);
              $('#viewstitle').html('');
              $('#main-content').fadeIn('400');
              $('#main-content').unblock();
          });   
      });
  });


  $("#users").click(function(){
      var blockmsg = 'Please wait <img style="display:inline;width:20px;height:20px;" src="public/img/loader.gif"/>';

      $('#main-content').block(formatBlock(blockmsg));
      $('#main-content').fadeOut('400', function() {
          
          $.get('registeredUser.html', function(data) {
              $('#main-content').html(data);
              $('#viewstitle').html('');
              $('#main-content').fadeIn('400');
              $('#main-content').unblock();
          });   
      });
  });

$("#collections").click(function(){
      var blockmsg = 'Please wait <img style="display:inline;width:20px;height:20px;" src="public/img/loader.gif"/>';

      $('#main-content').block(formatBlock(blockmsg));
      $('#main-content').fadeOut('400', function() {
          
          $.get('collections.html', function(data) {
              $('#main-content').html(data);
              $('#viewstitle').html('');
              $('#main-content').fadeIn('400');
              $('#main-content').unblock();
          });   
      });
  });

$("#completed").click(function(){
      var blockmsg = 'Please wait <img style="display:inline;width:20px;height:20px;" src="public/img/loader.gif"/>';

      $('#main-content').block(formatBlock(blockmsg));
      $('#main-content').fadeOut('400', function() {
          
          $.get('completed.html', function(data) {
              $('#main-content').html(data);
              $('#viewstitle').html('');
              $('#main-content').fadeIn('400');
              $('#main-content').unblock();
          });   
      });
  });

  $("#ongoing").click(function(){
    var blockmsg = 'Please wait <img style="display:inline;width:20px;height:20px;" src="public/img/loader.gif"/>';

    $('#main-content').block(formatBlock(blockmsg));
    $('#main-content').fadeOut('400', function() {
        
        $.get('ongoing.html', function(data) {
            $('#main-content').html(data);
            $('#viewstitle').html('');
            $('#main-content').fadeIn('400');
            $('#main-content').unblock();
        });   
    });
});

  $('#index').click(function(event) {
    var blockmsg = 'Please wait <img style="display:inline;width:20px;height:20px;" src="public/img/loader.gif"/>';

        $('#main-content').block(formatBlock(blockmsg));
        $('#main-content').fadeOut('400', function() {
            
            
            $.get('dashboard.html', function(data) {
                $('#main-content').html(data);
                $('#viewstitle').html('Dashboard');
                $('#main-content').fadeIn('400');
                $('#main-content').unblock();
            });   
        });
  });
// }

var Index = function() {
  "use strict";
  
  return {
      init: function() {
          checkSession()
           

      }
  }
}()
