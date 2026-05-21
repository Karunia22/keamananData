@if (isset($snapshot) && is_iterable($snapshot))
    @php
        $no = 1;
    @endphp
    @forelse ($snapshot as $index => $row)
        <tr>
            <td>{{ $no }}</td>
            <td>{{ $row['TGL'] ?? '-' }}</td>
            <td>{{ $row['STO'] ?? '-' }}</td>
            <td>{{ $row['STATUS'] ?? '-' }}</td>
            <td>{{ $row['LAYANAN'] ?? '-' }}</td>
            <td>{{ $row['TANGGAL OPEN'] ?? '-' }}</td>
            <td>{{ $row['NOMOR TIKET'] ?? '-' }}</td>
            <td>{{ $row['ALOKASI TTR'] ?? '-' }}</td>
            <td>{{ $row['SISA TTR'] ?? '-' }}</td>
            <td>{{ $row['NAMA CUSTOMER'] ?? '-' }}</td>
            <td>{{ $row['SID'] ?? '-' }}</td>
            <td>{{ $row['ALPRO'] ?? '-' }}</td>
            <td>{{ $row['PIC'] ?? '-' }}</td>
            <td>{{ $row['CEK GAUL'] ?? '-' }}</td>
            <td>{{ $row['UPDATE Lapngan'] ?? '-' }}</td>
            <td>{{ $row['PETUGAS'] ?? '-' }}</td>
            <td>{{ $row['SA'] ?? '-' }}</td>
        </tr>
        @php
            $no += 1;
        @endphp
    @empty
        <tr>
            <td colspan="14" style="text-align: center">Menunggu data...</td>
        </tr>
    @endforelse
@else
    <tr>
        <td colspan="17" style="text-align:center">
            Menunggu data...
        </td>
    </tr>
@endif
