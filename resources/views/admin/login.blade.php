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
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Admin</title>
    <style>
        /* Reset & base */
        *{box-sizing:border-box;margin:0;padding:0;font-family:Segoe UI,Tahoma,Geneva,Verdana,sans-serif}
        body{
            height:100vh;
            display:flex;
            align-items:center;
            justify-content:center;
            background:linear-gradient(135deg,#1e3c72 0%, #2a5298 100%);
        }
        .login-card{
            background:#fff;
            width:100%;
            max-width:400px;
            padding:40px 30px;
            border-radius:12px;
            box-shadow:0 15px 30px rgba(0,0,0,.25);
            animation:fadeIn .6s ease;
        }
        @keyframes fadeIn{
            from{opacity:0;transform:translateY(-20px);}
            to{opacity:1;transform:translateY(0);}
        }
        .login-card h2{
            text-align:center;
            margin-bottom:30px;
            color:#2a5298;
            font-weight:600;
        }
        .form-group{
            margin-bottom:20px;
        }
        .form-group label{
            display:block;
            margin-bottom:6px;
            color:#333;
            font-weight:500;
        }
        .form-group input{
            width:100%;
            padding:12px 15px;
            border:1px solid #ccc;
            border-radius:6px;
            font-size:15px;
            transition:border-color .3s;
        }
        .form-group input:focus{
            border-color:#2a5298;
            outline:none;
        }
        .btn-submit{
            width:100%;
            padding:12px;
            background:#2a5298;
            color:#fff;
            border:none;
            border-radius:6px;
            font-size:16px;
            font-weight:600;
            cursor:pointer;
            transition:background .3s;
        }
        .btn-submit:hover{
            background:#1e3c72;
        }
    </style>
</head>
<body>

    <div class="login-card">
        <h2>Administration</h2>
        <form method="POST" action="{{ route('admin.loginstore') }}">
            @csrf
            <div class="form-group">
                <label for="email">E-mail</label>
                <input id="email" type="email" name="email" required autofocus>
            </div>
          
            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input id="password" type="password" name="password" required>
            </div>
        
            <button type="submit" class="btn-submit">Se connecter</button>
        </form>
    </div>

</body>


