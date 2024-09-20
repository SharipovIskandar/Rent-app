<x-sidebar>
    <div class="container relative">
        <div class="grid md:grid-cols-2 grid-cols-1 gap-6 mt-6">
            <div class="rounded-md shadow dark:shadow-gray-700 p-6 bg-white dark:bg-slate-900 h-fit">
                <div>
                    <p class="font-medium mb-4">Rasmni shu yerga olib keling yoki "Rasm yuklash" tugmasini bosing</p>
                    <div class="preview-box flex justify-center rounded-md shadow dark:shadow-gray-800 overflow-hidden bg-gray-50 dark:bg-slate-800 text-slate-400 p-2 text-center small w-auto max-h-60">
                        Qabul qilinadigan kengaytmalar: JPG, PNG
                        <br> Hajm bo'yicha cheklov: 10MB
                    </div>
                    <input form="ads-create" type="file" id="input-file" name="image" accept="image/*"
                           onchange={handleChange()} hidden>
                    <label class="btn-upload btn bg-green-600 hover:bg-green-700 border-green-600 hover:border-green-700 text-white rounded-md mt-6 cursor-pointer"
                           for="input-file">
                        <i class="mdi mdi-upload me-2"></i>Rasm yuklash
                    </label>
                </div>
            </div>

            <div class="rounded-md shadow dark:shadow-gray-700 p-6 bg-white dark:bg-slate-900 h-fit">
                <form id="ads-create" action="/ads/create" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="_method" value="patch">
                    <div class="grid grid-cols-12 gap-5">
                        <div class="col-span-12">
                            <label for="title" class="font-medium">Sarlavha:</label>
                            <input name="title" id="title" type="text" class="form-input mt-2"
                                   placeholder="Sarlavha" value="#">
                        </div>

                        <div class="md:col-span-12 col-span-12">
                            <label for="description" class="font-medium">Ta'rif:</label>
                            <div class="form-icon relative mt-2">
                                <i class="mdi mdi-text-box-outline absolute top-2 start-4 text-green-600"></i>
                                <textarea name="description" id="description" class="form-input ps-11"
                                          placeholder="E'lon bo'yicha ta'rif...">#
                            </textarea>
                            </div>
                        </div>

                        <div class="md:col-span-12 col-span-12">
                            <label for="address" class="font-medium">Manzil:</label>
                            <div class="form-icon relative mt-2">
                                <i class="mdi mdi-map-marker-outline absolute top-2 start-4 text-green-600"></i>
                                <input name="address" id="address" type="text" class="form-input ps-11"
                                       placeholder="Manzil:" value="#">
                            </div>
                        </div>
                        <div class="md:col-span-12 col-span-12">
                            <label for="branch" class="font-medium">Filial:</label>
                            <div class="form-icon relative mt-2">
                                <select class="form-select form-input w-full py-2 h-10 bg-white dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-100 focus:border-gray-200 dark:border-gray-800 dark:focus:border-gray-700 focus:ring-0"
                                        id="branch" name="branch">
                                    @foreach ($branches as $branch) {
                                        @if (isset($ad) && $branch->id === $ad->branch_id)
                                             {{"<option value='$branch->id' selected>$branch->name</option>"}};
                                        @else
                                             {{"<option value='$branch->id'>$branch->name</option>"}};
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="md:col-span-12 col-span-12">
                                <label for="branch" class="font-medium">Gender:</label>
                                <div class="form-icon relative mt-2">
                                    <select class="form-select form-input w-full py-2 h-10 bg-white dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-100 focus:border-gray-200 dark:border-gray-800 dark:focus:border-gray-700 focus:ring-0"
                                            id="gender" name="gender">
                                        <option value="male" >ERKAK!!!!!!</option>
                                        <option value="female">Ayol</option>
                                        <option value="nothing">Odam Podam basman</option>
                                    </select>

                                </div>
                                <div class="col-span-12">
                                    <label for="price" class="font-medium">Narxi:</label>
                                    <div class="form-icon relative mt-2">
                                        <i class="mdi mdi-currency-usd absolute top-2 start-4 text-green-600"></i>
                                        <input name="price" id="price" type="number" class="form-input ps-11"
                                               placeholder="Narxi($):" value="#">
                                    </div>
                                </div>
                                <div class="col-span-12">
                                    <label for="rooms" class="font-medium">Xonalar:</label>
                                    <div class="form-icon relative mt-2">
                                        <input name="rooms" id="rooms" type="number" class="form-input ps-11"
                                               placeholder="Xonalar:" value="#">
                                    </div>
                                </div>
                            </div>

                            <button type="submit" id="submit" name="send"
                                    class="btn bg-green-600 hover:bg-green-700 border-green-600 hover:border-green-700 text-white rounded-md mt-5">
                                <i class="mdi mdi-content-save me-2"></i>
                                Saqlash
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-sidebar>
