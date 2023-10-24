<x-mail::message>
# {{ $data->subject }}

{{ $data->message }}

<br>
{{ $order->name }}
{{ $order->email }}
{{ $order->cellphone }}
</x-mail::message>
