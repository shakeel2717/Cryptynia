<x-mail::message>
# Email Verification Code

Dear <b>User</b>,


<b>Your OTP For Email Verification</b> <br>

Email OTP:<b> {{$token}} </b><br>

<x-mail::button :url="route('user.dashboard.index')">
Access Dashboard
</x-mail::button>

Thank you for choosing <b>{{ env('APP_NAME') }}</b> for your financial needs. We greatly value your trust and look forward to serving you effectively.

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
