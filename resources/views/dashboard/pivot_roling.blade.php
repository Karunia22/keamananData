@php
    $grandTotal = [
        'tsel' => 0,
        'datin' => ['k2' => 0, 'k3' => 0],
        'indibiz' => ['reguler' => 0, 'voice' => 0, 'iptv' => 0],
        'wms' => 0,
        'sqm_b2b' => ['datin' => 0, 'indibiz' => 0, 'wms' => 0],
        'unspec_b2b' => ['indibiz' => 0, 'wms' => 0, 'datin' => 0],
    ];

    $grandTotalAll = 0;
@endphp

@foreach ($serviceAreas as $area => $stos)
    @php
        $firstRow = true;

        $totals = [
            'tsel' => 0,
            'datin' => ['k2' => 0, 'k3' => 0],
            'indibiz' => ['reguler' => 0, 'voice' => 0, 'iptv' => 0],
            'wms' => 0,
            'sqm_b2b' => ['datin' => 0, 'indibiz' => 0, 'wms' => 0],
            'unspec_b2b' => ['indibiz' => 0, 'wms' => 0, 'datin' => 0],
        ];
    @endphp

    @foreach ($stos as $sto)
        @php
            $item = $snapshotPivot[$sto] ?? [
                'tsel' => 0,
                'datin' => ['k2' => 0, 'k3' => 0],
                'indibiz' => ['reguler' => 0, 'voice' => 0, 'iptv' => 0],
                'wms' => 0,
                'sqm_b2b' => ['datin' => 0, 'indibiz' => 0, 'wms' => 0],
                'unspec_b2b' => ['indibiz' => 0, 'wms' => 0, 'datin' => 0],
            ];

            // Hitung total per area
            $totals['tsel'] += $item['tsel'] ?? 0;
            $totals['datin']['k2'] += $item['datin']['k2'] ?? 0;
            $totals['datin']['k3'] += $item['datin']['k3'] ?? 0;

            $totals['indibiz']['reguler'] += $item['indibiz']['reguler'] ?? 0;
            $totals['indibiz']['voice'] += $item['indibiz']['voice'] ?? 0;
            $totals['indibiz']['iptv'] += $item['indibiz']['iptv'] ?? 0;

            $totals['wms'] += $item['wms'] ?? 0;

            $totals['sqm_b2b']['datin'] += $item['sqm_b2b']['datin'] ?? 0;
            $totals['sqm_b2b']['indibiz'] += $item['sqm_b2b']['indibiz'] ?? 0;
            $totals['sqm_b2b']['wms'] += $item['sqm_b2b']['wms'] ?? 0;

            $totals['unspec_b2b']['indibiz'] += $item['unspec_b2b']['indibiz'] ?? 0;
            $totals['unspec_b2b']['wms'] += $item['unspec_b2b']['wms'] ?? 0;
            $totals['unspec_b2b']['datin'] += $item['unspec_b2b']['datin'] ?? 0;

            // Total per STO
            $rowTotal =
                ($item['tsel'] ?? 0) +
                ($item['datin']['k2'] ?? 0) +
                ($item['datin']['k3'] ?? 0) +
                ($item['indibiz']['reguler'] ?? 0) +
                ($item['indibiz']['voice'] ?? 0) +
                ($item['indibiz']['iptv'] ?? 0) +
                ($item['wms'] ?? 0) +
                ($item['sqm_b2b']['datin'] ?? 0) +
                ($item['sqm_b2b']['indibiz'] ?? 0) +
                ($item['sqm_b2b']['wms'] ?? 0) +
                ($item['unspec_b2b']['indibiz'] ?? 0) +
                ($item['unspec_b2b']['wms'] ?? 0) +
                ($item['unspec_b2b']['datin'] ?? 0);
        @endphp

        <tr>
            @if ($firstRow)
                <td rowspan="{{ count($stos) + 1 }}" class="area">
                    {{ $area }}
                </td>
                @php $firstRow = false; @endphp
            @endif

            <td>{{ $sto }}</td>
            <td>{{ $item['tsel'] ?? 0 }}</td>
            <td>{{ $item['datin']['k2'] ?? 0 }}</td>
            <td>{{ $item['datin']['k3'] ?? 0 }}</td>
            <td>{{ $item['indibiz']['reguler'] ?? 0 }}</td>
            <td>{{ $item['indibiz']['voice'] ?? 0 }}</td>
            <td>{{ $item['indibiz']['iptv'] ?? 0 }}</td>
            <td>{{ $item['wms'] ?? 0 }}</td>
            <td>{{ $item['sqm_b2b']['datin'] ?? 0 }}</td>
            <td>{{ $item['sqm_b2b']['indibiz'] ?? 0 }}</td>
            <td>{{ $item['sqm_b2b']['wms'] ?? 0 }}</td>
            <td>{{ $item['unspec_b2b']['indibiz'] ?? 0 }}</td>
            <td>{{ $item['unspec_b2b']['wms'] ?? 0 }}</td>
            <td>{{ $item['unspec_b2b']['datin'] ?? 0 }}</td>
            <td>{{ $rowTotal }}</td>
        </tr>
    @endforeach

    @php
        $areaTotal =
            $totals['tsel'] +
            $totals['datin']['k2'] +
            $totals['datin']['k3'] +
            $totals['indibiz']['reguler'] +
            $totals['indibiz']['voice'] +
            $totals['indibiz']['iptv'] +
            $totals['wms'] +
            $totals['sqm_b2b']['datin'] +
            $totals['sqm_b2b']['indibiz'] +
            $totals['sqm_b2b']['wms'] +
            $totals['unspec_b2b']['indibiz'] +
            $totals['unspec_b2b']['wms'] +
            $totals['unspec_b2b']['datin'];

        $grandTotalAll += $areaTotal;

        // Tambahkan ke grand total
        $grandTotal['tsel'] += $totals['tsel'];
        $grandTotal['datin']['k2'] += $totals['datin']['k2'];
        $grandTotal['datin']['k3'] += $totals['datin']['k3'];
        $grandTotal['indibiz']['reguler'] += $totals['indibiz']['reguler'];
        $grandTotal['indibiz']['voice'] += $totals['indibiz']['voice'];
        $grandTotal['indibiz']['iptv'] += $totals['indibiz']['iptv'];
        $grandTotal['wms'] += $totals['wms'];
        $grandTotal['sqm_b2b']['datin'] += $totals['sqm_b2b']['datin'];
        $grandTotal['sqm_b2b']['indibiz'] += $totals['sqm_b2b']['indibiz'];
        $grandTotal['sqm_b2b']['wms'] += $totals['sqm_b2b']['wms'];
        $grandTotal['unspec_b2b']['indibiz'] += $totals['unspec_b2b']['indibiz'];
        $grandTotal['unspec_b2b']['wms'] += $totals['unspec_b2b']['wms'];
        $grandTotal['unspec_b2b']['datin'] += $totals['unspec_b2b']['datin'];
    @endphp

    {{-- TOTAL PER AREA --}}
    <tr style="background:#f2f2f2; font-weight:bold;">
        <td>TOTAL</td>
        <td>{{ $totals['tsel'] }}</td>
        <td>{{ $totals['datin']['k2'] }}</td>
        <td>{{ $totals['datin']['k3'] }}</td>
        <td>{{ $totals['indibiz']['reguler'] }}</td>
        <td>{{ $totals['indibiz']['voice'] }}</td>
        <td>{{ $totals['indibiz']['iptv'] }}</td>
        <td>{{ $totals['wms'] }}</td>
        <td>{{ $totals['sqm_b2b']['datin'] }}</td>
        <td>{{ $totals['sqm_b2b']['indibiz'] }}</td>
        <td>{{ $totals['sqm_b2b']['wms'] }}</td>
        <td>{{ $totals['unspec_b2b']['indibiz'] }}</td>
        <td>{{ $totals['unspec_b2b']['wms'] }}</td>
        <td>{{ $totals['unspec_b2b']['datin'] }}</td>
        <td>{{ $areaTotal }}</td>
    </tr>
