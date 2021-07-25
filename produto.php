<?php
session_start();
require 'php/conn.php';
$id_produto =addslashes($_GET['id']);
$read_produto=mysqli_query($conn,"SELECT * FROM produto where produto_id ='".$id_produto."' ORDER BY produto_descricao ASC");
if(mysqli_num_rows($read_produto)>'0'){
  foreach($read_produto as $read_produto_view);
}else{
    header("Location:index.php");

}
?>

<!DOCTYPE html>
<html lang="en">

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
          <li class="nav-item active">
            <a class="nav-link" href="#">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
          
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

      <div class="col-lg-9">

       

        
          <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100">
             
              <div class="card-body">
              <h5 class="pull-right">R$ <?php echo number_format($read_produto_view['produto_preco'], 2,",",".");?></h5>
                <h4 class="card-title">
                 <a href="#"><?php echo $read_produto_view['produto_descricao'];?></a>
                </h4>
                 <p class="card-text"><?php echo utf8_encode($read_produto_view['produto_breve_descricao']);?></p>
              </div>
              <div class="text-right">
                <a class="btn btn-success" href="meu-carrinho.php?id=<?php echo $id_produto;?>">Inserir no carrinho</a>
              </div>
              <br/>  
            </div>
          </div>
          <?php
               
            
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
