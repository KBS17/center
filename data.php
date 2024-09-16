<?php
require('../con1.php')

    $query = 'UPDATE notify SET seen = 1';
    
    $stm = $pdo->prepare($query);
    
    if ($stm->execute()){
        $query2 = 'SELECT notify AS msg FROM notify WHERE seen = 1';
    
        $stm2 =$pdo->prepare($query2);
        $stm2->execute()
    
        if (){
            $result = $stm2->fetchA11();
    
            echo json_encode($result);
        }
    }

?>