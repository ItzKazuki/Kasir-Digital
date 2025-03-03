@extends('layouts.dashboard')
@section('content')
    <div class="mx-auto max-w-242.5">
        <!-- Breadcrumb Start -->
        <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <h2 class="text-4xl font-bold text-black  ">
                Profile
            </h2>

            <nav>
                <ol class="flex items-center gap-2">
                    <li>
                        <a class="font-medium" href="{{ route('dashboard.index') }}">Dashboard /</a>
                    </li>
                    <li class="font-medium text-red-600">Profile</li>
                </ol>
            </nav>
        </div>
        <!-- Breadcrumb End -->

        <!-- ====== Profile Section Start -->
        <div
            class="overflow-hidden rounded-sm border border-gray-300 bg-white shadow-default    ">
            <div class="relative z-20 h-35 md:h-65">
                <img src="{{ asset('img/profile/cover-01.png') }}" alt="profile cover"
                    class="h-full w-full rounded-tl-sm rounded-tr-sm object-cover object-center" />
            </div>
            <div class="px-4 pb-6 text-center lg:pb-8 xl:pb-11.5">
                <div
                    class="relative z-30 mx-auto -mt-22 h-30 w-full max-w-30 rounded-full bg-white/20 p-1 backdrop-blur sm:h-44 sm:max-w-44 sm:p-3">
                    <form id="changeProfilePicture"
                        action="{{ route('dashboard.settings.update-profile', ['user' => auth()->user()->id]) }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="relative drop-shadow-2">
                            <img class="rounded-full aspect-square object-cover"
                                src="{{ auth()->user()->profile_image ? auth()->user()->profile_image : Avatar::create(auth()->user()->full_name)->toBase64() }}"
                                alt="profile" />
                            <label for="profile"
                                class="absolute bottom-0 right-0 flex h-8.5 w-8.5 cursor-pointer items-center justify-center rounded-full bg-red-600 text-white hover:bg-opacity-90 sm:bottom-2 sm:right-2">
                                <svg class="fill-current" width="14" height="14" viewBox="0 0 14 14" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M4.76464 1.42638C4.87283 1.2641 5.05496 1.16663 5.25 1.16663H8.75C8.94504 1.16663 9.12717 1.2641 9.23536 1.42638L10.2289 2.91663H12.25C12.7141 2.91663 13.1592 3.101 13.4874 3.42919C13.8156 3.75738 14 4.2025 14 4.66663V11.0833C14 11.5474 13.8156 11.9925 13.4874 12.3207C13.1592 12.6489 12.7141 12.8333 12.25 12.8333H1.75C1.28587 12.8333 0.840752 12.6489 0.512563 12.3207C0.184375 11.9925 0 11.5474 0 11.0833V4.66663C0 4.2025 0.184374 3.75738 0.512563 3.42919C0.840752 3.101 1.28587 2.91663 1.75 2.91663H3.77114L4.76464 1.42638ZM5.56219 2.33329L4.5687 3.82353C4.46051 3.98582 4.27837 4.08329 4.08333 4.08329H1.75C1.59529 4.08329 1.44692 4.14475 1.33752 4.25415C1.22812 4.36354 1.16667 4.51192 1.16667 4.66663V11.0833C1.16667 11.238 1.22812 11.3864 1.33752 11.4958C1.44692 11.6052 1.59529 11.6666 1.75 11.6666H12.25C12.4047 11.6666 12.5531 11.6052 12.6625 11.4958C12.7719 11.3864 12.8333 11.238 12.8333 11.0833V4.66663C12.8333 4.51192 12.7719 4.36354 12.6625 4.25415C12.5531 4.14475 12.4047 4.08329 12.25 4.08329H9.91667C9.72163 4.08329 9.53949 3.98582 9.4313 3.82353L8.43781 2.33329H5.56219Z"
                                        fill="" />
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M7.00004 5.83329C6.03354 5.83329 5.25004 6.61679 5.25004 7.58329C5.25004 8.54979 6.03354 9.33329 7.00004 9.33329C7.96654 9.33329 8.75004 8.54979 8.75004 7.58329C8.75004 6.61679 7.96654 5.83329 7.00004 5.83329ZM4.08337 7.58329C4.08337 5.97246 5.38921 4.66663 7.00004 4.66663C8.61087 4.66663 9.91671 5.97246 9.91671 7.58329C9.91671 9.19412 8.61087 10.5 7.00004 10.5C5.38921 10.5 4.08337 9.19412 4.08337 7.58329Z"
                                        fill="" />
                                </svg>
                                <input type="file" accept="image/*" id="profile" class="sr-only" />
                                <input type="hidden" name="profile_img" id="profile_img_base64">
                            </label>
                        </div>

                    </form>
                </div>
                <div class="mt-4">
                    <h3 class="mb-1.5 text-2xl font-medium text-black  ">
                        {{ auth()->user()->full_name }}
                    </h3>
                    <p class="font-medium">{{ ucfirst(auth()->user()->role) }}</p>
                    <div
                        class="mx-auto mb-5.5 mt-4.5 grid max-w-94 grid-cols-3 rounded-md border border-gray-300 py-2.5 shadow-1    ">
                        <div
                            class="flex flex-col items-center justify-center gap-1 border-r border-gray-300 px-4   xsm:flex-row">
                            <span class="font-semibold text-black  ">259</span>
                            <span class="text-sm">Product</span>
                        </div>
                        <div
                            class="flex flex-col items-center justify-center gap-1 border-r border-gray-300 px-4   xsm:flex-row">
                            <span class="font-semibold text-black  ">129K</span>
                            <span class="text-sm">Transaction</span>
                        </div>
                        <div class="flex flex-col items-center justify-center gap-1 px-4 xsm:flex-row">
                            <span class="font-semibold text-black  ">2K</span>
                            <span class="text-sm">Following</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ====== Profile Section End -->
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js"></script>
@endpush

@push('modals')
    <!-- Modal -->
    <div id="modalUpdateProfile" class="fixed inset-0 z-300 hidden" aria-labelledby="modal-title" role="dialog"
        aria-modal="true">
        <div class="fixed inset-0 bg-gray-500/75 transition-opacity" aria-hidden="true" onclick="hideModal()"></div>

        <div class="fixed inset-0 z-10 w-screen overflow-y-auto flex items-center justify-center p-4">
            <div
                class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:w-full sm:max-w-lg">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div
                            class="mx-auto flex size-12 shrink-0 items-center justify-center rounded-full bg-blue-100 sm:mx-0 sm:size-10">
                            <svg class="size-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-base font-semibold text-gray-900" id="modal-title">Ubah Foto Profile</h3>
                            <p class="text-sm text-gray-500 mt-2">Are you sure you want to change your profile picture? This
                                action cannot be undone.</p>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6 gap-5">
                    <button id="confirmUpdateProfileBtn" type="button"
                        class="w-full sm:w-auto px-3 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-500">Update</button>
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
        let modalCropImage = document.getElementById('cropImageModal');
        let imageToCrop = document.getElementById('cropImage');
        let cropper;

        function showModal() {
            document.getElementById('modalUpdateProfile').classList.remove('hidden');
        }

        function hideModal() {
            document.getElementById('modalUpdateProfile').classList.add('hidden');
        }

        document.getElementById("confirmUpdateProfileBtn").addEventListener("click", function() {
            document.getElementById('changeProfilePicture').submit();
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
                    showModal();
                }

            });
        });

        document.getElementById('profile').addEventListener("change", e => {
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
