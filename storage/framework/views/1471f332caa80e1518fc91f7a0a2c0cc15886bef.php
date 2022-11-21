<!DOCTYPE html>
<html lang="en">
<head>
  <title>Edit Student </title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</head>
<body>

<div class="container">
    <a href="<?php echo e(url('/get-student')); ?>" class="btn btn-primary mt-3 mb-3 float-end">All Student</a>

    <img class="mt-3" src="<?php echo e(asset('storage/')); ?>/<?php echo e($student[0]->image); ?>" alt="" width="100" height="100" />
    <form class="mt-3" id="updateStudent" enctype=multipart/form-data>
        <?php echo csrf_field(); ?>
        <input class="form-control mb-3" type="text" name="name" placeholder="Enter Name" value="<?php echo e($student[0]->name); ?>"  />
        <input class="form-control mb-3" type="email" name="email" placeholder="Enter Email" value="<?php echo e($student[0]->email); ?>" />
        <input class="form-control mb-3" type="file" name="file" />
        <input type="hidden" name="id" value="<?php echo e($student[0]->id); ?>" />
        <input id="btnSubmit" class="btn btn-primary btn-sm" type="submit" value="Update Student" />
    </form>

    <span id="output"></span>

    <script>
        $(document).ready(function(){
            $('#updateStudent').submit(function(event){
                event.preventDefault();

               var updateData = $('#updateStudent')[0];
               var Data = new FormData(updateData);
               console.log(Data);

               $.ajax({
                type:"POST",
                url:"<?php echo e(route('updateStudent')); ?>",
                data:Data,
                processData:false,
                contentType:false,
                success:function(data){
                    $('#output').text(data.result);
                    window.open("/get-student","_self");
                },
                error:function(err){
                    $('#output').text(err.responseText);

                }
               });

            });
        });
    </script>


</div>

</body>
</html>
<?php /**PATH D:\learning\laravel\Programming Experience\Laravel CRUD Using AJAX (jQuery)\college\resources\views/edit-student.blade.php ENDPATH**/ ?>