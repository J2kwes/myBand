<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css"
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $("a").on('click', function(event) {
                if (this.hash !== "") {
                    event.preventDefault();
                    var hash = this.hash;
                    $('html, body').animate({
                        scrollTop: $(hash).offset().top
                    }, 10000, function(){
                        window.location.hash = hash;
                    });
                }
            });
        });
    </script>
    <title>My band</title>
</head>
<body>
<div id="header">
    <a href="index.php?page=home">Home</a>
    <a href="index.php?page=news">News</a>
    <a href="index.php?page=contact">Contact</a>
    <a href="index.php?page=register">Register</a>
    <a href="index.php?page=login">Login</a>
</div>