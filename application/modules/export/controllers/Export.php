<?php 
defined('BASEPATH') or exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;

/**
 * 
 */
class Export extends MY_Controller
{
	
	function __construct()
	{
		// code...
		parent::__construct();

		if (!$this->aauth->is_loggedin()) {
			// code...
			redirect('login');
		}
		
		$this->load->model('events/mevents');
		$this->load->model('collections/mcollections');
		$this->load->model('course/mcourse');
    	$this->load->model('settings/settings_model','msettings');
    	$this->load->model('attendance/mattendance');
		$this->load->model('students/mstudents');

	}

	public function events_completed($year=0,$event_id=0,$course_id=0)
	{


        $result = $this->mattendance->list_attendees($event_id,$course_id);

		$event_info = $this->mevents->info($event_id);
		if (empty($event_info)) {
			// code...
			echo 'No event found';
			exit;
		}

      $sy = $this->msettings->get_sy($event_info->year_id);
			$event_title = $event_info->event_title;
			$courses = !empty($event_info->course_attendees) ? join(',',$event_info->course_attendees) : '';
			$event_year = $sy->start_year.' - '.$sy->end_year ;
      if (!empty($course_id)) {
        // code...
        $courses = $this->mcourse->get_coursesubtitle($course_id);

      }


        $file = new Spreadsheet();
        

        $active_sheet = $file->getActiveSheet();

        $active_sheet->mergeCells("A1:I1");
        $active_sheet->mergeCells("A2:I2");

        $active_sheet->getStyle('A1:A2')->getAlignment()->setHorizontal('center');
        $active_sheet->setCellValue('A1', 'Student Organization Collections and Events Monitoring System');
        $active_sheet->setCellValue('A2', $event_title.' List events attendees');

        $active_sheet->setCellValue('A3', 'Courses: ');
        $active_sheet->setCellValue('B3', $courses);

        $active_sheet->setCellValue('A4', 'School Year: '.$event_year);

        $active_sheet->setCellValue('A5', '#');
        $active_sheet->setCellValue('B5', 'Student Name');
        $active_sheet->setCellValue('C5', 'Course');
        $active_sheet->setCellValue('D5', 'Date of event');
        $active_sheet->setCellValue('E5', 'AM Time-in');
        $active_sheet->setCellValue('F5', 'AM Time-out');
        $active_sheet->setCellValue('G5', 'PM Time-in');
        $active_sheet->setCellValue('H5', 'PM Time-out');
        $active_sheet->setCellValue('I5', 'Status');

        $active_sheet->getColumnDimension('B')->setWidth(30);
        $active_sheet->getColumnDimension('D')->setWidth(20);
        $active_sheet->getColumnDimension('E')->setWidth(20);
        $active_sheet->getColumnDimension('F')->setWidth(20);
        $active_sheet->getColumnDimension('G')->setWidth(20);
        $active_sheet->getColumnDimension('H')->setWidth(20);
        $count = 6;
        $i=1;
		/*


				$list_events_attendee[$key]->course_sub_title = $this->mcourse->get_coursesubtitle($value->course_id);
				$list_events_attendee[$key]->event_title = $event_info->event_title;

				*/

        if (!empty($result)) {
    
          foreach($result as $row)
          {
            $active_sheet->setCellValue('A' . $count, $i);
            $active_sheet->setCellValue('B' . $count, $row->student_name);
            $active_sheet->setCellValue('C' . $count, $this->mcourse->get_coursesubtitle($row->course_id));
            $active_sheet->setCellValue('D' . $count, $row->date_of_event);
            $active_sheet->setCellValue('E' . $count, $row->timein);
            $active_sheet->setCellValue('F' . $count, $row->timeout);

            $active_sheet->setCellValue('G' . $count, $row->pm_in);
            $active_sheet->setCellValue('H' . $count, $row->pm_out);
            $active_sheet->setCellValue('I' . $count, $row->status);

            $count++;
            $i++;
          }
        }


        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($file, 'Xlsx');

        $file_name = 'attendance-students-'.time() . '.' . strtolower('xlsx');

        //$writer->save($file_name);

        header('Content-Type: application/x-www-form-urlencoded');

        header('Content-Transfer-Encoding: Binary');

        header("Content-disposition: attachment; filename=\"".$file_name."\"");

       ob_end_clean();
		  $writer->save('php://output');
		  exit();

  }

