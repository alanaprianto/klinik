<html>
<head>
    <title>KTA PRINT</title>
    <link media="print" rel="Alternate" href="print.pdf">
    <style>
        body {
            text-align: center;
            font-family: arial;
            font-size: 11px;
        }

        .rs-border {
            position: absolute;
            border-style: solid;
            border-width: 1px;
            text-align: center;
            font-family: arial;
            font-size: 11px;
        }

        .col-centered {
            float: none;
            margin: 0 auto;
        }

        .test {
            height: 4cm;
            width: 3cm;
            border-style: solid;
            border-width: 3px;
            margin-left: auto;
            margin-right: auto;
        }

        .center-in-parent {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translateX(-50%) translateY(-50%);
        }

        @media print {
            @page {
                size: A4;
                margin: 5px 5px 5px 5px;
            }
        }
    </style>
</head>
<body onload="window.print()">
<div class="rs-border">
    <!-- header -->
    <div >
        <div style="text-align: center; margin-left:200px; margin-top: 20px;">
            <table>
                <tr valign="middle">
                    <td><img src="{{asset('asdfasdfad')}}"></td>
                    <td style="text-align: center; line-height: 25px">
                        <b style="font-size:19px;">{{$patient->hospital->name}}</b><br>
                        <i style="font-size:17px;">Tambahan Moto Rumah Sakit bla bla bla</i><br>
                        <b style="font-size:10px;">{{$patient->hospital->address}}</b>
                    </td>
                </tr>
            </table>
        </div >
        <!-- end of header -->
        <br/><br/>

        <div style="padding: 10px 30px; text-align: center  ">
            <table width="100%">
                <tr valign="middle">
                    <td width="10%">
                        <b style="font-size:15px;">No.Rm</b><br>
                    </td>
                    <td width="1%">:</td>
                    <td style="font-size:14px; width: 10%">{{$patient->number_medical_record}}</td>
                    <td width="79%" style="text-align: right">
                        <b style="font-size:15px;">{{$now}}</b><br>
                    </td>
                </tr>
            </table>
        </div>
        <div style="padding: 10px 30px; text-align: center  ">
            <table width="100%">
                <tr>
                    <td colspan="4" style="text-align: center">
                        <h3>KETERANGAN DOKTER</h3>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        Yang bertanda tangan di bawah ini kami Dokter <b>{{$patient->hospital->name}}</b> menerangkan bahwa :
                    </td>
                </tr>
            </table>
        </div>
        <!-- content -->
        <div style="padding: 10px 100px; text-align: center  ">
            <table width="100%">
                <tr valign="middle">
                    <td width="">
                        <b style="font-size:15px;">Nama</b><br>
                    </td>
                    <td width="">:</td>
                    <td style="font-size:14px;">{{$patient->full_name}}</td>
                </tr>
                <tr>
                    <td>
                        <b style="font-size:15px;">Umur</b><br>
                    </td>
                    <td>:</td>
                    <td style="font-size:14px;">{{$patient->age}} Tahun</td>
                </tr>
                <tr>
                    <td>
                        <b style="font-size:15px;">Pekerjaan</b><br>
                    </td>
                    <td>:</td>
                    <td style="font-size:14px;">{{$patient->job}}</td>
                </tr>
                <tr>
                    <td>
                        <b style="font-size:15px;">Alamat</b><br>
                    </td>
                    <td>:</td>
                    <td style="font-size:14px;">{{$patient->address}}</td>
                </tr>
            </table>
        </div>
        <div style="padding: 10px 30px; text-align: center  ">
            <table width="100%">
                <tr>
                    <td colspan="4">
                        Oleh karena S A K I T, perlu diberikan I S T I R A H A T
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        selama <b>{{$sum_day != 0 ? $sum_day : 1}}</b> hari terhitung mulai tanggal <b>{{$query['from']}}</b> s.d <b>{{$query['until']}}</b>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        Demikian surat keterangan ini dibuat dengan sebenarnya dan untuk dipergunakan semestinya.
                    </td>
                </tr>
            </table>
            <table width="100%" style="margin-top: 30px; text-align: right">
                <tr>
                    <td>Bandung, 2017</td>
                </tr>
                <tr>
                    <td>Nama Jelas</td>
                </tr>
            </table>
            <table width="100%" style="margin-top: 100px; text-align: right">
                <tr>
                    <td><b>Nama Dokter Here</b></td>
                </tr>
                <tr>
                    <td><b>Dr. {{$doctor->full_name}}</b></td>
                </tr>
            </table>
        </div>
    </div>
</div>
</body>
</html>