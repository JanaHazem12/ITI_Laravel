<!-- users table -->
{{-- use App\Http\Controllers\PostController; --}}
{{-- use Carbon\Carbon; --}}
@inject('carbon', 'Carbon\Carbon')
{{-- blade injection ^ --}}
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
        <div class="flex justify-center gap-5 my-8">
        <a href="{{route('posts.create')}}" class="px-4 py-2 text-white bg-green-600 hover:bg-green-700 text-2xl rounded-lg shadow-sm transition font-extrabold">Create Post</a>
        <form action="{{ route('posts.restore') }}" method="POST">
          @csrf
          <button onclick="showMessage()" href="" class="px-4 py-2 text-white bg-green-600 hover:bg-green-700 text-xl rounded-lg shadow-sm transition font-extrabold">Restore</button>
        </form>
        <h2 id="restoreBtn" class="text-4xl text-blue-500 font-bold hidden">Restored Successfully !</h2>
        </div> 
    <div class="flex justify-center items-center">
    <table class="divide-y-2 divide-gray-200 border border-gray-500 rounded-lg shadow-lg">
        <thead class="ltr:text-left rtl:text-right">
      <tr class="text-teal-600 text-center text-3xl">
      <th class="px-3 py-2 whitespace-nowrap font-black font-serif ">ID</th>
        <th class="px-3 py-2 whitespace-nowrap font-black font-serif">Title</th>
                <th class="px-3 py-2 whitespace-nowrap font-black font-serif">Slug</th>
        <th class="px-3 py-2 whitespace-nowrap font-black font-serif">Posted By</th>
        <th class="px-3 py-2 whitespace-nowrap font-black font-serif">Post Image</th>
        <th class="px-3 py-2 whitespace-nowrap font-black font-serif">Actions</th>
      </tr>
    </thead>
    @foreach ($posts as $post)
    <tbody class="divide-y divide-gray-200 *:even:bg-gray-50 text-center font-serif text-gray-700">
      <tr class="font-medium text-2xl">
        <td class="px-3 py-2 whitespace-nowrap">{{$post->id}}</td>
        <!-- posts_ID -->
        <td class="px-3 py-2 whitespace-nowrap">{{$post->title ? $post->title : 'Not available'}}</td> 
        <td class="px-3 py-2 whitespace-nowrap">{{$post->slug}}</td> 
        <!-- posts_Title -->
        <td class="px-3 py-2 whitespace-nowrap">{{$post->user ? $post->user->name : 'Not available'}}
          <td class="px-3 py-2 whitespace-nowrap">
            <img class="w-20 h-20" src="{{asset('storage/images/'.$post->image_path)}}">
            {{-- {{$post->image_path ? $post->image_path : 'Not available'}} --}}
          {{-- <td class="px-3 py-2 whitespace-nowrap">{{ $post->user->name ? $post->user->name : 'Not available' }}</td> --}}
        <!-- posts_PostedBy -->
        {{-- <td class="px-3 py-2 whitespace-nowrap">{{ $post->created_at ? $post->created_at->toFormattedDateString() : 'Not available' }}</td> --}}
        <!-- posts_CreatedAt -->
        <td class="px-3 py-2 whitespace-nowrap text-4xl space-x-2">
            <a href="{{route('posts.show',$post['id'])}}" class="px-4 text-white bg-blue-600 hover:bg-blue-700 rounded-lg shadow-sm transition">View</a>
            <a href="{{route('posts.edit', $post['id'])}}" class="px-4 text-white bg-green-600 hover:bg-green-700 rounded-lg shadow-sm transition">Edit</a>
            <a href="{{route('posts.confirmDelete', $post['id']) }}" class="px-4 text-white bg-red-600 hover:bg-red-700 rounded-lg shadow-sm transition">Delete</a>
            {{-- <a href="{{route('posts.delete', $post['id']) }}" class="px-4 text-white bg-red-600 hover:bg-red-700 rounded-lg shadow-sm transition">Delete</a> --}}
          </td>
      </tr>
    </tbody>
    @endforeach
  </table>
  
</div><br>
<div class="flex justify-center items-center gap-5">
  {{$posts->links('')}} 
  {{-- generates the HTML for the pagination links (e.g., Next, Previous, page numbers)
  {{-- Laravel automatically handles the logic for calculating the current page, total pages, and links. --}}
</div><br><br>
<script>
  function showMessage(){
    document.getElementById('restoreBtn').classList.toggle('hidden');
  }
</script>
 </body>
</x-layout>
 </html>