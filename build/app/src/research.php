<?php
die("DEPRECATED");
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    require $_SERVER['DOCUMENT_ROOT'].'/classes/Session.class.php';
    require $_SERVER['DOCUMENT_ROOT'].'/classes/Player.class.php';
    require $_SERVER['DOCUMENT_ROOT'].'/classes/PC.class.php';
    require $_SERVER['DOCUMENT_ROOT'].'/classes/Finances.class.php';
    require $_SERVER['DOCUMENT_ROOT'].'/classes/Ranking.class.php';
    require $_SERVER['DOCUMENT_ROOT'].'/classes/Process.class.php';
    
    $software = new SoftwareVPC();
    $finances = new Finances();
    $session = new Session();
    $ranking = new Ranking();
    $process = new Process();

    $id = $_POST['id'];
    $name = $_POST['name'];
    $acc = $_POST['acc'];
    
    if(array_key_exists('keep', $_POST)){
        $keep = '1';
    } else {
        $keep = '0';
    }

    if(is_numeric($id)){
        
        if($software->issetSoftware($id, $_SESSION['id'],'VPC')){
            
            if(is_numeric($acc)){
            
                $accInfo = $finances->bankAccountInfo($acc);

                if ($accInfo['0']['exists'] == '0') {

                    $error = 'INVALID_ACC';
                    die($error);

                } elseif ($accInfo['0']['bankuser'] != $_SESSION['id']) {

                    $error = 'INVALID_ACC';
                    die($error);

                }

                $softInfo = $software->getSoftware($id, $_SESSION['id'], 'VPC');
                $price = $software->research_calculatePrice($softInfo->softversion);
                
                $infoStr = $acc.'/'.$keep.'/'.$price;
                
                if($finances->totalMoney() >= $price){
                
                    if ($process->newProcess($_SESSION['id'], 'RESEARCH', '', 'local', $id, $name, $infoStr, '0')) {

                        $pid = $session->processID('show');
                        
                        header("Location:processes?pid=$pid");
                        
                    } else {

                        $pid = $session->processID('show');
                        
                        $process->getProcessInfo($pid);
                        $process->showProcess();

                    }
                    
                } else {
                    die("Not enough money");
                }

            } else {
                die("Invalid acc");
            }
            
        } else {
            die("THis software doesnt exists");
        }
        
    } else {
        die("Invalid ID");
    }
    
} else {
    header("Location:index.php");
}

?>
