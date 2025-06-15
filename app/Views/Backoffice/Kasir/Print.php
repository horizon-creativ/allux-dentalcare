<?php
function penyebut($nilai)
{
    $nilai = abs($nilai);
    $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
    $temp = "";
    if ($nilai < 12) {
        $temp = " " . $huruf[$nilai];
    } else if ($nilai < 20) {
        $temp = penyebut($nilai - 10) . " belas";
    } else if ($nilai < 100) {
        $temp = penyebut($nilai / 10) . " puluh" . penyebut($nilai % 10);
    } else if ($nilai < 200) {
        $temp = " seratus" . penyebut($nilai - 100);
    } else if ($nilai < 1000) {
        $temp = penyebut($nilai / 100) . " ratus" . penyebut($nilai % 100);
    } else if ($nilai < 2000) {
        $temp = " seribu" . penyebut($nilai - 1000);
    } else if ($nilai < 1000000) {
        $temp = penyebut($nilai / 1000) . " ribu" . penyebut($nilai % 1000);
    } else if ($nilai < 1000000000) {
        $temp = penyebut($nilai / 1000000) . " juta" . penyebut($nilai % 1000000);
    } else if ($nilai < 1000000000000) {
        $temp = penyebut($nilai / 1000000000) . " milyar" . penyebut(fmod($nilai, 1000000000));
    } else if ($nilai < 1000000000000000) {
        $temp = penyebut($nilai / 1000000000000) . " trilyun" . penyebut(fmod($nilai, 1000000000000));
    }
    return $temp;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk#<?= $invoice['no_invoice'] ?></title>
</head>

<body>
    <style>
        body {
            font-family: "Lucida Console", "Courier New", monospace;
            font-size: 10px;
            padding: 0 0 0 0;
        }

        .border {
            border: 1px solid black;
            border-collapse: collapse;
        }

        .border-r {
            border-right: 1px solid black;
            border-collapse: collapse;
        }

        .border-l {
            border-left: 1px solid black;
            border-collapse: collapse;
        }

        .border-t {
            border-top: 1px solid black;
            border-collapse: collapse;
        }

        .border-b {
            border-bottom: 1px solid black;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            padding: 5px;
        }

        table {
            width: 100%;
        }

        .column {
            float: left;
            width: 50%;
        }

        /* Clear floats after the columns */
        .row:after {
            content: "";
            display: table;
            clear: both;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .text-left {
            text-align: left;
        }

        .text-top {
            vertical-align: top;
        }

        .text-bot {
            vertical-align: bottom;
        }

        .page {
            height: 50%;
        }

        .skinny {
            margin: 0 0 0 0;
            padding: 0 0 0 0;
        }

        .logo {
            -webkit-filter: grayscale(100%);
            /* Safari 6.0 - 9.0 */
            filter: grayscale(100%);
        }
    </style>
    <!-- ORIGINAL -->
    <div class="page">
        <table>
            <tr>
                <th>
                    <img src="<?= FCPATH . 'img/logo.png' ?>" alt="" width="50" class="logo">
                </th>
            </tr>
            <tr>
                <td class="text-center">Jl. Mayjend Panjaitan No.135 <br> Kec. Klojen, Kota Malang</td>
            </tr>
            <tr>
                <td class="text-center">0882-3184-0001</td>
            </tr>
        </table>

        <table>
            <tr>
                <td class="text-left">Struk: <?= $invoice['no_invoice'] ?></td>
                <td class="text-right"><?= date("d/m/Y H:i", strtotime($payment['created_at'])) ?></td>
            </tr>
            <tr>
                <td class="text-left">Kasir: <?= session('name_user') ?></td>
                <td class="text-right">Pasien: <?= $invoice['name_pasien'] ?></td>
            </tr>
        </table>
        <hr>
        <hr>
        <table>
            <tr>
                <th class="text-center" colspan="2">Layanan</th>
            </tr>
            <?php foreach ($invoiceItems as $invoiceItem): ?>
                <?php if ($invoiceItem['type_item'] == 'Layanan'): ?>
                    <tr>
                        <td class="text-left">
                            <?= $invoiceItem['name_item'] ?>
                            <br>
                            <?= "x" . $invoiceItem['qty_item'] . " @ " . number_format($invoiceItem['price_item'], 0, ',', '.') ?>
                        </td>
                        <td class="text-right">
                            <?= number_format($invoiceItem['total_item'], 0, ',', '.') ?>
                        </td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>
        </table>
        <table>
            <tr>
                <th class="text-center" colspan="2">Obat</th>
            </tr>
            <?php foreach ($invoiceItems as $invoiceItem): ?>
                <?php if ($invoiceItem['type_item'] == 'Obat'): ?>
                    <tr>
                        <td class="text-left">
                            <?= $invoiceItem['name_item'] ?>
                            <br>
                            <?= "x" . $invoiceItem['qty_item'] . " @ " . number_format($invoiceItem['price_item'], 0, ',', '.') ?>
                        </td>
                        <td class="text-right">
                            <?= number_format($invoiceItem['total_item'], 0, ',', '.') ?>
                        </td>
                    </tr>
                    <tr>
                        <th class="text-right" colspan="2">* <?= $invoiceItem['desc_item'] ?></th>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>
        </table>
        <hr>
        <table>
            <tr>
                <th class="text-left">Total</th>
                <th class="text-right"><?= number_format($invoice['total_invoice'], 0, ',', '.') ?></th>
            </tr>
            <tr>
                <th></th>
                <th></th>
            </tr>
            <tr>
                <th></th>
                <th></th>
            </tr>
            <tr>
                <td class="text-left">Bayar</td>
                <td class="text-right">(<?= $payment['type_payment'] ?>) <?= number_format($payment['amount_payment'], 0, ',', '.') ?></td>
            </tr>
            <tr>
                <td class="text-left">Kembali</td>
                <td class="text-right"><?= number_format($payment['change_payment'], 0, ',', '.') ?></td>
            </tr>
        </table>
    </div>

    <!-- <hr style="margin-top: 0px; margin-bottom: 0px;"> -->
</body>

</html>