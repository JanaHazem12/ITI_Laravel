<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<x-layout>
<body>
   <div class="container mx-auto px-4 py-8">
    <h1 class="text-5xl font-bold text-center text-green-600 mb-10 underline">Post Info</h1>

    <div class="flex justify-center items-center">
        @foreach ($post as $postt)
            <div class="bg-white shadow-lg rounded-2xl p-6 border border-gray-200 w-full">
                <div class="mb-4">
                    <h3 class="text-2xl font-semibold text-gray-800 mb-2">Post Info</h3>
                    <h2 class="text-gray-600"><strong>Title: </strong>{{ $postt['title'] }}</h2>
                    <p class="text-gray-600"><strong>Description: </strong>{{ $postt['description'] }}</p>
                </div>

                <div class="mt-6 border-t pt-4">
                    <h3 class="text-2xl font-semibold text-gray-800 mb-2">Post Creator Info</h3>
                    <p class="text-gray-600"><strong>Name:</strong> {{ $postt['user']['name'] }}</p>
                    <p class="text-gray-600"><strong>Email:</strong> {{ $postt['user']['email'] }}</p>
                    <p class="text-gray-600"><strong>Created At:</strong> {{ $postt['user']['created_at'] }}</p>
                </div>
            </div>
        @endforeach
    </div>
</div>

</body>
</x-layout>
</html>
