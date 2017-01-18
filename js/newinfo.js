$(document).ready(function(){
  $("#submit").click(function(){
    if($("#name").val() !=''){
      var name = $("#name").val();
      // AJAX Code To Submit Form.
      $.ajax({
        url: "infos.php",
        type: "POST",
        data: 'name=' + name,
        success: function(result){
          if (result == 0){
            var html = '<div id="myAlert1" class="alert alert-danger" target="1" role="alert"><a id="linkClose" href="#" class="close">&times;</a> <strong>';
            var html2 = '</strong> , n\'existe pas la liste des membres de l\'AFAM!</div>';
            var all = html + name + html2;
            $("#results").fadeIn("slow", function() {
              $("#results").html(all)
            });
          }
          else {
            $("#results").fadeIn("slow", function() {
            $("#results").html(result);
            $('form').trigger('reset');
            });
          }

          $('.close').click( function (e) {
            e.preventDefault(); $('#myAlert'+$(this).attr('target')).hide('fade');
        });
      }
    });
  }
      else
      {
        alert ('remplissez au moins un champ');
      }

      return false;

  });

});
