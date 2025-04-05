<!-- users table -->
{{-- use App\Http\Controllers\PostController; --}}
 
<html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
 </head>
 <body>
    {{-- <nav class="bg-gray-400 text-white p-4">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
          <!-- Logo -->
          <span class="text-2xl font-bold"><img class="w-10" src="https://staging-ci.suez.edu.eg/wp-content/uploads/2022/08/iti-logo.png" alt=""></span>
            <a href="#" class="text-2xl float-end hover:bg-white hover:text-black hover:border-white rounded-lg w-25 hover:text-center">All Posts</a>
    </nav><br> --}}
    <x-layout>
        <div class="flex justify-center my-8">
        <a href="{{route('posts.create')}}" class="px-4 py-2 text-white bg-green-600 hover:bg-green-700 text-2xl rounded-lg shadow-sm transition font-extrabold">Create Post</a>
    </div> 
    <div class="flex justify-center items-center">
    <table class="text-lg divide-y-2 divide-gray-200 border border-gray-500 rounded-lg shadow-lg">
        <thead class="ltr:text-left rtl:text-right">
      <tr class="text-teal-600 text-center">
      <th class="px-3 py-2 whitespace-nowrap font-black font-serif text-4xl">ID</th>
        <th class="px-3 py-2 whitespace-nowrap font-black font-serif text-4xl">Title</th>
        <th class="px-3 py-2 whitespace-nowrap font-black font-serif text-4xl">Posted By</th>
        <th class="px-3 py-2 whitespace-nowrap font-black font-serif text-4xl">Created At</th>
        <th class="px-3 py-2 whitespace-nowrap font-black font-serif text-4xl">Actions</th>
      </tr>
    </thead>
    @foreach ($posts as $post)
    <tbody class="divide-y divide-gray-200 *:even:bg-gray-50 text-center font-serif text-gray-700">
      <tr class="font-medium">
        <td class="px-3 py-2 whitespace-nowrap text-4xl">{{$post['id']}}</td>
        <!-- posts_ID --> 
        <td class="px-3 py-2 whitespace-nowrap text-4xl">{{$post['title']}}</td> 
        <!-- posts_Title -->
        <td class="px-3 py-2 whitespace-nowrap text-4xl">{{$post['Posted By']}}</td>
        <!-- posts_PostedBy -->
        <td class="px-3 py-2 whitespace-nowrap text-4xl">{{ $post['Created At'] }}</td>
        <!-- posts_CreatedAt -->
        <td class="px-3 py-2 whitespace-nowrap text-4xl space-x-2">
            <a href="{{route('posts.show',$post['id'])}}" class="px-4 text-white bg-blue-600 hover:bg-blue-700 rounded-lg shadow-sm transition">View</a>
            <a href="{{route('posts.edit', $post['id'])}}" class="px-4 text-white bg-green-600 hover:bg-green-700 rounded-lg shadow-sm transition">Edit</a>
            <a class="px-4 text-white bg-red-600 hover:bg-red-700 rounded-lg shadow-sm transition">Delete</a>
        </td>
      </tr>
    </tbody>
    @endforeach
  </table>
  
</div>   
 </body>
</x-layout>
 </html>