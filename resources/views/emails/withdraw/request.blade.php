<x-mail::message>
# Confirmation of Your Withdrawal Order

Dear <b>{{$withdraw->user->username}}</b>,

We are writing to confirm that we have received your recent withdrawal order.

<b>Withdrawal Details:</b> <br>
Withdrawal Number:<b> 78678{{$withdraw->id}} </b><br>
Withdrawal Amount:<b> ${{number_format($withdraw->amount,2)}} </b><br>
Withdrawal Fees:<b> ${{number_format($withdraw->fees,2)}} </b><br>
Withdrawal Method:<b> {{$withdraw->wallet}} ({{$withdraw->method}}) </b><br>
Requested Date:<b> {{$withdraw->created_at}} </b><br>

<x-mail::button :url="route('user.dashboard.index')">
Access Dashboard
</x-mail::button>

Please note that our team is currently processing your withdrawal request. The processing time may vary depending on the withdrawal method you've chosen and any additional verification that might be required. We are committed to ensuring the security of your funds and will take all necessary measures to expedite this process.

Thank you for choosing <b>{{ env('APP_NAME') }}</b> for your financial needs. We greatly value your trust and look forward to serving you effectively.

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
