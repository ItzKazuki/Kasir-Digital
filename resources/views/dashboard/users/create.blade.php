@extends('layouts.dashboard')
@section('content')
    <div class="mx-auto max-w-270">
        <!-- Breadcrumb Start -->
        <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <h2 class="text-3xl font-bold text-black">
                Create User
            </h2>

            <nav>
                <ol class="flex items-center gap-2">
                    <li>
                        <a class="font-medium" href="{{ route('dashboard.index') }}">Dashboard /</a>
                    </li>
                    <li class="font-medium text-red-600">Create User</li>
                </ol>
            </nav>
        </div>
        <!-- Breadcrumb End -->

        <!-- ====== Create User Section Start -->
        <form action="{{ route('dashboard.users.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-5 gap-8">
                <div class="col-span-5 xl:col-span-3">
                    <div class="rounded-sm border border-gray-300 bg-white shadow-default">
                        <div class="border-b border-gray-300 px-7 py-4">
                            <h3 class="font-medium text-black">
                                User Information
                            </h3>
                        </div>
                        <div class="p-7">

                            <div class="mb-5.5 flex flex-col gap-5.5 sm:flex-row">
                                <div class="w-full sm:w-1/2">
                                    <label class="mb-3 block text-sm font-medium text-black" for="fullName">Full
                                        Name</label>
                                    <input
                                        class="w-full rounded border border-gray-300 bg-gray-200 py-3 px-4.5 font-medium text-black focus:border-red-600 focus-visible:outline-none"
                                        type="text" name="full_name" id="full_name" placeholder="John Doe" />
                                    @error('full_name')
                                        <div class="mt-1 text-red-600">
                                            <p class="text-xs">{{ $message }}</p>
                                        </div>
                                    @enderror
                                </div>

                                <div class="w-full sm:w-1/2">
                                    <label class="mb-3 block text-sm font-medium text-black" for="phoneNumber">Phone
                                        Number</label>
                                    <input
                                        class="w-full rounded border border-gray-300 bg-gray-200 px-4.5 py-3 font-medium text-black focus:border-red-600 focus-visible:outline-none"
                                        type="tel" pattern="08[0-9]{8,11}" name="phone_number" id="phone_number"
                                        placeholder="08XXXXXXXXXX" />
                                    @error('phone_number')
                                        <div class="mt-1 text-red-600">
                                            <p class="text-xs">{{ $message }}</p>
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-5.5">
                                <label class="mb-3 block text-sm font-medium text-black" for="emailAddress">Email
                                    Address</label>
                                <input
                                    class="w-full rounded border border-gray-300 bg-gray-200 py-3 px-4.5 font-medium text-black focus:border-red-600 focus-visible:outline-none"
                                    type="email" name="email" id="email" placeholder="someone@domain.com" />
                                @error('email')
                                    <div class="mt-1 text-red-600">
                                        <p class="text-xs">{{ $message }}</p>
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-5.5">
                                <label class="mb-3 block text-sm font-medium text-black" for="username">Username</label>
                                <input
                                    class="w-full rounded border border-gray-300 bg-gray-200 px-4.5 py-3 font-medium text-black focus:border-red-600 focus-visible:outline-none"
                                    type="text" name="username" id="username" placeholder="yourname" />
                                @error('username')
                                    <div class="mt-1 text-red-600">
                                        <p class="text-xs">{{ $message }}</p>
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-5.5">
                                <label class="mb-3 block text-sm font-medium text-black" for="password">Password</label>
                                <input
                                    class="w-full rounded border border-gray-300 bg-gray-200 px-4.5 py-3 font-medium text-black focus:border-red-600 focus-visible:outline-none"
                                    type="password" name="password" id="password" placeholder="********" />
                                @error('password')
                                    <div class="mt-1 text-red-600">
                                        <p class="text-xs">{{ $message }}</p>
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-5.5">
                                <label class="mb-3 block text-sm font-medium text-black" for="role">Role</label>
                                <select
                                    class="w-full rounded border border-gray-300 bg-gray-200 px-4.5 py-3 font-medium text-black focus:border-red-600 focus-visible:outline-none"
                                    name="role" id="role">
                                    <option value="admin">Admin</option>
                                    <option value="kasir">Kasir</option>
                                </select>
                                @error('role')
                                    <div class="mt-1 text-red-600">
                                        <p class="text-xs">{{ $message }}</p>
                                    </div>
                                @enderror
                            </div>

                            <div class="flex justify-end gap-4.5">
                                <button
                                    class="flex justify-center rounded border border-gray-300 px-6 py-2 font-medium text-black hover:shadow-1"
                                    type="reset">
                                    Cancel
                                </button>
                                <button
                                    class="flex justify-center rounded bg-red-600 px-6 py-2 font-medium text-white hover:bg-opacity-90"
                                    type="submit">
                                    Save
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-span-5 xl:col-span-2">
                    <div class="rounded-sm border border-gray-300 bg-white shadow-default    ">
                        <div class="border-b border-gray-300 px-7 py-4  ">
                            <h3 class="font-medium text-black  ">
                                Photo Profile
                            </h3>
                        </div>
                        <div class="p-7">
                            <div class="mb-4 flex items-center gap-3">
                                <div id="previewProfileContainer" class="h-14 w-14 rounded-full hidden">
                                    <img id="previewProfile" class="rounded-full aspect-square object-cover"
                                        alt="User" />
                                </div>
                                <div>
                                    <p id="profileInfo" class="mb-1 font-medium text-red-600">Unggah Foto Profile!</p>
                                </div>
                            </div>
                            <div id="FileUpload"
                                class="relative mb-5 block w-full cursor-pointer appearance-none rounded border border-dashed border-blue-600 bg-gray-200 px-4 py-4 sm:py-7">
                                <input type="hidden" name="profile_img" id="profile_img_base64">
                                <input type="file" accept="image/*" id="inputImageProfile"
                                    class="absolute inset-0 z-50 m-0 h-full w-full cursor-pointer p-0 opacity-0 outline-none" />
                                <div class="flex flex-col items-center justify-center space-y-3">
                                    <span
                                        class="flex h-10 w-10 items-center justify-center rounded-full border border-gray-300 bg-white    ">
                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M1.99967 9.33337C2.36786 9.33337 2.66634 9.63185 2.66634 10V12.6667C2.66634 12.8435 2.73658 13.0131 2.8616 13.1381C2.98663 13.2631 3.1562 13.3334 3.33301 13.3334H12.6663C12.8431 13.3334 13.0127 13.2631 13.1377 13.1381C13.2628 13.0131 13.333 12.8435 13.333 12.6667V10C13.333 9.63185 13.6315 9.33337 13.9997 9.33337C14.3679 9.33337 14.6663 9.63185 14.6663 10V12.6667C14.6663 13.1971 14.4556 13.7058 14.0806 14.0809C13.7055 14.456 13.1968 14.6667 12.6663 14.6667H3.33301C2.80257 14.6667 2.29387 14.456 1.91879 14.0809C1.54372 13.7058 1.33301 13.1971 1.33301 12.6667V10C1.33301 9.63185 1.63148 9.33337 1.99967 9.33337Z"
                                                fill="#3C50E0" />
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M7.5286 1.52864C7.78894 1.26829 8.21106 1.26829 8.4714 1.52864L11.8047 4.86197C12.0651 5.12232 12.0651 5.54443 11.8047 5.80478C11.5444 6.06513 11.1223 6.06513 10.8619 5.80478L8 2.94285L5.13807 5.80478C4.87772 6.06513 4.45561 6.06513 4.19526 5.80478C3.93491 5.54443 3.93491 5.12232 4.19526 4.86197L7.5286 1.52864Z"
                                                fill="#3C50E0" />
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M7.99967 1.33337C8.36786 1.33337 8.66634 1.63185 8.66634 2.00004V10C8.66634 10.3682 8.36786 10.6667 7.99967 10.6667C7.63148 10.6667 7.33301 10.3682 7.33301 10V2.00004C7.33301 1.63185 7.63148 1.33337 7.99967 1.33337Z"
                                                fill="#3C50E0" />
                                        </svg>
                                    </span>
                                    <p class="text-sm font-medium">
                                        <span class="text-blue-600">Click to upload</span>
                                        or drag and drop
                                    </p>
                                    <p class="mt-1.5 text-sm font-medium">
                                        SVG, PNG, JPG or GIF
                                    </p>
                                    <p class="text-sm font-medium">
                                        (max, 800 X 800px)
                                    </p>
                                </div>

                            </div>
                            @error('profile_img')
                                <div class="mt-1 text-red-600">
                                    <p class="text-xs">{{ $message }}</p>
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- ====== Create User Section End -->
    </div>
