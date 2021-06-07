<?php 

include('../functions/conn.php');
header('Content-Type: text/xml');


$body = file_get_contents("php://input");
$_POST = json_decode($body, true);

$table = 'check_cep';

try{

    $_POST['cep'] =  preg_replace('/[^0-9]/', '', $_POST['cep']);

    $cep = $_POST['cep'];

    foreach($_POST as $input=>$value){		          
                
        $inputs[] 	= $input;
        $values[] 	= $value;
    
    }
    
    $count_inputs = $inputs;
    $inputs 	  = implode(",",$inputs);
    $inputs 	  = "(".$inputs.")";
    $values       = implode("','",$values);
    $values       = "('".$values."')";
    
    $sql  = "INSERT INTO $table";
    $sql .= $inputs;
    $sql .= " VALUES ".$values;		
    
    $prepare = $con->prepare( $sql );			
    
    for($x=0;$x<count($inputs_count);$x++){
        $prepare->bindParam( ":$inputs[$x]", $value );
    }

    $executa = $prepare->execute();

    //true = CEP foi cadastrado no banco de dados, retornar informações da API Viacep

    $sql_check_cep  = "SELECT cep,logradouro,complemento,bairro,localidade,uf FROM $table WHERE cep = $cep";
    $get            = $con->query($sql_check_cep);
    $data           = $get->fetchAll(PDO::FETCH_ASSOC);
    $count          = $get->rowCount();

    $output = "
        <xmlcep>
            <response>CEP successfully registered in the database!</response>
            <status>true</status>
            <cep>".$data[0]['cep']."</cep>
            <logradouro>".$data[0]['logradouro']."</logradouro>
            <complemento>".$data[0]['complemento']."</complemento>
            <bairro>".$data[0]['bairro']."</bairro>
            <localidade>".$data[0]['localidade']."</localidade>
            <uf>".$data[0]['uf']."</uf>
        </xmlcep>
    ";
        
    print ($output);

}catch (Exception $e) {
    // echo 'Exception: ',  $e->getMessage(), "\n";
    $output = "<xmlcheckcep><response>Server not found!</response><status>error</status></xmlcheckcep>";
    print ($output);
}
