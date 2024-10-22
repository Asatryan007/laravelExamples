<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        body{
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
    </style>
    <title>{{$title}}</title>
</head>
<body>
    <h1>{{$title}}</h1>
    <div>
        <div>
            <span style="color:red">Content From Controller: </span>
            <p>{{$content}}</p>
        </div>
        <div>
            <span>Static content :</span>
            <p>This is static content</p>
        </div>
    </div>
    <footer>
        <a href="about_task2">About Task 2</a> <!--navigate to About task2 page -->
    </footer>
</body>
</html>
