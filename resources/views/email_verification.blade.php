<!DOCTYPE html PUBLIC>
<html>
    <head></head>
    <body>
        Welcome {{$name}}<br>
        
        <h3>Click the button to verify</h3>

        <a href="{{url('verification/'.$verifylink)}}">Click here</a><br>

        Enjoy being at Internwheel!
    </body>
</html>

