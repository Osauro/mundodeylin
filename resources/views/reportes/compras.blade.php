<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Compras</title>
    <style>
        @page {
            margin: 0cm 0cm;
            font-family: Arial;
        }

        body {
            margin: 3cm 2cm 2cm;
        }

        header {
            position: fixed;
            top: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2cm;
            background-color: #ECECEC;
            color: #000;
            text-align: left;
            line-height: 18px;
            font-size: 12px;
            padding: 10px;
        }

        header div{
            padding-left: 10px;
        }

        footer {
            position: fixed;
            bottom: 0cm;
            left: 0cm;
            right: 20px;
            height: 20px;
            color: #ccc;
            text-align: right;
            line-height: 10px;
        }
        table {
            border-spacing: 0px;
            border-collapse: separate;
            width: 100%;
        }
        td {
            padding: 3px;
        }

        .derecha{
            text-align: right;

        }
    </style>
</head>
<body>
    <header>
        <div>{{ env('APP_NAME') }}</div>
        <div><strong>Dirección: </strong>Aqui viene la dirección</div>
        <div><strong>Teléfono: </strong>73010688</div>
        <div><strong>Fecha: </strong>{{ date('d-m-Y - H:i:s') }}</div>
    </header>
    <main>
        <h1 align="center">Reporte de compra</h1>
        <table border="1">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th width="65">Cantidad</th>
                    <th width="65">Medida</th>
                    <th width="65">Precio/U</th>
                    <th width="65">Precio/T</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($compra->items as $item)
                    <tr>
                        <td>{{ $item->producto->nombre }}</td>
                        <td class="derecha">{{ $item->cantidad }}</td>
                        <td class="derecha">{{ $item->producto->unidad_medida }}</td>
                        <td class="derecha">{{ $item->precio_unitario }}</td>
                        <td class="derecha">{{ $item->precio_total }}</td>
                    </tr>
                @endforeach
                <tr style="border: 0px;">
                    <td style="border: 0px;"></td>
                    <td style="border: 0px;"></td>
                    <td style="border: 0px;"></td>
                    <td class="derecha"><strong>TOTAL:</strong></td>
                    <td class="derecha">{{ number_format($compra->items->sum('precio_total'), 2, ',', '') }}</td>
                </tr>
            </tbody>
        </table>

    </main>
    <footer>
        www.dieguitosoft.com
    </footer>
    <script type="text/php">
        if ( isset($pdf) ) {
            $pdf->page_script('
                $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
                $pdf->text(270, 760, "Pagina $PAGE_NUM de $PAGE_COUNT", $font, 10);
            ');
        }
    </script>
</body>
</html>
