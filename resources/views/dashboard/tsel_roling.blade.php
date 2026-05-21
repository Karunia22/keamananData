    @forelse ($snapshot as $index => $row)
        <tr>
            <td>{{ $row['2'] ?? '-' }}</td>
            <td>{{ $row['T_G_L'] ?? '-' }}</td>
            <td>{{ $row['STO'] ?? '-' }}</td>
            <td>{{ $row['NOTIK'] ?? '-' }}</td>
            <td>{{ $row['JENIS_GGN'] ?? '-' }}</td>
            <td>{{ $row['TGT_TTR'] ?? '-' }}</td>
            <td>{{ $row['TTR_BERJALAN'] ?? '-' }}</td>
            <td> {{ $row['SUMMARY'] ?? '-' }} </td>
            <td>{{ $row['TGL_OPEN'] ?? '-' }}</td>
            <td>{{ $row['TEKNISI'] ?? '-' }}</td>
            <td>{{ $row['STATUS'] ?? '-' }}</td>
            <td>{{ $row['KENDALA'] ?? '-' }}</td>
            <td>{{ $row['LAYANAN_FO'] ?? '-' }}</td>
        </tr>
    @empty
        <tr>
            <td colspan="14" style="text-align: center">Menunggu data...</td>
        </tr>
    @endforelse
