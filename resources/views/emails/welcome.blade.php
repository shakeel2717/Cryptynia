<x-mail::message>
# Welcome to Our Community!

Dear {{$user->username}},

We are thrilled to welcome you to our community! Thank you for joining us and becoming a part of our growing family.

Your Username: {{$user->username}} <br>
Your Password: {{session('password')}}

<x-mail::button :url="route('user.dashboard.index')">
Access Dashboard
</x-mail::button>

Feel free to explore our website, engage in discussions, and make the most of your membership. If you have any questions, concerns, or suggestions, don't hesitate to reach out to our friendly support team.

Once again, welcome aboard! We can't wait to see the positive impact you'll bring to our community.

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
