@extends('admin-dashboard')

@section('work_space')

    <!-- Edit Modal -->
    <div class="modal fade" id="reviewQnAModal">
        <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Review Q/A</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body review-qna">
                    Loading
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
        </div>
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
                                    <th>Result</th>
                                    <th>Review</th>

                                </tr>
                                </thead>
                                <tbody>
                                <?php $i = 0; ?>
                                @foreach ($results as $result)
                                        <?php $i++; ?>
                                    <tr>

                                        <td>{{ $i }}</td>
                                        <td>{{$result->exam->name}}</td>
                                        <td>{{$result->marks}}</td>
                                        <td>
                                            <a href="#" data-id="{{$result->id}}" class="reviewExam" data-toggle="modal" data-target="#reviewQnAModal">Review Q/A</a>
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
    $(document).ready(function () {
        $('.reviewExam').click(function (){

            var id = $(this).attr('data-id')

            $.ajax({
                url:"{{route('student.reviewQnN')}}",
                type:"GET",
                data:{attempt_id:id},
                success:function(data){
                    console.log(data)
                    var html = '';
                    if(data.success == true)
                    {

                        var results = data.data;
                        if(results.length > 0)
                        {
                            for(let i =0;i < results.length;i++)
                            {
                                let is_correct = '<span style="color:red" class="fa fa-closed-captioning"></span>';
                                if (results[i]['answer']['is_correct'] == 1)
                                {
                                     is_correct = '<span style="color:green" class="fa fa-check"></span>';
                                }

                                let answer = results[i]['answer']['answer']
                                html +=`
                                   <div class="row">
                                        <div class="col-sm-12">
                                        <h6>Q(`+(i+1)+`).+`+results[i]['question']['question']+`</h6>
                                         <p>Ans:- `+answer+`  `+is_correct+`</p>
                                        </div>
                                    </div>
                                `;
                            }
                        }else
                        {
                            html += `<h6>You didn't attempt any Questions!</h6>`;
                        }

                    }else
                    {
                       html += `<p>Having some issue on server side.</p>`
                    }
                    $('.review-qna').html(html)
                }

            });

        });


    });


</script>

@endsection
