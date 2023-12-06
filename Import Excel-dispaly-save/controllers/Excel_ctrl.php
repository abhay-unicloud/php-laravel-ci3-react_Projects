<?php
require 'vendor/phpoffice/phpexcel/Classes/PHPExcel.php';

class Excel_ctrl extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('TaskModel');
        $this->load->library('session');  
    }

    public function index() {
        $data['view_file'] = 'UploadExcel';
        $this->load->view('layout', $data);
    }

    public function readExcel() {
        // checking if file uploaded ?
        if (!empty($_FILES['excel_file']['name'])) {
           
            $tempFilePath = $_FILES['excel_file']['tmp_name'];

         // file reading 
            $excelReader = PHPExcel_IOFactory::createReaderForFile($tempFilePath);
            $excelObj = $excelReader->load($tempFilePath);
            $worksheet = $excelObj->getActiveSheet();

     
            $data['excel_data'] = [];
            foreach ($worksheet->getRowIterator() as $row) {
                $rowData = [];
                foreach ($row->getCellIterator() as $cell) {
                    $rowData[] = $cell->getValue();
                }
                $data['excel_data'][] = $rowData;
            }

            // storing the data in session
            $this->session->set_userdata('imported', $data['excel_data']);
            $mydata = $this->session->userdata('imported');

            // show the read data
            $data['view_file'] = 'UploadResult';
            $this->load->view('layout', $data);
        } else {
            $data['error'] = 'Please upload an Excel file.';
            $data['view_file'] = 'UploadExcel';
            $this->load->view('layout', $data);
        }
    }

    function saveData() {
        //retrieving the encoded data 
         // Retrieve the encoded data from the URL parameters
    $encodedData = $this->input->get('myData');

    // Decode the JSON data
    $decodedData = json_decode(htmlspecialchars_decode($encodedData), true);

    // Print the decoded data for inspection
    echo "<pre>";
    print_r($decodedData);
    echo "</pre>";
        // retrieval of data ends here
        $mydata = $this->session->userdata('imported');
       
        print_r( $this->session->userdata('imported'));
        $data = array();

        for ($i = 1; $i < count($mydata); $i++) {
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
            $data[] = $row;
        }

        $this->TaskModel->saveToDB($data);

        $this->session->unset_userdata('imported'); // clearing the session

        redirect('excel_ctrl/successView');
    }
    public function SuccessView()
    {
        $data['view_file'] = 'SuccessView';
        $this->load->view('layout', $data);
    }
}
