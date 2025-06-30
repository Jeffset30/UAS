<html>
    <body>
            <h1>Barang</h1>
            <div>
                <a href="{{ route('barang.create') }}">Tambah Barang Baru</a>
            </div>
            <div> 
                <form method="get" action="{{ route('barang.index') }}">
                    <input type="text" name="q" placeholder="Cari Barang" />
                    <input type="submit" value="Filter" />
                </form>
            <table>
                <tr>
                    <td>Name</td>
                    <td>Barcode</td>
                    <td>Satuan</td>
                </tr>
            @foreach ($items as $item)
            <tr>
                <td>{{ $item->name }}</td>
                <td>{{ $item->barcode }}</td>
                <td>{{ $item->satuan }}</td>
                <td>
                <a href="{{ route ('barang.show', $item->id) }}">Show</a>
                </td>
            </tr>                
            @endforeach
            <tr>
                <td colspan="4">{{ $items->links() }}</td>
            </tr>
        </table>
    </body>
</html>