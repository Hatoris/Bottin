$(document).ready(function(){
new Clipboard('.btn');

  $("#submit1").click(function () {
    if ($("#groupe").find("option:selected").val()>0) {
      var groupe = [];
      $("#groupe").find("option:selected").each(function (i, selected) {
              groupe[i] = $(selected).text();
              });

      if($("#groupe0:checked").val() == 'table')
        {
          $.ajax({
            url: "infos.php",
            type: "POST",
            data: 'groupe=' + groupe,
            success: function(result){
              $("#results1").html(result);
                $(".close").click( function (e) {
                  e.preventDefault(); $('#myAlert'+$(this).attr('target')).hide('fade');
                });
            }
          });
        }
      if($("#groupe1:checked").val() == 'email')
        {
          $.ajax({
            url: "infos.php",
            type: "POST",
            data: 'groupee=' + groupe,
            success: function(result){
              $("#results1").html(result);
              $(".close").click( function (e) {
                e.preventDefault(); $('#myAlert'+$(this).attr('target')).hide('fade');
              });
            }
          });
        };
    }
    else { alert('select something')};
    return false;
  });
});
