<!-- delete.blade.php -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Post</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body>
    <div class="flex justify-center items-center min-h-screen bg-gray-600">
        <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
            <h3 class="text-2xl font-semibold text-gray-800">Are you sure you want to delete this post?</h3>
            <form action="{{ route('posts.delete', $post->id) }}" method="POST" class="mt-4">
                @csrf
                @method('DELETE')
                <div class="flex justify-between mt-6">
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">Delete</button>
                    <a href="{{route('posts')}}" class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>