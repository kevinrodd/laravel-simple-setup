@extends('LaravelSimpleSetup::main')
@section('content')
    <div class="row">
        <div class="col-12 text-center mt-3">
            <ul class="progressbar">
                <li class="active"><a href="/setup">Basic Settings</a></li>
                <li class="active"> <a href="/setup/step-2">Database</a></li>
                <li>Expert Settings</li>
                <li>Summary</li>
            </ul>
        </div>
    </div>




    <div class="row mt-3" style="padding:50px">

        <div class="col-12">




            <form id="dbform" action="{{route('setupStep2')}}" method="post">
                @csrf
                <div class="form-group" style="    border: 1px solid black;
    padding: 25px;
    cursor: pointer;text-align:center" id="db_check">
                    <div class="checkbox">
                        <input style="display:none" type="checkbox" name="app_db_setting" id="app_db_setting" value="this.checked">
                        <label style="cursor:pointer">
                            <i class="fa fa-hand-pointer-o" aria-hidden="true"></i> I want to use a database</label>
                    </div>
                </div>
                <div id="errormsg"></div>

                <div id="db_settings" class="form-group"></div>






                <div class="row">
                    <div class="col-12 col-md-6">
                        <a href="/setup" class="btn btn-outline-danger mb-2"  ><i class="fa fa-angle-left"></i> Previous Step </a>
                    </div>
                    <div class="col-12 col-md-6">
                        <button type="submit" class="btn btn-outline-danger mb-2  float-md-right"  > Next Step <i class="fa fa-angle-right"></i></button>
                    </div>
                </div>

            </form>
        </div>

    </div>
    </div>


    <script>

        $(function() {

            var dbhost = "{{ $data['DB_CONNECTION'] }}";

            if(dbhost.length > 1)
            {
                $('#db_check').css('background','#f4645f');
                $('#db_check').css('border','none');
                $('#db_check').css('color','white');
                $('#app_db_setting').attr('checked','checked');
                $('#db_settings').slideUp(0, function () {


                   showContent();



                    $('#db_settings').slideDown(500);
                    tippy('.tip');
                });
            }
            else
            {
                addEmpty();
            }



            $("form").attr('novalidate', 'novalidate');

            $(document).on('click', '#db_check', function(e) {


                $('#app_db_setting').trigger('click');

                if(document.getElementById('app_db_setting').checked)
                {

                    $('#db_check').css('background','#f4645f');
                    $('#db_check').css('border','none');
                    $('#db_check').css('color','white');



                }else
                {
                    $('#db_check').css('background','none');
                    $('#db_check').css('color','black');
                    $('#db_check').css('border','1px solid black');
                    $('#errormsg').html("");
                    $('#errormsg').removeClass('danger').removeClass('alert-danger');
                    $('#errormsg').css('padding','0');
                }





            });

            $(document).on('click', '#testdb', function(e) {

                $('#testdb').html('Testing... <i class="fa fa-spinner faa-spin animated "></i>');


                $('#testdb').removeClass('btn-success').removeClass('btn-danger').addClass('btn-dark');
                // $('#testdb').html('Test Connection <i class="fa fa-question-circle-o "></i>');
                e.preventDefault();
                $.ajax({
                    type: 'post',
                    url: '{{route("testDB")}}',
                    data: $('#dbform').serialize(),
                    success: function (data) {

                        if(data.hasOwnProperty('Error'))
                        {
                            $('#errormsg').html(data.Error);
                            $('#errormsg').addClass('danger').addClass('alert-danger');
                            $('#testdb').removeClass('btn-dark').addClass('btn-danger');
                            $('#testdb').html('Test Connection <i class="fa fa-times "></i>');
                        }else
                        {
                            $('#errormsg').html(data.Success);
                            $('#errormsg').addClass('success').addClass('alert-success');
                            $('#testdb').removeClass('btn-dark').addClass('btn-success');
                            $('#testdb').html('Test Connection <i class="fa fa-check-circle-o "></i>');
                        }


                        $('#errormsg').css('color','black');
                        $('#errormsg').css('padding','10px');


                    },
                    statusCode: {
                        500: function() {
                            $('#testdb').removeClass('btn-dark').addClass('btn-danger');
                            $('#testdb').html('Test Connection <i class="fa fa-times "></i>');
                            $('#errormsg').html("Coul not connect to database");
                            $('#errormsg').addClass('danger').addClass('alert-danger');
                            $('#errormsg').css('color','red');
                            $('#errormsg').css('padding','10px');
                        }
                    }
                });



            });

            $(document).on('focus', 'input', function() {
                $('#testdb').removeClass('btn-success').removeClass('btn-danger').addClass('btn-dark');
                $('#testdb').html('Test Connection <i class="fa fa-question-circle-o "></i>');
                $('#errormsg').html("");
                $('#errormsg').removeClass('danger').removeClass('alert-danger');
                $('#errormsg').css('padding','0');

            });



            $(document).on('change', '#db_connection', function() {
                if (this.value == "sqlite") {


                    $('#db_port').hide();
                    $('#db_port_label').hide();
                    $('#db_host').hide();
                    $('#db_host_label').hide();
                    $('#db_username').hide();
                    $('#db_username_label').hide();
                    $('#db_password').hide();
                    $('#db_password_label').hide();
                    $('#db_database').attr("placeholder", "Filename");
                    $('#db1tooltip').hide();
                    $('#db2tooltip').hide();
                    $('#db3tooltip').hide();
                    $('#db4tooltip').hide();
                }
                else
                {

                    $('#db1tooltip').show();
                    $('#db2tooltip').show();
                    $('#db3tooltip').show();
                    $('#db4tooltip').show();


                    $('#db_port').show();
                    $('#db_port_label').show();
                    $('#db_host').show();
                    $('#db_host_label').show();
                    $('#db_username').show();
                    $('#db_username_label').show();
                    $('#db_password').show();
                    $('#db_password_label').show();
                    $('#db_database').attr("placeholder", "MyDatabase");

                    if(this.value == "postgresql")
                    {
                        $('#db_port').val("5432");

                    }

                    else if(this.value == "mysql")
                    {
                        $('#db_port').val("3306");

                    }
                    else if(this.value == "sqlserver")
                    {
                        $('#db_port').val("");


                    }

                }
            });



            $('#app_db_setting').click(function() {
                if (!this.checked) {


                    $('#db_settings').slideUp(500, function () {
                        $("#db_settings").html('');
                        addEmpty();
                    });




                }
                else {

                    $('#db_settings').slideUp(0, function () {


                        showContent();



                        $('#db_settings').slideDown(500);
                        tippy('.tip');
                    });

                }
            });




        });

        function addEmpty()
        {
            console.log("add empty");
            $('#db_settings').html('<select class="form-control" id="db_connection" style="display:none" name="db_connection"><option value="&nbsp;"></option></select>');
        }

        function showContent()
        {
            $('#db_settings').html('  <label for="app_env">Select Database Type</label> <span class="tip" title="The type of your database"><i class="fa fa-question-circle" aria-hidden="true"></i></span>\n' +
                '    <select class="form-control" id="db_connection" name="db_connection">\n' +
                '        @if($data["DB_CONNECTION"] == "mysql")\n' +
                '            <option value="mysql">MySQL</option>\n' +
                '            <option value="postgresql">PostgreSQL</option>\n' +
                '            <option value="sqlite">SQLite</option>\n' +
                '        @elseif($data["DB_CONNECTION"] == "postgresql")\n' +
                '            <option value="postgresql">PostgreSQL</option>\n' +
                '            <option value="mysql">MySQL</option>\n' +
                '            <option value="sqlite">SQLite</option>\n' +
                '        @else\n' +
                '            <option value="sqlite">SQLite</option>\n' +
                '            <option value="postgresql">PostgreSQL</option>\n' +
                '            <option value="mysql">MySQL</option>\n' +
                '        @endif\n' +
                '\n' +
                '\n' +
                '    </select>\n' +
                '\n' +
                '    <label for="app_name" class="mt-1" id="db_host_label">DB Host</label> <span class="tip" id="db1tooltip" title="The ip or domain your database server is hosted. For local development this usually is 127.0.0.1"><i class="fa fa-question-circle" aria-hidden="true"></i></span>\n' +
                '    @if($data["DB_CONNECTION"] == "mysql")\n' +
                '    <input type="text" class="form-control" id="db_host" name="db_host" placeholder="127.0.0.1"  required="" value="{{$data["DB_HOST"]}}">\n' +
                '    @elseif($data["DB_CONNECTION"] == "postgresql")\n' +
                '        <input type="text" class="form-control" id="db_host" name="db_host" placeholder="127.0.0.1" required="" value="{{$data["DB_HOST"]}}">\n' +
                '    @else\n' +
                '        <input type="text" class="form-control" id="db_host" name="db_host" placeholder="127.0.0.1" required="" value="{{$data["DB_HOST"]}}">\n' +
                '    @endif\n' +
                '\n' +
                '    <label for="app_name" class="mt-1" id="db_port_label">DB Port</label> <span class="tip" id="db2tooltip" title="The port on which your database is running"><i class="fa fa-question-circle" aria-hidden="true"></i></span>\n' +
                '    @if($data["DB_CONNECTION"] == "mysql")\n' +
                '        <input type="text" class="form-control" id="db_port" name="db_port" placeholder="3306" required="" value="{{$data["DB_PORT"]}}">\n' +
                '    @elseif($data["DB_CONNECTION"] == "postgresql")\n' +
                '        <input type="text" class="form-control" id="db_port" name="db_port" placeholder="3306" required="" value="{{$data["DB_PORT"]}}">\n' +
                '    @else\n' +
                '        <input type="text" class="form-control" id="db_port" name="db_port" placeholder="3306" required="" value="{{$data["DB_PORT"]}}">\n' +
                '    @endif\n' +
                '\n' +
                '    <label for="app_name" class="mt-1" id="db_database_label">DB Database</label> <span class="tip" title="The name of your database"><i class="fa fa-question-circle" aria-hidden="true"></i></span>\n' +
                '    @if($data["DB_CONNECTION"] == "mysql")\n' +
                '        <input type="text" class="form-control" id="db_database" name="db_database" placeholder="Database Name" required="" value="{{$data["DB_DATABASE"]}}">\n' +
                '    @elseif($data["DB_CONNECTION"] == "postgresql")\n' +
                '        <input type="text" class="form-control" id="db_database" name="db_database" placeholder="Database Name" required="" value="{{$data["DB_DATABASE"]}}">\n' +
                '    @else\n' +
                '        <input type="text" class="form-control" id="db_database" name="db_database" placeholder="Database Name" required="" value="{{pathinfo($data["DB_DATABASE"],PATHINFO_FILENAME)}}">\n' +
                '    @endif\n' +
                '\n' +
                '    <label for="app_name" class="mt-1" id="db_username_label">DB Username</label> <span class="tip" id="db3tooltip" title="The username for your database connection"><i class="fa fa-question-circle" aria-hidden="true"></i></span>\n' +
                '    @if($data["DB_CONNECTION"] == "mysql")\n' +
                '        <input type="text" class="form-control" id="db_username" name="db_username" placeholder="Username" required="" value="{{$data["DB_USERNAME"]}}">\n' +
                '    @elseif($data["DB_CONNECTION"] == "postgresql")\n' +
                '        <input type="text" class="form-control" id="db_username" name="db_username" placeholder="Username" required="" value="{{$data["DB_USERNAME"]}}">\n' +
                '    @else\n' +
                '        <input type="text" class="form-control" id="db_username" name="db_username" placeholder="Username" required="" value="{{$data["DB_USERNAME"]}}">\n' +
                '    @endif\n' +
                '\n' +
                '    <label for="app_name" class="mt-1" id="db_password_label">DB Password</label> <span class="tip"  id="db4tooltip"title="The password for your database connection"><i class="fa fa-question-circle" aria-hidden="true"></i></span>\n' +
                '    @if($data["DB_CONNECTION"] == "mysql")\n' +
                '        <input type="text" class="form-control" id="db_password" name="db_password" placeholder="Password" required="" value="{{$data["DB_PASSWORD"]}}">\n' +
                '    @elseif($data["DB_CONNECTION"] == "postgresql")\n' +
                '        <input type="text" class="form-control" id="db_password" name="db_password" placeholder="Password" required="" value="{{$data["DB_PASSWORD"]}}">\n' +
                '    @else\n' +
                '        <input type="text" class="form-control" id="db_password" name="db_port" placeholder="Password" required="" value="{{$data["DB_PASSWORD"]}}">\n' +
                '    @endif\n' +
                '\n' +
                '\n' +
                '\n' +
                '    <a id="testdb" class="btn btn-dark mb-2 form-control" style="color:white;margin-top:25px"> Test Connection <i class="fa fa-question-circle-o "></i></a>');



            if ($('#db_connection').val() == "sqlite") {


                $('#db_port').hide();
                $('#db_port_label').hide();
                $('#db_host').hide();
                $('#db_host_label').hide();
                $('#db_username').hide();
                $('#db_username_label').hide();
                $('#db_password').hide();
                $('#db_password_label').hide();
                $('#db_database').attr("placeholder", "Filename");
                $('#db1tooltip').hide();
                $('#db2tooltip').hide();
                $('#db3tooltip').hide();
                $('#db4tooltip').hide();
            }
            else
            {

                $('#db1tooltip').show();
                $('#db2tooltip').show();
                $('#db3tooltip').show();
                $('#db4tooltip').show();


                $('#db_port').show();
                $('#db_port_label').show();
                $('#db_host').show();
                $('#db_host_label').show();
                $('#db_username').show();
                $('#db_username_label').show();
                $('#db_password').show();
                $('#db_password_label').show();
                $('#db_database').attr("placeholder", "MyDatabase");

                if(this.value == "postgresql")
                {
                    $('#db_port').val("5432");

                }

                else if(this.value == "mysql")
                {
                    $('#db_port').val("3306");

                }
                else if(this.value == "sqlserver")
                {



                }

            }
        }


    </script>
@endsection
