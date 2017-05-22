/*
 *ELizabeth Benner
 *blog-script.js
 *Scripts for the it 328 blogs assignment
 */
//input script adapted from: https://www.abeautifulsite.net/whipping-file-inputs-into-shape-with-bootstrap-3
$(document).on('change', ':file', function() {
    var input = $(this),
        label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
    input.trigger('fileselect', [label]);
});

$(document).ready( function() {
    $(':file').on('fileselect', function(event, label) {

           var input = $(this).parents('.input-group').find(':text');

          if( input.length ) {
              input.val(label);
          } else {
              if( label ) alert(label);
          }

    });
});

//Password verification script adapted from: http://jsfiddle.net/dbwMY/
$(document).ready(function() {
  $("#password-verify").keyup(validate);
});


function validate() {
  var password = $("#password").val();
  var verify = $("#password-verify").val();

    
 
    if(password == verify) {
        $("#verify-status").removeClass("text-danger");
        $("#verify-status").addClass("text-success");
        $("#verify-status").text("Passwords match");        
    }
    else {
        $("#verify-status").removeClass("text-success");
        $("#verify-status").addClass("text-danger");
        $("#verify-status").text("Passwords do not match!");  
    }
    
}