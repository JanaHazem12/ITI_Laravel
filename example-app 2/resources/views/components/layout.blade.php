<html>
    @vite(['resources/css/app.css','resources/js/app.js'])
    <nav class="bg-gray-400 text-white p-4">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
          <!-- Logo -->
          <span class="text-2xl font-bold"><img class="w-10" src="https://staging-ci.suez.edu.eg/wp-content/uploads/2022/08/iti-logo.png" alt=""></span>
            <a href="{{ route('posts') }}" class="text-2xl float-end hover:bg-white hover:text-black hover:border-white rounded-lg w-25 hover:text-center">All Posts</a>
    </nav><br>
    <div>
        {{ $slot }}
    </div>
<html>

{{-- SEARCH FOR THE COMMAND TO ADD THIS COMP. AUTOMATICALLY --}}