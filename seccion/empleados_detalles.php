<?php include ("../template/cabecera.php");?>

<?php include ("../config/bd.php"); ?>

<?php $sql= $conexion->prepare("SELECT id_Empleado,empleados_web.Nombre,Apellidos,Fecha_ingreso,Puesto,Area,Sueldo,Sueldo_real,complemento,Sueldo_tipo,tipos_sueldo.Nombre as Pago
                                from empleados_web 
                                inner join tipos_sueldo on tipos_sueldo.id_forma_pago = empleados_web.Sueldo_tipo");                       
            $sql->execute();
            $empleados=$sql->fetchall(PDO::FETCH_ASSOC);
?>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap5.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
<script>
$(document).ready(function() {
    $('#example').DataTable( {
        responsive: {
            details: {
                display: $.fn.dataTable.Responsive.display.modal( {
                    header: function ( row ) {
                        var data = row.data();
                        return 'Detalles de  '+data[1]+' ' +data[2];
                    }
                } ),
                renderer: $.fn.dataTable.Responsive.renderer.tableAll( {
                    tableClass: 'table'
                } )
            }
        }
    } );
} );
</script>

<?php
$hoy =(date("Y-m-d"));
$semana = date('W');
$mes = date ("M");

$txtId=(isset($_POST['txtId']))?$_POST['txtId']:"";
$txtSueldo=(isset($_POST['txtSueldo']))?$_POST['txtSueldo']:""; //recibo la cantidad de Sueldo de la tabla empleados
$txtSueldoReal=(isset($_POST['txtSueldoReal']))?$_POST['txtSueldoReal']:"";
$txtComplemento=(isset($_POST['txtComplemento']))?$_POST['txtComplemento']:"";
$txtML=(isset($_POST['txtML']))?$_POST['txtML']:"";
$txtHE=(isset($_POST['txtHE']))?$_POST['txtHE']:"";
$txtSueldoTipo=(isset($_POST['txtSueldoTipo']))?$_POST['txtSueldoTipo']:"";
$txtDescuentos=(isset($_POST['txtDescuentos']))?$_POST['txtDescuentos']:"";
$txtConcepto=(isset($_POST['txtConcepto']))?$_POST['txtConcepto']:"";
$accion=(isset($_POST['accion']))?$_POST['accion']:"";
$notasId=(isset($_POST['notasId']))?$_POST['notasId']:"";
$nota=(isset($_POST['nota']))?$_POST['nota']:"";
$pagotipo=(isset($_POST['txtSueldoTipo']))?$_POST['txtSueldoTipo']:"";
$weekNum = date("W") - date("W",strtotime(date("Y-m-01"))) + 1;
$sumatotal = (int)$txtSueldo+(int)$txtSueldoReal+(int)$txtComplemento+(int)$txtML+(int)$txtHE-(int)$txtDescuentos;

switch($accion){
    case "agregar":   
        
      $sql= $conexion->prepare("INSERT INTO empleados_pagos (id_empleado,fecha_pago,mes,num_semana,Frecuencia_pago,pagotipo,descuentos,descuentos_con,sueldo_imss,sueldo_real,complemento,metroslineales,horasextras,total)       
                                                     VALUES (:id_empleado,:fecha_pago,:mes,:num_semana,:Frecuencia_pago,:pagotipo,:descuentos,:descuentos_con,:sueldo_imss,:sueldo_real,:complemento,:metroslineales,:horasextras,:total);");
            
          $sql->bindParam(':id_empleado',$txtId);
          $sql->bindParam(':fecha_pago',$hoy);
          $sql->bindParam(':mes',$mes);
          $sql->bindParam(':num_semana',$weekNum);
         $sql->bindParam(':Frecuencia_pago',$txtSueldoTipo);
          $sql->bindParam(':pagotipo',$pagotipo);
          $sql->bindParam(':descuentos',$txtDescuentos);
          $sql->bindParam(':descuentos_con',$txtConcepto);
          $sql->bindParam(':sueldo_real',$txtSueldoReal);
          $sql->bindParam(':complemento',$txtComplemento);
          $sql->bindParam(':metroslineales',$txtML);
          $sql->bindParam(':horasextras',$txtHE);
          $sql->bindParam(':sueldo_imss',$txtSueldo);
          $sql->bindParam(':total',$sumatotal);
          $sql->execute();
         
          break;
         case "notas":
           $sql =$conexion->prepare("INSERT INTO empleados_notas (id_empleado,nota,fecha) VALUES (:id_empleado,:nota,:fecha);");
           $sql->bindParam(':id_empleado',$notasId);
           $sql->bindParam(':nota',$nota);
           $sql->bindParam(':fecha',$hoy);
           $sql->execute();
           break;
        }
          
        
?>

<br> <br><br> <br>


<div class="container" width='100%'>
<table id="example" class="display nowrap" style="width:100%">
        <thead>
            <tr>
                <th># Empleado</th>
                <th>Nombre</th>
                <th>A. Paterno</th>
                <!--<th>Email</th>-->
                
                <th>Puesto</th>
                <th>Area</th>
                <th>Sueldo tipo</th>
                <th>Sueldo</th>
                
                
                
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($empleados as $result) {?>
            <tr>
                <td><?PHP echo $result ['id_Empleado'];?></td>
                <td><?PHP echo $result ['Nombre'];?></td>
                <td><?PHP echo $result ['Apellidos'];?></td>
                
                
                <td><?PHP echo $result ['Puesto'];?></td>
                <td><?PHP echo $result ['Area'];?></td>
                <td><?PHP echo $result ['Pago'];?></td>
                <td><?PHP echo $result ['Sueldo'];?></td>
                
               <!-- <td><img class="img-thumbnail rounded" src="../../img/<?PHP echo $result ['foto'];?>" alt=""></td>-->
                <td>
                    
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#ModalNuevo_<?PHP echo $result ['id_Empleado'] ?>">Pagar</button>                 
                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal_<?PHP echo $result ['id_Empleado'] ?>">Notas</button>                                      
                    
                  <!-- Modal -->
                    <div class="modal fade" id="exampleModal_<?PHP echo $result ['id_Empleado'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <form  method="post">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Agrega una nota al empleado:</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        
                        <div class="modal-body">
                                <div class="form-floating mb-3">
                                <input type="hidden" name="notasId" id="notasId" class="form-control" value="<?PHP echo $result ['id_Empleado'] ?>"placeholder=""required /> 
                                <input type="text" name="" id="" class="form-control" value="<?PHP echo $result ['Nombre'] ?><?PHP echo $result ['Apellidos'] ?>"placeholder=""required /> 
                                <label for="floatingInput">#empleado</label>      
                                </div>
                                <div class="form-floating mb-3">
                                <input type="text" name="fecha" id="fecha" class="form-control" value ="<?PHP echo $hoy?>"placeholder=""required /> 
                                <label for="floatingInput">Fecha de captura de la nota:</label>      
                                </div>
                                <div class="form-floating mb-3">
                                <input type="text" name="nota" id="nota" class="form-control" value ="" placeholder=""required /> 
                                <label for="floatingInput">Descripcion de la nota:</label>      
                                </div>
                                </div>
                                <div class="modal-footer">
                                <button type="button"value ="agregar" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" name ="accion" value ="notas" class="btn btn-success">Guardar</button>
                            </div>
                        
                        </div><!--]Cierra modal notas content-->
                    </div><!--]Cierra modal notas dialog-->
                    </form>
                    </div><!--]Cierra modal notas-->
                    
                    <div class="modal fade" id="ModalNuevo_<?PHP echo $result ['id_Empleado'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <form  method="post">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Captura los datos del pago</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">Cerrar</button>
                            </div>
                <div class="modal-body">   
                        <div class="form-floating mb-3">
                        <input type="hidden" name="txtId" id="txtId" class="form-control" value="<?PHP echo $result ['id_Empleado'] ?>"placeholder=""required /> 
                        <input type="text" name="" id="txtId" class="form-control" value="<?PHP echo $result ['Nombre'] ?> <?PHP echo $result ['Apellidos'] ?>"placeholder=""required /> 
                        <label for="floatingInput">#empleado</label>      
                        </div>
                        <div class="form-floating mb-3">
                        <input type="text" name="fecha" id="fecha" class="form-control" value ="<?PHP echo $hoy?>"placeholder=""required /> 
                        <label for="floatingInput">Fecha de pago:</label>      
                        </div>
                        <div class="form-floating mb-3">
                        <input type="text" name="" id="modelo" class="form-control" value ="<?PHP echo $result ['Pago'] ?>"placeholder=""required /> 
                        <input type="hidden" name="txtSueldoTipo" id="modelo" class="form-control" value ="<?PHP echo $result ['Sueldo_tipo'] ?>"placeholder=""required /> 
                        
                        <label for="floatingInput">Frecuencia de pago:</label>      
                        </div>
                        <div class="form-floating mb-3">
                        <input type="text" name="txtSueldo" id="txtCantidad" class="form-control" value ="" placeholder="" /> 
                        <label for="floatingInput">Sueldo IMSS:</label>      
                        </div>
                        <div class="form-floating mb-3">
                        <input type="text" name="txtSueldoReal" id="txtCantidad" class="form-control" value ="<?PHP echo $result['Sueldo']?>" placeholder=""required /> 
                        <label for="floatingInput">Sueldo Real:</label>      
                        </div>
                        <div class="form-floating mb-3">
                        <input type="text" name="txtComplemento" id="txtCantidad" class="form-control" value ="<?PHP echo $result['complemento']?>" placeholder="" /> 
                        <label for="floatingInput">Complemento:</label>      
                        </div>
                        <div class="form-floating mb-3">
                        <input type="text" name="txtML" id="txtCantidad" class="form-control" value ="" placeholder="" /> 
                        <label for="floatingInput">Metros lineales:</label>      
                        </div>
                        <div class="form-floating mb-3">
                        <input type="text" name="txtHE" id="txtCantidad" class="form-control" value ="" placeholder="" /> 
                        <label for="floatingInput">Horas Extra:</label>      
                        </div>
                        <!-- <input class="form-check-input" type="checkbox" name ="pagotipo" value="1" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                                Sueldo
                            </label><br>
                            <input class="form-check-input" name ="pagotipo" type="checkbox" value="2" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                                Raya
                            </label> -->
                       
                        <div class="form-floating mb-3">
                        <input type="text" name="txtDescuentos" id="modelo" class="form-control" placeholder="" /> 
                        <label for="floatingInput">Descuentos:</label>      
                        </div>
                        <div class="form-floating mb-3">
                        <input type="text" name="txtConcepto" id="modelo" class="form-control" placeholder="" /> 
                        <label for="floatingInput">Concepto descuentos:</label>      
                        </div>    
                    </div>
                        <div class="modal-footer">
                        <button type="button"value ="agregar" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" name ="accion" value ="agregar" class="btn btn-success">Guardar</button>
                        </div>
                        
                 </div><!-- Cierra el modal dialog.-->
             </div><!-- Cierra el modal Content.-->
             </form><!-- Cierra el formulario de envio para los botones pagar y notas-->
        </div><!-- Cierra el modal Pagar.-->     
        
                
                     <?php } ?><!-- cierra el foreach para el llenado de la tabla -->
                 </td>
            </tr>               
        </tbody>            
    </table>
                

    
    </div><!-- Cierra el contenedor principal-->