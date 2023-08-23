@component('mail::message')
# Login Details for Library System

Hello {{ $user->fullname }},

Thank you for registering with our Library System. Below are your login details:

**Username:** {{ $username }}
**Password:** {{ $randomPassword }}

Please keep these details safe and do not share them with anyone.

Thank you,
The Library System Team
@endcomponent
