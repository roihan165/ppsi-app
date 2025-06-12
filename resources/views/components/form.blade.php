<!-- <div>
    Well begun is half done. - Aristotle
</div> -->
<div class="max-w-md mx-auto bg-white shadow-lg rounded-xl p-6">
    <h2 class="text-2xl font-semibold mb-4">{{ $title }}</h2>

    <form method="{{ $method }}" action="{{ $action }}">
        @csrf
        {{ $slot }}
    </form>
</div>
