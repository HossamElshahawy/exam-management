@extends('admin-dashboard')

@section('work_space')

<!-- Button Add trigger modal -->
    <br>

    <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#addExamModal">
        Add Exam
    </button>

<!-- Add Modal -->
<div class="modal fade" id="addExamModal">
    <div class="modal-dialog">

        <form id="addExam">
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
          <label>Date:-</label>
          <input type="date" name="date" class="form-control">
          <br>
          <label>Attempt:-</label>
          <input type="number" min="1" name="attempt" class="form-control">
          <br>
          <label>Time:-</label>
          <input type="time" name="time" class="form-control">
          <br>
{{--            <label for="level">{{ __('Level') }}</label>--}}
{{--            <div>--}}
{{--                <select id="level" name="level" class="form-control" required>--}}

{{--                    <option value="1">1</option>--}}
{{--                    <option value="2">2</option>--}}
{{--                    <option value="3">3</option>--}}
{{--                    <option value="4">4</option>--}}
{{--                    <option value="5">5</option>--}}

{{--                </select>--}}
{{--            </div>--}}
{{--            <br>--}}
          <label>Subject Name:-</label>

            <select name="subject_id" id="subject_id" class="form-control">
                <option value="">Select Subject</option>
                @if (auth()->user()->role == 1)
                    @foreach ($subjects as $subject)
                        <option value="{{$subject->id}}">{{$subject->name}}</option>
                    @endforeach
                @elseif (auth()->user()->role == 2)
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

<!-- Add QNA Modal -->
<div class="modal fade" id="addQnaModal">
    <div class="modal-dialog">

        <form id="addQna">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Question</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <input type="hidden" name="exam_id" id="addExamId">
                    <input type="search" name="search" placeholder="Search Here .." class="w-100">
                    <br><br>
                    <table>
                        <thead>
                        <th></th>
                        <th>Questions</th>
                        </thead>

                        <tbody class="addBody">

                        </tbody>
                    </table>


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

<!-- show QNA Modal -->
<div class="modal fade" id="showQnaModal">
    <div class="modal-dialog">


            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Show Question</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <thead>
                        <th>#</th>
                        <th>Questions</th>
                        <th>Action</th>

                        </thead>

                        <tbody class="showQuestionTable">

                        </tbody>
                    </table>


                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

  <!-- Edit Modal -->
      <div class="modal fade" id="editExamModal">
        <div class="modal-dialog">

            <form id="editExam">
                @csrf
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Edit</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <input type="hidden" id="exam_id" name="exam_id">
            <label>Name:-</label>
            <input name="name" id="name" class="form-control">
            <br>
            <label>Date:-</label>
            <input type="date" id="date" name="date" class="form-control">
            <br>
            <label>Time:-</label>
            <input type="time" name="time" id="time" class="form-control">
            <br>
            <label>Attempt:-</label>
            <input type="number" min="1" name="attempt" id="attempt" class="form-control">
            <br>
            <label>Subject Name:-</label>
            <select name="subject_id" id="subject_id" class="form-control">
                <option value="">Select Subject</option>
                @if (auth()->user()->role == 1)
                    @foreach ($subjects as $subject)
                        <option value="{{$subject->id}}">{{$subject->name}}</option>
                    @endforeach
                @elseif (auth()->user()->role == 2)
                    @foreach ($profsubjects as $profsubject)
                        <option value="{{$profsubject->id}}">{{$profsubject->name}}</option>
                    @endforeach
                @endif
            </select>
{{--                <br>--}}
{{--                <label>Level:-</label>--}}
{{--                <div  id="level" style="display:none;">--}}
{{--                    <label for="level">{{ __('Level') }}</label>--}}

{{--                    <div>--}}
{{--                        <select id="level" name="level" required>--}}

{{--                            <option value="1">1</option>--}}
{{--                            <option value="2">2</option>--}}
{{--                            <option value="3">3</option>--}}
{{--                            <option value="4">4</option>--}}
{{--                            <option value="5">5</option>--}}

