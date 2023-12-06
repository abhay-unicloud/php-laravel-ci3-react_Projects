<?php
class TaskModel extends CI_Model {
public function __construct(){
    parent:: __construct();
}
function saveToDB($data){
    $this->db->insert_batch('task_data',$data);

}


}    














?>