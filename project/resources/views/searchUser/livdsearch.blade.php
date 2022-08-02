<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SearchTask</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>

</head>

<body>
    <div class="container p-8">
        <br></br>

        <h3 align="center"> Search User</h3>
        <br></br>
        <div class="row">

            <div class="col-12">
                <div class="form-group">
                    <input type="text" name="search" id="search" class="form-control" placeholder="Search user/email">

                </div>

                <div class="table-responsive table-dark">
                    <table class="table table-striped  table-striped table-bordered  table-bordered">
                        <thead>
                            <tr>
                                <th>id </th>
                                <th>name</th>
                                <th>email</th>
                            </tr>
                        </thead>

                        <tbody>

                        </tbody>


                    </table>


                </div>
  <br></br>

            </div>

          
        </div>
    </div>
    <script>
        $(document).ready(function() {
            fetch_customer_data();

            function fetch_customer_data(query = '') {
                // alert("load data= "+ query);
                $.ajax({
                    url: "{{route('action')}}",
                    method: 'GET',
                    data: {
                        query: query
                    },
                    dataType: 'json',
                    success: function(data) {
                        $('tbody').html(data.table_data);
                        $('#total_records').text(data.total_data);
                    }

                })
            }
            $(document).on('keyup', '#search', function() {
                var query = $(this).val();
                fetch_customer_data(query);

            });
        });
    </script>

</body>

</html>