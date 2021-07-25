<?php
session_start();
require 'php/conn.php';
$id_produto = addslashes($_GET['id']);
if(!isset($_SESSION['carrinho'])){
  $_SESSION['carrinho']=array();
}
$read_produto=mysqli_query($conn,"SELECT * FROM produto where produto_id ='".$id_produto."' ORDER BY produto_descricao ASC");
if(mysqli_num_rows($read_produto)>'0'){
  foreach($read_produto as $read_produto_view);
  if($_SESSION['carrinho'] [$id_produto]){
    $_SESSION['carrinho'] [$id_produto] += 1;
  }else{
    $_SESSION['carrinho'] [$id_produto] = 1 ;
  }
  header("Location: meu-carrinho.php");    
}
print_r($_SESSION['carrinho']);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">

<title>carrinho compras</title>

<!-- Bootstrap core CSS -->
<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

<!-- Custom styles for this template -->
<link href="css/shop-homepage.css" rel="stylesheet">

</head>

<body>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
<div class="container">
<a class="navbar-brand" href="index.php">Carrinho de Compras</a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
<span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="navbarResponsive">
<ul class="navbar-nav ml-auto">

<li class="nav-item">
<a class="nav-link" href="meu-carrinho.php">Meu carrinho</a>
</li>
</ul>
</div>
</div>
</nav>

<!-- Page Content -->
<div class="container">

<div class="row">

<div class="col-lg-3">

<h1 class="my-4">categorias</h1>
<div class="list-group">
<?php
$read_categoria =mysqli_query($conn,"SELECT * FROM categoria ORDER BY categoria_descricao ASC");
if(mysqli_num_rows($read_categoria)>'0'){
  foreach($read_categoria as $read_categoria_view){
    echo '<a href="index.php?cat='.$read_categoria_view['categoria_id'].'" class="list-group-item">'.$read_categoria_view['categoria_descricao'].'</a>';
  }
}

?>

</div>
</div>

<!-- /.col-lg-3 -->


<div class="col-lg-4 col-md-6 mb-4">

<h2>Meu Carrinho</h2>   
<table class="table">
<tr>
<td>Item</td>
<td>Descrição</td>
<td>Valor</td>
<td>Quantidade</td>
<td>Valor Total</td>
<td>Opções</td>
</tr>

<?php 
$item_carrinho = '0';
if(count($_SESSION['carrinho'])>'0'){
  foreach($_SESSION['carrinho'] as $id_produto_carrinho => $quantidade_produto_carrinho){
    $item_carrinho ++;
    $read_produto_carrinho =mysqli_query($conn,"SELECT produto_descricao,produto_preco FROM produto where produto_id='".$id_produto_carrinho."'");
    if (mysqli_num_rows($read_produto_carrinho)>'0'){
      foreach($read_produto_carrinho as $read_produto_carrinho_view);
      $valor_total_produto_carrinho = $quantidade_produto_carrinho * $read_produto_carrinho_view['produto_preco'];
      $valor_total_venda+=$valor_total_produto_carrinho;
    }
    echo '<tr>
    <td>'.$item_carrinho.'</td>
    <td>'.$read_produto_carrinho_view['produto_descricao'].'</td>
    <td>'.number_format($read_produto_carrinho_view['produto_preco'],2,',','.').'</td>
    <td>'.$quantidade_produto_carrinho.'</td>
    <td>'.number_format($valor_total_produto_carrinho, 2,',','.').'</td>
    <td><a href="deletar-prod-carrinho.php?id='.$id_produto_carrinho.'">Deletar</a></td>
    </tr>';
  }
}

?>
</table>
<hr/>
<h3>Valor Total Venda: <?php echo number_format($valor_total_venda, 2,',','.');?></h3>

<div class="text-right">
           <a class="btn btn-success" href="finalizar-pedido.php?id=<?php echo $id_produto;?>">Finalizar Pedido</a>
</div>




<div class="row">
<?php
if(isset($_GET['cat']) && $_GET['cat'] !=''){
  $id_cat = addslashes($_GET['cat']);
  $sql_categoria ="AND produto_id_categoria = '".$id_cat."'";
}else{
  $sql_categoria ="";
}
$read_produto = mysqli_query($conn,"SELECT * FROM produto where produto_id != '' {$sql_categoria} order by produto_descricao asc");
if (mysqli_num_rows($read_produto)>'0'){
  foreach($read_produto as $read_produto_view){
    
    
    ?>          
    
    
    
    
    </div>
    <?php
  }
}
?>

</div>


</div>


</div>


</div>
<!-- /.container -->

<!-- Footer -->
<footer class="py-5 bg-dark">
<div class="container">
<p class="m-0 text-center text-white">Copyright &copy; Everaldo 2021</p>
</div>
<!-- /.container -->
</footer>

<!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
