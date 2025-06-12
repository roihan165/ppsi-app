<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Card Modal Demo</title>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
      // Optional: log Alpine loaded
      document.addEventListener('alpine:init', () => {
          console.log('Alpine is ready');
      });
    </script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">

    <div x-data="{ showModal: false }" class="relative">
        <!-- Card -->
        <div @click="showModal = true" class="cursor-pointer p-6 bg-white shadow-lg rounded-lg">
            <h2 class="text-xl font-bold">Click Me</h2>
            <p class="text-gray-600">I open a modal</p>
        </div>

        <!-- Modal -->
        <div
            x-show="showModal"
            x-transition
            class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
        >
            <div @click.away="showModal = false" class="bg-white p-8 rounded shadow-lg w-96">
                <h3 class="text-lg font-semibold mb-2">Modal Title</h3>
                <p class="mb-4">This is the modal content!</p>
                <button @click="showModal = false" class="bg-blue-500 text-white px-4 py-2 rounded">Close</button>
            </div>
        </div>
    </div>

</body>
</html>
