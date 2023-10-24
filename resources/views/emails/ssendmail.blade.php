<x-mail::message>
    # Novo contato:
    <strong>Name:</strong> {{ $data['name'] }}
    <em>Email:</em> {{ $data['email'] }}
    <em>Assunto:</em> {{ $data['subject'] }}
    
    <em>Mensagem</em>
    {{ $data['message'] }}
    
    Obrigado,
    {{ config('app.name') }}
</x-mail::message>
