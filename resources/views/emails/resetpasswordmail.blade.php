<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
</head>
<body>
    <h1>Beste {{$user->first_name}}</h1>
    <p>Hierbij de reset token.</p>

    <!-- //! Hardcoded address. Change in production -->
    link:  <a href="{{'http://127.0.0.1:8000/#/auth/reset/' . $token}}">Link</a>

</body>
</html>
