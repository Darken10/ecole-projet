@props(['lesson'])
<div class=" max-w-2xl bg-white border border-gray-200 rounded-lg  dark:bg-gray-800 dark:border-gray-700 shadow-md">
    <div class=" p-4 bg-white rounded-lg md:p-8 dark:bg-gray-800 mx-auto"  >
        <dl class="grid max-w-screen-xl grid-cols-2 gap-8 p-4 mx-auto text-gray-900 sm:grid-cols-3 xl:grid-cols-3 dark:text-white sm:p-8">
            <div class="flex flex-col">
                <dt class="mb-2 text-3xl font-extrabold">{{ $lesson->count_views() }}</dt>
                <dd class="text-gray-500 dark:text-gray-400">Vues</dd>
            </div>
            <div class="flex flex-col">
                <dt class="mb-2 text-3xl font-extrabold">{{ $lesson->count_followers() }}</dt>
                <dd class="text-gray-500 dark:text-gray-400">Suivre</dd>
            </div>
            <div class="flex flex-col">
                <dt class="mb-2 text-3xl font-extrabold">{{ $lesson->count_likes() }}</dt>
                <dd class="text-gray-500 dark:text-gray-400">J'aime</dd>
            </div>
        </dl>
    </div>
</div>