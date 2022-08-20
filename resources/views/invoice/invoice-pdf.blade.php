<!DOCTYPE html
    PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='https://www.w3.org/1999/xhtml'>

<head>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />

<body style='font-family:Tahoma;font-size:12px;color: #333333;background-color:#FFFFFF;'>
    <table align='center' border='0' cellpadding='0' cellspacing='0' style='height:842px; width:595px;font-size:12px;'>
        <tr>
            <td valign='top'>
                <table width='100%' cellspacing='0' cellpadding='0'>
                    <tr>
                        <td valign='bottom' width='50%' height='50'>
                            <div align='left'>
                                <h1>Fatura No: <span>{{ $data['no'] }}</span></h1>
                                    {{-- <div style="width: 30%" class="">
                                        <img style="width: 100%"
                                            src='{{ $data['shop_logo'] }}' />
                                    </div> --}}
                            </div><br />
                        </td>

                        <td width='50%'>&nbsp;</td>
                    </tr>
                </table>
                <table width='100%' cellspacing='0' cellpadding='0'>
                    <tr>
                        <td valign='top' width='35%' style='font-size:12px;'>
                            <strong>{{ $data['customer_name'] }}</strong><br />
                            {{ $data['customer_address'] }}<br />
                            {{ $data['customer_phone'] }}<br />

                        </td>
                        <td valign='top' width='35%'>
                        </td>
                        <td valign='top' width='30%' style='font-size:12px;'>Fatura Tarihi:
                            {{ $data['invoice_date'] }}<br />
                            Bugünün Tarihi: {{ $data['today_date'] }}<br />


                        </td>

                    </tr>
                </table>
                <table width='100%' height='100' cellspacing='0' cellpadding='0'>
                    <tr>
                        <td>
                            <div align='center' style='font-size: 14px;font-weight: bold;'>Fatura Detayı</div>
                        </td>
                    </tr>
                </table>
                <table width='100%' cellspacing='0' cellpadding='2' border='1' bordercolor='#CCCCCC'>
                    <tr>

                        <td width='35%' bordercolor='#ccc' bgcolor='#f2f2f2' style='font-size:12px;'><strong>Ürün
                            </strong></td>
                        <td width='35%' bordercolor='#ccc' bgcolor='#f2f2f2' style='font-size:12px;'><strong>Kod
                            </strong></td>
                        <td bordercolor='#ccc' bgcolor='#f2f2f2' style='font-size:12px;'><strong>Adet</strong></td>
                        <td bordercolor='#ccc' bgcolor='#f2f2f2' style='font-size:12px;'><strong>Fiyat</strong>
                        </td>
                        <td bordercolor='#ccc' bgcolor='#f2f2f2' style='font-size:12px;'><strong>Toplam</strong></td>

                    </tr>
                    <tr style="display:none;">
                        <td colspan="*">
                            @foreach ($data['invoice_detail'] as $item)
                            <tr>
                                <td valign='top' style='font-size:12px;'>{{$item->getProduct->name}}</td>
                                <td valign='top' style='font-size:12px;'>{{$item->getProduct->code}}</td>
                                <td valign='top' style='font-size:12px;'>{{$item->qty}} </td>
                                <td valign='top' style='font-size:12px;'>{{$item->price}} {{$data["money"]}}</td>
                                <td valign='top' style='font-size:12px;'>{{$item->qty *$item->price}} {{$data["money"]}}  </td>
                            </tr>
                    @endforeach
            </td>
        </tr>
    </table>
    <table width='100%' cellspacing='0' cellpadding='2' border='0'>
        <tr>
            <td style='font-size:12px;width:50%;'><strong></strong>
            </td>
            <td>
                <table width='100%' cellspacing='0' cellpadding='2' border='0'>
                    <tr>

                    </tr>
                    <tr>

                    </tr>
                    <tr>

                        <td align='right' style='font-size:12px;'><b>Toplam:</b></td>
                        <td align='right' style='font-size:12px;'><b>{{$data["invoice_total"]}} {{$data["money"]}}</b></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <table width='100%' height='50'>
        <tr>
            <td style='font-size:12px;text-align:justify;'></td>
        </tr>
    </table>
    <table width='100%' cellspacing='0' cellpadding='2'>
        <tr>
            <td width='33%' style='border-top:double medium #CCCCCC;font-size:12px;' valign='top'>
                <b>{{ $data['shop_name'] }}</b><br />


            </td>
            <td width='33%' style='border-top:double medium #CCCCCC; font-size:12px;' align='center' valign='top'>
                {{ $data['shop_address'] }}<br />
                {{ $data['shop_phone'] }}<br />
            </td>

        </tr>
    </table>
    </td>
    </tr>
    </table>
</body>

</html>