  public function events_collections($semester=1,$year_id=0,$course_id=0)
  {



    $list_all = null;
    if ($semester == 1) {
      // code...
      $semester_title = 'First semester';

          // code...
        $list_all = $this->mcollections->list_1stsemester($year_id,$course_id);
        if (!empty($list_all)) {
          // code...
          foreach ($list_all as $key => $value) {
            // code...
            $info = $this->mstudents->info($value->student_id);

            $list_all[$key]->student_name = $info->fName.' '.$info->mName.' '.$info->lName.' '.$info->ext;
            $list_all[$key]->course_id = $info->course_id;
            $list_all[$key]->grade = $info->grade;
            $list_all[$key]->section = $info->section;
            $list_all[$key]->course = $info->course_sub_title;
          }
        }

        
      }

    if ($semester == 2) {
      // code...
      $semester_title = 'Second semester';
      // code...
      $list_all = $this->mcollections->list_2ndsemester($year_id,$course_id);
        if (!empty($list_all)) {
          // code...
          foreach ($list_all as $key => $value) {
            // code...
            $info = $this->mstudents->info($value->student_id);

            $list_all[$key]->student_name = $info->fName.' '.$info->mName.' '.$info->lName.' '.$info->ext;
            $list_all[$key]->course_id = $info->course_id;
            $list_all[$key]->grade = $info->grade;
            $list_all[$key]->section = $info->section;
            $list_all[$key]->course = $info->course_sub_title;
          }
        }
      
    }


      $sy = $this->msettings->get_sy($year_id);
      $event_year = $sy->start_year.' to '.$sy->end_year ;
      if (!empty($course_id)) {
        // code...
        $courses = $this->mcourse->get_coursesubtitle($course_id);

      }


        $file = new Spreadsheet();
        

        $active_sheet = $file->getActiveSheet();

        $active_sheet->mergeCells("A1:I1");
        $active_sheet->mergeCells("A2:I2");

        $active_sheet->getStyle('A1:A2')->getAlignment()->setHorizontal('center');
        $active_sheet->setCellValue('A1', 'Student Organization Collections and Events Monitoring System');
        $active_sheet->setCellValue('A2', $semester_title.' Collections');

        $active_sheet->setCellValue('A3', 'Course: ');
        $active_sheet->setCellValue('B3', $courses);

        $active_sheet->setCellValue('A4', 'School Year: '.$event_year);

        $active_sheet->setCellValue('A5', 'ID');
        $active_sheet->setCellValue('B5', 'Student Name');
        $active_sheet->setCellValue('C5', 'Course');
        $active_sheet->setCellValue('D5', 'Date collected');
        $active_sheet->setCellValue('E5', 'Amount');

        $active_sheet->getColumnDimension('B')->setWidth(30);
        $active_sheet->getColumnDimension('D')->setWidth(20);
        $active_sheet->getColumnDimension('E')->setWidth(20);
        $count = 6;
        $i=1;
    

        if (!empty($list_all)) {
    
          foreach($list_all as $row)
          {
            $active_sheet->setCellValue('A' . $count, $i);
            $active_sheet->setCellValue('B' . $count, $row->student_name);
            $active_sheet->setCellValue('C' . $count, $this->mcourse->get_coursesubtitle($row->course_id));
            $active_sheet->setCellValue('D' . $count, $row->date_of_payment);
            $active_sheet->setCellValue('E' . $count, $row->amount_pay);

            $count++;
            $i++;
          }
        }


        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($file, 'Xlsx');

        $file_name = 'collections-students-'.time() . '.' . strtolower('xlsx');


        header('Content-Type: application/x-www-form-urlencoded');

        header('Content-Transfer-Encoding: Binary');

        header("Content-disposition: attachment; filename=\"".$file_name."\"");

       

      ob_end_clean();
      $writer->save('php://output');
      exit();

  }

}

 ?>