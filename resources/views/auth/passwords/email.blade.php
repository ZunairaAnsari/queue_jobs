@extends('layout')

@section('content')
    <div class="max-w-md mx-auto bg-white p-8 rounded-lg shadow-lg">
        <h2 class="text-3xl font-bold mb-6 text-center text-gray-800">Forgot Your Password?</h2>

        @if (session('status'))
            <div class="mb-4 text-green-600 text-center font-semibold">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                <input type="email" id="email" name="email" required autofocus class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>

            <button type="submit" class="w-full bg-indigo-600 text-white rounded-md py-2 hover:bg-indigo-500 transition-colors duration-200">Send Password Reset Link</button>
        </form>
    </div>
@endsection
