<div class="container mx-auto p-4">
        <h1 class="text-4xl font-bold text-center mb-8">Add Region</h1>
        <form action="/add-region" method="POST" class="bg-white p-6 rounded shadow-md">
            <div class="mb-4">
                <label for="country_id" class="block text-gray-700">Country</label>
                <select id="country_id" name="country_id" class="w-full p-2 border border-gray-300 rounded mt-1" required>
                    <!-- Add options dynamically from the database -->
                </select>
            </div>
            <div class="mb-4">
                <label for="region_name" class="block text-gray-700">Region Name</label>
                <input type="text" id="region_name" name="region_name" class="w-full p-2 border border-gray-300 rounded mt-1" required>
            </div>
            <button type="submit" class="w-full bg-blue-900 text-white py-2 rounded hover:bg-blue-800">Add Region</button>
        </form>
    </div>
