<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Admin</title>
</head>
<body>

    <form method="POST" action="{{ route('admin.loginstore') }}">
        @csrf
        <div>
            <label for="email">E-mail</label>
            <input id="email" type="email" name="email" required autofocus>
        </div>
    
        <div>
            <label for="password">Mot de passe</label>
            <input id="password" type="password" name="password" required>
        </div>
    
        <button type="submit">Se connecter</button>
    </form> 

</body>
</html>