@endsection

 @push('styles')
    <link rel="stylesheet" href="{{ asset('vendor/cropperjs/cropper.css') }}" />
    <script src="{{ asset('vendor/cropperjs/cropper.js') }}"></script>
@endpush

@push('modals')
    <div id="cropImageModal" class="fixed inset-0 z-300 hidden" aria-labelledby="modal-title" role="dialog"
        aria-modal="true">
        <div class="fixed inset-0 bg-gray-500/75 transition-opacity" aria-hidden="true" onclick="hideModal()"></div>

        <div class="fixed inset-0 z-10 w-screen overflow-y-auto flex items-center justify-center p-4">
            <div
                class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:w-full sm:max-w-lg">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-8 sm:pb-6">
                    <div class="sm:flex sm:items-start gap-4">
                        <div id="cropImageContainer">
                            <img id="cropImage" src="https://avatars0.githubusercontent.com/u/3456749" alt="">
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6 gap-5">
                    <button id="confirmCropImageBtn" type="button"
                        class="w-full sm:w-auto px-3 py-2 bg-red-600 text-white rounded-md hover:bg-red-500">Crop</button>
                    <button onclick="document.getElementById('cropImageModal').classList.add('hidden')"
                        class="mt-3 sm:mt-0 w-full sm:w-auto px-3 py-2 bg-white text-gray-900 rounded-md ring-1 ring-gray-300 hover:bg-gray-50">Cancel</button>
                </div>
            </div>
        </div>
    </div>
