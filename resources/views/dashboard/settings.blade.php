@extends('layouts.dashboard')
@section('content')
    <div class="mx-auto max-w-270">
        <!-- Breadcrumb Start -->
        <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <h2 class="text-3xl font-bold text-black  ">
                Settings
            </h2>

            <nav>
                <ol class="flex items-center gap-2">
                    <li>
                        <a class="font-medium" href="{{ route('dashboard.index') }}">Dashboard /</a>
                    </li>
                    <li class="font-medium text-red-600">Settings</li>
                </ol>
            </nav>
        </div>
        <!-- Breadcrumb End -->

        <!-- ====== Settings Section Start -->
        <div class="grid grid-cols-5 gap-8">
            <div class="col-span-5 xl:col-span-3">
                <div class="rounded-sm border border-gray-300 bg-white shadow-default    ">
                    <div class="border-b border-gray-300 px-7 py-4  ">
                        <h3 class="font-medium text-black  ">
                            Personal Information
                        </h3>
                    </div>
                    <div class="p-7">
                        <form action="{{ route('dashboard.settings.update-user', ['user' => $user->id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-5.5 flex flex-col gap-5.5 sm:flex-row">
                                <div class="w-full sm:w-1/2">
                                    <label class="mb-3 block text-sm font-medium text-black  " for="fullName">Full
                                        Name</label>
                                    <div class="relative">
                                        <span class="absolute left-4 top-4">
                                            <svg class="fill-current" width="20" height="20" viewBox="0 0 20 20"
                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <g opacity="0.8">
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M3.72039 12.887C4.50179 12.1056 5.5616 11.6666 6.66667 11.6666H13.3333C14.4384 11.6666 15.4982 12.1056 16.2796 12.887C17.061 13.6684 17.5 14.7282 17.5 15.8333V17.5C17.5 17.9602 17.1269 18.3333 16.6667 18.3333C16.2064 18.3333 15.8333 17.9602 15.8333 17.5V15.8333C15.8333 15.1703 15.5699 14.5344 15.1011 14.0655C14.6323 13.5967 13.9964 13.3333 13.3333 13.3333H6.66667C6.00363 13.3333 5.36774 13.5967 4.8989 14.0655C4.43006 14.5344 4.16667 15.1703 4.16667 15.8333V17.5C4.16667 17.9602 3.79357 18.3333 3.33333 18.3333C2.8731 18.3333 2.5 17.9602 2.5 17.5V15.8333C2.5 14.7282 2.93899 13.6684 3.72039 12.887Z"
                                                        fill="" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M9.99967 3.33329C8.61896 3.33329 7.49967 4.45258 7.49967 5.83329C7.49967 7.214 8.61896 8.33329 9.99967 8.33329C11.3804 8.33329 12.4997 7.214 12.4997 5.83329C12.4997 4.45258 11.3804 3.33329 9.99967 3.33329ZM5.83301 5.83329C5.83301 3.53211 7.69849 1.66663 9.99967 1.66663C12.3009 1.66663 14.1663 3.53211 14.1663 5.83329C14.1663 8.13448 12.3009 9.99996 9.99967 9.99996C7.69849 9.99996 5.83301 8.13448 5.83301 5.83329Z"
                                                        fill="" />
                                                </g>
                                            </svg>
                                        </span>
                                        <input
                                            class="w-full rounded border border-gray-300 bg-gray-200 py-3 pl-11.5 pr-4.5 font-medium text-black focus:border-red-600 focus-visible:outline-none        "
                                            type="text" name="full_name" id="full_name" placeholder="Jhon Doe"
                                            value="{{ $user->full_name }}" />
                                    </div>
                                    @error('full_name')
                                        <div class="mt-1 text-red-600">
                                            <p class="text-xs">{{ $message }}</p>
                                        </div>
                                    @enderror
                                </div>

                                <div class="w-full sm:w-1/2">
                                    <label class="mb-3 block text-sm font-medium text-black  " for="phoneNumber">Phone
                                        Number</label>
                                    <input
                                        class="w-full rounded border border-gray-300 bg-gray-200 px-4.5 py-3 font-medium text-black focus:border-red-600 focus-visible:outline-none        "
                                        type="tel" pattern="08[0-9]{8,11}" name="phone_number" id="full_name"
                                        placeholder="08XXXXXXXXXX" value="{{ $user->no_telp }}" />
                                    @error('phone_number')
                                        <div class="mt-1 text-red-600">
                                            <p class="text-xs">{{ $message }}</p>
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-5.5">
                                <label class="mb-3 block text-sm font-medium text-black  " for="emailAddress">Email
                                    Address</label>
                                <div class="relative">
                                    <span class="absolute left-4 top-4">
                                        <svg class="fill-current" width="20" height="20" viewBox="0 0 20 20"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <g opacity="0.8">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M3.33301 4.16667C2.87658 4.16667 2.49967 4.54357 2.49967 5V15C2.49967 15.4564 2.87658 15.8333 3.33301 15.8333H16.6663C17.1228 15.8333 17.4997 15.4564 17.4997 15V5C17.4997 4.54357 17.1228 4.16667 16.6663 4.16667H3.33301ZM0.833008 5C0.833008 3.6231 1.9561 2.5 3.33301 2.5H16.6663C18.0432 2.5 19.1663 3.6231 19.1663 5V15C19.1663 16.3769 18.0432 17.5 16.6663 17.5H3.33301C1.9561 17.5 0.833008 16.3769 0.833008 15V5Z"
                                                    fill="" />
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M0.983719 4.52215C1.24765 4.1451 1.76726 4.05341 2.1443 4.31734L9.99975 9.81615L17.8552 4.31734C18.2322 4.05341 18.7518 4.1451 19.0158 4.52215C19.2797 4.89919 19.188 5.4188 18.811 5.68272L10.4776 11.5161C10.1907 11.7169 9.80879 11.7169 9.52186 11.5161L1.18853 5.68272C0.811486 5.4188 0.719791 4.89919 0.983719 4.52215Z"
                                                    fill="" />
                                            </g>
                                        </svg>
                                    </span>
                                    <input
                                        class="w-full rounded border border-gray-300 bg-gray-200 py-3 pl-11.5 pr-4.5 font-medium text-black focus:border-red-600 focus-visible:outline-none        "
                                        type="email" name="email" id="email" placeholder="someone@domain.com"
                                        value="{{ $user->email }}" />
                                </div>
                                @error('email')
                                    <div class="mt-1 text-red-600">
                                        <p class="text-xs">{{ $message }}</p>
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-5.5">
                                <label class="mb-3 block text-sm font-medium text-black  " for="username">Username</label>
                                <input
                                    class="w-full rounded border border-gray-300 bg-gray-200 px-4.5 py-3 font-medium text-black focus:border-red-600 focus-visible:outline-none        "
                                    type="text" name="username" id="username" placeholder="yourname"
                                    value="{{ $user->username }}" />
                                @error('username')
                                    <div class="mt-1 text-red-600">
                                        <p class="text-xs">{{ $message }}</p>
                                    </div>
                                @enderror
                            </div>

                            <div class="flex justify-end gap-4.5">
                                <button
                                    class="flex justify-center rounded border border-gray-300 px-6 py-2 font-medium text-black hover:shadow-1    "
                                    type="submit">
                                    Cancel
                                </button>
                                <button
                                    class="flex justify-center rounded bg-red-600 px-6 py-2 font-medium text-white hover:bg-opacity-90"
                                    type="submit">
                                    Save
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-span-5 xl:col-span-2">
                <div class="rounded-sm border border-gray-300 bg-white shadow-default    ">
                    <div class="border-b border-gray-300 px-7 py-4  ">
                        <h3 class="font-medium text-black  ">
                            Your Photo Profile
                        </h3>
                    </div>
                    <div class="p-7">
                        <div class="mb-4 flex items-center gap-3">
                            <div class="h-14 w-14 rounded-full">
                                <img class="rounded-full aspect-square object-cover"
                                    src="{{ $user->profile_image ? $user->profile_image : Avatar::create($user->full_name)->toBase64() }}"
                                    alt="User" />
                            </div>
                            <div>
                                <span class="mb-1 font-medium text-black  ">Edit your photo</span>
                                <span class="flex gap-2">
                                    @if ($user->profile_image)
                                        <form id="update-profile-{{ $user->id }}"
                                            action="{{ route('dashboard.settings.delete-profile', ['user' => $user->id]) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button"
                                                onclick="showModal('update-profile-{{ $user->id }}')"
                                                class="text-sm text-gray-600 font-medium hover:text-red-600">
                                                Delete
                                            </button>
                                        </form>
                                    @else
                                        <p class="text-sm font-medium text-red-600">Unggah Foto Profile!</p>
                                    @endif
                                    {{-- <button class="text-sm text-gray-600 font-medium hover:text-red-600">
                                            Update
                                        </button> --}}
                                </span>
                            </div>
                        </div>
                        <form id="upload-profile-image"
                            action="{{ route('dashboard.settings.update-profile', ['user' => $user->id]) }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
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

                            <div class="flex justify-end gap-4.5">
                                <button
                                    class="flex justify-center rounded border border-gray-300 px-6 py-2 font-medium text-black hover:shadow-1    "
                                    type="button">
                                    Cancel
                                </button>
                                <button
                                    class="flex justify-center rounded bg-red-600 px-6 py-2 font-medium text-white hover:bg-opacity-90"
                                    type="submit">
                                    Save
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- ====== Settings Section End -->
    </div>
