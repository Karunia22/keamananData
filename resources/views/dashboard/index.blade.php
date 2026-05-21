{{-- index --}}
@extends('layout.master')
@section('content')
    @php
        // $layanan =
    @endphp
    <div class="monitorDua" id="rolling-content">
        @include('dashboard.index_roling')
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
        renderCharts();

        updateIndex();

        setInterval(updateIndex, 10000);
    });

        function updateIndex() {
            $.ajax({
                url: "{{ route('index') }}",
                type: 'GET',
                success: function(res) {

                    $('#rolling-content').html(res.html);

                    // set ulang data chart
                    window.dataCharts = res.charts;

                    // render ulang chart
                    renderCharts();

                    console.log('Pivot updated at: ' + new Date().toLocaleTimeString());
                },
                error: function(xhr) {
                    console.error('Error rolling data');
                }
            });
        }
    </script>
@endsection
