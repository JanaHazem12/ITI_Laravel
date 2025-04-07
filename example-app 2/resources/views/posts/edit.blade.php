<html>
    @vite(['resources/css/app.css','resources/js/app.js'])

    <x-layout>
        <span class="flex justify-center items-center text-4xl font-extrabold my-10 underline">EDIT THE FORM</span>

        <div class="flex justify-center items-center">
            <form action="{{ route('posts.update', $post['id']) }}" method="POST" class="w-full max-w-lg">
                @csrf
                @method('PUT')
                {{-- THE FORM DOESN'T UNDERSTAND ANYTHING OTHER THAN GET/POST, SO WE'VE TO USE THIS DECORATOR --}}
                <div class="mb-4">
                    <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Title</label>
                    <input type="text" name="title" id="title" value="{{ $post['title'] }}"
                        class="appearance-none block w-full bg-gray-200 text-gray-700 rounded py-3 px-4 leading-tight focus:outline-none  ">
                </div>
                <div class="mb-4">
                    <label for="desc" class="block text-gray-700 text-sm font-bold mb-2">Description</label>
                    <textarea name="description" id="descriptionId" class="bg-gray-200 w-full h-20 rounded-sm"></textarea>
                </div>
                <div class="mb-4">
                    <label for="Posted By" class="block text-gray-700 text-sm font-bold mb-2">Posted By</label>
                    <div class="relative">
                        <select name="Posted By" id="Posted By"
                            class="block appearance-none w-full bg-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none  ">
                            @foreach ($users as $user)
                            <option >{{$user->name}}</option>                        
                            @endforeach
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="mb-4">
                    <label for="CreatedAt" class="block text-gray-700 text-sm font-bold mb-2">Created At</label>
                    <input type="text" name="Created At" id="CreatedAt" value="{{$post['Created At']}}"
                        class="appearance-none block w-full bg-gray-200 text-gray-700 rounded py-3 px-4 leading-tight focus:outline-none">
                </div>
               
                <div class="flex justify-center items-center mt-4">
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-800 text-white rounded-lg w-60 py-2">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </x-layout>
</html>
