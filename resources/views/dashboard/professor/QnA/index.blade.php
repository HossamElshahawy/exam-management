@extends('admin-dashboard')

@section('work_space')

<!-- Button Add trigger modal -->
    <br>

    <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#addQnaModal">
        Add Q&A
    </button>

     <!-- Add Modal -->
  <div class="modal fade" id="addQnaModal">
    <div class="modal-dialog">


      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Add Q&A</h4>
          <button id="addAnswer" class="ml-5 btn btn-info">Add Answer</button>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="addQna">
            @csrf
            <div class="modal-body addModalAnswers">
                <div class="row">
                    <div class="col">
                        <input type="text" name="question" class="w-100" placeholder="Add Your Question" required>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <span class="error" style="color:rgb(12, 5, 17);"></span>

            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
      </div>
    </div>
  </div>

    <!-- Edit Modal -->
       <div class="modal fade" id="editQnaModal">
        <div class="modal-dialog">


          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Edit Q&A</h4>
              <button id="addEditAnswer" class="ml-5 btn btn-info">Edit Answer</button>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form id="editQna">
                @csrf
                <div class="modal-body editModalAnswers">
                    <div class="row">
                        <div class="col">
                            <input type="hidden" id="question_id" name="question_id">
                            <input type="text" name="question" id='question' class="w-100" placeholder="Add Your Question" required>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <span class="editError" style="color:rgb(12, 5, 17);"></span>

                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">update</button>
                </div>
            </form>
          </div>
        </div>
      </div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteQnaModal">
    <div class="modal-dialog">

        <form id="deleteQna">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Delete Q&N</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you Sure Delete it </p>

                    <input type="hidden" name="id" id="delete_Qna_id">
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
              <h3 class="card-title">Q&N</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Question</th>
                  <th>Answers</th>

                  <th>Controller</th>

                </tr>
                </thead>
                <tbody>
                    <?php $i = 0; ?>
                    @foreach ($questions as $question)
                    <?php $i++; ?>
                    <tr>
                        <td>{{ $i }}</td>
                        <td>{{$question->question}}</td>
                        <td>
                            @foreach ($question->answers as $answer)
                                {{$answer->answer}} @if ($answer->is_correct) (Correct) @endif <br>
                            @endforeach
                        </td>
                        <td>
                            <button type="button" data-id= "{{$question->id}}"  class="btn btn-info editButton" data-toggle="modal" data-target="#editQnaModal">
                                <i class="fas fa-folder">
                                </i>
                                edit
                              </button><br>
                            <button type="button" class="btn btn-danger deleteButtonQna" data-id= "{{$question->id}}"  data-toggle="modal" data-target="#deleteQnaModal">
                                <i class="fas fa-folder">
                                </i>
                                Delete
                            </button>
                        </td>
                    </tr>
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

@section('js_space')

