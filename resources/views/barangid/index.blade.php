<html>
    <body>
        <h1>Detail Barang</h1>

        <table>
            <tr>
                <td>Nama</td>
                <td>Barcode</td>
                <td>Satuan</td>
            </tr>
            <tr>
                <td>{{$item->name}}</td>
                <td>{{$item->barcode}}</td>
                <td>{{$item->satuan}}</td>
            </tr>   
        </table>
        <button onclick="kehalamanedit()">edit</button>
        <button onclick="Konfirmasihapus();">delete</button>
        <script>
            function Konfirmasihapus(){
                const konfirmasi = confirm("yakin mau hapus data barang ?")
                if (konfirmasi){
                    window.location = "{{route('barang.destroy',$item->id)}}";
            }}

            function kehalamanedit(){
                window.location = "{{route('barang.edit',$item->id)}}";
            }
        </script>
    </body>
</html>