<x-layout>
    <div class="max-w-md mx-auto bg-white p-8 rounded-lg shadow-md mt-10">
        <h1 class="text-2xl font-bold mb-6 text-center">Create an Account</h1>
        
        <form action="/register" method="POST">
            @csrf
            
            <div class="mb-4">
                <label class="block text-gray-700">Name</label>
                <input type="text" name="name" class="w-full border p-2 rounded" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Email Address</label>
                <input type="email" name="email" class="w-full border p-2 rounded" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Password</label>
                <input type="password" name="password" class="w-full border p-2 rounded" required>
            </div>

            <div class="mb-6">
                <label class="block text-gray-700">Confirm Password</label>
                <input type="password" name="password_confirmation" class="w-full border p-2 rounded" required>
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">Register</button>
        </form>

        <p class="mt-4 text-center text-sm">
            Already have an account? <a href="/login" class="text-blue-600">Login here</a>
        </p>
    </div>
</x-layout>