{{--                        </select>--}}
{{--                    </div>--}}
{{--                </div>--}}

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
     <div class="modal fade" id="deleteExamModal">
        <div class="modal-dialog">

            <form id="deleteExam">
                @csrf
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Delete Exam</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <p>Are you Sure Delete it </p>

                <input type="hidden" name="id" id="delete_Exam_id">
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
              <h3 class="card-title">Exams</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Date</th>
                  <th>Time</th>
{{--                  <th>Level</th>--}}
                  <th>Attempt</th>
                  <th>Subject</th>
                  <th>Questions</th>
                  <th>Show Questions</th>

                  <th>Controller</th>

                </tr>
                </thead>
                <tbody>
                    <?php $i = 0; ?>
                    @foreach ($exams as $exam)
                    <?php $i++; ?>
                    <tr>

                    <td>{{ $i }}</td>
                    <td>{{$exam->name}}</td>
                    <td>{{$exam->date}}</td>
                    <td>{{$exam->time}}</td>
{{--                    <td>{{$exam->level}}</td>--}}
                    <td>{{$exam->attempt}}</td>

                    <td>{{$exam->subject->name}}</td>
                        <td>
                            <a href="#" class="addQuestions" data-toggle="modal" data-target="#addQnaModal" data-id="{{$exam->id}}">add question</a>
                        </td>
                        <td>
                            <a href="#" class="showQuestions" data-toggle="modal" data-target="#showQnaModal" data-id="{{$exam->id}}">show question</a>
                        </td>

                    <td class="project-actions">

                        <button type="button" data-id= "{{$exam->id}}"  class="btn btn-info editButton" data-toggle="modal" data-target="#editExamModal">
                            <i class="fas fa-folder">
                            </i>
                            edit
                          </button>
                          <button type="button" class="btn btn-danger deleteButton" data-id= "{{$exam->id}}"  data-toggle="modal" data-target="#deleteExamModal">
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
    $("#addExam").submit(function(e){
        e.preventDefault();
        var formData = $(this).serialize();

        $.ajax({
                url:"{{route('exam.store')}}",
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
        var exam_id = $(this).attr('data-id');
        $("#exam_id").val(exam_id);

        var url = '{{route("exam.edit","id")}}';
        url = url.replace('id',exam_id);

        $.ajax({
            url:url,
            type:"GET",
            success:function(data)
            {
                console.log(data);
                if(data.success == true)
                {
                    var exam = data.data;
                    $("#name").val(exam[0].name);
                    $("#date").val(exam[0].date);
                    $("#time").val(exam[0].time);
                    // $("#level").val(exam[0].level);

                    $("#attempt").val(exam[0].attempt);


                    $("#subject_id").val(exam[0].subject_id);
                    $("#subject_id option[value='" + exam[0].subject_id + "']").prop("selected", true);

                }
                else
                {
                    alert(data.msg)
                }
            }
        })
    });

    //  //update
    $("#editExam").submit(function(e){
            e.preventDefault();
            var formData = $(this).serialize();


            $.ajax({
                url:"{{route('exam.update', ['exam' => ':id'])}}".replace(':id', $('#exam_id').val()),
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
            var exam_id = $(this).attr('data-id');
            $("#delete_Exam_id").val(exam_id);
        });

          // delete form
        $("#deleteExam").submit(function(e){
            e.preventDefault();
            var formData = $(this).serialize();


            $.ajax({
                url:"{{route('exam.destroy', ['exam' => ':id'])}}".replace(':id', $('#delete_Exam_id').val()),
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

        // get question in exam
    $('.addQuestions').click(function (){
        var id = $(this).attr('data-id');
        $('#addExamId').val(id);
        $.ajax({
            url:"{{route('getQuestions')}}",
            type:"GET",
            data:{exam_id:id},
            success:function (data)
            {
                console.log(data);
                if(data.success == true)
                {
                    var questions = data.data;
                    var html = '';
                    if(questions.length > 0)
                    {
                        for(let i =0;i<questions.length;i++)
                        {
                            html += `
                            <tr>
                                <td>
                                <input type="checkbox" value="`+questions[i]['id']+`" name="questions_ids[]">
                                </td>
                                <td>`+questions[i]['question']+`</td>
                            </tr>
                        `;
                        }
                    }else
                    {
                        html +=
                            `
                        <tr>
                        <td colspan="2">Questions Not Available</td>
                        </tr>
                        `;
                    }
                    $('.addBody').html(html); //23:25
                }else
                {
                    alert(data.msg);
                }
            }
        });
    });

    // add questions to exam
    $("#addQna").submit(function(e){
        e.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            url:"{{route('addQuestions')}}",
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

        });
    });

    // show examQuestion
    $('.showQuestions').click(function(){
       var id = $(this).attr('data-id');

        $.ajax({
            url:"{{route('showExamQuestions')}}",
            type:"GET",
            data:{exam_id:id},
            success:function(data){
                // console.log(data)

                var html = '';
                var questions = data.data;
                if(questions.length > 0)
                {
                    for(let i =0;i<questions.length;i++)
                    {
                        html +=`
                        <tr>
                            <td>`+(i+1)+`</td>
                            <td>`+questions[i]['question'][0]['question']+`</td>
                            <td>
                                <button class="btn btn-danger deleteExamQuestions" data-id ="`+questions[i]['id']+`">
                                    Delete
                                </button>
                            </td>
                        </tr>
                        `;

                    }



                }else
                {
                    html +=
                        `
                        <tr>
                              <td colspan="1">Questions not Available</td>
                        </tr>

                        `;
                }
                $('.showQuestionTable').html(html);
            }
        });
    });
    // delete examQuestion
    $(document).on('click','.deleteExamQuestions',function () {
        var id = $(this).attr('data-id');
        var obj = $(this);
        $.ajax({
            url:"{{route('deleteExamQuestions')}}",
            type:"GET",
            data:{id:id},
            success:function(data){
                if(data.success == true)
                {
                    obj.parent().parent().remove();
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

