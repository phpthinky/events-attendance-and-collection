<?php 

/**
 * 
 */

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\Label\Alignment\LabelAlignmentLeft;
use Endroid\QrCode\Logo\Logo;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;

class Import extends MY_Controller
{
	
	function __construct()
	{
		// code...
		parent::__construct();

		$this->load->model('import/mimport');
	}
public function index($value='')
{
	// code...
	$data = new stdClass();

	$data->content = 'import/import-index';
	$this->template->load($this->theme,$data);

}

public function students($value='')
{
	// code...

	//echo json_encode($this->input->post());
	$excel_data = $this->input->post('data');
	//echo json_encode($excel_data[0]);
		$errors = array();

	if (!empty($excel_data)) {
		// code...
		foreach ($excel_data as $key => $value) {
			// code...
			$value = (object)$value;

			$value->curriculum_year_start = toymd($value->curriculum_year_start);
			$value->curriculum_year_end = toymd($value->curriculum_year_end);
			




			if($year_id = $this->mimport->year_id($value->curriculum_year_start,$value->curriculum_year_end,$value->semester)){

			$data = new stdClass();
			$data->code = $value->student_id;
			$data->fName = $value->first_name;
			$data->mName = $value->middle_name;
			$data->lName = $value->last_name;
			$data->ext = $value->name_extension;
			$action = '';
			if (!$this->mimport->find($data->code)) {
				// code...
			$action = 'insert';

				if($result = $this->mimport->insert($data)){

				}else{
				$errors[] = $result;

				}
			$this->toqrcode($data->code);

			}else{
				$action = 'update';
				if($result = $this->mimport->update($value->student_id,$data)){

				}else{
				$errors[] = $result;

				}
			}

				$data_course = new stdClass();
				$data_course->course_id = $this->mimport->getcourse_id($value->course);
				$data_course->student_id = $value->student_id;
				$data_course->grade = $value->year;
				$data_course->section = $value->section;
				$data_course->semester = $value->semester;
				$data_course->year_id = $year_id;

				//var_dump($data_course);
				
				if (!empty($data_course->course_id) && !empty($data_course->year_id)) {
						// code...
					if($result = $this->mimport->save_course($action,$data_course)){

					}else{
					$errors[] = $result;

					}
				}
				//echo "Course added";
				}else{
					$errors[] = $value->student_id.' has invalid school year or semester data.';
				}
	
		//	}

		}
		
		if (!empty($errors)) {
			// code...
		echo json_encode(array('status'=>false,'msg'=>'No data to import.','errors'=>$errors));

		}else{
		echo json_encode(array('status'=>true,'msg'=>'Import completed.'));

		}
	}else{
		echo json_encode(array('status'=>false,'msg'=>'No data to import.'));
	}
}

public function save_course($data='')
{
	// code...
}
public function import($input)
{
        $newcolumn = $this->col->column('research');

        $data = json_decode($input['data']);
        $newdata = arrangeDataToTableFormat($this->table,$newcolumn,$data);
        
        $error = array();
        $i=1;
        foreach ($newdata as $key => $info) {
          # code...
              $split_data = split_data($this->table,$newcolumn,$info);
              $value = $split_data[0];
              $ndata = $split_data[1];
              $ndata = unsetEmpty($ndata);

                    $title = !empty($value['progtitle']) ? $value['progtitle'] : $value['projtitle'];   
                    $result = $this->mresearch->_findtitle($value['projtitle'],$value['progtitle']);

                    $title = !empty($value['progtitle']) ? $value['progtitle'] : $value['projtitle'];
                    if (!empty($result)) {
                    
                      $error[] =  "$i - $title";

                    }else{

                    $value['startdate'] = mdy2ymd($value['startdate']);
                    $value['enddate'] = mdy2ymd($value['enddate']);
                    
                    $value['date_posted'] = date('Y-m-d H:i:s');
                    $value['posted_by'] = $this->user_id;
                    $value['cost'] = intval(preg_replace('/[^\d.]/', '', $value['cost']));
                    
                    unset($value['id']);
		
                    if (hasRole(['admin','editor'])) {
                      # code...
                      $value['post_status'] = 3;
                    }
                    if($result = $this->mresearch->_add($value)){
                    
                                
                            if (!empty($ndata)) {
                            # code...
                             $this->col->add_value($ndata,$result,'proposal');
                            }
                            if (!isset($value['staff'])) {
                              # code...
                              $value['staff'] = null;
                            }

                            if (!isset($value['leader'])) {
                              # code...
                              $value['leader'] = null;
                            }


                                $researchers = explode_researchers(array('input'=>$value['staff'],'id'=>$result),$value['leader']);
                                
                                if (!empty($researchers)) {
                                  # code...

                                $this->mresearcher->_addresearcher($researchers,$result,'research');
                                }

                    }else{

                      $error[] =  "$i - $title";

                    }
                    
                  }

                
                  $i++;

        }
        if (!empty($error)) {
          # code...
        echo json_encode(array('status'=>false,'msg'=>'Some data was not imported.','error'=>$error));
        }else{
        echo json_encode(array('status'=>true,'msg'=>'All research data successfully imported'));
        }

}



	public function toqrcode($code='')
	{
		

		$data =site_url('scanner/info?qrcode=').$code;
		$qr_code_data = QrCode::create($data)
                 ->setSize(300)
                 ->setMargin(10);
		$writer = new PngWriter;
		$label = Label::create('STUDENT GOVERNMENT');
		//$logo = Logo::create(UPLOADPATH.'org-logo.png')
			//	->setResizeToWidth(100);
		$result = $writer->write($qr_code_data,null,label:$label);
		//header("Content-Type: " . $result->getMimeType());

		//echo $result->getString();
	//	$qr_code = "QR".$code;
		$result->saveToFile(UPLOADPATH.'qrcode'.DIRECTORY_SEPARATOR.$code.".png");
		return;// $code;

	}


















////end class
}

 ?>