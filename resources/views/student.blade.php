<!DOCTYPE html>
<html lang="en">
<head>
  <title>Student </title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</head>
<body>
<div class="container">
    <h1 class="mt-3 mb-3 text-center">Laravel & Ajax CRUD Operation</h1>

    <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
          <img src="..." class="rounded me-2" alt="...">
          <strong class="me-auto text text-success">Success!!</strong>
          <small class="text text-danger">Well done.</small>
          <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            <span id="output" class="text text-success"></span>
        </div>
    </div>

    <br><br>
    {{-- <a href="{{route('addStudent')}}" class="btn btn-primary mt-3 mb-3">Add Student</a> --}}
    <table class="table table-striped" id="students-table">
        <tr>
            <th>S.No</th>
            <th>Name</th>
            <th>Email</th>
            <th>Image</th>
            <th>Action</th>
        </tr>

    </table>
</div>

    <script>
        $(document).ready(function(){

            $.ajax({
                type:"GET",
                url:"{{ route('getStudent') }}",
                success: function(data){
                    console.log(data);
                    if(data.students.length > 0){
                        for(let i=0;i<data.students.length;i++){
                            let img = data.students[i]['image'];
                            $('#students-table').append(`<tr>
                                <td>`+(i+1)+`</td>
                                <td>`+(data.students[i]['name'])+`</td>
                                <td>`+(data.students[i]['email'])+`</td>
                                <td><img src="{{ asset('storage/`+img+`')}}" alt="`+img+`" width="60px" height="60px"/></td>
                                <td>
                                    <a href="{{route('addStudent')}}" class="btn btn-sm btn-success">Add</a>
                                    <a href="/editStudent/`+(data.students[i]['id'])+`" class="btn btn-sm btn-warning">Edit</a>
                                    <a href="#" data-id="`+(data.students[i]['id'])+`"  class="deleteData btn btn-sm btn-danger">Delete</a>
                                </td>
                                </tr>`);
                        }
                    }else{
                        $('#students-table').append("<tr><td colspan='4'>Data Not Found</td></tr>");
                    }
                },
                error:function(err){
                    console.log(err.response.Text);
                }
            });

            $('#students-table').on('click','.deleteData',function(){
               var id = $(this).attr("data-id");
               var obj = $(this);
               $.ajax({
                    type:"GET",
                    url:"delete-data/"+id,
                    success:function(data){
                        $(obj).parent().parent().remove();
                        $('#output').text(data.result);
                        $(".toast").toast("show");
                    },
                    error:function(err){
                        console.log(err.responseText);
                        $(".toast").toast("show");
                    }
               });
            });

        });
    </script>

</body>
</html>
