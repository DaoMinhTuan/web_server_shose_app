<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shose App Email Send</title>
</head>
<body>
    <p>{{$data['body']}}</p>
     
    <form action="{{ route('confrim_account') }}"  method="POST" >
        <div hidden>
            <input type="text"  name="toke" value="{{ $data['token'] }}">
        </div>
        <button> xác minh tài khoản</button>
    </form>
    
</body>
</html>