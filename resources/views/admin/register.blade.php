<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inscription administrateur</title>
    <style>
        :root {
            --bg: #020617;
            --card-bg: #020617;
            --accent: #22c55e;
            --accent-hover: #16a34a;
            --border: #1f2937;
            --text-main: #f9fafb;
            --text-muted: #9ca3af;
            --danger: #f97373;
            --input-bg: #020617;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            background: radial-gradient(circle at top, #1d2433, #020617 55%, #000 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-main);
        }

        .auth-wrapper {
            width: 100%;
            max-width: 480px;
            padding: 24px;
        }

        .card {
            background: linear-gradient(145deg, rgba(15, 23, 42, 0.98), rgba(15, 23, 42, 0.9));
            border-radius: 18px;
            border: 1px solid rgba(148, 163, 184, 0.2);
            box-shadow:
                0 18px 45px rgba(15, 23, 42, 0.8),
                0 0 0 1px rgba(15, 23, 42, 0.9);
            padding: 26px 26px 30px;
            backdrop-filter: blur(22px);
        }

        .card-header {
            margin-bottom: 20px;
        }

        .card-title {
            font-size: 1.45rem;
            font-weight: 650;
            margin: 0 0 4px;
            letter-spacing: 0.02em;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .badge {
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: var(--accent);
            border-radius: 999px;
            padding: 3px 10px;
            border: 1px solid rgba(34, 197, 94, 0.3);
            background: rgba(22, 163, 74, 0.08);
        }

        .card-subtitle {
            margin: 0;
            font-size: 0.85rem;
            color: var(--text-muted);
        }

        .form {
            margin-top: 18px;
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .form-row {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
        }

        .field {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        label {
            font-size: 0.8rem;
            font-weight: 500;
            color: var(--text-muted);
        }

        input,
        select {
            border-radius: 10px;
            border: 1px solid var(--border);
            background-color: var(--input-bg);
            color: var(--text-main);
            padding: 9px 11px;
            font-size: 0.9rem;
            outline: none;
            transition: border-color 0.15s ease, box-shadow 0.15s ease, background-color 0.15s ease,
                transform 0.05s ease;
        }

        input::placeholder {
            color: #6b7280;
        }

        input:focus,
        select:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 1px rgba(34, 197, 94, 0.25), 0 0 0 8px rgba(34, 197, 94, 0.12);
            background-color: #020617;
        }

        .error-list {
            margin-bottom: 10px;
            padding: 10px 12px;
            border-radius: 10px;
            border: 1px solid rgba(248, 113, 113, 0.5);
            background: radial-gradient(circle at top left, rgba(248, 113, 113, 0.16), transparent);
            color: #fecaca;
            font-size: 0.8rem;
        }

        .error-list ul {
            margin: 0;
            padding-left: 18px;
        }

        .error-text {
            color: #fecaca;
            font-size: 0.75rem;
        }

        .submit-row {
            margin-top: 8px;
        }

        .btn-primary {
            width: 100%;
            border-radius: 999px;
            border: none;
            padding: 10px 16px;
            font-size: 0.95rem;
            font-weight: 600;
            letter-spacing: 0.03em;
            text-transform: uppercase;
            cursor: pointer;
            background: radial-gradient(circle at top left, #4ade80, #16a34a);
            color: #022c22;
            box-shadow:
                0 14px 30px rgba(21, 128, 61, 0.6),
                0 0 0 1px rgba(21, 128, 61, 0.6);
            transition: transform 0.08s ease, box-shadow 0.1s ease, filter 0.1s ease;
        }

        .btn-primary:hover {
            filter: brightness(1.03);
            transform: translateY(-1px);
            box-shadow:
                0 18px 40px rgba(21, 128, 61, 0.7),
                0 0 0 1px rgba(21, 128, 61, 0.7);
        }

        .btn-primary:active {
            transform: translateY(0);
            box-shadow:
                0 10px 20px rgba(21, 128, 61, 0.6),
                0 0 0 1px rgba(21, 128, 61, 0.7);
        }

        .footer-text {
            margin-top: 14px;
            font-size: 0.78rem;
            color: var(--text-muted);
            text-align: center;
        }

        @media (max-width: 480px) {
            .card {
                padding: 20px 18px 22px;
            }

            .form-row {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="auth-wrapper">
        <div class="card">
            <div class="card-header">
                <div class="badge">Back-office</div>
                <h3 class="card-title">Créer un compte administrateur</h3>
                <p class="card-subtitle">
                    Renseignez les informations ci-dessous pour créer un accès au panneau d’administration.
                </p>
            </div>

            <form class="form" method="POST" action="{{ route('adminstore.register') }}">
                @csrf

                {{-- affichage des erreurs de validation globales --}}
                {{-- @if ($errors->any())
                    <div class="error-list">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif --}}

                <div class="form-row">
                    <div class="field">
                        <label for="nom">Nom</label>
                        <input type="text" name="nom" id="nom" value="{{ old('nom') }}" placeholder="Fulbert">
                        @error('nom')
                            <span class="error-text">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="field">
                        <label for="prenom">Prénom</label>
                        <input type="text" name="prenom" id="prenom" value="{{ old('prenom') }}" placeholder="Tchikoua">
                        @error('prenom')
                            <span class="error-text">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="field">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="admin@exemple.com">
                        @error('email')
                            <span class="error-text">{{ $message }}</span>
                        @enderror
                </div>

                <div class="form-row">
                    <div class="field">
                        <label for="motdepasse">Mot de passe</label>
                        <input type="password" name="motdepasse" id="motdepasse" autocomplete="new-password"
                            placeholder="Au moins 8 caractères">
                        @error('motdepasse')
                            <span class="error-text">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="field">
                        <label for="motdepasse_confirmation">Confirmation du mot de passe</label>
                        <input type="password" name="motdepasse_confirmation" id="motdepasse_confirmation"
                            autocomplete="new-password" placeholder="Répétez le mot de passe">
                    </div>
                </div>

                <div class="field">
                    <label for="role">Rôle</label>
                    <select name="role" id="role">
                        @foreach ($roles as $role)
                            <option value="{{ $role->name }}" @selected(old('role') === $role->name)>
                                {{ $role->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('role')
                        <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>

                <div class="submit-row">
                    <button class="btn-primary" type="submit">
                        Créer le compte
                    </button>
                </div>


            </form>

            <p class="footer-text">
                Vous disposez déjà d’un compte ? Accédez à la page de connexion d’administration.
            </p>
        </div>
    </div>
</body>
</html>
