<!DOCTYPE html>
<html lang="en">
<head>
  <title>Add Student </title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</head>
<body>

<div class="container">
    <a href="{{url('/get-student')}}" class="btn btn-primary mt-3 mb-3 float-end">All Student</a>

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

    <form class="mt-3" id="addStudent" enctype='multipart/form-data'>
        @csrf
        <input class="form-control mb-3" type="text" name="name" placeholder="Enter Name" required />
        <input class="form-control mb-3" type="email" name="email" placeholder="Enter Email" required />
        <input class="form-control mb-3" type="file" name="file" required />
        <input id="btnSubmit" class="btn btn-primary" type="submit" value="Add Student" />
    </form>

    <a onClick="window.location.reload()" class="btn btn-primary mt-3 mb-3">Click to refresh for add new </a>


    {{-- <span id="output"></span> --}}
</div>


<script>
    $(document).ready(function(){
        $('#addStudent').submit(function(event){
            event.preventDefault();

            var AddStudentData = $('#addStudent')[0];
            var Data = new FormData(AddStudentData);

            console.log(Data);
            $('#btnSubmit').prop('disabled',true);

            $.ajax({
                type:"POST",
                url:"{{ route('addStudent') }}",
                data:Data,
                processData:false,
                contentType:false,
                success:function(data){
                    $('#output').text(data.res);
                    $('#btnSubmit').prop('disabled',true);

                    $("input[type='text']").val('');
                    $("input[type='email']").val('');
                    $("input[type='file']").val('');

                    $(".toast").toast("show");
                },
                error:function(e){
                    $('#output').text(e.responseText);
                    $('#btnSubmit').prop('disabled',false);

                    $("input[type='text']").val('');
                    $("input[type='email']").val('');
                    $("input[type='file']").val('');

                    $(".toast").toast("show");
                }
            })
        });
    });
</script>


</body>
</html>
