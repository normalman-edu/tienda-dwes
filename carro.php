<?php
  session_start();
  include("./include/funciones.php");
  $connect = connect_db();

  $title = "Plantas el Caminàs -> ";
  include("./include/header.php");
  require './include/ElCaminas/Carrito.php';
  require './include/ElCaminas/Producto.php';
  require './include/ElCaminas/Productos.php';
  use ElCaminas\Carrito;


  $carrito = new Carrito();
  //Falta comprobar qué acción: add, delete, empty
  $action= "view";
  if(isset($_GET["action"])){
      $action=$_GET["action"];
  }
  if($action == "add"){
  $carrito->addItem($_GET["id"], 1);}
else if($action == "delete"){
  $carrito->deleteItem($_GET["id"]);}
else if($action == "empty"){
  $carrito->empty();}

  $redirect ="./index.php";
  if(isset($_GET['redirect'])){
    $redirect= urldecode($_GET['redirect']);
  }
?>
<script>
function checkDelete(){
	//Siempre que una acción no se pueda deshacer hay que pedir confirmación al usuario
	if (confirm("¿Seguro que desea eliminar el producto del carrito?"))
		return true;
	else
		return false;
}
</script>
  <div class="row carro">
    <h2 class='subtitle' style='margin:0'>Carrito de la compra</h2>
    <?php  echo $carrito->toHtml();?>


    <a class="btn btn-danger" href="<?php echo urldecode($_GET['redirect']); ?>">Seguir Comprando</a>
    <a class="btn btn-danger" href="./checkout.php">Check Out</a>
  </div>
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Detalle del producto</h4>
      </div>
      <div class="modal-body">
        <iframe src='#' width="100%" height="600px" frameborder=0 style='padding:8px'></iframe>
      </div>
    </div>
  </div>
</div>
<?php
$bottomScripts = array();
$bottomScripts[] = "modalIframeProducto.js";

include("./include/footer.php");
?>
