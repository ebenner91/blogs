
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