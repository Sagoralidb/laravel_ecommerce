<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reset Your Password</title>
</head>
<body style="font-family: Arial, Helvetica, sans-serif; font-size:16px">
    <p>Hell, {{ $formData['user']->name }}</p>
    <h1>You have requested to change your password</h1>
    <p>Please click the link given below to reset password</p>
     <a href="{{ route('front.resetPassword', $formData['token'] )}}">click here</a>

     <p>Thanks</p>
</body>
</html>