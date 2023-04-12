@extends('admin-dashboard')

@section('work_space')

<!-- Button Add trigger modal -->
    <br>

    <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#addChapterModal">
        Add Chapter
    </button>

     <!-- Add Modal -->
  <div class="modal fade" id="addChapterModal">
    <div class="modal-dialog">

        <form id="addChapter">
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
          <label>description:-</label>
          <input type="text" name="description" class="form-control">
          <br>
          <label>Number Of Questions:-</label>
          <input type="number" name="num_questions" class="form-control">
          <br>
          <label>Subject Name:-</label>

          {{-- <select name="subject_id" id="subject_id" class="form-control">
            <option value="">Select Subject</option>
            @if (count($subjects)>0)
                @foreach ($subjects as $subject)
                <option value="{{$subject->id}}">{{$subject->name}}</option>
                @endforeach
            @endif
            </select> --}}
            <select name="subject_id" id="subject_id" class="form-control">
                <option value="">Select Subject</option>
                @if (auth()->user()->role == 0)
                    @foreach ($subjects as $subject)
                        <option value="{{$subject->id}}">{{$subject->name}}</option>
                    @endforeach
                @elseif (auth()->user()->role == 1)
                    @foreach ($profsubjects as $profsubject)
                        <option value="{{$profsubject->id}}">{{$profsubject->name}}</option>
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
     <div class="modal fade" id="editChapterModal">
        <div class="modal-dialog">

            <form id="editChapter">
                @csrf
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Edit</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <input type="hidden" id="chapter_id" name="chapter_id">
            <label>Name:-</label>
            <input name="name" id="name" class="form-control">
            <br>
            <label>description:-</label>
            <input type="text" name="description" id="description" class="form-control">
            <br>
            <label>Number Of Questions:-</label>
            <input type="number" name="num_questions"  id="num_questions"  class="form-control">
            <br>
            <label>Subject:-</label>
            <select name="subject_id" id="subject_id" class="form-control">
                <option value="">Select Subject</option>
                @if (auth()->user()->role == 0)
                    @foreach ($subjects as $subject)
                        <option value="{{$subject->id}}">{{$subject->name}}</option>
                    @endforeach
                @elseif (auth()->user()->role == 1)
                    @foreach ($profsubjects as $profsubject)
                        <option value="{{$profsubject->id}}">{{$profsubject->name}}</option>
                    @endforeach
                @endif
            </select>
                <br>
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
     <div class="modal fade" id="deleteChapterModal">
        <div class="modal-dialog">

            <form id="deleteChapter">
                @csrf
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Delete Subject</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <p>Are you Sure Delete it </p>

                <input type="hidden" name="id" id="delete_Chapter_id">
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
              <h3 class="card-title">Chapters</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>description</th>
                  <th>Subject</th>

                  <th>Controller</th>

                </tr>
                </thead>
                <tbody>
                    <?php $i = 0; ?>
                    @foreach ($chapters as $chapter)
                    <?php $i++; ?>
                    <tr>

                    <td>{{ $i }}</td>
                    <td>{{$chapter->name}}</td>
                    <td>{{$chapter->description}}</td>
                    <td>{{$chapter->subject->name}}</td>
                    <td class="project-actions">

                        <button type="button" data-id= "{{$chapter->id}}"  class="btn btn-info editButton" data-toggle="modal" data-target="#editChapterModal">
                            <i class="fas fa-folder">
                            </i>
                            edit
                          </button>
                          <button type="button" class="btn btn-danger deleteButton" data-id= "{{$chapter->id}}"  data-toggle="modal" data-target="#deleteChapterModal">
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
    $("#addChapter").submit(function(e){
        e.preventDefault();
        var formData = $(this).serialize();

        $.ajax({
                url:"{{route('chapter.store')}}",
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

    // // edit
    $(".editButton").click(function(){
        var chapter_id = $(this).attr('data-id');
        $("#chapter_id").val(chapter_id);

        var url = '{{route("chapter.edit","id")}}';
        url = url.replace('id',chapter_id);

        $.ajax({
            url:url,
            type:"GET",
            success:function(data)
            {
                if(data.success == true)
                {
                    var chapter = data.data;
                    $("#name").val(chapter[0].name);
                    $("#description").val(chapter[0].description);
                    $("#num_questions").val(chapter[0].num_questions);

                    $("#subject_id").val(chapter[0].subject_id);
                    $("#subject_id option[value='" + chapter[0].subject_id + "']").prop("selected", true);

                }
                else
                {
                    alert(data.msg)
                }
            }
        })
    });

    //  //update
    $("#editChapter").submit(function(e){
            e.preventDefault();
            var formData = $(this).serialize();


            $.ajax({
                url:"{{route('chapter.update', ['chapter' => ':id'])}}".replace(':id', $('#chapter_id').val()),
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

    //       //delete
        $(".deleteButton").click(function(){
            var chapter_id = $(this).attr('data-id');
            $("#delete_Chapter_id").val(chapter_id);
        });

    //      // delete form
        $("#deleteChapter").submit(function(e){
            e.preventDefault();
            var formData = $(this).serialize();


            $.ajax({
                url:"{{route('chapter.destroy', ['chapter' => ':id'])}}".replace(':id', $('#delete_Chapter_id').val()),
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

            });

        });
});

</script>

@endsection

