<x-mail::message>
# Withdrawal Request Complete

Dear <b>{{$withdraw->user->username}}</b>,

We are pleased to inform you that your withdrawal request has been approved and processed successfully.

<b>Withdrawal Details:</b> <br>
Withdrawal Wallet Address: <b>{{ $withdraw->wallet }}</b><br>
Withdrawal TXID: <b>{{ $withdraw->txId }}</b><br>
Withdrawal Amount: <b>${{ number_format($withdraw->amount, 2) }}</b><br>
Withdrawal Method: <b>{{ $withdraw->method }}</b><br>
Requested Date: <b>{{ $withdraw->created_at }}</b><br>
Approval Date: <b>{{ now() }}</b><br>

<x-mail::button :url="route('user.dashboard.index')">
Access Dashboard
</x-mail::button>

Your withdrawal has been successfully processed and the funds have been sent to your specified wallet address. Please allow some time for the transaction to be confirmed on the blockchain. If you have any questions or concerns, feel free to contact our customer support team.

Thank you for using <b>{{ env('APP_NAME') }}</b> for your financial needs. We appreciate your trust and continued support.

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
