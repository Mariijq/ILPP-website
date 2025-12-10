<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Admin Password Notification</title>
</head>
<body>
    @if(isset($new_password))
        <p>Your admin password has been changed.</p>
        <p>New password: {{ $new_password }}</p>
    @endif

    @if(isset($reset_url))
        <p>Click the link below to reset your password:</p>
        <a href="{{ $reset_url }}">{{ $reset_url }}</a>
    @endif
</body>
</html>
