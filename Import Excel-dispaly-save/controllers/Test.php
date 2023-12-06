<?php
/*********************************************************************************************
		 
		 Author  		: kailash kumawat
		 Last Modified 	: 27-sep-2015
		 File Name 		: supplier.php
		 Purpose 		: Login and authentication.
		 Copyright 2009 ShimBi Computing Laboratories Pvt. Ltd. All Rights Reserved.			 
**********************************************************************************************/

class Test extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Comm_functions','',TRUE);
		$this->load->model('Mastermodel','',TRUE);
		$this->load->model('Suppliermodel','',TRUE);
		$this->form_validation->set_error_delimiters ( '<div class="error">', '</div>' );
		if (session_id ()=="")
			session_start ();
		$this->Comm_functions->check_session_admin();
	}
	//check supplier payment with work order balance
	function index($id=NULL)
  {
		if ($this->input->post('flag')=="as")
		{
			$this->form_validation->set_rules('source', "Source", 'required');
			$this->form_validation->set_rules('target',"Target", 'required');
			if ($this->form_validation->run())
			{
				$source=$this->input->post('source');
				$target=$this->input->post('target');
				//echo "source=$source,target=$target";die();
				$sql="UPDATE scl_booking_register SET cust_id=$target WHERE cust_id=$source";
				$this->db->query($sql);
				$sql="UPDATE scl_booking_register SET consignor_id=$target WHERE consignor_id=$source";
				$this->db->query($sql);
				$sql="UPDATE scl_booking_register SET consignee_id=$target WHERE consignee_id=$source";
				$this->db->query($sql);

				$sql="UPDATE scl_courier_data SET customer_id=$target WHERE customer_id=$source";
				$this->db->query($sql);

				$sql="UPDATE scl_customer_report_master SET customer_id=$target WHERE customer_id=$source";
				$this->db->query($sql);

				$sql="UPDATE scl_local_voucher SET customer_id=$target WHERE customer_id=$source";
				$this->db->query($sql);

				$sql="UPDATE scl_lr_form SET customer_id=$target WHERE customer_id=$source";
				$this->db->query($sql);
				$sql="UPDATE scl_lr_form SET consignor_id=$target WHERE consignor_id=$source";
				$this->db->query($sql);
				$sql="UPDATE scl_lr_form SET consignee_id=$target WHERE consignee_id=$source";
				$this->db->query($sql);

				$sql="UPDATE scl_lr_receipt SET customer_id=$target WHERE customer_id=$source"; 
				$this->db->query($sql);

				$sql="UPDATE scl_project_code SET customer_id=$target WHERE customer_id=$source"; 
				$this->db->query($sql);

				$sql="UPDATE scl_quotation SET customer_id=$target WHERE customer_id=$source"; 
				$this->db->query($sql);

				$sql="UPDATE scl_rc_note SET consignor=$target WHERE consignor=$source";
				$this->db->query($sql);

				$sql="UPDATE scl_rc_note SET consignee=$target WHERE consignee=$source";
				$this->db->query($sql);

				$sql="UPDATE scl_rc_vehicle SET vendor=$target WHERE vendor=$source"; 
				$this->db->query($sql);

				$sql="DELETE FROM scl_customer WHERE cust_id=$source";
				$this->db->query($sql);
			}
		}
		
		$data['customer'] = $this->Mastermodel->dropdown('customer',1);
		$data['title'] = "change customer";
		$data['view_file'] = 'admin/main/change_customer';
		$this->load->view('admin/main',$data);	
	}

	function testmail()
	{
		$pendingLR=$this->db->select("scl_lr_form.lr_form_id,scl_lr_form.show_lr_no,
			scl_lr_form.lr_action_status as lr_status,scl_lr_form.lorry_no,
			vehicle_placed_date,vehicle_released_date,
			vehicle_placed_date_unloading,vehicle_released_date_unloading,
			max(scl_lr_actions.added_date) as last_mod_date,scl_lr_form.created_date,1 as type,
			(select concat_ws('|',IFNULL(t1.lr_a_status,'-'),IFNULL(t1.lr_a_remark,'-'),IFNULL(t1.added_date,'-'),IFNULL(t1.lr_loading_report_date,'-'),IFNULL(t1.	lr_loading_release_datelr,'-'),IFNULL(t1.lr_unloading_report_date,'-'),IFNULL(t1.lr_unloading_complete_date,'-'),IFNULL(t1.lr_performance_comments,'-')) from scl_lr_actions as t1 WHERE t1.lr_id=scl_lr_actions.lr_id ORDER BY t1.id DESC LIMIT 1) as last_action,
			CONCAT_WS('X',dimensions_length,dimensions_width,dimensions_height) as veh_dimension,
			t2.name as type_of_vehicle,t3.city_name as from_city,t4.city_name as to_city,t1.comp_name as customer_name,
			DATEDIFF(vehicle_placed_date_unloading, vehicle_released_date) as transit_days,minimum_transit_period,
			eway_bill_expiry_date,t1.cust_email_1 as customer_email,t5.comp_name as consignor_name,
			t6.comp_name as consignee_name,t1.cust_free_period_loading,t1.cust_free_period_unloading,
			t7.driver_mob_no,t1.cust_email_2,t1.cust_email_3,t7.remark as loading_remark,
			t7.booking_loading_free,t7.booking_unloading_free,scl_lr_form.image1,
			scl_lr_form.image2,scl_lr_form.image3,scl_lr_form.image4",false)
			//->where('lr_action_status not in (4,5)',NULL,FALSE)
			->where('lr_form_id',7936)
			->join('scl_lr_actions','scl_lr_actions.lr_id=lr_form_id','left')
			->join('scl_vehicle_type as t2','t2.vehicle_type_id=scl_lr_form.typ_vehicle_id','left')
			->join('scl_city as t3','t3.city_id=scl_lr_form.frm_city_id','left')
			->join('scl_city as t4','t4.city_id=scl_lr_form.to_city_id','left')
			->join('scl_customer as t1','t1.cust_id=scl_lr_form.customer_id','left')
			->join('scl_customer as t5','t5.cust_id=scl_lr_form.consignor_id','left')
			->join('scl_customer as t6','t6.cust_id=scl_lr_form.consignee_id','left')
			->join('scl_booking_register as t7','t7.convert_lr=scl_lr_form.lr_form_id','left')
			->order_by('lr_date','asc')
			->group_by('lr_form_id')
			->get('scl_lr_form')
			->result_array();
			$tvalue=$pendingLR[0];
			$email_data = $this->Mastermodel->getViewDetail('mail_format',12);
			$tvalue['unloading_release_date']='2020-11-03 20:20:00';
		$this->load->model('Customermodel','',TRUE); 
		$email_data['attachment']='D:\wamp\www\ctcroadways\application\uploads/detention/PUN-18834.pdf';
		$this->Customermodel->deliveryEmail(3,null,$tvalue,$email_data);
	}
	function import()
	{
		$custArr=$this->Mastermodel->dropdown('customer');
		echo '<pre>';print_r($custArr);//die();

		require_once 'phpexcel/Classes/PHPExcel.php';
		$inputFileName = './uploads/BIDDING-Copy.xlsx';
		$objReader = PHPExcel_IOFactory::createReader('Excel2007');
		$objReader->setReadDataOnly(true);
		$objPHPExcel = $objReader->load($inputFileName);
		$objWorksheet = $objPHPExcel->getActiveSheet();

		$highestRow = $objWorksheet->getHighestRow();
		//$highestColumn = $objWorksheet->getHighestColumn();
		//$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
		$head=array('bidding_id','bidding_date','customer_name','loading_vendor_details','city_from','consignee_address','city_to','type_of_vehicle','dimension','weight','billing_rate','remark','level');

		$rows = array();
		$dbArr=array();
		for ($row = 2; $row <= $highestRow; ++$row) 
		{
			for ($col = 0; $col <= count($head)-1; ++$col) 
			{
				$val= $objWorksheet->getCellByColumnAndRow($col, $row)->getValue();
				if($head[$col]=="bidding_date" && $val!="")
					$val = date("Y-m-d",$this->fromExcelToLinux($val)); 
				if($head[$col]=="customer_name" && $val!="")
				{
					if(array_search(trim($val),$custArr)===false)
					{
						echo $val;die("y");
					}
					$val = array_search(trim($val),$custArr); 
				}	
				$dbArr[$row][$head[$col]]=(empty($val)?null: $this->special_chars($val));
			}
			//echo '<pre>';print_r($dbArr);die();
		}
		//echo '<pre>';print_r($dbArr);
		$this->db->insert_batch('scl_bidding',$dbArr);
		echo "done";
	}
	function fromExcelToLinux($excel_time) {
		return ($excel_time-25569)*86400;
	}
	function special_chars($str)
    {
        $str=iconv("UTF-8","UTF-8//IGNORE",$str);
        //$str = htmlentities($str, ENT_COMPAT, 'iso-8859-1');
		//$str = preg_replace('/&(.)(acute|cedil|circ|lig|grave|ring|tilde|uml);/', "$1", $str);
        return $str;
    }
	function check_lr_book(){
		//$this->Comm_functions->addLRBook(2);
		$this->load->model ( 'Customermodel', '', TRUE );
		$this->Customermodel->send_email();
		//$this->Customermodel->set_detention_pdf(7929);
	}
	function test_lr_detention(){
		$post=$this->Mastermodel->getViewDetail('lr_form','7900');
		$post['com_name']=$this->Mastermodel->getFieldValue('company',1,'com_name');;
		$post['project_name']=$this->Mastermodel->getFieldValue('project_code',$post['project_code'],'project_name');;
		$data['post']=$post;
		//echo '<pre>';print_r($data['post']);die("y");
		include_once(realpath($_SERVER['DOCUMENT_ROOT']).'/tcpdf/examples/example_001.php');
		$page=$this->load->view('admin/pdf/detention_format',$data,TRUE);
		$name=realpath($_SERVER['DOCUMENT_ROOT'])."/uploads/detention/LR-1001.pdf";
		//die("y");
		sample($page,$name,NULL,NULL,NULL,'F');
	}
} 