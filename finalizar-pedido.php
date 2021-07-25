<?php
session_start();
require 'php/conn.php';

if(count($_SESSION['carrinho']) =='0'){
    echo"<script>alert('Não exitem produtos no carrinho de compras')</script>";
    echo"<script>window.location='meu-carrinho.php</script>";
}else{
    $insert_pedido = "INSERT INTO pedido(pedido_data,pedido_data_hora,pedido_valor_pedido_status) VALUES('".date('Y-m-d')."','".date('Y-m-d H:i:s')."','0','0')";
    mysqli_query($conn, $insert_pedido);
    $read_ultimo_pedido = mysqli_query($conn, "SELECT pedido_id FROM pedido ORDER BY pedido_id DESC LIMIT 1");
    if(mysqli_num_rows($read_ultimo_pedido)>'0'){
        foreach($read_ultimo_pedido as $read_ultimo_pedido_view);

    }

    foreach($_SESSION['carrinho']as $id_produto => $qtd_produto){

        $read_produto_carrinho =mysqli_query($conn,"SELECT produto_descricao,produto_preco FROM produto where produto_id='".$id_produto."'");
        if (mysqli_num_rows($read_produto_carrinho)>'0'){
          foreach($read_produto_carrinho as $read_produto_carrinho_view);
          $valor_total_produto_carrinho = $quantidade_produto_carrinho * $read_produto_carrinho_view['produto_preco'];
          $valor_total_venda += $valor_total_produto_carrinho;
        }
       $insert_itens_pedido ="INSERT INTO itens_pedido('itens_id_pedido','itens_pedido_id_produto','itens_pedido_quantidade','itens_pedido_valor_produto','itens_pedido_valor_total') VALUES ('".$id_produto."','".$qtd_produto."','".$read_produto_carrinho_view['produto_preco']."','".$valor_total_produto_carrinho."')";
       mysqli_query($conn, $insert_itens_pedido);
   }
   $update_pedido="UPDATE pedido SET pedido_valor = '".$valor_total_venda."' WHERE pedido_id ='".$read_ultimo_pedido_view['pedido_id']."'";
   echo "<script> alert ('Pedido finalizado')</script>";
   echo"<script>window.location ='meus-pedidos.php'</script>";
}
?>