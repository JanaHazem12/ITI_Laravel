{{-- use Carbon\Carbon; --}}
{{-- OR INJECT BOTH WORK AS EXPECTED --}}

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
        {{-- @foreach ($post as $postt) --}}
        {{-- {{ dd($post['id']) }} --}}
        {{-- we don't need to loop as we're displaying the content of a specific post_id --}}
            <div class="bg-white shadow-lg rounded-2xl p-6 border border-gray-200 w-full">
                <h3 class="text-xl font-bold text-red-800 mb-2 float-end">Post_Id = {{$post->id}}</h3>
                <div class="mb-4">
                    <h3 class="text-2xl font-semibold text-gray-800 mb-2">Post Info</h3>
                    <h2 class="text-gray-600"><strong>Title: </strong>{{$post->title}}</h2>
                    <p class="text-gray-600"><strong>Description: </strong>{{$post->description}}</p>
                </div>

                <div class="mt-6 border-t pt-4">
                    <h3 class="text-2xl font-semibold text-gray-800 mb-2">Post Creator Info</h3>
                    <h2 class="text-gray-600"><strong>Created at: </strong>{{$post->created_at->toDayDateTimeString()}}</h2>
                    <h2 class="text-gray-600"><strong>Updated at: </strong>{{$post->updated_at}}</h2>
                </div>
            </div>
    </div>
    <div id="comments-section" class="mt-10 bg-white p-6 rounded-xl shadow">
        <h2 class="text-xl font-bold mb-4 text-gray-800">Comments</h2>
    @foreach($post->comments as $comment)
        <div class="bg-gray-100 p-4 mb-3 rounded-lg shadow-sm">
            <p class="text-gray-700">{{ $comment->comment_body }}            
                {{-- go to edit method in commentsController --}}
                    <br><a href="javascript:void(0);" onclick="toggleEdit({{ $comment->id }})" class="text-blue-500 hover:underline text-sm">Edit</a>
                   
                {{-- <br><a href="javascript:void(0);" onclick="toggleEdit()" class="text-blue-500 hover:underline edit-btn text-sm">Edit</a><br> --}}
                {{-- go to delete method in commentsController --}}
                <form method="POST" action="{{route('comments.delete',$comment->id)}}">
                    @csrf
                    @method('DELETE')
                    <button href="" class="text-red-500 hover:underline delete-btn text-sm">Delete</button>
                </form>
            </p>
            <span class="text-sm text-gray-500">Posted on {{$comment->created_at->format('l, F j, Y g:i A')}}</span>
        
        </div>
        <div id="editComment-{{ $comment->id }}" class="bg-white w-100 p-6 mr-8 rounded-2xl shadow hidden">
            <h2 class="text-xl font-bold mb-2 text-blue-500">Edit Comment</h2>
            <form class="space-y-4" method="POST" action="{{route('comments.edit',$comment->id)}}">
                @csrf
                @method('PUT')
                <textarea id="comment-body" class="w-full p-3 border rounded-lg resize-none" rows="4" name="edited_body" placeholder="Write your comment..."></textarea>
                <div class="flex justify-end space-x-2">
                    {{-- <button type="reset" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-xl hover:bg-gray-300">Cancel</button> --}}
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-xl hover:bg-blue-700">Done</button>
                </div>
            </form>
        </div>
    @endforeach
    </div><br>
    <div class="bg-white p-6 rounded-2xl shadow">
        <h2 class="text-xl font-bold mb-4">Add Comment</h2>
        <form id="comment-form" class="space-y-4" method="POST" action="{{ route('comments.store',$post->id) }}">
            @csrf
            <textarea id="comment-body" class="w-full p-3 border rounded-lg resize-none" rows="4" name="comment_body" placeholder="Write your comment..."></textarea>
            <div class="flex justify-end space-x-2">
                {{-- <button type="reset" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-xl hover:bg-gray-300">Cancel</button> --}}
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-xl hover:bg-blue-700">Post</button>
            </div>
        </form>
    </div><br>
</div>
<script>
    function toggleEdit(commentId) {
        const section = document.getElementById('editComment-'+commentId);
        section.classList.toggle('hidden');
    }
</script>
</body>
</x-layout>
</html>
