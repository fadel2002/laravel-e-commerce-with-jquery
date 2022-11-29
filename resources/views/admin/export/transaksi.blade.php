<table>
    <thead>
        <tr>
            <th style="font-weight: bold; text-align: center;">ID Barang</th>
            <th style="font-weight: bold; text-align: center;">Nama Barang</th>
            <th style="font-weight: bold; text-align: center;">Kategori Barang </th>
            <th style="font-weight: bold; text-align: center;">Barang Terjual </th>
            <th style="font-weight: bold; text-align: center;">Pemasukan Barang Terjual </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data['barang'] as $item)
        @if ($data['hasil']['barang_terjual'][$item->id_barang] > 0 &&
        $data['hasil']['harga_barang_terjual'][$item->id_barang] > 0)
        <tr>
            <td style="text-align: center;">{{$item->id_barang}}</td>
            <td style="text-align: center;">{{$item->nama_barang}}</td>
            <td style="text-align: center;">{{$item->nama_kategori}}</td>
            <td style="text-align: center;">{{$data['hasil']['barang_terjual'][$item->id_barang]}}</td>
            <td style="text-align: center;">{{$data['hasil']['harga_barang_terjual'][$item->id_barang]}}</td>
        </tr>
        @endif
        @endforeach
        <tr>
            <td style="font-weight: bold; text-align: center;">Interval Waktu</td>
            <td style="font-weight: bold; text-align: center;">{{$data['hasil']['start']}}</td>
            <td style="font-weight: bold; text-align: center;">{{$data['hasil']['end']}}</td>
            <td style="font-weight: bold; text-align: center;">{{$data['hasil']['total_item_terjual']}}</td>
            <td style="font-weight: bold; text-align: center;">{{$data['hasil']['total_pemasukan']}}</td>
        </tr>
    </tbody>
</table>