@endforeach

{{-- GRAND TOTAL --}}
{{-- <tr style="background:#1f3c88; color:white; font-weight:bold;">
    <td colspan="2">TOTAL</td>
    <td class="tsel">{{ $grandTotal['tsel'] }}</td>
    <td class="datin">{{ $grandTotal['datin']['k2'] }}</td>
    <td class="datin">{{ $grandTotal['datin']['k3'] }}</td>
    <td class="indibiz">{{ $grandTotal['indibiz']['reguler'] }}</td>
    <td class="indibiz">{{ $grandTotal['indibiz']['voice'] }}</td>
    <td class="indibiz">{{ $grandTotal['indibiz']['iptv'] }}</td>
    <td class="wms">{{ $grandTotal['wms'] }}</td>
    <td class="sqm">{{ $grandTotal['sqm_b2b']['datin'] }}</td>
    <td class="sqm">{{ $grandTotal['sqm_b2b']['indibiz'] }}</td>
    <td class="sqm">{{ $grandTotal['sqm_b2b']['wms'] }}</td>
    <td class="unspec">{{ $grandTotal['unspec_b2b']['indibiz'] }}</td>
    <td class="unspec">{{ $grandTotal['unspec_b2b']['wms'] }}</td>
    <td class="unspec">{{ $grandTotal['unspec_b2b']['datin'] }}</td>
    <td class="wms">{{ $grandTotalAll }}</td>
</tr> --}}
