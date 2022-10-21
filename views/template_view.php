<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title> Tasks list </title>
    <style>
        .btn-danger{
            height: 3em;
            width: 3em;
        }
        .btn-success{
            height: 3em;
            width: 3em;
        }
        .row{
            padding-bottom: 1em;
        }
        .container{
            padding-top: 2em;
        }
        .tabbut{
            text-align: center;
        }
        td { 
            white-space:pre 
        }
        .loginform {
            border: 1px solid #a9a9a9;
            width: 400px;
            margin: 10em auto;
            height: 20em;
        }
		header{
			border-bottom: solid black 1px;
		}
    </style>
</head>
<body>
    <div class="container">
		<header>
			<h1 align="center"> Project done using MCV  </h1>
		</header>
		<?php include $content_view; ?>
    </div>
</body>
</html>