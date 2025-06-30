<html>
    <body>
        <h1>Form Barang</h1>
        <form action="{{$action}}" method="post">
            @csrf
            <div>
                <label for="barcode">Barcode</label>
                <input type="text" name='barcode' value="{{$item -> barcode}}">
            </div>
            <div>
                <label for="Nama">Nama Barang : </label>
                <input type="text" name='nama' value="{{$item -> name}}">
            </div>
            <div>
                <label for="Satuan">Satuan</label>
                <input type="text" name='satuan' value="{{$item -> satuan}}">
            </div>
            <div class="">
                <input type="submit" value="simpan">
            </div>
        </form>
    </body>
</html>