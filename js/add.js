$(document).ready(function() {
    var max_fields      = 10; //maximum input boxes allowed
    var max_fileds_superviseur = 2;
    var wrapper         = $(".input_fields_wrap_groupe"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID
    var add_groupe      = $(".add_field_button_groupe");//Add button group
    var add_supp        = $(".add_osup");//Add supervasier
    var z = 1; // initial count
    var x = 1; //initlal text box count
    var s = 1;

    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $("#occupations").append('<tr classe="' + x +'" id="a' + x +'"><td><label for="oname">Nom de l\'occupation:</label></br><input type="text" class="form-control" defaultvalue=" " id="oname" name="oname[' + x +']"></td><td><label for="oproject">Nom du projet:</label></br><input type="text" class="form-control" defaultvalue=" " id="oproject" name="oproject[' + x +']"></td><td id ="aa'+ x +'"><label for="osuper">Nom du superviseur:</label> <a href="#" class="glyphicon glyphicon-plus-sign add_osup" id="' + x + '" style="align: center"></a></br><input type="text" class="form-control" defaultvalue=" " id="osuper" name="osuper[' + x + ']"></td><td><label for="ostart">Date de debut:</label></br><input type="text" class="form-control" defaultvalue=" " id="ostart" name="ostart[' + x +']"></td><td><label for="oend">Date de fin:</label></br><input type="text" class="form-control" defaultvalue=" " id="oend" name="oend[' + x +']"></td><td><a href="#" class="glyphicon glyphicon-remove remove_field" id="' + x + '" style="align: center"></a></td></tr>'); //add input box
            z = 1;
        }
        $("#ostart, #oend").datepicker({
            format: 'yyyy-mm-dd',
            todayHighlight: true,
            autoclose: true,
        });
    });

    $("#occupations").on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault();  $("#a" + $(this).attr("id")).remove(); x--; s--;
    })

    var y = 1; //initlal text box count
    $(add_groupe).click(function(e){ //on add input button click
        e.preventDefault();
        if(y < max_fields){ //max input box allowed
            y++; //text box increment
            $("#groupes").append('<tr id="b' + y +'"><td><label for="gname">Nom du groupe:</label></br><input type="text" class="form-control" defaultvalue=" " id="gname" name="gname[' + y +']"> </td><td><label for="gstart">Date de debut:</label></br><input type="text" class="form-control" defaultvalue=" " id="gstart" name="gstart[' + y +']"></td><td><label for="gend">Date de fin:</label></br><input type="text" class="form-control" defaultvalue=" " id="gend" name="gend[' + y +']"></td><td><a href="#" class="glyphicon glyphicon-remove remove_field_groupe" id="' + y + '" style="align: center"></a></td></tr>'); //add input box
        }
        $("#gstart, #gend").datepicker({
            format: 'yyyy-mm-dd',
            todayHighlight: true,
            autoclose: true,
        });
    });

    $("#groupes").on("click",".remove_field_groupe", function(e){ //user click on remove text
        e.preventDefault(); $("#b" + $(this).attr("id")).remove(); y--;
    })



    $("#occupations").on("click", ".add_osup", function(e){
        e.preventDefault();
        if(z < max_fileds_superviseur) {
            z++;
            s++;
            $("#aa" + $(this).attr("id")).append('<tr id="g' + z +'"><td><input type="text" class="form-control col-md-1" content="width=80%" defaultvalue=" " id="'+ z +'" name="osuper1['+ s +']"></td><td><a href="#" class="glyphicon glyphicon-remove remove_osup" id="'+ z +'" style="align: center"></a></td></tr>');
            console.log( $(this).attr("id"));
        }

    });
    $("#occupations").on("click",".remove_osup", function(e){ //user click on remove text
        e.preventDefault(); $("#g" + $(this).attr("id")).remove(); z--; s--;
    });



});
