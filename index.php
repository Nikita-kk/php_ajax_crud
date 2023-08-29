<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <title>PHP- AJAX-CRUD</title>
</head>

<body>

    <!-- Modal -->
    <div class="modal fade" id="student_Addmodal" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Add Student Data using jquery ajax in php without
                        page reload</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- design -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="error-message">

                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="">First name</label>
                            <input type="text" class="form-control fname">
                        </div>
                        <div class="col-md-6">
                            <label for="">last name</label>
                            <input type="text" class="form-control lname">
                        </div>
                        <div class="col-md-6">
                            <label for="">class</label>
                            <input type="text" class="form-control class">
                        </div>
                        <div class="col-md-6">
                            <label for="">Section</label>
                            <input type="text" class="form-control section">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary student_add_ajax">save</button>
                </div>
            </div>
        </div>
    </div>


         <!--  store the data -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>PHP-AJAX-CRUD | How to store data without reload using jquery ajax.
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary float-right" data-toggle="modal"
                                data-target="#student_Addmodal">
                                Add
                            </button>
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="message-show">

                        </div>
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Class</th>
                                    <th>Section</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="studentdata">


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- jquery cdn link -->
    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->

    <script src="https://code.jquery.com/jquery-3.5.1.js">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"
        integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous">
    </script>


    <script>
        $(document).ready(function () {
            getdata();

            // for store
            $('.student_add_ajax').click(function (e) {
                e.preventDefault();

                var fname = $('.fname').val();
                var lname = $('.lname').val();
                var stu_class = $('.class').val();
                var section = $('.section').val();
                // console.log(stu_class);

                // validation 
                if (fname != "" & lname != "" & stu_class != "" & section != "") {
                    $.ajax({
                        type: "POST",
                        url: "ajax-crud/code.php",
                        data: {
                            "checking_add": true,
                            "fname": fname,
                            "lname": lname,
                            "class": stu_class,
                            "section": section,
                        },
                        success: function (response) {
                            // console.log(response);
                            $('#student_Addmodal').modal('hide');
                            $(".message-show").append('\
                                 <div class="alert alert-success alert-dismissible fade show" role="alert">\
                                 <strong>hey!</strong> ' + response + '. \
                                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">\
                                 <span aria-hidden="true">&times;</span>\
                                 </button>\
                                 </div>\
                             ');
                             $('.studentdata').html("");   //without reloading page refresh
                            getdata();
                             $('.fname').val("");
                             $('.lname').val("");
                             $('.class').val("");
                             $('.section').val("");

                        }
                    });
                    // validation close if and else start
                } else {
                    //  console.log("please fill the form");
                    $(".error-message").append('\
                         <div class="alert alert-warning alert-dismissible fade show" role="alert">\
                         <strong>hey!</strong> please fill the form. \
                         <button type="button" class="close" data-dismiss="alert" aria-label="Close">\
                         <span aria-hidden="true">&times;</span>\
                         </button>\
                         </div>\
                     ');

                }

            });

        });

        function getdata() {
            $.ajax({
                type: "GET",
                url: "ajax-crud/fetch.php",
                success: function (response) {
                    // console.log(response);
                    $.each(response, function (key, value) {
                        // console.log(value['fname']);
                        $('.studentdata').append('<tr>' +
                            '<td>' + value['id'] + '</td>\
                               <td>' + value['fname'] + '</td>\
                                <td>' + value['lname'] + '</td>\
                                <td>' + value['class'] + '</td>\
                                <td>' + value['section'] + '</td>\
                                <td>\
                                    <a href="" class="badge btn-info">VIEW</a>\
                                    <a href="" class="badge btn-primary">EDIT</a>\
                                    <a href="" class="badge btn-danger">DELETE</a>\
                                </td>\
                                </tr>');


                    });


                }
            });
        }
    </script>
</body>

</html>