<?php
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
Class Import_ctrl extends CI_Controller{
  public function __construct() {
    parent::__construct();
    $this->load->model('TaskModel');
}

public function index() {
    $data['view_file']='Excelview';
    $this->load->view('layout',$data);
   // $this->load->view('Excelview');
   //'database' => @$_SESSION["SELECTED_DB"],
}

public function readExcel() {
    //checking if file uploaded ?
    if (!empty($_FILES['excel_file']['name'])) {
        // getting file path 
        $tempFilePath = $_FILES['excel_file']['tmp_name'];

        // we read the file 
        $spreadsheet = IOFactory::load($tempFilePath);
        $data['excel_data'] = $spreadsheet->getActiveSheet()->toArray();
        //storing the data in sesssion..
          $this->session->set_userdata('imported',$data['excel_data']);
          $mydata=  $this->session->userdata('imported');
         

        // show the read data.
        $data['view_file']='Excelresult';
        $this->load->view('layout',$data);
    } else {
        $data['error'] = 'Please upload an Excel file.';
        $data['view_file']='Excelview';
        $this->load->view('layout',$data);
    }
}
 function saveData(){
    $mydata= $this->session->userdata('imported');
    $data=array();

    for($i=1;$i<count($mydata);$i++)
    {
        $row = array(
            'customer' => $mydata[$i][0],
            'bidding_no' => $mydata[$i][1],
            'wbs_no' => $mydata[$i][2],
            'project' => $mydata[$i][3],
            'op_no' => $mydata[$i][4],
            'cn_no' => $mydata[$i][5],
            'cn_date' => $mydata[$i][6],
            'initiator' => $mydata[$i][7],
            'type_of_vehicle' => $mydata[$i][8],
            'dimension' => $mydata[$i][9],
            'weight' => $mydata[$i][10],
            'vendor_consignor' => $mydata[$i][11],
            'from_location' => $mydata[$i][12],
            'phone_no' => $mydata[$i][13],
            'project_name_consignee' => $mydata[$i][14],
            'to_location' => $mydata[$i][15],
            'num_of_vehicles' => $mydata[$i][16],
        );
       $data[]=$row;
    }
      
      $this->TaskModel->saveToDB($data);


      $this->session->unset_userdata('imported');//clearing the session

      redirect('import_ctrl/index');
  }


    /* if($mydata)
     {
        $this->TaskModel->saveToDB($mydata);//saving to DB
        $this->session->unset_userdata('imported');//clearing the session data after saving the data .
        redirect('import_ctrl/index');//redirecting 
     } else {
        redirect('import_ctrl/index');
     }*/


 }


?>