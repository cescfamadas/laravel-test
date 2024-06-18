<x-layout>
    <x-header>Post index page</x-header>
    <div class="flex justify-end">
        <a class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
        href="/posts/create">Create a new post</a>

    </div>
    <div> my name is {{$name}} and my age is {{$age}} </div>
    <ul>
        @foreach ($posts as $post)
<li>{{ $post}}</li>
            
        @endforeach
    </ul></x-layout>