@endpush

@push('scripts')
    <script>
        let modalCropImage = document.getElementById('cropImageModal');
        let imageToCrop = document.getElementById('cropImage');
        let cropper;

        document.getElementById("confirmCropImageBtn").addEventListener("click", function() {
            canvas = cropper.getCroppedCanvas({
                width: 350,
                height: 350,
            });

            canvas.toBlob(function(blob) {
                url = URL.createObjectURL(blob);
                var reader = new FileReader();
                reader.readAsDataURL(blob);
                reader.onloadend = function() {
                    var base64data = reader.result;
                    document.getElementById('profile_img_base64').value = base64data;
                    document.getElementById('cropImageModal').classList.add('hidden');
                    document.getElementById('previewProfileContainer').classList.remove('hidden');
                    document.getElementById('previewProfile').src = base64data;


                    document.getElementById('profileInfo').classList.remove('text-red-600');
                    document.getElementById('profileInfo').classList.add('text-green-600');
                    document.getElementById('profileInfo').textContent = 'Foto Profile Berhasil Diunggah! Silahkan Kirim Data';
                }

            });
        });

        document.getElementById('inputImageProfile').addEventListener("change", e => {
            const files = e.target.files;
            const setImageToCroper = (url) => {
                imageToCrop.src = url;
                modalCropImage.classList.remove('hidden');
            }

            let reader;
            let file;
            let url;

            if (files && files.length > 0) {
                file = files[0];

                if (url) {
                    setImageToCroper(URL.createObjectURL(file));
                } else {
                    reader = new FileReader();

                    reader.onload = function(e) {
                        setImageToCroper(reader.result);
                    };
                    reader.readAsDataURL(file);
                }
            }
        });

        const observer = new MutationObserver((mutationsList) => {
            for (const mutation of mutationsList) {
                if (mutation.type === 'attributes' && mutation.attributeName === 'class') {
                    if (!modalCropImage.classList.contains('hidden')) {
                        cropper = new Cropper(imageToCrop, {
                            aspectRatio: 1,
                            viewMode: 3,
                            preview: '#cropImagePreviewContainer'
                        });
                    } else {
                        if (cropper) {
                            cropper.destroy();
                            cropper = null;
                        }
                    }
                }
            }
        });

        observer.observe(modalCropImage, {
            attributes: true
        });
    </script>
@endpush
