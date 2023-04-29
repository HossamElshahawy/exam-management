@extends('admin-dashboard')

@section('work_space')


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
                                    <th>Subject</th>
                                    <th>Attempt</th>
                                    <th>Available Attempt</th>
                                    <th>COPY link</th>

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
                                        <td>{{$exam->subject->name}}</td>
                                        <td>{{$exam->attempt}}</td>
                                        <td></td>
                                        <td><a href="#" data-code="{{$exam->enterance_id}}" class="copy"><i class="fa fa-copy"></i></a> </td>


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

            $('.copy').click(function () {
                $(this).parent().prepend('<span class="copied_text">COPIED</span>');

                var code = $(this).attr('data-code');
                var url = "{{URL::to('/')}}/exam/"+code;

                var $temp = $("<input>");
                $("body").append($temp);
                $temp.val(url).select();
                document.execCommand("copy");
                $temp.remove();
                setTimeout(()=>{
                    $('.copied_text').remove();
                },1000);

            });

        });
    </script>


@endsection
