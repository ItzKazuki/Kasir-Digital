@extends('layouts.dashboard')
@section('content')
    <!-- Breadcrumb Start -->
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <h2 class="text-2xl font-bold text-black">
            Laporan: {{ $report->date }}
        </h2>

        <nav>
            <ol class="flex items-center gap-2">
                <li>
                    <a class="font-medium" href="{{ route('dashboard.index') }}">Dashboard /</a>
                </li>
                <li>
                    <a href="{{ route('dashboard.reports.index') }}" class="font-medium">Laporan /</a>
                </li>
                <li class="font-medium text-red-600">{{ $report->date }}</li>
            </ol>
        </nav>
    </div>
    <!-- Breadcrumb End -->

    <!-- ====== Report Details Section Start -->
    <div class="grid grid-cols-1 gap-9 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
        <div class="flex flex-col gap-9 col-span-2">
            <!-- Report Summary -->
            <div class="rounded-sm border border-gray-300 bg-white shadow-default">
                <div class="border-b border-gray-300 px-6 py-4 flex justify-between">
                    <h3 class="font-medium text-black">
                        Ringkasan Laporan
                    </h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <h3 class="font-bold text-md py-2">Total Penjualan</h3>
                            <p>Rp. {{ number_format($report->total_sales, 0, ',', '.') }}</p>
                        </div>
                        <div>
                            <h3 class="font-bold text-md py-2">Total Transaksi</h3>
                            <p>{{ $report->total_transactions }}</p>
                        </div>
                        <div>
                            <h3 class="font-bold text-md py-2">Penjualan Tunai</h3>
                            <p>Rp. {{ number_format($report->cash_sales, 0, ',', '.') }}</p>
                        </div>
                        <div>
                            <h3 class="font-bold text-md py-2">Penjualan Non-Tunai</h3>
                            <p>Rp. {{ number_format($report->other_sales, 0, ',', '.') }}</p>
                        </div>
                        <div>
                            <h3 class="font-bold text-md py-2">Keuntungan Kotor</h3>
                            <p>Rp. {{ number_format($report->total_profit, 0, ',', '.') }}</p>
                        </div>
                        <div>
                            <h3 class="font-bold text-md py-2">Laba Bersih</h3>
                            <p>Rp. {{ number_format($report->net_profit, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Cash Details -->
            <div class="rounded-sm border border-gray-300 bg-white shadow-default">
                <div class="border-b border-gray-300 px-6 py-4 flex justify-between">
                    <h3 class="font-medium text-black">
                        Detail Kas
                    </h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <h3 class="font-bold text-md py-2">Kas Awal</h3>
                            <p>Rp. {{ number_format($report->cash_before, 0, ',', '.') }}</p>
                        </div>
                        <div>
                            <h3 class="font-bold text-md py-2">Kas Akhir</h3>
                            <p>Rp. {{ number_format($report->cash_after, 0, ',', '.') }}</p>
                        </div>
                        <div>
                            <h3 class="font-bold text-md py-2">Selisih Kas</h3>
                            <p class="{{ $report->cash_difference < 0 ? 'text-red-600' : 'text-green-600' }}">
                                Rp. {{ number_format($report->cash_difference, 0, ',', '.') }}
                            </p>
                        </div>
                        <div>
                            <h3 class="font-bold text-md py-2">Pengeluaran</h3>
                            <p>Rp. {{ number_format($report->expenses, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Notes -->
            <div class="rounded-sm border border-gray-300 bg-white shadow-default">
                <div class="border-b border-gray-300 px-6 py-4 flex justify-between">
                    <h3 class="font-medium text-black">
                        Catatan
                    </h3>
                </div>
                <div class="p-6">
                    <p>{{ $report->notes ?: 'Tidak ada catatan tambahan.' }}</p>
                </div>
            </div>
        </div>

        <div class="flex flex-col gap-9">
            <!-- Report Metadata -->
            <div class="rounded-sm border border-gray-300 bg-white shadow-default">
                <div class="border-b border-gray-300 px-6 py-4 flex justify-between">
                    <h3 class="font-medium text-black">
                        Informasi Laporan
                    </h3>
                </div>
                <div class="p-6">
                    <div class="flex flex-col gap-4">
                        <div>
                            <h3 class="font-bold text-md py-2">Tanggal Laporan</h3>
                            <p>{{ \Carbon\Carbon::parse($report->date)->format('d M, Y') }}</p>
                        </div>
                        <div>
                            <h3 class="font-bold text-md py-2">Dibuat Oleh</h3>
                            <p>{{ $report->created_by }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ====== Report Details Section End -->
@endsection
