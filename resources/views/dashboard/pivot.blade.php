@extends('layout.master')

@section('content')
    <div class="pivot-container">

        <div class="pivot-header">
            <h2>Report B2B</h2>
            <div class="pivot-date">
                {{ now()->format('d F Y') }}
            </div>
        </div>

        <div class="pivot-card">

            <div class="table-wrapper">
                <table class="pivot-table">

                    <thead>
                        <tr class="main-header">
                            <th rowspan="2">SERVICE AREA</th>
                            <th rowspan="2">STO</th>
                            <th rowspan="2" class="tsel">TSEL</th>

                            <th colspan="2" class="datin">DATIN</th>
                            <th colspan="3" class="indibiz">INDIBIZ</th>
                            <th rowspan="2" class="wms">WMS</th>
                            <th colspan="3" class="sqm">SQM B2B</th>
                            <th colspan="3" class="unspec">UNSPEC B2B</th>
                            <th rowspan="2" class="wms">Total</th>
                        </tr>

                        <tr class="sub-header">
                            <th class="datin" style="color:white">K2</th>
                            <th class="datin" style="color:white">K3</th>

                            <th class="indibiz" style="color:white">REGULER</th>
                            <th class="indibiz" style="color:white">VOICE</th>
                            <th class="indibiz" style="color:white">IPTV</th>

                            <th class="sqm" style="color:white">DATIN</th>
                            <th class="sqm" style="color:white">INDIBIZ</th>
                            <th class="sqm" style="color:white">WMS</th>

                            <th class="unspec" style="color:white">INDIBIZ</th>
                            <th class="unspec" style="color:white">WMS</th>
                            <th class="unspec" style="color:white">DATIN</th>
                        </tr>
                    </thead>

                    <tbody id="rolling-content">
                        @include('dashboard.pivot_roling')
                    </tbody>
                    <tfoot id="rolling-footer">
                        {{-- GRAND TOTAL --}}
                        @include('dashboard.pivot_footer_roling')
                    </tfoot>
                </table>
                <script>
                    function updatePivot() {
                        $.ajax({
                            url: "{{ route('pivot') }}",
                            type: 'GET',
                            success: function(res) {
                                $('#rolling-content').html(res.body);
                                $('#rolling-footer').html(res.footer);
                            }, // <-- koma penting!
                            error: function(xhr) {
                                console.error('Error rolling data');
                            }
                        });
                    }

                    // Jalankan setiap 5 detik
                    setInterval(updatePivot, 5000);
                </script>

            </div>
        </div>
    </div>
@endsection
