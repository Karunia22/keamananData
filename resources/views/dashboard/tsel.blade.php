@extends('layout.master')

@section('content')
    <table class="pivot">
        <thead>
            <tr>
                <th>NO</th>
                <th>T_G_L</th>
                <th>STO</th>
                <th>NOTIK</th>
                <th>JENIS GANGGUAN</th>
                <th>TGT TTR</th>
                <th>TTR BERJALAN</th>
                <th>SUMMARY</th>
                <th>TGL OPEN</th>
                <th>TEKNISI</th>
                <th>STATUS</th>
                <th>KENDALA</th>
                <th>LAYANAN_FO</th>
            </tr>
        </thead>
        <tbody id="rolling-content">
            {{-- Data awal di-load di sini --}}
            @include('dashboard.tsel_roling')
        </tbody>
    </table>

    <script>
        function updateTsel() {
            $.ajax({
                url: "{{ route('tsel') }}",
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
        setInterval(updateTsel, 5000);
    </script>
@endsection
