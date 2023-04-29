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

    <p style="color:black;">Welcome,{{Auth::User()->name}}</p>
    <h1 class="text-center">{{$exam[0]['name']}}</h1>
    @if($success == true)
        @if(count($qna)>0)
            @php $qcount = 1;  @endphp
            @foreach($qna as $data)
                <h1 class="text-center">Q. {{$data['question'][0]['question']}}</h1>
                @php $acount = 1;  @endphp
                @foreach($data['question'][0]['answers'] as $answer)
                    <b><b>{{$acount++}}). </b> {{$answer['answer']}}</p>
                @endforeach
            @endforeach
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

</body>
</html>