<script>
    $(document).ready(function(){

        //form submittion
        $("#addQna").submit(function(e){
            e.preventDefault();

            if($(".answers").length < 2 )
            {
                $(".error").text("Please Add Minimum Two Answer")
                setTimeout(function(){
                    $(".error").text("");
                },2000);

            }
            else
            {

                var checkIsCorrect = false;

                for(let i =0;i<$(".is_correct").length;i++)
                {
                    if($(".is_correct:eq("+i+")").prop("checked")==true)
                    {
                        checkIsCorrect = true;
                        $(".is_correct:eq("+i+")").val($(".is_correct:eq("+i+")").next().find('input').val());
                    }
                }

                if(checkIsCorrect)
                {
                    var formData = $(this).serialize();
                    $.ajax({
                        url:"{{route('QnA.store')}}",
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

                }
                else
                {
                    $(".error").text("Please Select Anyone Correct Answer")
                    setTimeout(function(){
                    $(".error").text("");
                    },2000);
                }

            }

        });

        //add answer
        $("#addAnswer").click(function(){

            if($(".answers").length >= 6)
            {
                $(".error").text("You Can Add Maximum 6 Answers")
                setTimeout(function(){
                    $(".error").text("");
                },2000);

            }
            else
            {
                var html =`
                <div class="row mt-2 answers">
                    <input type='radio' name='is_correct' class='is_correct'>
                        <div class="col">
                            <input type="text" name="answer[]" class="w-100" placeholder="Add Your Answer">
                        </div>
                        <button class="btn btn-danger deleteButton">Remove</button>
                    </div>

                `;
                $(".addModalAnswers").append(html);
            }

        });
            //delete button in form add Q
            $(document).on("click",".deleteButton",function(){

                $(this).parent().remove();
            });


            //edit or update Q&A
        $("#addEditAnswer").click(function(){

            if($(".editAnswers").length >= 6)
            {
                $(".editError").text("You Can Add Maximum 6 Answers")
                setTimeout(function(){
                    $(".editError").text("");
                },2000);

            }
            else
            {
                var html =`
                        <div class="row mt-2 editAnswers">
                            <input type='radio' name='is_correct' class='edit_is_correct'>
                                <div class="col">
                                    <input type="text" name="new_answers[]" class="w-100" placeholder="Add Your Answer">
                                </div>
                                <button class="btn btn-danger deleteButton">Remove</button>
                            </div>

                `;
                $(".editModalAnswers").append(html);
            }

        });

        $(".editButton").click(function(){
            var qid = $(this).attr('data-id');
            var url = '{{route("QnA.edit", ":id")}}';
            url = url.replace(':id', qid);

            $.ajax({
                url: url,
                type: "GET",
                data:{qid:qid},
                success: function(data) {
                    console.log(data);
                    var qna = data.data[0];

                    $("#question_id").val(qna['id']);
                    $("#question").val(qna['question']);
                    $(".editAnswers").remove();

                    var html = '';

                    for(let i =0 ; i < qna['answers'].length ; i++)
                    {

                        var checked = '';
                        if(qna['answers'][i]['is_correct'] == 1)
                        {
                            checked = 'checked';
                        }



                        html +=`
                        <div class="row mt-2 editAnswers">
                            <input type='radio' name='is_correct' class='edit_is_correct' `+checked+`>
                                <div class="col">
                                    <input type="text" name="answer[`+qna['answers'][i]['id']+`]" class="w-100"
                                    placeholder="Add Your Answer" value="`+qna['answers'][i]['answer']+`" required>
                                </div>
                                <button class="btn btn-danger deleteButton deleteAnswer"  data-id = "`+qna['answers'][i]['id']+`"  >Remove</button>
                        </div>
                        `;
                    }
                    $(".editModalAnswers").append(html);

                }
            });
        });


         //update Qna submittion
         $("#editQna").submit(function(e){
            e.preventDefault();

            if($(".editAnswers").length < 2 )
            {
                $(".editError").text("Please Add Minimum Two Answer")
                setTimeout(function(){
                    $(".editError").text("");
                },2000);

            }
            else
            {

                var checkIsCorrect = false;

                for(let i =0;i<$(".edit_is_correct").length;i++)
                {
                    if($(".edit_is_correct:eq("+i+")").prop("checked")==true)
                    {
                        checkIsCorrect = true;
                        $(".edit_is_correct:eq("+i+")").val($(".edit_is_correct:eq("+i+")").next().find('input').val());
                    }
                }

                if(checkIsCorrect)
                {

                    var formData = $(this).serialize();
                    $.ajax({
                        url:"{{route('QnA.update', ['QnA' => ':id'])}}".replace(':id', $('#question_id').val()),
                        type:"PUT", // Change this to PUT
                        data:formData,
                        success:function(data){
                            if(data.success == true)
                            {
                                location.reload();
                            }
                            else
                            {
                                alert(data.msg);
                            }
                        }
                    });


                }
                else
                {
                    $(".editError").text("Please Select Anyone Correct Answer")
                    setTimeout(function(){
                    $(".editError").text("");
                    },2000);
                }

            }

        });

        // remove answer from edit Question
        $(document).on('click','.deleteAnswer',function(){

            var ansId = $(this).attr('data-id');
            var url = '{{route("QnA.destroy", ":id")}}';
            url = url.replace(':id', ansId);
            $.ajax({
                url:url,
                type:"DELETE",
                data:{id:ansId, _token: "{{ csrf_token() }}"},
                success:function(data){
                   if(data.success == true)
                   {
                    console.log(data.msg);
                   }
                   else
                   {
                    alert(data.msg);
                   }
                }
            });



        });

        // remove Q&N
        $('.deleteButtonQna').click(function () {
            var id = $(this).attr('data-id');
            $('#delete_Qna_id').val(id);
        });

        $("#deleteQna").submit(function(e){
            e.preventDefault();
            var formData = $(this).serialize();


            $.ajax({
                url:"{{route('Qna.delete')}}",
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

    });
</script>
@endsection

@endsection

