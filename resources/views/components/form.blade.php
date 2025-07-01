<!-- <div>
    Well begun is half done. - Aristotle
</div> -->
<div class="max-w-md mx-auto bg-white shadow-lg rounded-xl p-6">
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <h2 class="text-2xl font-semibold mb-4">{{ $title }}</h2>
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ $action }}" method="{{ $method }}">
        @csrf
        {{ $slot }}
    </form>
</div>
