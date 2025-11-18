<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
</head>
<body>
    <h3>Formulaire d'enregistrement Admin </h3>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('adminstore.register') }}">

        @csrf
        <label class="" for="nom">Nom</label>
        <input class="" type="text" name="nom" id="nom">

        <label class="" for="">Prenom</label>
        <input class="" type="text" name="prenom" id="prenom">

        <label class="" for="">Email ou Telephone</label>
        <input class="" type="email" name="email" id="email">

        <label class="" for="">Mot de passe</label>
        <input class="" type="password" name="motdepasse" id="motdepasse" autocomplete="new-password">

        <label class="" for="motdepasse_confirmation">Confirmation de mot de passe</label>
        <input class="" type="password" name="motdepasse_confirmation" id="motdepasse_confirmation">

        <button class="" type="submit">Envoyer</button>
    </form>
    
</body>
</html>