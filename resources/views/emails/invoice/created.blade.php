
@extends('emails.layout')
@section('content')
    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
        <tr>
            <td align="center" bgcolor="#1976D2" style="padding: 40px 0 30px 0;">
                <span style="color: #FFFFFF; font-size: larger;">Your {{ $transaction->invoicing_month }} Invoice</span>
            </td>
        </tr>
        <tr>
            <td style="padding: 40px 30px 40px 30px;">
                <table border="1" style="border-collapse: collapse;" width="100%">
                    <tr>
                        <th style="padding:15px; border: 1px solid #000000; font-size: larger">Expense</th>
                        <th style="padding:15px; border: 1px solid #000000; font-size: larger">Amount</th>
                    </tr>
                    @foreach($transaction->lineItems as $lineItem)
                        <tr>
                            <td style="padding:15px 30px; border: 1px solid #000000; font-size: larger">{{ $lineItem->account_name }}</td>
                            <td style="padding:15px; border: 1px solid #000000; font-size: larger">${{ $lineItem->amount }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td bgcolor="#D32F2F" style="padding:15px 30px; border: 1px solid #000000; font-size: larger; color: #FFFFFF; ">Total</td>
                        <td bgcolor="#D32F2F"style="padding:15px; border: 1px solid #000000;font-size: larger; color: #FFFFFF;">${{ $transaction->lineItemsTotalAmount->total }}</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td align="center" style="padding: 40px 30px 40px 30px;">
                <a href="{{ \Illuminate\Support\Facades\URL::to('/').'/#/invoice/'.$transaction->id }}"
                   style="padding: 10px; font-size: large; background-color: #1976D2; color: #FFFFFF; border: none; text-align: center; text-decoration: none; cursor: pointer;">
                    View Invoice
                </a>
            </td>
        </tr>
    </table>

@endsection
