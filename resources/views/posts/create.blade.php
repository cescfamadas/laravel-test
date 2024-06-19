<x-layout>
<x-header>Post create page</x-header>
    <div class="max-2-2xl mx-auto p-4 bg-slate-200 dark:slate-900 rounded-lg">
        <form method="POST" action="/posts">
            @csrf
            <div class="mb-6">
    <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
    <input type="text" id="title" name="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
</div>
<div class="mb-6">
    
<label for="content"  class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Post content</label>
<textarea id="content" name="content" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write your content here..."></textarea>
</div>
<div class="mb-6">
<button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">submit</button>
</div>
        </form>
    </div>
</x-layout>