<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verander wachtwoord // {{ env('APP_NAME') }}</title>
    @vite('resources/css/app.css')
</head>

<body class="flex bg-blue-800 shadow justify-center items-center h-screen">
<div class="min-h-screen flex items-center justify-center w-full">
    <div class="bg-white shadow-xl drop-shadow-xl rounded-lg px-8 py-6 w-96">
        <h1 class="text-2xl font-bold text-center mb-4">Verander wachtwoord</h1>
        <form method="post" action="{{ route('password.store') }}">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">E-mailadres</label>
                <input type="email" name="email" id="email"
                       value="{{ old('email', $request->email) }}"
                       class="shadow-sm rounded-md w-full px-3 py-2 border border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('email') border-red-500 @enderror"
                       placeholder="your@email.com">
                @error('email')
                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Wachtwoord</label>
                <input type="password" name="password" id="password"
                       class="shadow-sm rounded-md w-full px-3 py-2 border border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('password') border-red-500 @enderror"
                       placeholder="Voer uw wachtwoord in">
                @error('password')
                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Herhaal
                    wachtwoord</label>
                <input type="password" name="password_confirmation" id="password_confirmation"
                       class="shadow-sm rounded-md w-full px-3 py-2 border border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('password') border-red-500 @enderror"
                       placeholder="Herhaal uw wachtwoord in">
                @error('password')
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
