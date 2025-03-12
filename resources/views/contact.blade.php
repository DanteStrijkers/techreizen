<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contactformulier</title>
</head>
<body>

    <h1>Contactformulier</h1>

    @if(session('success'))
        <div style="color: green;">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('contact.submit') }}" method="POST">
        @csrf

        <div>
            <label for="name">Naam:</label>
            <input type="text" id="name" name="name" required>
        </div>

        <div>
            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" required>
        </div>

        <div>
            <label for="message">Bericht:</label>
            <textarea id="message" name="message" required></textarea>
        </div>

        <button type="submit">Verstuur</button>

        <!-- Cancel Button -->
        <button type="button" onclick="window.location.href='{{ url('/') }}'">Annuleren</button>
    </form>

</body>
</html>
