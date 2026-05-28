@component('mail::message')
# Welcome to Our Service!

Hello {{ $customer->name }},

Thank you for joining us! We're excited to have you as a new customer.

## What's Next?

- Complete your profile for a personalized experience
- Explore our services and features
- Contact our support team if you have any questions

Get Started
@endcomponent

If you have any questions, feel free to reach out to our support team.

Best regards,  
{{ config('app.name') }}

@slot('footer')
© {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
@endslot
@endcomponent