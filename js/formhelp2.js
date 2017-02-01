$(document).ready(function(){
      $("#dob, #ostart, #oend, #gstart, #gend").datepicker({
          format: 'yyyy-mm-dd',
          todayHighlight: true,
          autoclose: true,
      });

      $("#submit").click(function() {
        var datas = {};

              $("form.addpeople").find('[name]').each(function(index, value) {
                if($(this).val() == '') {
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
                url : 'testadd.php',
                type : 'post',
                data : datas,
                dataType: "json",
                success : function(res) {
                  if(res.status == 'Success'){
                    $("#results").append('<div class="alert alert-success" role="alert"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span><span class="sr-only">Success:</span><strong> ' + res.name + ' </strong> a bien été ajouté aux membres de l\'AFAM</div>');
                    $('form.addpeople').trigger('reset');
                    console.log(res.osup);
                  }
                  else {
                    $("#results").append('<div class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span><span class="sr-only">Error:</span> Vous n\'avaez pas remplis le nom, le sim ou le courriel</div>');
                  }
                },
              });



        return false;
      });

  });
