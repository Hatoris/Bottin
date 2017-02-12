$(document).ready(function(){
  $("#submit1").click(function() {
      var  datas = $("#modifyname").val();
      $('form#modify').trigger('reset');
    $.ajax({
      url : "testmodify.php",
      type : "POST",
      data : 'name=' + datas,
      success : function(response) {
        $("#results1").append(response);
          var max_fields      = 20; //maximum input boxes allowed
          var max_fileds_superviseur = 2;
          var wrapper         = $(".input_fields_wrap_groupe_bis"); //Fields wrapper
          var add_button      = $(".add_field_button_bis"); //Add button ID
          var add_groupe      = $(".add_field_button_groupe_bis");//Add button group
          var zzz = $().length;
          var zz = 1;
          var sss = $(".osup1").length
          var ss = sss - 1;

          var xx = $(".occ").length;
          var x = xx - 1;
          var yy = $(".gro").length;
          var y = yy - 1;
          console.log(x);
          $(add_button).on('click', function(e){ //on add input button click
            e.preventDefault();
            if(x < max_fields){ //max input box allowed
                ++x; //text box increment
                $("#occupationsbis" + $(this).attr("id")).append('<tr id="c' + x +'"><td><label for="oname">Nom de l\'occupation:</label></br><input type="text" class="form-control" defaultvalue=" " id="oname" name="oname[' + x +']"></td><td><label for="oproject">Nom du projet:</label></br><input type="text" class="form-control" defaultvalue=" " id="oproject" name="oproject[' + x +']"></td><td id ="bb'+ x +'"><label for="osuper">Nom du superviseur:</label> <a href="#" class="glyphicon glyphicon-plus-sign add_osup" id="' + x + '" style="align: center"></a></br><input type="text" class="form-control" defaultvalue=" " id="osuper" name="osuper[' + x +']"></td><td><label for="ostart">Date de debut:</label></br><input type="text" class="form-control" defaultvalue=" " id="ostart" name="ostart[' + x +']"></td><td><label for="oend">Date de fin:</label></br><input type="text" class="form-control" defaultvalue=" " id="oend" name="oend[' + x +']"></td><td><a href="#" class="glyphicon glyphicon-remove remove_field_bis" id="' + x + '" style="align: center"></a></td></tr>'); //add input box
                zz = 1;
                }
                $("#ostart, #oend").datepicker({
                    format: 'yyyy-mm-dd',
                    todayHighlight: true,
                    autoclose: true,
                });
                $("#occupationsbis" + $(this).attr("id")).on("click",".remove_field_bis", function(e){ //user click on remove text
                    e.preventDefault();  $("#c" + $(this).attr("id")).remove(); x--;

                })
            });
            $("#ostart, #oend").datepicker({
                format: 'yyyy-mm-dd',
                todayHighlight: true,
                autoclose: true,
            });
            $("#occupationsbis1").on("click",".remove_field_bis", function(e){ //user click on remove text
                e.preventDefault();  $("#c" + $(this).attr("id")).remove(); x--;

            })



            console.log(y);
            $(add_groupe).on('click', function(e){ //on add input button click
                e.preventDefault();
                if(y < max_fields){ //max input box allowed
                    ++y;
                    $("#groupesbis" + $(this).attr("id")).append('<tr id="d' + y +'"><td><label for="gname">Nom du groupe:</label></br><input type="text" class="form-control" defaultvalue=" " id="gname" name="gname[' + y +']"> </td><td><label for="gstart">Date de debut:</label></br><input type="text" class="form-control" defaultvalue=" " id="gstart" name="gstart[' + y +']"></td><td><label for="gend">Date de fin:</label></br><input type="text" class="form-control" defaultvalue=" " id="gend" name="gend[' + y +']"></td><td><a href="#" class="glyphicon glyphicon-remove remove_field_groupe_bis" id="' + y + '" style="align: center"></a></td></tr>'); //add input box

                }
                $("#gstart, #gend").datepicker({
                    format: 'yyyy-mm-dd',
                    todayHighlight: true,
                    autoclose: true,
                });
                $("#groupesbis" + $(this).attr("id")).on("click",".remove_field_groupe_bis", function(e){ //user click on remove text
                    e.preventDefault(); $("#d" + $(this).attr("id")).remove(); y--;

                })
            });
            $("#gstart, #gend").datepicker({
                format: 'yyyy-mm-dd',
                todayHighlight: true,
                autoclose: true,
            });


            $('.close').on('click', function (e) {
              e.preventDefault(); $('#'+$(this).attr('target')).hide('fade');
          });

          $(".submit2").on("click", function(e) {
            e.preventDefault();
            var datas = {};
           //alert("coucou");
         $("form.modifypeople" + $(this).attr("id")).find('[name]').each(function(index, value) {
           if($(this).val() == ' ') {
             var vals = $(this).attr('defaultvalue');
           }
           else {
            var vals = $(this).val();
           };

             var sa = $(this),
                 name = sa.attr('name');
                 //value = vals,
           datas[name] = vals;
         });

         $.ajax({
           url : 'testmodify2.php',
           type : 'post',
           data : datas,
           success : function(res2) {
                $(".results2").append(res2);

           }
         });
        });

        $("#occupationsbis1").on("click", ".add_osup", function(e){
              e.preventDefault();
              if(zz < max_fileds_superviseur) {
                  zz++;
                  ss++;
                  $("#bb" + $(this).attr("id")).append('<tr id="g' + zz +'"><td><input type="text" class="form-control col-md-1" content="width=80%" defaultvalue=" " id="'+ zz +'" name="osuper1['+ ss +']"></td><td><a href="#" class="glyphicon glyphicon-remove remove_osup" id="'+ zz +'" style="align: center"></a></td></tr>');
                  console.log( $(this).attr("id"));
              }

          });
          $("#occupationsbis1").on("click",".remove_osup", function(e){ //user click on remove text
              e.preventDefault(); $("#g" + $(this).attr("id")).remove(); zz--; ss--;
          });
          $("#groupesbis1").on("click",".remove_field_groupe_bis", function(e){ //user click on remove text
                  e.preventDefault(); $("#d" + $(this).attr("id")).remove(); y--;
              });
      }
    });
    return false;
  });
  function getNumbers(inputString){
    var regex=/\d+\.\d+|\.\d+|\d+/g,
        results = [],
        n;

    while(n = regex.exec(inputString)) {
        results.push(parseFloat(n[0]));
    }

    return results;
}

});
