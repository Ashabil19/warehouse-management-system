@extends('layouts.sidebar')

@section('title', 'Stock Barang')

@section('content')
<h1 style="color: #5B3E99; font-weight: bold; text-align: center;">STOCK BARANG</h1>
<a href="{{ route('stock.export') }}" 
   style="display: inline-block; margin-bottom: 20px; padding: 10px 20px; background-color: #5B3E99; color: #FFF; text-decoration: none; border-radius: 5px; font-weight: bold;">
   Export to Excel
</a>

<div style="height: 85%; overflow-y: auto;"> <!-- Add this div wrapper -->
    <table id="stockTable" style="width: 100%; margin-top: 20px; border-collapse: collapse;">
        <thead>
            <tr>
                <th style="text-align: left; padding: 8px; color: #5B3E99;">NO</th>
                <th style="text-align: left; padding: 8px; color: #5B3E99;">Nama Barang</th>
                <th style="text-align: right; padding: 8px; color: #5B3E99; cursor: pointer;" onclick="sortTable(2)">Jumlah <span style="font-size: 12px;">&#9660;</span></th> <!-- Add arrow icon -->
                <th style="text-align: right; padding: 8px; color: #5B3E99; cursor: pointer;" onclick="sortTable(3)">Status <span style="font-size: 12px;">&#9660;</span></th> <!-- Add arrow icon -->
            </tr>
        </thead>
        <tbody>
            @foreach ($stocks as $index => $stock)
            <tr style="background-color: {{ $index % 2 == 0 ? '#F3F3F3' : '#FFFFFF' }};">
                <td style="padding: 8px; width: 50px;">{{ $index + 1 }}.</td>
                <td style="padding: 8px;">
                    <p style="font-weight: bold;"> {{ $stock->barangmasuk->kode_barang }} | {{ $stock->barangmasuk->nama_barang }}</p>
                    <a href="#" style="display: inline-block; padding: 5px 15px; background-color: #E0E0F8; color: #5B3E99; border: 1px solid #5B3E99; border-radius: 5px; font-weight: bold; text-decoration: none;">
                        Stok Barang
                    </a>
                </td>
                <td style="padding: 8px; text-align: right; font-weight: bold; font-size: 18px;">{{ $stock->jumlah }}</td>
                <td style="padding: 8px; text-align: right; font-weight: bold; font-size: 18px; color: {{ $stock->status == 'dikirim' ? 'green' : 'inherit' }};">
                    {{ $stock->status }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div> <!-- End of div wrapper -->

<script>
function sortTable(columnIndex) {
    const table = document.getElementById("stockTable");
    const tbody = table.getElementsByTagName("tbody")[0];
    const rows = Array.from(tbody.getElementsByTagName("tr"));
    const isNumericColumn = columnIndex === 2; // Assuming column 2 is "Jumlah"

    rows.sort((a, b) => {
        const cellA = a.getElementsByTagName("td")[columnIndex].innerText;
        const cellB = b.getElementsByTagName("td")[columnIndex].innerText;

        if (isNumericColumn) {
            return parseFloat(cellA) - parseFloat(cellB);
        } else {
            return cellA.localeCompare(cellB);
        }
    });

    // Append sorted rows back to the tbody
    rows.forEach(row => tbody.appendChild(row));
}
</script>

@endsection