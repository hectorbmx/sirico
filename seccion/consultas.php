
<?php

$host="localhost";
$db="riveraco1";
$usuario="root";
$pass="admin";

try {
    $conexion=new PDO("mysql:host =$host;dbname=$db",$usuario,$pass);
    // if($conexion){echo "";}
} catch (Exception $ex) {
    echo $ex->getMessage();
}
    //throw $th;    ?>



<?php if (isset($_GET['accion'])=="insertar"){
    $id =$_POST['presupuesto'];
    $dia = date('Y/m/d');
    $concepto=$_POST['nombre'];
    $costo =$_POST['costo'];
    $cantidad =$_POST['cantidad'];
    // $concepto =$_POST['concepto'];
    // $costo =$_POST['costo'];
    

    $senteciasql=$conexion->prepare("INSERT INTO presupuestos_detalles (id_presupuesto,concepto,costo,cantidad,fecha) values(:id_presupuesto,:concepto,:costo,:cantidad,:fecha);");
    $senteciasql->bindparam(':id_presupuesto',$id);
    $senteciasql->bindparam(':concepto',$concepto);
    $senteciasql->bindparam(':costo',$costo);
    $senteciasql->bindparam(':cantidad',$cantidad);
    $senteciasql->bindparam(':fecha',$dia);
    $senteciasql->execute();
    exit();   
};
if (isset($_GET["borrar"])){
    $id=$_GET["borrar"];
    $sentenciasql=$conexion->prepare("DELETE FROM presupuestos_detalles where id =".$id);
    // $sentenciasql->bindparam('id',$id);
    $sentenciasql->execute();
    exit();

};

if (isset($_GET["consultar"])){
    $id=$_GET["consultar"];
    $sentenciasql=$conexion->prepare("SELECT * FROM presupuestos_detalles where id =".$id);
    $sentenciasql->execute();
    $presupuestos=$senteciasql->fetchALL(PDO::FETCH_ASSOC);
    echo json_encode($presupuestos);
    exit();

}

$senteciasql = $conexion->prepare("SELECT * FROM presupuestos_detalles ");
$senteciasql->execute();
$presupuestos=$senteciasql->fetchALL(PDO::FETCH_ASSOC);
echo json_encode($presupuestos);


?>