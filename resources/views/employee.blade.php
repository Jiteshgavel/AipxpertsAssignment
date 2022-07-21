<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                 <div class=" card-title text-canter">Empoyee List</div>
            </div>
        <div class="card-body">
        <div class="col-md-12">
            <table class="display" style="width:100%" id="example">
                <div class="row mb-4">
                    <div class="col">
                        <select id="status"  class="form-control form-control-sm" id="exampleFormControlSelect1">
                            <option value="P">Present</option>
                            <option value="A">Absent</option>
                        </select>
                    </div>
                    <div class="col">
                        <button id="statusUpdate"  class="btn btn-sm btn-primary">Update Status</button>
                    </div>
                </div>
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Select</th>
                        <th scope="col">Name</th>
                        <th scope="col">Dob</th>
                        <th scope="col">Designation</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody id="_employee_list">

                </tbody>
            </table>
        </div>
        </div>
       
    </div>
      </div>

    <script src=" https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

   <script>
    $(document).ready(function() {
            $('#example').DataTable();
            
            getEmployee();
            function getEmployee() {
                $.ajax({
                    url: "{{ route('getRecord') }}",
                    type: 'POST',
                    data: {
                        '_token': '{{ csrf_token() }}',
                    },
                    dataType: 'json',
                    success: function(res) {
                        if (res.status == 200) {
                            var name = '-----';
                            var x = '';
                            $.each(res.data, function(key, val) {
                                if (val.designation != null) {
                                    name = val.designation.name;
                                }
                                x = x + '<tr>' +
                                    '<td scope="row" data-label="#">' + parseInt(key + 1) +
                                    '</td>' +
                                    '<td scope="row" data-label="#"> <input class="check-box" type="checkbox" name="status" value="' +
                                    val.id + '"> </td>' +
                                    '<td data-label="Name">' + val.employee_name + '</td>' +
                                    '<td data-label="Email">' + val.dob + '</td>' +
                                    '<td data-label="Contact No">' + name.toUpperCase() +
                                    '</td>' +
                                    '<td data-label="WareHouse">' + val.status + '</td>' +
                                    '</tr>';
                            });
                            $('#_employee_list').html(x);
                        } else {
                            $('#_employee_list').html(
                                '<tr><td colspan="8" style="text-align:center;">' + res.msg +
                                '</td></tr>');
                        }
                    },
                    complete: function() {
                        $('#example').DataTable();
                    }
                });
 
            }

           
         

            $("#statusUpdate").click(function() {
                    var checked_value = [];
                    $("input:checkbox[name=status]:checked").each(function() {
                        checked_value.push($(this).val());
                    });
                    var status = $('#status').find(":selected").val();

                    if(checked_value.length  !== 0 && status!="")
                    {
                        $.ajax({
                        url: "{{ route('updateStatus') }}",
                        type: 'POST',
                        data: {
                            '_token': '{{ csrf_token() }}',
                            'status':status,
                            'id':checked_value,
                        },
                        dataType: 'json',
                        success: function(res) {
                            if (res.status == 200) {
                                alert(res.msg);
                            } else {
                                alert(res.msg);
                            }
                        },
                        complete: function() {
                            getEmployee();
                        }
                    });

                    }else{
                        alert('check value first')
                    }
                    
            });

        });
   </script>
</body>

</html>
