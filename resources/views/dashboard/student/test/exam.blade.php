<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exam Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE1UksdQRVvoxMfooUoWzQ" crossorigin="anonymous">
</head>
<body>


<div class="container">
    @php

        $time = explode(':',$exam[0]['time']);

    @endphp
    <p style="color:black;">Welcome,{{Auth::User()->name}}</p>
    <h1 class="text-center">{{$exam[0]['name']}}</h1>
    <h5 class="text-right time">{{$exam[0]['time']}}</h5>
    @php $qcount = 0;  @endphp
@if($success == true)
        @if(count($qna)>0)
            <form method="POST" action="{{route('student.examSubmit')}}" class="mb-5" id="exam_form" onsubmit="return isValid()">
                @csrf
                <input type="hidden" name="exam_id" value="{{$exam[0]['id']}}">
                @foreach($qna as $data)
                    <div>
                        <h1 class="text-center">Q. {{$data['question'][0]['question']}}</h1>
                        <input type="hidden" name="q[]" value="{{$data['question'][0]['id']}}">
                        <input type="hidden" name="ans_{{$data['question'][0]['id']}}" id="ans_{{$data['question'][0]['id']}}">
                        @php $acount = 1;  @endphp
                        @foreach($data['question'][0]['answers'] as $answer)
                            <p><b>{{$acount++}}).</b> {{$answer['answer']}}
                                <input type="radio" name="radio_{{$data['question'][0]['id']}}" class="select_answer" data-id="{{$data['question'][0]['id']}}" value="{{$answer['id']}}">
                            </p>
                        @endforeach
                    </div>
                    <br>
                    @php $qcount++; @endphp
                @endforeach
                <div class="text-center">
                    <input type="submit" class="btn btn-info">
                </div>
            </form>
    @else
            <h3 style="color:red;" class="text-center">Q & A Not Available</h3>
        @endif


    @else
        <h3 style="color:red;" class="text-center">{{$msg}}</h3>
    @endif
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE1UksdQRVvoxMfooUoWzQ" crossorigin="anonymous"></script>

<script>
    var timerExpired = false; // Add flag to track timer expiration

    $(document).ready(function () {
       $('.select_answer').click(function () {
          var no = $(this).attr('data-id');
          $('#ans_'+no).val($(this).val());
       });

        var time = @json($time);

        $('.time').text(time[0]+':'+time[1]+':00 Left Time');
        var seconds = 4;
        var hours = parseInt(time[0]);
        var minutes = parseInt(time[1]);

       var timer = setInterval(()=>{

           if (hours == 0 && minutes == 0 && seconds == 0 ) {
            clearInterval(timer);
            timerExpired = true;
            $('#exam_form').submit();
           }
            console.log(hours+" -:- "+minutes+" -:- "+seconds)
            if(seconds<=0)
            {
                minutes-- ;
                seconds = 4;
            }
            if(minutes<=0 && hours != 0)
            {
                hours-- ;
                minutes = 59;
                seconds = 59;
            }

            let tempHours = hours.toString().length > 1? hours:'0'+hours;
            let tempMinutes = minutes.toString().length > 1? minutes:'0'+minutes;
            let tempSeconds = seconds.toString().length > 1? seconds:'0'+seconds;


            $('.time').text(tempHours+':'+tempMinutes+':'+tempSeconds+'Left Time');


            seconds-- ;
        },1000);

    });
    function isValid()
    {
        var result = true;
        if (timerExpired) {
            return true; // Skip validation if timer has expired
        }
        var qlength = parseInt("{{$qcount}}")-1;
        $('.error_msg').remove();
        for(let i =1;i<=qlength;i++)
        {
            if ($('#ans_'+i).val()=="")
            {
                result = false;
                $('#ans_'+i).parent().append('<span style="color:red;" class="error_msg">Please Select Answer.</span>')
                setTimeout(()=>{
                    $('.error_msg').remove();
                },5000)
            }

        }
        return result;
    }


</script>



</body>
</html>



