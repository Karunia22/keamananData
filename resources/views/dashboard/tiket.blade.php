@extends('layout.master')

@section('content')
    <table class="pivot">
        <thead>
            <tr>
                <th colspan="17">SALDO GANGGUAN B2B SA PALOPO : PLP,BLP</th>
            </tr>
            <tr>
                <th>NO</th>
                <th>TGL</th>
                <th>STO</th>
                <th>STATUS</th>
                <th>LAYANAN</th>
                <th>TANGGAL OPEN</th>
                <th>NOMOR TIKET</th>
                <th>ALOKASI TTR</th>
                <th>SISA TTR</th>
                <th>NAMA CUSTOMER</th>
                <th>SID</th>
                <th>ALPRO</th>
                <th>PIC</th>
                <th>CEK GAUL</th>
                <th>UPDATE LAPANGAN</th>
                <th>PETUGAS</th>
                <th>SA</th>
            </tr>
        </thead>
        <tbody id="rolling-content">
            {{-- Data awal di-load di sini --}}
            @include('dashboard.tiket_roling')
        </tbody>
    </table>
    <div class="table-wrapper">

    </div>
    <script>
        function updatePivot() {
            $.ajax({
                url: "{{ route('tiket') }}",
                type: 'GET',
                success: function(response) {
                    // Update isi tbody saja
                    $('#rolling-content').html(response);
                    console.log('Pivot updated at: ' + new Date().toLocaleTimeString());
                },
                error: function(xhr) {
                    console.error('Error rolling data');
                }
            });
        }

        // Jalankan setiap 5 detik
        setInterval(updatePivot, 5000);
    </script>
@endsection
