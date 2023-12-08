<?php include '../html/pagamentos.html'; ?>

<?php
// Inicialização do carrinho de compras (usando uma sessão para armazenar os itens temporariamente)
session_start();

// Função para adicionar um produto ao carrinho
function addToCart($productId, $productName, $productPrice, $quantity) {
    $cartItem = array(
        'id' => $productId,
        'name' => $productName,
        'price' => $productPrice,
        'quantity' => $quantity
    );

    // Adiciona o item ao carrinho
    $_SESSION['cart'][] = $cartItem;
}

// Função para remover um produto do carrinho
function removeFromCart($productId) {
    // Encontra o índice do item no carrinho
    $index = array_search($productId, array_column($_SESSION['cart'], 'id'));

    // Remove o item do carrinho
    if ($index !== false) {
        unset($_SESSION['cart'][$index]);
    }
}

// Função para atualizar a quantidade de um produto no carrinho
function updateQuantity($productId, $quantity) {
    // Encontra o índice do item no carrinho
    $index = array_search($productId, array_column($_SESSION['cart'], 'id'));

    // Atualiza a quantidade
    if ($index !== false) {
        $_SESSION['cart'][$index]['quantity'] = $quantity;
    }
}

// Adiciona um produto ao carrinho (exemplo)
addToCart(1, 'Cropped com Manga', 1500.00, 2);

// Atualiza a quantidade de um produto no carrinho (exemplo)
updateQuantity(1, 3);

// Remove um produto do carrinho (exemplo)
removeFromCart(1);

// Exemplo de como você pode recuperar e exibir os itens do carrinho
foreach ($_SESSION['cart'] as $item) {
    echo "Produto: {$item['name']}, Quantidade: {$item['quantity']}, Total: R$ " . number_format($item['quantity'] * $item['price'], 2) . "<br>";
}
?>
