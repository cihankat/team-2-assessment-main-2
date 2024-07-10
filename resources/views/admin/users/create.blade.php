@extends('components.layouts.admin')

@section('content')
<div class="container mx-auto px-4 sm:px-8">
    <div class="py-8">
        <div class="max-w-md mx-auto bg-white shadow-lg rounded-lg overflow-hidden md:max-w-lg">
            <div class="md:flex">
                <div class="w-full p-4">
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <form action="{{ route('admin.users.store') }}" method="POST" class="p-4">
                            @csrf
                            <div class="mb-6">
                                <label for="firstname" class="block mb-2 text-sm font-medium text-black">Voornaam:</label>
                                <input type="text" id="firstname" name="firstname" class="bg-gray-50 border border-gray-300 text-black text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                            </div>
                            <div class="mb-6">
                                <label for="prefix" class="block mb-2 text-sm font-medium text-black">Tussenvoegsel:</label>
                                <input type="text" id="prefix" name="prefix" class="bg-gray-50 border border-gray-300 text-black text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            </div>
                            <div class="mb-6">
                                <label for="lastname" class="block mb-2 text-sm font-medium text-black">Achternaam:</label>
                                <input type="text" id="lastname" name="lastname" class="bg-gray-50 border border-gray-300 text-black text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                            </div>
                            <div class="mb-6">
                                <label for="gender" class="block mb-2 text-sm font-medium text-black">Geslacht:</label>
                                <select id="gender" name="gender" class="bg-gray-50 border border-gray-300 text-black text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                                    <option value="Man">Man</option>
                                    <option value="Vrouw">Vrouw</option>
                                    <option value="Anders">Anders</option>
                                </select>
                            </div>
                            <div class="mb-6">
                                <label for="email" class="block mb-2 text-sm font-medium text-black">Email:</label>
                                <input type="email" id="email" name="email" class="bg-gray-50 border border-gray-300 text-black text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                            </div>
                            <div class="mb-6">
                                <label for="usernumber" class="block mb-2 text-sm font-medium text-black">Gebruikers Nummer:</label>
                                <input type="text" id="usernumber" name="usernumber" class="bg-gray-50 border border-gray-300 text-black text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            </div>
                            <div class="mb-6">
                                <label for="password" class="block mb-2 text-sm font-medium text-black">Wachtwoord:</label>
                                <input type="password" id="password" name="password" class="bg-gray-50 border border-gray-300 text-black text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                            </div>
                            <div class="mb-6">
                                <label for="profile_picture" class="block mb-2 text-sm font-medium text-black">Profiel Afbeelding:</label>
                                <input type="file" id="profile_picture" name="profile_picture" class="bg-gray-50 text-black focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            </div>
                            <div class="mb-6">
                                <button type="submit" class="w-full text-white bg-blue-500 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Student Aanmaken</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
