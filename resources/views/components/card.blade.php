<!-- <div>
    It is never too late to be what you might have been. - George Eliot
</div> -->

<div class="growth-card">
    <img src={{$image}} alt="{{$alt ?? 'image.jpg'}}">
    <div x-data="{ showModal: false }" class="relative">
        <!-- Card -->
        <div @click="showModal = true" class="cursor-pointer p-6 bg-white shadow-lg rounded-lg">
            <h3>{{ $title }}</h3>
            <p>
                {{ $slot }}
            </p>
        </div>

        <!-- Modal -->
        <div
            x-show="showModal"
            x-transition
            class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
        >
            <div @click.away="showModal = false" class="bg-white p-8 rounded shadow-lg w-96">
                <h3 class="text-lg font-semibold mb-2"></h3>
                <p class="mb-4">{!!$bahan!!}</p>
                <button @click="showModal = false" class="bg-blue-500 text-white px-4 py-2 rounded">Close</button>
            </div>
        </div>
    </div>
</div>