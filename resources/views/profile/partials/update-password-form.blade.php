<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier votre mot de passe</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9fafb;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        h2 {
            text-align: center;
            color: #4a5568;
        }
        .mt-1 {
            margin-top: 8px;
        }
        .mt-6 {
            margin-top: 24px;
        }
        .form-group {
            margin-bottom: 16px;
        }
        label {
            display: block;
            margin-bottom: 4px;
            font-weight: bold;
        }
        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #cbd5e0;
            border-radius: 4px;
            font-size: 16px;
        }
        .btn-primary {
            background-color: green;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
        }
        .text-sm {
            font-size: 14px;
        }
        .text-green-600 {
            color: #38a169;
        }
    </style>
</head>
<body>

<div class="container">
    <header>
        <h2>Modifier votre mot de passe</h2>
        <p class="mt-1 text-sm text-gray-600">
            Veillez à ce que votre compte utilise un mot de passe long et aléatoire pour rester sécurisé.
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6">
        @csrf
        @method('put')

        <div class="form-group">
            <label for="update_password_current_password">Mot de passe actuel</label>
            <input id="update_password_current_password" name="current_password" type="password" autocomplete="current-password" required />
            <span class="text-red-600">@error('current_password') {{ $message }} @enderror</span>
        </div>

        <div class="form-group">
            <label for="update_password_password">Nouveau mot de passe</label>
            <input id="update_password_password" name="password" type="password" autocomplete="new-password" required />
            <span class="text-red-600">@error('password') {{ $message }} @enderror</span>
        </div>

        <div class="form-group">
            <label for="update_password_password_confirmation">Confirmer le mot de passe</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required />
            <span class="text-red-600">@error('password_confirmation') {{ $message }} @enderror</span>
        </div>

        <div>
            <button type="submit" class="btn-primary">Modifier</button>
            @if (session('status') === 'password-updated')
                <p class="text-sm text-green-600">{{ __('Mot de passe modifié.') }}</p>
            @endif
        </div>
    </form>
</div>

</body>
</html>