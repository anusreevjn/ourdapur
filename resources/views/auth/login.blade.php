<x-layout>
    <div class="max-w-md mx-auto bg-white p-8 rounded-lg shadow-md mt-10">
        <h1 class="text-2xl font-bold mb-6 text-center">Welcome Back</h1>
        
        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="/login" method="POST">
            @csrf
            
            <div class="mb-4">
                <label class="block text-gray-700">Email Address</label>
                <input type="email" name="email" class="w-full border p-2 rounded" required>
            </div>

            <div class="mb-6">
                <label class="block text-gray-700">Password</label>
                <input type="password" name="password" class="w-full border p-2 rounded" required>
            </div>

            <button type="submit" class="w-full bg-green-600 text-white py-2 rounded hover:bg-green-700">Login</button>
        </form>

        <p class="mt-4 text-center text-sm">
            Don't have an account? <a href="/register" class="text-blue-600">Register here</a>
        </p>
    </div>
</x-layout>