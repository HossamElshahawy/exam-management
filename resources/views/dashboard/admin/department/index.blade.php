@extends('admin-dashboard')

@section('work_space')

<!-- Button Add trigger modal -->
    <br>

    <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#addDepartmentModal">
        Add Deaprtment
    </button>

     <!-- Add Modal -->
  <div class="modal fade" id="addDepartmentModal">
    <div class="modal-dialog">

        <form id="addDepartment">
            @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Add</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <label>name:-</label>
          <input type="text" name="name" class="form-control">
          <br>
          <label>Faculity Name:-</label>

          <select name="faculity_id" id="faculity_id" class="form-control">
            <option value="">Select Faculity</option>
            @if (count($faculities)>0)
                @foreach ($faculities as $faculity)
                <option value="{{$faculity->id}}">{{$faculity->name}}</option>
                @endforeach
            @endif
            </select>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </div>
        </form>

      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

  <!-- Edit Modal -->
     <div class="modal fade" id="editDepartmentModal">
        <div class="modal-dialog">

            <form id="editDepartment">
                @csrf
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Edit</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <input type="hidden" id="department_id" name="department_id">
            <label>Name:-</label>
            <input name="name" id="name" class="form-control">
              <br>
              <label>Faculity Name:-</label>
              <select name="faculity_id" id="faculity_id" class="form-control">
                <option value="">Select Faculity</option>
                @if (count($faculities)>0)
                    @foreach ($faculities as $faculity)
                    <option value="{{$faculity->id}}">{{$faculity->name}}</option>
                    @endforeach
                @endif
                </select>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save</button>
            </div>
          </div>
            </form>

          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

     <!-- Delete Modal -->
     <div class="modal fade" id="deleteDepartmentModal">
        <div class="modal-dialog">

            <form id="deleteDepartment">
                @csrf
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Delete Department</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <p>Are you Sure Delete it </p>

                <input type="hidden" name="id" id="delete_department_id">
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
              <h3 class="card-title">Faculity</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Faculity</th>
                  <th>Controller</th>

                </tr>
                </thead>
                <tbody>
                    <?php $i = 0; ?>
                    @foreach ($departments as $department )
                    <?php $i++; ?>
                    <tr>

                    <td>{{ $i }}</td>
                    <td>{{$department->name}}</td>
                    <td>{{$department->faculity->name}}</td>
                    <td class="project-actions">

                        <button type="button" data-id= "{{$department->id}}"  class="btn btn-info editButton" data-toggle="modal" data-target="#editDepartmentModal">
                            <i class="fas fa-folder">
                            </i>
                            edit
                          </button>
                          <button type="button" class="btn btn-danger deleteButton" data-id= "{{$department->id}}"  data-toggle="modal" data-target="#deleteDepartmentModal">
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
<!-- jQuery -->
<script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- DataTables  & Plugins -->
<script src="{{asset('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/plugins/jszip/jszip.min.js')}}"></script>
<script src="{{asset('assets/plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('assets/plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
<script>
    $(function () {
    $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
    });
    });
</script>

<script>

$(document).ready(function(){

    // add
    $("#addDepartment").submit(function(e){
        e.preventDefault();
        var formData = $(this).serialize();

        $.ajax({
                url:"{{route('department.store')}}",
                type:"POST",
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


    });

    // edit
    $(".editButton").click(function(){
        var department_id = $(this).attr('data-id');
        $("#department_id").val(department_id);

        var url = '{{route("department.edit","id")}}';
        url = url.replace('id',department_id);

        $.ajax({
            url:url,
            type:"GET",
            success:function(data)
            {
                if(data.success == true)
                {
                    var department = data.data;
                    $("#name").val(department[0].name);
                    $("#faculity_id").val(department[0].faculity_id);
                    $("#faculity_id option[value='" + department[0].faculity_id + "']").prop("selected", true);
                }
                else {
                    alert(data.msg)
                }
            }
        })
    });

    //update
    $("#editDepartment").submit(function(e){
            e.preventDefault();
            var formData = $(this).serialize();


            $.ajax({
                url:"{{route('department.update', ['department' => ':id'])}}".replace(':id', $('#department_id').val()),
                type:"PUT",
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

        });

          //delete
        $(".deleteButton").click(function(){
            var department_id = $(this).attr('data-id');
            $("#delete_department_id").val(department_id);
        });

         // delete form
        $("#deleteDepartment").submit(function(e){
            e.preventDefault();
            var formData = $(this).serialize();


            $.ajax({
                url:"{{route('department.destroy', ['department' => ':id'])}}".replace(':id', $('#delete_faculity_id').val()),
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

