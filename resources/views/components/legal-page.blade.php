@props(['title', 'content'])

<x-container.page :title="$title">
    <div class="mx-auto">
        <div class="prose prose-lg prose-gray max-w-none">
            <div class="text-base leading-8 text-gray-700 space-y-8">
                {!! $content !!}
            </div>
        </div>
    </div>
</x-container.page>
