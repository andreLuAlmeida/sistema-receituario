<x-mail::message>
# Nova Receita:

Clique no link abaixo para acessar a receita:
<a href="{{ route('receita.show-public', ['token' => $token]) }}">Visualizar</a>
</x-mail::message>