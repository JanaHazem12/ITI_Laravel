<html>
    @vite(['resources/css/app.css','resources/js/app.js'])
    {{-- <nav class="bg-gray-400 text-white p-4">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
          <!-- Logo -->
          <span class="text-2xl font-bold"><img class="w-10" src="https://staging-ci.suez.edu.eg/wp-content/uploads/2022/08/iti-logo.png" alt=""></span>
            <a href="#" class="text-2xl float-end hover:bg-white hover:text-black hover:border-white rounded-lg w-25 hover:text-center">All Posts</a>
    </nav><br> --}}
    <x-layout>
        <span class="flex justify-center items-center text-4xl font-extrabold my-10 underline">FILL THE FORM</span>
        <div class="flex justify-center items-center text-center">
            @if ($errors->any())
            <div class="text-red-600 font-bold font-serif">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>
        <div class="flex justify-center items-center">
       
        <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
            {{-- xx action is related to the URL in the route NOT the class or class functions xx --}}
            @csrf
            {{-- for security vulnerabilities ^^ --}}
            <div>
                <div class="w-200">
                    <label class="block tracking-wide text-gray-700 text-sm font-bold mb-2" for="grid-first-name">
                        Title
                    </label>
                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 rounded py-3 px-4 mb-3 leading-tight focus:outline-none" id="grid-first-name" name="title" type="text" placeholder="Enter title here ...">
                </div><br>
                <div class="w-full">
                    <label class="block tracking-wide text-gray-700 text-sm font-bold mb-2" for="grid-last-name">
                        Description
                    </label>
                    <textarea name="description" id="desc" class="rounded-lg bg-gray-200 w-200 h-30"></textarea>
                </div>
            </div><br>
            {{-- <div class="flex flex-wrap -mx-3 mb-2">
                <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-sm font-bold mb-2" for="grid-city">
                        City
                    </label>
                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-city" type="text" placeholder="Albuquerque">
                </div> --}}
                <div class="w-full">
                    <label class="block tracking-wide text-gray-700 text-sm font-bold mb-2" for="grid-state">
                        Post Creator
                    </label>
                    <div class="relative">
                        <select name="postCreator" class="block appearance-none w-full bg-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white" id="grid-state">
                        {{-- loop over names in User DB to get ALL names AND put them in the dropdown --}}
                            @foreach ($users as $user)  
                                <option value={{$user->id}}>{{$user->name ? $user->name : 'Not Available'}}</option>
                            @endforeach
                            {{-- <option>Sara</option>
                            <option>Omar</option>
                            <option>Laila</option> --}}
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                        </div>
                    </div>
                </div>
                {{-- <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-sm font-bold mb-2" for="grid-zip">
                        Zip
                    </label>
                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-zip" type="text" placeholder="90210">
                </div> --}}
               <br><div class="w-full">
                        <label class="block tracking-wide text-gray-700 text-sm font-bold mb-2" for="grid-state">
                            Upload image:
                        </label><br>
                        <input class="appearance-none block w-full bg-gray-200 text-gray-700 rounded py-3 px-4 mb-3 leading-tight focus:outline-none" type="file" name="file">
                        {{-- <button class="bg-blue-400 w-30 font-serif text-white rounded-sm">upload</button> --}}
                </div><br>
            </div>
            <div class="flex justify-center items-center mt-4">
                <button type="submit" class="bg-green-600 hover:bg-green-800 text-white rounded-lg w-60 py-2">
                    Create
                </button>
            </div>
        </form>
    </div>
</x-layout>
</html>
