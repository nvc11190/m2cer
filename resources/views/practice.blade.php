<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">

    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- Styles -->
    <style>
        html, body {
            background-color: #3b3b3b;
            color: #e0dcdc;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
            margin: 100px;
        }

        .title {
            font-size: 30px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }

        .question-box {
            min-height: 35px;
            min-width: 35px;
            margin: 3px;
            padding: 2px;
            text-align: center;
            cursor: pointer;
            border: 1px solid #dee2e6 !important;
            font-size: 20px;
            display: inline;
        }

        .correct {
            background-color: #016501 !important;
        }

        .incorrect {
            background-color: red !important;
        }

        label.lb-correct {
            color: #03d703;
        }

        label.lb-incorrect {
            color: red;
        }

        .q-active {
            background-color: #618fe7;
        }

        .question {
            border: 1px solid;
            width: auto;
            margin-bottom: 50px;
            font-weight: bold;
            font-size: 30px;
        }

        .answer {
            margin-bottom: 50px;
            text-align: left;
            font-size: 25px;
        }
    </style>
</head>
<body>
<h1>Magento 2 Associate Practice</h1>
<div class="flex-center position-ref">
    <div class="content">
        <div class="content-container">
            @php
                $i = 1;
            @endphp
            @foreach ($data as $row)
                <div class="question-wrapper" id="question-{{$row['id']}}">
                    <div class="question">
                        {{$row['question']}}
                    </div>
                    <div class="answer">
                        @foreach ($row['answers'] as $answer)
                            @php
                                $class = $answer['isCorrect'] == 1 ? 'a-correct' : 'a-incorrect';
                            @endphp
                            <input type="checkbox" name="answer" value="{{$class}}" id="answer-{{$i}}" />
                            <label for="answer-{{$i}}" class="{{$class}}">{{$answer['answer']}}</label><br>
                            @php
                                $i++;
                            @endphp
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
        <div class="title">
            @for ($i = 1; $i <= 319; $i++)
                @php
                    $class = '';
                    if ($i == 1) {
                        $class = 'q-active';
                    }
                @endphp
                <div class="question-box {{$class}}" data-question-id="{{$i}}" id="index-{{$i}}">
                    {{$i}}
                </div>
            @endfor
        </div>
        <input type="hidden" value="1" id="qid" />
        <button type="button" class="btn btn-primary" id="check" data-question="1" style="margin-top: 20px;">Check</button>
    </div>
</div>
</body>

<script type="text/javascript">

    $(document).ready(function(){
        $('.question-wrapper').hide();
        $("#question-1").show();
    });

    $(".question-box").click(function(e){
        e.preventDefault();
        $(this).addClass('q-active');
        var id = $(this).data("question-id");
        $('#qid').val(id)
        $('#check').attr("data-question", id);

        $('.question-wrapper').hide();
        $("#question-"+id).show();
    });

    $("#check").on('click', function(e){
        var id = $('#qid').val();
        var result = true;
        $('#question-' + id + ' input[type=checkbox]').each(function() {
            if (!$(this).is(":checked") && $(this).val() == 'a-correct') {
                result = false;
            }

            if ($(this).is(":checked") && $(this).val() == 'a-incorrect') {
                result = false;
            }
        });

        if (result === true) {
            $('#index-'+id).removeClass('incorrect');
            $('#index-'+id).addClass('correct');
            $("#question-"+id+" label.a-correct").addClass('lb-correct');
            $("#question-"+id+" label.a-incorrect").removeClass('lb-incorrect');
        } else {
            $('#index-'+id).removeClass('correct');
            $('#index-'+id).addClass('incorrect');
            $("#question-"+id+" label.a-correct").addClass('lb-correct');
            $("#question-"+id+" label.a-incorrect").addClass('lb-incorrect');
        }
    });
</script>
</html>
