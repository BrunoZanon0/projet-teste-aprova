<!DOCTYPE html>
<html>
<head>
    <title>Produto Cadastrado com Sucesso</title>
</head>
<body>
    <p>Olá {{ $product->user->name }},</p>
    <p>Seu produto <strong>{{ $product->name }}</strong> foi cadastrado com sucesso na nossa plataforma.</p>

    <h3>Detalhes do produto:</h3>
    <ul>
        <li><strong>Nome:</strong> {{ $product->name }}</li>
        <li><strong>Descrição:</strong> {{ $product->descricao }}</li>
        <li><strong>Preço:</strong> R$ {{ number_format($product->preco, 2, ',', '.') }}</li>
        <li><strong>Link para visualizar o produto:</strong> <a href="#">Ver Produto</a></li>
    </ul>

    <p>Atenciosamente,<br>Equipe [Nome da Plataforma]</p>
</body>
</html>
