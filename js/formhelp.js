$(document).ready(function(){
      $("#dob, #ostart, #oend, #gstart, #gend").datepicker({
          format: 'yyyy-mm-dd',
          todayHighlight: true,
          autoclose: true,
      });
      $("#submit").click(function(){
        if($("#name").val() !='') {
          if($("#sim").val() !='') {
            if($("#email").val() !='') {

            }
            else {
              alert ('Entrer une adresse courriel');
            }
          }
          else {
            alert ('Les informations SIM doivent etre remplies');
          }
        }
        else {
          alert ('Le nom et le prenom doit etre remplie');
        }
        return false;
      });
  });
