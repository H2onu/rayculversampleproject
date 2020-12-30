/**
 * Created by Ray on 12/19/2017.
 */


$("#submit_project").submit(function (e) {

    alert('yo');

    var url = "http://localhost/psc_github/app/AIS/AIS.php"; // the script where you handle the form input.
    $("#myModal").modal('show');
    e.preventDefault(); // avoid to execute the actual submit of the form.
    e.stopImmediatePropagation();
    $.ajax({
        type: "POST",
        url: url,
        data: $("#reg_form").serialize(), // serializes the form's elements.
        success: function (data) {


            $('#modal-body').html(data);

            var n = data.search('Oops')

            if (n >= 1) {

                $('#ModalLabel').hide();


            }

            var y = data.search('Success');

            if (y >= 1) {

                $('#ModalLabel').hide();
                $("#reg_form")[0].reset();

                $("#button-modal-close").click(function () {

                    window.location.replace("http://www.dev.com/helpful-links/report-a-problem");
                });


            }
        }
    });

    e.preventDefault(); // avoid to execute the actual submit of the form.
});


$("#button-modal-close").click(function () {

    $('#modal-body').html("<div class='modal-body' id='modal-body'><div class='alert alert-warning'><span class='glyphicon glyphicon-refresh spinning'></span>Processing...</div></div>");
    $('#modal-header').html("<div class='modal-header'><h5 class='modal-title alert alert-info' id='ModalLabel'>Patience please while we process this request...This may take up to 15 seconds.</h5></div>");
    //  window.location.replace("http://www.dev.com/helpful-links/report-a-problem");
});

