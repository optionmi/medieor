@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('cropperjs/cropper.min.css') }}">
@endsection

@section('content')
    @include('partials.header')

    <main class="flex items-start justify-center min-h-[calc(100vh-6rem)] bg-gray-200 py-5 px-2 sm:py-10 sm:px-5">
        <div
            class="w-full max-w-2xl bg-white border border-gray-200 rounded-lg shadow sm:min-w-[70rem] dark:bg-gray-800 dark:border-gray-700">
            <div class="flex justify-end px-4 pt-4">
                <button id="dropdownButton" data-dropdown-toggle="dropdown"
                    class="inline-block text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-1.5"
                    type="button">
                    <span class="sr-only">Open dropdown</span>
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 16 3">
                        <path
                            d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z" />
                    </svg>
                </button>
                <!-- Dropdown menu -->
                <div id="dropdown"
                    class="z-10 hidden text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                    <ul class="py-2" aria-labelledby="dropdownButton">
                        <li>
                            <button
                                class="block w-full px-4 py-2 text-sm text-gray-700 text-start hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white"
                                onclick="editDetailsForm()">
                                Edit Details
                            </button>
                        </li>
                        <li>
                            <button
                                class="block w-full px-4 py-2 text-sm text-gray-700 text-start hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white"
                                onclick="changePasswordForm()">
                                Change Password
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="flex flex-col gap-10 p-5 sm:p-10 sm:flex-row">
                <div class="flex flex-col items-center w-full pb-10 sm:border-r sm:w-1/3">
                    <img class="w-48 h-48 mb-3 rounded-full shadow-lg" src="{{ asset('images/user_avatar/' . $user->img) }}"
                        alt="{{ $user->name }} image" id="user_avatar" />
                    <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">{{ $user->name }}</h5>
                    {{-- <span class="text-sm text-gray-500 dark:text-gray-400">Visual Designer</span> --}}
                    {{-- <div class="flex mt-4 md:mt-6">
                        <a href="#"
                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Add
                            friend</a>
                        <a href="#"
                            class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg ms-2 focus:outline-none hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Message</a>
                    </div> --}}
                </div>

                <div class="flex flex-col w-full sm:w-2/3">
                    <form class="smoothSubmit" action="{{ route('web.update.profile', $user) }}" method="POST">
                        <span class="block mb-4 text-xs text-gray-400 uppercase">Details</span>
                        @csrf
                        <div id="details" class="flex flex-col gap-2 line">
                            <div class="flex items-center gap-5 leading-[42px]">
                                <label for="name"
                                    class="block sm:min-w-[10rem] min-w-[5.8rem] font-medium text-gray-600 dark:text-gray-300">Name</label>
                                <p class="w-full">{{ $user->name }}</p>
                                <div class="flex flex-col w-full gap-1">
                                    <input class="hidden w-full rounded-md" name="name" type="text"
                                        value="{{ $user->name }}" id="name">
                                    <span class="text-xs text-red-500 error" id="error-name"></span>
                                </div>
                            </div>
                            <div class="flex items-center gap-5 leading-[42px]">
                                <label for="email"
                                    class="block sm:min-w-[10rem] min-w-[5.8rem] font-medium text-gray-600 dark:text-gray-300">Email</label>
                                <p class="w-full">{{ $user->email }}</p>
                                <div class="flex flex-col w-full gap-1">
                                    <input class="hidden w-full rounded-md" name="email" type="email"
                                        value="{{ $user->email }}" id="email">
                                    <span class="text-xs text-red-500 error" id="error-email"></span>
                                </div>
                            </div>
                            <div class="flex items-center gap-5 leading-[42px]">
                                <label for="country"
                                    class="block sm:min-w-[10rem] min-w-[5.8rem] font-medium text-gray-600 dark:text-gray-300">Country</label>
                                <p class="w-full">{{ $user->country_name }}</p>
                                <div class="flex flex-col w-full gap-1">
                                    <select class="hidden w-full rounded-md" name="country" id="country">
                                        <option value="">Select a country</option>
                                        @foreach ($countries as $code => $name)
                                            <option {{ $user->country == $code ? 'selected' : '' }}
                                                value="{{ $code }}">
                                                {{ $name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-xs text-red-500 error" id="error-country"></span>
                                </div>
                            </div>
                            <div class="flex items-center gap-5 leading-[42px]">
                                <label for="phone"
                                    class="block sm:min-w-[10rem] min-w-[5.8rem] font-medium text-gray-600 dark:text-gray-300">Phone</label>
                                <p class="w-full">{{ $user->phone }}</p>
                                <div class="flex flex-col w-full gap-1">
                                    <input class="hidden w-full rounded-md" name="phone" type="text"
                                        value="{{ $user->phone }}" id="phone">
                                    <span class="text-xs text-red-500 error" id="error-phone"></span>
                                </div>
                            </div>
                            <div class="items-center hidden gap-5" id="profilePic">
                                <label for="img"
                                    class="block sm:min-w-[10rem] min-w-[5.8rem] font-medium text-gray-600 dark:text-gray-300">Profile
                                    Picture</label>
                                <div class="flex flex-col w-full gap-1">
                                    <input class="hidden w-full rounded-md" name="img" type="file"
                                        value="{{ $user->phone }}" id="img" accept="image/*">
                                    <span class="text-xs text-red-500 error" id="error-img"></span>
                                </div>
                            </div>

                            <div class="hidden my-5 text-center" id="saveDetailsBtnContainer">
                                <button type="submit" id="saveDetailsBtn"
                                    class="px-5 py-2 font-semibold text-white rounded-md bg-primary">Update
                                    Profile</button>
                            </div>
                        </div>
                    </form>
                    <div id="updatePassword" class="hidden my-5">
                        <span class="block my-3 text-xs text-gray-400 uppercase">Password</span>
                        <form class="smoothSubmit" action="{{ route('web.update.password', $user) }}" method="POST">
                            @csrf
                            <div class="flex flex-col gap-2">
                                <div class="flex items-center gap-5">
                                    <label for="currentPassword"
                                        class="block sm:min-w-[10rem] min-w-[5.8rem] font-medium text-gray-600 dark:text-gray-300">Current
                                        Password</label>
                                    <div class="flex flex-col w-full gap-1">
                                        <input class="w-full rounded-md " type="password" name="currentPassword">
                                        <span class="text-xs text-red-500 error" id="error-currentPassword"></span>
                                    </div>
                                </div>
                                <div class="flex items-center gap-5">
                                    <label for="newPassword"
                                        class="block sm:min-w-[10rem] min-w-[5.8rem] font-medium text-gray-600 dark:text-gray-300">New
                                        Password</label>
                                    <div class="flex flex-col w-full gap-1">
                                        <input class="w-full rounded-md " type="password" name="password"
                                            id="newPassword">
                                        <span class="text-xs text-red-500 error" id="error-password"></span>
                                    </div>
                                </div>
                                <div class="flex items-center gap-5">
                                    <label for="confirmPassword"
                                        class="block sm:min-w-[10rem] min-w-[5.8rem] font-medium text-gray-600 dark:text-gray-300">Confirm
                                        Password</label>
                                    <div class="flex flex-col w-full gap-1">
                                        <input class="w-full rounded-md " type="password" name="password_confirmation"
                                            id="confirmPassword">
                                        <span class="text-xs text-red-500 error" id="error-password_confirmation"></span>
                                    </div>
                                </div>
                                <div class="flex justify-center my-5">
                                    <button type="submit"
                                        class="px-5 py-2 font-semibold text-white rounded-md bg-primary">Update
                                        Password</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('scripts')
    <script src="{{ asset('cropperjs/cropper.min.js') }}"></script>
    <script>
        const dropDownfix = () => {
            document.querySelector('#dropdownButton').click()
        }
        const editDetailsForm = () => {
            dropDownfix();
            const p = document.querySelectorAll('form p');
            p.forEach(element => {
                element.classList.toggle('hidden')
            });

            const input = document.querySelectorAll('form #details input');
            input.forEach(element => {
                element.classList.toggle('hidden')
            });

            const select = document.querySelectorAll('form #details select');
            select.forEach(element => {
                element.classList.toggle('hidden')
            });

            const profilePic = document.querySelector('#profilePic');
            profilePic.classList.toggle('hidden')
            profilePic.classList.toggle('flex')

            const saveDetailsBtnContainer = document.querySelector('#saveDetailsBtnContainer');
            saveDetailsBtnContainer.classList.toggle('hidden')
        }

        const changePasswordForm = () => {
            dropDownfix();
            const updatePassword = document.getElementById('updatePassword');
            updatePassword.classList.toggle('hidden');
        }

        const img = document.getElementById('img');
        img.addEventListener('change', function(e) {
            previewImage(e);
        });

        function previewImage(event) {
            var reader = new FileReader();
            // reader.onload = function() {
            //     var output = document.getElementById('user_avatar');
            //     output.src = reader.result;
            // };
            // reader.readAsDataURL(event.target.files[0]);

            reader.onload = function(e) {
                const user_avatar = document.getElementById('user_avatar');
                user_avatar.src = e.target.result;
                // new Cropper(user_avatar, {
                //     aspectRatio: 1, // Square aspect ratio
                //     startSize: [80, 80, '%'] // Initial crop area size
                // });
            };

            reader.readAsDataURL(event.target.files[0]);
        }


        // var $modal = $('#modal');
        // var image = document.getElementById('image');
        // var cropper;

        // /*------------------------------------------
        // --------------------------------------------
        // Image Change Event
        // --------------------------------------------
        // --------------------------------------------*/
        // $("body").on("change", ".image", function(e) {
        //     var files = e.target.files;
        //     var done = function(url) {
        //         image.src = url;
        //         $modal.modal('show');
        //     };

        //     var reader;
        //     var file;
        //     var url;

        //     if (files && files.length > 0) {
        //         file = files[0];

        //         if (URL) {
        //             done(URL.createObjectURL(file));
        //         } else if (FileReader) {
        //             reader = new FileReader();
        //             reader.onload = function(e) {
        //                 done(reader.result);
        //             };
        //             reader.readAsDataURL(file);
        //         }
        //     }
        // });

        // /*------------------------------------------
        // --------------------------------------------
        // Show Model Event
        // --------------------------------------------
        // --------------------------------------------*/
        // $modal.on('shown.bs.modal', function() {
        //     cropper = new Cropper(image, {
        //         aspectRatio: 1,
        //         viewMode: 3,
        //         preview: '.preview'
        //     });
        // }).on('hidden.bs.modal', function() {
        //     cropper.destroy();
        //     cropper = null;
        // });

        // /*------------------------------------------
        // --------------------------------------------
        // Crop Button Click Event
        // --------------------------------------------
        // --------------------------------------------*/
        // $("#crop").click(function() {
        //     canvas = cropper.getCroppedCanvas({
        //         width: 160,
        //         height: 160,
        //     });

        //     canvas.toBlob(function(blob) {
        //         url = URL.createObjectURL(blob);
        //         var reader = new FileReader();
        //         reader.readAsDataURL(blob);
        //         reader.onloadend = function() {
        //             var base64data = reader.result;
        //             $("input[name='image_base64']").val(base64data);
        //             $(".show-image").show();
        //             $(".show-image").attr("src", base64data);
        //             $("#modal").modal('toggle');
        //         }
        //     });
        // });
    </script>

    </script>
@endsection
