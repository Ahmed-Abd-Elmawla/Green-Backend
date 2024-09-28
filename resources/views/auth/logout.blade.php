<!DOCTYPE html>
<html>
<head>
    <title>Logging out...</title>
</head>
<body>
    <script type="text/javascript">

    history.pushState(null, document.title, location.href);
    history.back();
    history.forward();
    window.onpopstate = function () {
        history.go(1);
    };
    window.location.href = '{{ url('/login') }}';

    </script>

    <noscript>
        <!-- Provide a fallback for users with JavaScript disabled -->
        <p>JavaScript is required to log out. Please enable JavaScript and try again, or <a href="{{ url('/login') }}">click here</a> to go to the login page.</p>
    </noscript>
</body>
</html>
