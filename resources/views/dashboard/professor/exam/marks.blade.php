@extends('admin-dashboard')

@section('work_space')
    <!-- Button Add trigger modal -->
    <br>
    <!-- Add Modal -->
    <div class="modal fade" id="editMarkModal">
        <div class="modal-dialog">

            <form id="editMark">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Update Mark</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-sm-3">
                                <label>Marks/Q</label>
                            </div>
                            <div class="col-sm-6">
                                <input type="hidden" name="exam_id" id="exam_id">
                                <input type="text" onkeypress="return event.charCode >=48 && event.charCode <=57 || event.charCode ==46"  name="mark" id="mark" placeholder="Enter Mark" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-3">
                                <label>Total Marks</label>
                            </div>
                            <div class="col-sm-6">
                                <input type="number" id="tmark" placeholder="Total Marks" disabled required>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update Marks</button>
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
                            <h3 class="card-title">Marks </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                   <th>#</th>
                                    <th>name</th>
                                    <th>mark</th>
                                    <th>Total Mark</th>
                                    <th>edit</th>



                                </tr>
                                </thead>
                                <tbody>
                                <?php $i = 0; ?>
                                @foreach ($exams as $exam)
                                        <?php $i++; ?>
                                    <tr>

                                        <td>{{ $i }}</td>
                                        <td>{{$exam->name}}</td>
                                        <td>{{$exam->mark}}</td>
                                        <td>{{count($exam->getQnaExam) * $exam->mark}}</td>

                                        <td class="project-actions">
                                            <button type="button" data-id="{{$exam->id}}" data-mark= "{{$exam->mark}}" data-totalqe="{{ count($exam->getQnaExam) }}" class="btn btn-info editMark" data-toggle="modal" data-target="#editMarkModal">
                                                <i class="fas fa-folder">
                                                </i>
                                                edit
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

        $(document).ready(function () {
            var totalQna = 0;

            $('.editMark').click(function () {
                var exam_id = $(this).attr('data-id')

                var marks = $(this).attr('data-mark')
                var totalq = $(this).attr('data-totalqe')

                $('#exam_id').val(exam_id);
                $('#mark').val(marks);
                $('#tmark').val((marks * totalq).toFixed(1) );
                totalQna = totalq;

            });

            $('#mark').keyup(function () {
                $('#tmark').val( ($(this).val()* totalQna).toFixed(1) );
            });

            $("#editMark").submit(function(e){
                e.preventDefault();
                var formData = $(this).serialize();


                $.ajax({
                    url:"{{route('mark.update')}}",
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
        });



    </script>

@endsection