@endsection

 @push('styles')
    <link rel="stylesheet" href="{{ asset('vendor/cropperjs/cropper.css') }}" />
    <script src="{{ asset('vendor/cropperjs/cropper.js') }}"></script>
@endpush

@push('modals')
    <!-- Modal -->
    <div id="deleteConfirmModal" class="fixed inset-0 z-300 hidden" aria-labelledby="modal-title" role="dialog"
        aria-modal="true">
        <div class="fixed inset-0 bg-gray-500/75 transition-opacity" aria-hidden="true" onclick="hideModal()"></div>

        <div class="fixed inset-0 z-10 w-screen overflow-y-auto flex items-center justify-center p-4">
            <div
                class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:w-full sm:max-w-lg">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div
                            class="mx-auto flex size-12 shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:size-10">
                            <svg class="size-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-base font-semibold text-gray-900" id="modal-title">Hapus Foto Profile?</h3>
                            <p class="text-sm text-gray-500 mt-2">Are you sure you want to delete this profile picture?
                                This action
                                cannot be undone.</p>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6 gap-5">
                    <button id="confirmDeleteBtn" type="button"
                        class="w-full sm:w-auto px-3 py-2 bg-red-600 text-white rounded-md hover:bg-red-500">Hapus</button>
                    <button onclick="hideModal()"
                        class="mt-3 sm:mt-0 w-full sm:w-auto px-3 py-2 bg-white text-gray-900 rounded-md ring-1 ring-gray-300 hover:bg-gray-50">Cancel</button>
                </div>
            </div>
        </div>
    </div>

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
        let deleteFormId = '';
        let modalCropImage = document.getElementById('cropImageModal');
        let imageToCrop = document.getElementById('cropImage');
        let cropper;

        function showModal(formId) {
            deleteFormId = formId;
            document.getElementById('deleteConfirmModal').classList.remove('hidden');
        }

        function hideModal() {
            document.getElementById('deleteConfirmModal').classList.add('hidden');
        }

        document.getElementById("confirmDeleteBtn").addEventListener("click", function() {
            if (deleteFormId) {
                document.getElementById(deleteFormId).submit();
            }
        });

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
                    document.getElementById('upload-profile-image').submit();
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

        modalCropImage.addEventListener('transitionend', function(event) {
            if (event.target === modalCropImage && modalCropImage.classList.contains('hidden')) {
                if (cropper) {
                    cropper.destroy();
                    cropper = null;
                }
            }
        });
    </script>
@endpush
