$(document).ready(function() {
    var max_fields      = 10; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap_groupe"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID
    var add_groupe      = $(".add_field_button_groupe");//Add button group

    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $("#occupations").append('<tr id="a' + x +'"><td><label for="oname">Nom de l\'occupation:</label></br><input type="text" class="form-control" id="oname" name="oname[]"></td><td><label for="oproject">Nom du projet:</label></br><input type="text" class="form-control" id="oproject" name="oproject[]"></td><td><label for="osuper">Nom du superviseur:</label></br><input type="text" class="form-control" id="osuper" name="osuper[]"></td><td><label for="ostart">Date de debut:</label></br><input type="text" class="form-control" id="ostart" name="ostart[]"></td><td><label for="oend">Date de fin:</label></br><input type="text" class="form-control" id="oend" name="oend[]"></td><td><a href="#" class="glyphicon glyphicon-remove remove_field" id="' + x + '" style="align: center"></a></td></tr>'); //add input box
        }
        $("#ostart, #oend").datepicker({
            format: 'yyyy-mm-dd',
            todayHighlight: true,
            autoclose: true,
        });
    });

    $("#occupations").on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault();  $("#a" + $(this).attr("id")).remove(); x--;
    })

    var y = 1; //initlal text box count
    $(add_groupe).click(function(e){ //on add input button click
        e.preventDefault();
        if(y < max_fields){ //max input box allowed
            y++; //text box increment
            $("#groupes").append('<tr id="b' + y +'"><td><label for="gname">Nom du groupe:</label></br><input type="text" class="form-control" id="gname" name="gname[]"> </td><td><label for="gstart">Date de debut:</label></br><input type="text" class="form-control" id="gstart" name="gstart[]"></td><td><label for="gend">Date de fin:</label></br><input type="text" class="form-control" id="gend" name="gend[]"></td><td><a href="#" class="glyphicon glyphicon-remove remove_field_groupe" id="' + y + '" style="align: center"></a></td></tr>'); //add input box
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


});
