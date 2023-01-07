
    <div class="flex  flex-col gap-2">

        <label for="nama" class="block text-sm font-medium text-gray-700 leading-5">
            Nama @error('nama') <span class="text-red-700 font-bold">Wajib diisi</span> @enderror
        </label>

        <div class="mt-1 rounded-md shadow-sm">
            <input id="nama" name="nama" type="text" required autofocus class="w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('nama') border-red-700 border-2 @enderror" placeholder="ini nama" />
        </div>


        <label for="role" class="block text-sm font-medium text-gray-700 leading-5">
            Role @error('role') <span class="text-red-700 font-bold">Wajib diisi</span> @enderror
        </label>

        <div class="mt-1 rounded-md shadow-sm" x-data="{datanya : []}" x-init="fetch('https://api-supplychainmeuble.fly.dev/api/role',{method: 'GET'})
        .then(async (response) => {
            datanya = await response.json()
            datanya = datanya.data
        })">
            <select id="role" name="role" required class="w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('role') border-red-700 border-2 @enderror">

                <option disabled selected>-- Pilih Role --</option>
                <template x-for="datane in datanya">

                    <option x-bind:value="datane.id" x-text="datane.nama">

                </template>

            </select>
        </div>

        <label for="email" class="block text-sm font-medium text-gray-700 leading-5">
            Email @error('email') <span class="text-red-700 font-bold">Wajib diisi</span> @enderror
        </label>

        <div class="mt-1 rounded-md shadow-sm">
            <input id="email" name="email" type="email" required autofocus class="w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('email') border-red-700 border-2 @enderror" placeholder="ex: hilih@gmail.com" />
        </div>

        <hr class="my-3">
        <div class="">
            <span class="flex w-full gap-3 items-center">
                <button type="submit" class="flex justify-center px-4 py-2 text-sm font-medium text-white bg-green-600 border border-transparent rounded-md hover:bg-green-500 focus:outline-none focus:border-green-700 focus:ring-indigo active:bg-green-700 transition duration-150 ease-in-out">
                    Simpan
                </button>
                @if ($message = Session::get('success'))
                    <div class="text-green-600" role="alert">{{ $message }}</div>
                @endif
            </span>
        </div>
    </div>