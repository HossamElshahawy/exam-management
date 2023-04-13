@extends('admin-dashboard')

@section('work_space')
<!-- Delete Modal -->
<div class="modal fade" id="deleteUsersModal">
    <div class="modal-dialog">

        <form id="deleteUsers">
            @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Delete Request</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <p>Are you Sure Delete it </p>

            <input type="hidden" name="id" id="delete_user_id">
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger">Delete</button>
        </div>
      </div>
        </form>

      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

<section class="content">
    <br>

    <div class="container-fluid">
      <div class="row">
        <div class="col-12">

          <!-- /.card -->

          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Approved Professors</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Controller</th>

                </tr>
                </thead>
                <tbody>
                    <?php $i = 0; ?>
                    @foreach ($users as $user )
                    <?php $i++; ?>
                    <tr>

                    <td>{{ $i }}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>

                    <td class="project-actions">

                        <button type="button" class="btn btn-danger deleteButton" data-id= "{{$user->id}}"  data-toggle="modal" data-target="#deleteUsersModal">
                            <i class="fas fa-folder">
                            </i>
                            Delete
                          </button>

                    </td>
                     <tr>
                     @endforeach

                </tbody>

              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>

@endsection
@section('js_space')
<script>
    $(document).ready(function(){


        //delete
        $(".deleteButton").click(function(){
            var user_id = $(this).attr('data-id');
            $("#delete_user_id").val(user_id);
        });

        // delete form
        $("#deleteUsers").submit(function(e){
            e.preventDefault();
            var formData = $(this).serialize();


            $.ajax({
                url:"{{route('prof.destroy', ['prof' => ':id'])}}".replace(':id', $('#delete_user_id').val()),
                type:"DELETE",
                data:formData,
                success:function(data){
                    if(data.success == true)
                    {
                        location.reload();
                    }else
                    {
                        alert(data.msg)
                    }
                }

            })

        })




    });
</script>
@endsection
