<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wachtwoord vergeten // {{ env('APP_NAME') }}</title>
    @vite('resources/css/app.css')
</head>

<body class="flex bg-blue-800 shadow justify-center items-center h-screen">
<div class="min-h-screen flex items-center justify-center w-full">
    <div class="bg-white shadow-xl drop-shadow-xl rounded-lg px-8 py-6 w-96">
        <h1 class="text-2xl font-bold text-center mb-4">Wachtwoord vergeten</h1>
        <form method="post" action="{{ route('password.email') }}">
            @csrf
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">E-mailadres</label>
                <input type="email" name="email" id="email"
                       class="shadow-sm rounded-md w-full px-3 py-2 border border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('email') border-red-500 @enderror"
                       placeholder="your@email.com">
                @if (session('status'))
                    <p class="text-xs text-green-500 mt-1">{{ session('status') }}</p>
                @endif
                @error('email')
                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit"
                    class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                Wachtwoord reset aanvragen
            </button>
        </form>
    </div>
</div>

</body>
</html>
