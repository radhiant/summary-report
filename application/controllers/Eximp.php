<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Eximp extends CI_Controller {

    private $filename = "import_data_pembiayaan";

    public function __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('pembiayaan_model');
        $this->load->model('pendapatan_model');
        $this->load->model('katbiaya_model');
        $this->load->model('project_model');
        $this->load->model('user_model');

        if(!$this->session->userdata('login_session')['login'] == 'GLBKU'){
            redirect('login/logout');
            exit;
        }else{
            if($this->session->userdata('login_session')['level'] == '1'){
            
            }else{
                redirect('pendapatan');
            }
        }

        
      }

      public function index()
	{   
        $data['judul'] = "Export Import";
        $data['data'] = $this->pembiayaan_model->data()->result();

		$this->load->view('templates/header', $data);
		$this->load->view('eximp/index');
		$this->load->view('js/eximpjs');
		$this->load->view('templates/footer');
    }

    public function pendapatan()
	{   
        $data['judul'] = "Export Import";
        $data['data'] = $this->pendapatan_model->data()->result();

		$this->load->view('templates/header', $data);
		$this->load->view('eximp/pendapatan');
		$this->load->view('js/eximpjs');
		$this->load->view('templates/footer');
    }

    public function uploadPembiayaan()
    {
        $upload = $this->pembiayaan_model->upload_file($this->filename);
        if($upload['result'] == "success"){ // Jika proses upload sukses
            
            redirect('eximp/importPembiayaan');
        }else{ // Jika proses upload gagal
            $this->session->set_flashdata('Pesan','
		<script>
		$(document).ready(function() {
			swal.fire({
				title: "'.$upload['error'].'",
				icon: "error",
				confirmButtonColor: "#4e73df",
			});
		});
		</script>
		');
            redirect('eximp');
        }
	}
	
	public function uploadPendapatan()
    {
        $upload = $this->pendapatan_model->upload_file($this->filename);
        if($upload['result'] == "success"){ // Jika proses upload sukses
            
            redirect('eximp/importPendapatan');
        }else{ // Jika proses upload gagal
            $this->session->set_flashdata('Pesan','
		<script>
		$(document).ready(function() {
			swal.fire({
				title: "'.$upload['error'].'",
				icon: "error",
				confirmButtonColor: "#4e73df",
			});
		});
		</script>
		');
            redirect('eximpendapatan');
        }
    }


    public function importPembiayaan(){
		// Load plugin PHPExcel nya
		include APPPATH.'third_party/PHPExcel/PHPExcel.php';
		
		$excelreader = new PHPExcel_Reader_Excel2007();
		$loadexcel = $excelreader->load('excel/'.$this->filename.'.xlsx'); // Load file yang telah diupload ke folder excel
		$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
		
		// Buat sebuah variabel array untuk menampung array data yg akan kita insert ke database
		$data = array();
		
		$numrow = 1;
		foreach($sheet as $row){
			// Cek jika semua data tidak diisi
			if($row['A'] == "" && $row['B'] == "" && $row['C']== "" && $row['D'] == "" && $row['E'] == "" && $row['F'] == "" && $row['G'] == "" && $row['H'] == "" && $row['I'] == "")
			continue;

			// Cek $numrow apakah lebih dari 1
			// Artinya karena baris pertama adalah nama-nama kolom
			// Jadi dilewat saja, tidak usah diimport
			if($numrow > 2){
				// Kita push (add) array data ke variabel data
				array_push($data, array(
					// 'pembiayaan_id'=>$row['A'], 
					'katbiaya_id'=>$row['B'], 
					'project_id'=>$row['C'],
                    'user_id'=>$row['D'],
                    'pembiayaan_beban_biaya'=>$row['E'],
                    'pembiayaan_tgl'=>$row['F'],
                    'pembiayaan_nilai_realisasi'=>$row['G'],
                    'pembiayaan_ket'=>$row['H'],
                    'pembiayaan_tgl_input'=>$row['I'],
				));
			}
			
			$numrow++; // Tambah 1 setiap kali looping
		}

		// Hapus semua data
		$this->pembiayaan_model->delete_all('pembiayaan');

		// Panggil fungsi insert_multiple yg telah kita buat sebelumnya di model
		$this->pembiayaan_model->insert_multiple($data);
        
        $this->session->set_flashdata('Pesan','
		<script>
		$(document).ready(function() {
			swal.fire({
				title: "Berhasil di Import!",
				icon: "success",
				confirmButtonColor: "#4e73df",
			});
		});
		</script>
		');
		redirect("eximp"); // Redirect ke halaman awal (ke controller siswa fungsi index)
	}

	public function importPendapatan(){
		// Load plugin PHPExcel nya
		include APPPATH.'third_party/PHPExcel/PHPExcel.php';
		
		$excelreader = new PHPExcel_Reader_Excel2007();
		$loadexcel = $excelreader->load('excel/'.$this->filename.'.xlsx'); // Load file yang telah diupload ke folder excel
		$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
		
		// Buat sebuah variabel array untuk menampung array data yg akan kita insert ke database
		$data = array();
		
		$numrow = 1;
		foreach($sheet as $row){
			// Cek jika semua data tidak diisi
			if($row['A'] == "" && $row['B'] == "" && $row['C']== "" && $row['D'] == "" && $row['E'] == "" && $row['F'] == "" && $row['G'] == "" && $row['H'] == "" && $row['I'] == "")
			continue;

			// Cek $numrow apakah lebih dari 1
			// Artinya karena baris pertama adalah nama-nama kolom
			// Jadi dilewat saja, tidak usah diimport
			if($numrow > 2){
				// Kita push (add) array data ke variabel data
				array_push($data, array(
					// 'pembiayaan_id'=>$row['A'], 
					'project_id'=>$row['B'], 
					'pendapatan_periode'=>$row['C'],
                    'pendapatan_tgl_penagihan'=>$row['D'],
                    'pendapatan_tgl_tempo'=>$row['E'],
                    'pendapatan_jml_tagihan'=>$row['F'],
                    'pendapatan_ket'=>$row['G'],
                    'pendapatan_jml_bayar'=>$row['H'],
                    'pendapatan_tgl_bayar'=>$row['I'],
				));
			}
			
			$numrow++; // Tambah 1 setiap kali looping
		}

		// Hapus semua data
		$this->pendapatan_model->delete_all('pendapatan');

		// Panggil fungsi insert_multiple yg telah kita buat sebelumnya di model
		$this->pendapatan_model->insert_multiple($data);
        
        $this->session->set_flashdata('Pesan','
		<script>
		$(document).ready(function() {
			swal.fire({
				title: "Berhasil di Import!",
				icon: "success",
				confirmButtonColor: "#4e73df",
			});
		});
		</script>
		');
		redirect("eximpendapatan"); // Redirect ke halaman awal (ke controller siswa fungsi index)
	}
    

    public function exportPembiayaan(){
		// Load plugin PHPExcel nya
		require_once APPPATH.'third_party/PHPExcel/PHPExcel.php';
		
		// Panggil class PHPExcel nya
		$excel = new PHPExcel();

		// Settingan awal fil excel
		$excel->getProperties()->setCreator('GLBKU')
							   ->setLastModifiedBy('GLBKU')
							   ->setTitle("Data Pembiayaan")
							   ->setSubject("Data")
							   ->setDescription("Data Semua Pembiayaan")
							   ->setKeywords("Data Pembiayaan");

		// Buat sebuah variabel untuk menampung pengaturan style dari header tabel
		$style_col = array(
			'font' => array('bold' => true), // Set font nya jadi bold
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
			),
			'borders' => array(
				'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
				'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
				'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
				'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
			)
		);

		// Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
		$style_row = array(
			'alignment' => array(
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
			),
			'borders' => array(
				'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
				'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
				'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
				'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
			)
		);

		$excel->setActiveSheetIndex(0)->setCellValue('A1', "DATA PEMBIAYAAN"); // Set kolom A1 dengan tulisan "DATA SISWA"
		$excel->getActiveSheet()->mergeCells('A1:I1'); // Set Merge Cell pada kolom A1 sampai E1
		$excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
		$excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
		$excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1

		// Buat header tabel nya pada baris ke 3
		$excel->setActiveSheetIndex(0)->setCellValue('A3', "ID");   
		$excel->setActiveSheetIndex(0)->setCellValue('B3', "Katbiaya");   
		$excel->setActiveSheetIndex(0)->setCellValue('C3', "Project");   
		$excel->setActiveSheetIndex(0)->setCellValue('D3', "User");   
        $excel->setActiveSheetIndex(0)->setCellValue('E3', "Beban Biaya");   
        $excel->setActiveSheetIndex(0)->setCellValue('F3', "Tanggal"); 
        $excel->setActiveSheetIndex(0)->setCellValue('G3', "Nilai Realisasi"); 
        $excel->setActiveSheetIndex(0)->setCellValue('H3', "Keterangan"); 
        $excel->setActiveSheetIndex(0)->setCellValue('I3', "Tgl Input"); 

		// Apply style header yang telah kita buat tadi ke masing-masing kolom header
		$excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('F3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('G3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('H3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('I3')->applyFromArray($style_col);

		// Panggil function view yang ada di Pembiayaan untuk menampilkan semua datanya
		$pembiayaan = $this->pembiayaan_model->dataOrderby('ASC')->result();

		$no = 1; // Untuk penomoran tabel, di awal set dengan 1
		$numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
		foreach($pembiayaan as $data){ // Lakukan looping pada variabel
			$excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $data->pembiayaan_id);
			$excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $data->katbiaya_id);
			$excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $data->project_id);
			$excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $data->user_id);
            $excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $data->pembiayaan_beban_biaya);
            $excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $data->pembiayaan_tgl);
            $excel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, $data->pembiayaan_nilai_realisasi);
            $excel->setActiveSheetIndex(0)->setCellValue('H'.$numrow, $data->pembiayaan_ket);
            $excel->setActiveSheetIndex(0)->setCellValue('I'.$numrow, $data->pembiayaan_tgl_input);
			
			// Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
			$excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('G'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('H'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('I'.$numrow)->applyFromArray($style_row);
			
			$no++; // Tambah 1 setiap kali looping
			$numrow++; // Tambah 1 setiap kali looping
		}

		// Set width kolom
		$excel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true); 
		$excel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true); 
		$excel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true); 
		$excel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true); 
        $excel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true); 
        $excel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true); 
        $excel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true); 
        $excel->getActiveSheet()->getColumnDimension('H')->setWidth(30); 
        $excel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true); 
		
		// Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
		$excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);

		// Set orientasi kertas jadi LANDSCAPE
		$excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);

		// Set judul file excel nya
		$excel->getActiveSheet(0)->setTitle("Laporan Data Pembiayaan");
		$excel->setActiveSheetIndex(0);

		// Proses file excel
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="Data Pembiayaan.xlsx"'); // Set nama file excel nya
		header('Cache-Control: max-age=0');

		$write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
		$write->save('php://output');
    }
    
    public function exportPendapatan(){
		// Load plugin PHPExcel nya
		include APPPATH.'third_party/PHPExcel/PHPExcel.php';
		
		// Panggil class PHPExcel nya
		$excel = new PHPExcel();

		// Settingan awal fil excel
		$excel->getProperties()->setCreator('GLBKU')
							   ->setLastModifiedBy('GLBKU')
							   ->setTitle("Data Pendapatan")
							   ->setSubject("Data")
							   ->setDescription("Data Semua Pendapatan")
							   ->setKeywords("Data Pendapatan");

		// Buat sebuah variabel untuk menampung pengaturan style dari header tabel
		$style_col = array(
			'font' => array('bold' => true), // Set font nya jadi bold
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
			),
			'borders' => array(
				'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
				'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
				'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
				'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
			)
		);

		// Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
		$style_row = array(
			'alignment' => array(
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
			),
			'borders' => array(
				'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
				'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
				'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
				'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
			)
		);

		$excel->setActiveSheetIndex(0)->setCellValue('A1', "DATA PENDAPATAN"); // Set kolom A1 dengan tulisan "DATA SISWA"
		$excel->getActiveSheet()->mergeCells('A1:I1'); // Set Merge Cell pada kolom A1 sampai E1
		$excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
		$excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
		$excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1

		// Buat header tabel nya pada baris ke 3
		$excel->setActiveSheetIndex(0)->setCellValue('A3', "ID");   
		$excel->setActiveSheetIndex(0)->setCellValue('B3', "Project");   
		$excel->setActiveSheetIndex(0)->setCellValue('C3', "Periode");   
		$excel->setActiveSheetIndex(0)->setCellValue('D3', "Tgl Tagihan");   
        $excel->setActiveSheetIndex(0)->setCellValue('E3', "Tempo");   
        $excel->setActiveSheetIndex(0)->setCellValue('F3', "Jml Tagihan"); 
        $excel->setActiveSheetIndex(0)->setCellValue('G3', "Ket"); 
        $excel->setActiveSheetIndex(0)->setCellValue('H3', "Jml Bayar"); 
        $excel->setActiveSheetIndex(0)->setCellValue('I3', "Tgl Bayar"); 

		// Apply style header yang telah kita buat tadi ke masing-masing kolom header
		$excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('F3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('G3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('H3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('I3')->applyFromArray($style_col);

		// Panggil function view yang ada di Pembiayaan untuk menampilkan semua datanya
		$pendapatan = $this->pendapatan_model->dataOrderby('ASC')->result();

		$no = 1; // Untuk penomoran tabel, di awal set dengan 1
		$numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
		foreach($pendapatan as $data){ // Lakukan looping pada variabel
			$excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $data->pendapatan_id);
			$excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $data->project_id);
			$excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $data->pendapatan_periode);
			$excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $data->pendapatan_tgl_penagihan);
            $excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $data->pendapatan_tgl_tempo);
            $excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $data->pendapatan_jml_tagihan);
            $excel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, $data->pendapatan_ket);
            $excel->setActiveSheetIndex(0)->setCellValue('H'.$numrow, $data->pendapatan_jml_bayar);
            $excel->setActiveSheetIndex(0)->setCellValue('I'.$numrow, $data->pendapatan_tgl_bayar);
			
			// Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
			$excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('G'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('H'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('I'.$numrow)->applyFromArray($style_row);
			
			$no++; // Tambah 1 setiap kali looping
			$numrow++; // Tambah 1 setiap kali looping
		}

		// Set width kolom
		$excel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true); 
		$excel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true); 
		$excel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true); 
		$excel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true); 
        $excel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true); 
        $excel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true); 
        $excel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true); 
        $excel->getActiveSheet()->getColumnDimension('H')->setWidth(30); 
        $excel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true); 
		
		// Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
		$excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);

		// Set orientasi kertas jadi LANDSCAPE
		$excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);

		// Set judul file excel nya
		$excel->getActiveSheet(0)->setTitle("Laporan Data Pendapatan");
		$excel->setActiveSheetIndex(0);

		// Proses file excel
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="Data Pendapatan.xlsx"'); // Set nama file excel nya
		header('Cache-Control: max-age=0');

		$write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
		$write->save('php://output');
	}


}