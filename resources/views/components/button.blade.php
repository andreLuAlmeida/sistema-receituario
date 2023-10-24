<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-primary bg-gray-800 border rounded-4']) }}>
    {{ $slot }}
</button>
