@extends('layouts.dashboard')
@section('content')
    <div class="mx-auto max-w-270">
        <!-- Breadcrumb Start -->
        <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <h2 class="text-3xl font-bold text-black">
                Buat Laporan
            </h2>

            <nav>
                <ol class="flex items-center gap-2">
                    <li>
                        <a class="font-medium" href="{{ route('dashboard.index') }}">Dashboard /</a>
                    </li>
                    <li>
                        <a href="{{ route('dashboard.reports.index') }}" class="font-medium">Laporan /</a>
                    </li>
                    <li class="font-medium text-red-600">Buat Laporan</li>
                </ol>
            </nav>
        </div>
        <!-- Breadcrumb End -->

        <!-- ====== Create Report Section Start -->
        <form action="{{ route('dashboard.reports.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-5 gap-8">
                <div class="col-span-5 xl:col-span-6">
                    <div class="rounded-sm border border-gray-300 bg-white shadow-default">
                        <div class="border-b border-gray-300 px-7 py-4">
                            <h3 class="font-medium text-black">
                                Informasi Laporan
                            </h3>
                        </div>
                        <div class="p-7">
                            <!-- Date -->
                            <div class="mb-4">
                                <label class="mb-3 block text-sm font-medium text-black" for="date">Tanggal <span
                                        class="text-red-600">*</span></label>
                                <input
                                    class="w-full rounded border border-gray-300 bg-gray-200 py-3 px-4.5 font-medium text-black focus:border-red-600 focus-visible:outline-none"
                                    type="date" name="date" id="date" value="{{ old('date', now()->toDateString()) }}" readonly
                                    required />
                                @error('date')
                                    <div class="mt-1 text-red-600">
                                        <p class="text-xs">{{ $message }}</p>
                                    </div>
                                @enderror
                            </div>

                            <!-- Cash Before and Cash After -->
                            <div class="mb-4 flex flex-col gap-6 xl:flex-row">
                                <div class="w-full xl:w-1/2">
                                    <label class="mb-3 block text-sm font-medium text-black" for="cash_before">Kas Awal
                                        <span class="text-red-600">*</span></label>
                                    <input
                                        class="w-full rounded border border-gray-300 bg-gray-200 py-3 px-4.5 font-medium text-black focus:border-red-600 focus-visible:outline-none"
                                        type="number" name="cash_before" id="cash_before" placeholder="0"
                                        value="{{ old('cash_before') }}" required />
                                    @error('cash_before')
                                        <div class="mt-1 text-red-600">
                                            <p class="text-xs">{{ $message }}</p>
                                        </div>
                                    @enderror
                                </div>

                                <div class="w-full xl:w-1/2">
                                    <label class="mb-3 block text-sm font-medium text-black" for="cash_after">Kas Akhir
                                        <span class="text-red-600">*</span></label>
                                    <input
                                        class="w-full rounded border border-gray-300 bg-gray-200 py-3 px-4.5 font-medium text-black focus:border-red-600 focus-visible:outline-none"
                                        type="number" name="cash_after" id="cash_after" placeholder="0"
                                        value="{{ old('cash_after') }}" required />
                                    @error('cash_after')
                                        <div class="mt-1 text-red-600">
                                            <p class="text-xs">{{ $message }}</p>
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Expenses -->
                            {{-- <div class="mb-4">
                                <label class="mb-3 block text-sm font-medium text-black" for="expenses">Pengeluaran</label>
                                <input
                                    class="w-full rounded border border-gray-300 bg-gray-200 py-3 px-4.5 font-medium text-black focus:border-red-600 focus-visible:outline-none"
                                    type="number" name="expenses" id="expenses" placeholder="0"
                                    value="{{ old('expenses') }}" required />
                                @error('expenses')
                                    <div class="mt-1 text-red-600">
                                        <p class="text-xs">{{ $message }}</p>
                                    </div>
                                @enderror
                            </div> --}}

                            <!-- Notes -->
                            <div class="mb-4">
                                <label class="mb-3 block text-sm font-medium text-black" for="notes">Catatan</label>
                                <textarea
                                    class="w-full rounded border border-gray-300 bg-gray-200 py-3 px-4.5 font-medium text-black focus:border-red-600 focus-visible:outline-none"
                                    name="notes" id="notes" rows="4"
                                    placeholder="Tambahkan catatan tambahan...">{{ old('notes') }}</textarea>
                                @error('notes')
                                    <div class="mt-1 text-red-600">
                                        <p class="text-xs">{{ $message }}</p>
                                    </div>
                                @enderror
                            </div>

                            <!-- Submit Button -->
                            <div class="flex justify-end gap-4.5">
                                <a href="{{ route('dashboard.reports.index') }}"
                                    class="flex justify-center rounded border border-gray-300 px-6 py-2 font-medium text-black hover:shadow-1">
                                    Batal
                                </a>
                                <button
                                    class="flex justify-center rounded bg-red-600 px-6 py-2 font-medium text-white hover:bg-opacity-90"
                                    type="submit">
                                    Simpan
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- ====== Create Report Section End -->
    </div>
@endsection
