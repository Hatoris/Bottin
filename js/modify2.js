$(document).ready(function(){

  $("#submit1").click(function() {
      var  datas = $("#modifyname").val();

        $.ajax({
          url : "testmodify.php",
          type : "POST",
          data : 'name=' + datas,
          success : function(response) {
            $("#results1").append(response);


            var max_fields      = 100; //maximum input boxes allowed
            var wrapper         = $(".input_fields_wrap_groupe_bis"); //Fields wrapper
            var add_button      = $(".add_field_button_bis"); //Add button ID
            var add_groupe      = $(".add_field_button_groupe_bis");//Add button group

            var x = 20 ;
            $(add_button).on('click', function(e){ //on add input button click
                e.preventDefault();
                if(x < max_fields){ //max input box allowed
                    x++; //text box increment
                    $("#occupationsbis" + $(this).attr("id")).append('<tr id="c' + x +'"><td><label for="oname">Nom de l\'occupation:</label></br><input type="text" class="form-control" defaultvalue=" " id="oname" name="oname[' + x +']"></td><td><label for="oproject">Nom du projet:</label></br><input type="text" class="form-control" defaultvalue=" " id="oproject" name="oproject[' + x +']"></td><td><label for="osuper">Nom du superviseur:</label></br><input type="text" class="form-control" defaultvalue=" " id="osuper" name="osuper[' + x +']"></td><td><label for="ostart">Date de debut:</label></br><input type="text" class="form-control" defaultvalue=" " id="ostart" name="ostart[' + x +']"></td><td><label for="oend">Date de fin:</label></br><input type="text" class="form-control" defaultvalue=" " id="oend" name="oend[' + x +']"></td><td><a href="#" class="glyphicon glyphicon-remove remove_field_bis" id="' + x + '" style="align: center"></a></td></tr>'); //add input box
                    console.log(x);
                }
                $("#ostart, #oend").datepicker({
                    format: 'yyyy-mm-dd',
                    todayHighlight: true,
                    autoclose: true,
                });
                $("#occupationsbis" + $(this).attr("id")).on("click",".remove_field_bis", function(e){ //user click on remove text
                    e.preventDefault();  $("#c" + $(this).attr("id")).remove(); x--;
                    console.log(x);
                })
            });

            /*
              $(".gro").find('[tr]').each(function(){
                      y++;
              });
              var y =  $("gro:last").attr("id");
              */
              var y = 20;

            $(add_groupe).on('click', function(e){ //on add input button click
                e.preventDefault();
                if(y < max_fields){ //max input box allowed
                    y++;
                    $("#groupesbis" + $(this).attr("id")).append('<tr id="d' + y +'"><td><label for="gname">Nom du groupe:</label></br><input type="text" class="form-control" defaultvalue=" " id="gname" name="gname[' + y +']"> </td><td><label for="gstart">Date de debut:</label></br><input type="text" class="form-control" defaultvalue=" " id="gstart" name="gstart[' + y +']"></td><td><label for="gend">Date de fin:</label></br><input type="text" class="form-control" defaultvalue=" " id="gend" name="gend[' + y +']"></td><td><a href="#" class="glyphicon glyphicon-remove remove_field_groupe_bis" id="' + y + '" style="align: center"></a></td></tr>'); //add input box
                    console.log(y);
                }
                $("#gstart, #gend").datepicker({
                    format: 'yyyy-mm-dd',
                    todayHighlight: true,
                    autoclose: true,
                });
                $("#groupesbis" + $(this).attr("id")).on("click",".remove_field_groupe_bis", function(e){ //user click on remove text
                    e.preventDefault(); $("#d" + $(this).attr("id")).remove(); y--;
                    console.log(y);
                })
            });


          }

        });
        return false;
  });
});
