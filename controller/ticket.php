<?php
    require_once("../config/conexion.php");
    require_once("../models/Ticket.php");

    $ticket = new Ticket();

    switch($_GET["op"]){
        case "insert":
            $ticket->insert_ticket($_POST["usu_id"],$_POST["tipo_id"],$_POST["proceso_id"],$_POST["tick_orden"],$_POST["tick_acta"],$_POST["tick_descrip"]);
        break;

        case "listar_x_usu":
            $datos=$ticket->list_ticket($_POST["usu_id"]);
            $data= Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = $row["tick_id"];
                $sub_array[] = $row["tipo_name"];
                $sub_array[] = $row["proces_name"];
                $sub_array[] = $row["tick_orden"];

                if ($row["tick_estado"]=="Activo"){
                    $sub_array[] = '<span class="label label-pill label-success">Abierto</span>';
                }elseif ($row["tick_estado"]=="Proceso"){
                        $sub_array[] = '<span class="label label-pill label-warning">Procesando</span>';
                    }else {
                        $sub_array[] = '<span class="label label-pill label-danger">Cerrado</span>';
                    }

                $sub_array[] = date('d/m/Y H:i:s',strtotime($row["tick_fecha"]));
                $sub_array[] = '<button type="button" onClick="ver('.$row["tick_id"].');"  id="'.$row["tick_id"].'" class="btn btn-inline btn-primary btn-sm ladda-button"><i class="fa fa-eye"></i></button>';
                $data[] = $sub_array;
            }

            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);
        break;

        case "listar":
            $datos=$ticket->listar_ticket();
            $data= Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = $row["tick_id"];
                $sub_array[] = $row["tipo_name"];
                $sub_array[] = $row["proces_name"];
                $sub_array[] = $row["tick_orden"];

                if ($row["tick_estado"]=="Activo"){
                    $sub_array[] = '<span class="label label-pill label-success">Abierto</span>';
                }elseif ($row["tick_estado"]=="Proceso"){
                        $sub_array[] = '<span class="label label-pill label-warning">Procesando</span>';
                    }else {
                        $sub_array[] = '<span class="label label-pill label-danger">Cerrado</span>';
                    }

                $sub_array[] = date('d/m/Y H:i:s',strtotime($row["tick_fecha"]));
                $sub_array[] = '<button type="button" onClick="ver('.$row["tick_id"].');"  id="'.$row["tick_id"].'" class="btn btn-inline btn-primary btn-sm ladda-button"><i class="fa fa-eye"></i></button>';
                $data[] = $sub_array;
            }

            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);
        break;
    }
?>