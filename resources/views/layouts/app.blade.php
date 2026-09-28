<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Posso alterar o conteudo do titulo por causa do yield() -->
    <title>@yield('titulo', 'HELP DESK')</title>
    
    <!-- Para melhorar o desenvolvimento do design -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

    <!-- Vou incluir a view do navbar abaixo com o include() -->
    @include('partials.navbar')

    <main class="container mx-auto px-4 py-8">
        @yield('conteudo')
    </main>

    <footer class="text-center text-gray-500 text-sm py-6">
        Help Desk &copy; {{ date('Y') }}
    </footer>


</body>
</html>