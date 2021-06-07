<?php

include('../functions/conn.php');
header('Content-Type: text/xml');


$body = file_get_contents("php://input");
$_POST = json_decode($body, true);

$table = 'check_cep';

try{

    $cep = $_POST['cep'];

    $cep =  preg_replace('/[^0-9]/', '', $cep);

    // Validação
    if(is_null($cep)){

        $output = "<xmlcheckcep><response>Invalid CEP!</response><status>error</status></xmlcheckcep>";
        return print ($output);

    }

    if(strlen($cep) < 8){

        $output = "<xmlcheckcep><response>Invalid CEP!</response><status>error</status></xmlcheckcep>";
        return print ($output);

    }

    //Consulta

    $sql_check_cep  = "SELECT cep,logradouro,complemento,bairro,localidade,uf FROM $table WHERE cep = $cep";
    $get            = $con->query($sql_check_cep);
    $data           = $get->fetchAll(PDO::FETCH_ASSOC);
    $count          = $get->rowCount();

    $data_cep = $data[0]['cep'];

    if($data_cep){
        
        //true = CEP encontrado no banco de dados, retornar as informações cadastradas !

        $output = "
            <xmlcep>
                <status>true</status>
                <cep>".$data[0]['cep']."</cep>
                <logradouro>".$data[0]['logradouro']."</logradouro>
                <complemento>".$data[0]['complemento']."</complemento>
                <bairro>".$data[0]['bairro']."</bairro>
                <localidade>".$data[0]['localidade']."</localidade>
                <uf>".$data[0]['uf']."</uf>
            </xmlcep>
        ";
            
        print($output);

    }else{

        //false = CEP não encontrado !

        $output = "<xmlcheckcep><response>CEP Not Found!</response><status>false</status><cep>$cep</cep></xmlcheckcep>";
        print ($output);
        
    }

}catch (Exception $e) {
    echo 'Exception: ',  $e->getMessage(), "\n";
}

