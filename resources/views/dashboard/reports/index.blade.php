@extends('layouts.dashboard')
@section('content')
    <!-- Breadcrumb Start -->
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <h2 class="text-2xl font-bold text-black">
            Daftar Laporan
        </h2>

        <nav>
            <ol class="flex items-center gap-2">
                <li>
                    <a class="font-medium" href="{{ route('dashboard.index') }}">Dashboard /</a>
                </li>
                <li class="font-medium text-red-600">Laporan</li>
            </ol>
        </nav>
    </div>
    <!-- Breadcrumb End -->

    <div class="mt-4 flex flex-col gap-10">
        <div class="rounded-sm border border-gray-300 bg-white px-5 pb-2.5 pt-6 shadow-md sm:px-7.5 xl:pb-1">
            <h2 class="text-lg font-bold text-black">
                Filter Laporan
            </h2>
            <div class="mb-4 flex flex-col sm:flex-row sm:items-center sm:justify-between">

                <form action="" method="get">
                    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:gap-6">
                        <!-- Bulan -->
                        <div class="flex flex-col gap-1.5 sm:flex-row sm:items-center sm:gap-6">
                            <label for="month" class="text-sm font-medium text-gray-700">Bulan</label>
                            <select name="month"
                                class="w-full rounded border-[1.5px] border-gray-300 bg-white px-5 py-3 font-normal text-black outline-none">
                                <option value="">-- Pilih Bulan --</option>
                                @for ($m = 1; $m <= 12; $m++)
                                    <option value="{{ $m }}" {{ request('month') == $m ? 'selected' : '' }}>
                                        {{ DateTime::createFromFormat('!m', $m)->format('F') }}
                                    </option>
                                @endfor
                            </select>
                        </div>

                        <!-- Tahun -->
                        <div class="flex flex-col gap-1.5 sm:flex-row sm:items-center sm:gap-6">
                            <label for="year" class="text-sm font-medium text-gray-700">Tahun</label>
                            <select name="year"
                                class="w-full rounded border-[1.5px] border-gray-300 bg-white px-5 py-3 font-normal text-black outline-none">
                                <option value="">-- Pilih Tahun --</option>
                                @for ($y = 2020; $y <= now()->year; $y++)
                                    <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>
                                        {{ $y }}</option>
                                @endfor
                            </select>
                        </div>

                        <button type="submit"
                            class="mt-3 sm:mt-0 w-full sm:w-auto px-3 py-2 bg-red-600 text-white rounded-md hover:bg-red-500">Filter</button>
                    </div>
                </form>

                <a
                    href="{{ route('dashboard.reports.download', ['month' => request('month'), 'year' => request('year')]) }}"
                    class="mt-3 sm:mt-0 w-full sm:w-auto px-3 py-2 bg-red-600 text-white rounded-md hover:bg-red-500">
                    Download Laporan
                </a>

            </div>
            <div class="max-w-full overflow-x-auto">
                <table class="w-full table-auto">
                    <thead>
                        <tr class="bg-gray-100 text-left">
                            <th class="min-w-[150px] px-4 py-4 font-medium text-black">
                                Tanggal
                            </th>
                            <th class="min-w-[150px] px-4 py-4 font-medium text-black">
                                Total Penjualan
                            </th>
                            <th class="min-w-[150px] px-4 py-4 font-medium text-black">
                                Total Transaksi
                            </th>
                            <th class="min-w-[150px] px-4 py-4 font-medium text-black">
                                Laba Bersih
                            </th>
                            <th class="min-w-[150px] px-4 py-4 font-medium text-black">
                                Dibuat Oleh
                            </th>
                            <th class="px-4 py-4 font-medium text-black">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($reports->isEmpty())
                            <tr>
                                <td colspan="6" class="px-4 py-4 text-center text-gray-500">
                                    Tidak ada laporan ditemukan.
                                </td>
                            </tr>
                        @else
                            @foreach ($reports as $report)
                                <tr>
                                    <td class="border-b border-gray-200 px-4 py-5">
                                        {{ \Carbon\Carbon::parse($report->date)->format('d M, Y') }}
                                    </td>
                                    <td class="border-b border-gray-200 px-4 py-5">
                                        {{ 'Rp ' . number_format($report->total_sales, 0, ',', '.') }}
                                    </td>
                                    <td class="border-b border-gray-200 px-4 py-5">
                                        {{ $report->total_transactions }}
                                    </td>
                                    <td class="border-b border-gray-200 px-4 py-5">
                                        {{ 'Rp ' . number_format($report->net_profit, 0, ',', '.') }}
                                    </td>
                                    <td class="border-b border-gray-200 px-4 py-5">
                                        {{ $report->created_by }}
                                    </td>
                                    <td class="border-b border-gray-200 px-4 py-5">
                                        <div class="flex items-center space-x-3.5">
                                            <a href="{{ route('dashboard.reports.show', ['report' => $report->id]) }}"
                                                class="hover:text-red-600">
                                                <svg class="fill-current" width="18" height="18" viewBox="0 0 18 18"
                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M8.99981 14.8219C3.43106 14.8219 0.674805 9.50624 0.562305 9.28124C0.47793 9.11249 0.47793 8.88749 0.562305 8.71874C0.674805 8.49374 3.43106 3.20624 8.99981 3.20624C14.5686 3.20624 17.3248 8.49374 17.4373 8.71874C17.5217 8.88749 17.5217 9.11249 17.4373 9.28124C17.3248 9.50624 14.5686 14.8219 8.99981 14.8219ZM1.85605 8.99999C2.4748 10.0406 4.89356 13.5562 8.99981 13.5562C13.1061 13.5562 15.5248 10.0406 16.1436 8.99999C15.5248 7.95936 13.1061 4.44374 8.99981 4.44374C4.89356 4.44374 2.4748 7.95936 1.85605 8.99999Z"
                                                        fill="" />
                                                    <path
                                                        d="M9 11.3906C7.67812 11.3906 6.60938 10.3219 6.60938 9C6.60938 7.67813 7.67812 6.60938 9 6.60938C10.3219 6.60938 11.3906 7.67813 11.3906 9C11.3906 10.3219 10.3219 11.3906 9 11.3906ZM9 7.875C8.38125 7.875 7.875 8.38125 7.875 9C7.875 9.61875 8.38125 10.125 9 10.125C9.61875 10.125 10.125 9.61875 10.125 9C10.125 8.38125 9.61875 7.875 9 7.875Z"
                                                        fill="" />
                                                </svg>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
