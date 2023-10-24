<x-mail::message>
# Novo contato: <br>
__Nome:__ {{ $data['name'] }} <br>
__Email:__ {{ $data['email'] }} <br>
__Assunto:__ {{ $data['subject'] }} <br>
    
__Mensagem__ <br>
{{ $data['message'] }}
</x-mail::message>
