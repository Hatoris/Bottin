$(document).ready(function() {
    $("#dob, #ostart, #oend, #gstart, #gend").datepicker({
        format: 'yyyy-mm-dd',
        todayHighlight: true,
        autoclose: true,
    });


 var selector = 'input#gname';
 $(document).on('keydown.autocomplete', selector, function() {
     $(this).autocomplete({
        source : 'groupe.php',
        minLength : 1,

     });
     //console.log(groupes);
 });

    $("#submit").click(function() {
        var datas = {};
        //console.log("trigger");
        $("form.addpeople").find('[name]').each(function(index, value) {
            if ($(this).val() == '') {
                var vals = $(this).attr('defaultvalue');
            } else {
                var vals = $(this).val();
            }

            var name = $(this).attr('name');
            //value = vals,
            datas[name] = vals;
            //console.log(datas);
        });

        $.ajax({
            url: 'testadd.php',
            type: 'POST',
            data: datas,
            dataType: 'json',
            success: function(res) {
                if (res.status == 'Success') {
                    $("#results").append('<div class="alert alert-success" role="alert"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span><span class="sr-only">Success:</span><strong> ' + res.name + ' </strong> a bien été ajouté aux membres de l\'AFAM</div>');
                    setTimeout(function() {
                        $('.alert').remove();
                    }, 2000);
                    $('form.addpeople').trigger('reset');
                    //console.log(res.osup);
                } else if (res.status == 'error') {
                    $("#results").append('<div class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span><span class="sr-only">Error:</span><strong> ' + res.name + ' </strong> </div>');
                } else {
                    $("#results").append('<div class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span><span class="sr-only">Error:</span> Vous n\'avaez pas remplis le nom, le sim ou le courriel' + res + '</div>');
                }
            }
        });



        return false;
    });

});
