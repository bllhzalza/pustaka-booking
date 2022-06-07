<?php

defined('BASEPATH') or exit('No Direct script access allowed');

class Laporan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    
    }
    public function laporan_buku()
    {
        
        $data['judul'] = 'Laporan Data Buku';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['buku'] = $this->ModelBuku->getBuku()->result_array();
        $data['kategori'] = $this->ModelBuku->getKategori()->result_array();
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('buku/laporan_buku', $data);
        $this->load->view('templates/footer');
    }

    public function cetak_laporan_buku()
    {
        $data['buku'] = $this->ModelBuku->getBuku()->result_array();
        $data['kategori'] = $this->ModelBuku->getKategori()->result_array();

        $this->load->view('buku/laporan_print_buku', $data);
    }

    public function laporan_buku_pdf()
    {
        $data['buku'] = $this->ModelBuku->getBuku()->result_array();

        $this->load->library('pdf');
            
        $paper_size = 'A4'; // ukuran kertas
        $orientation = 'landscape'; //tipe format kertas potrait atau landscape

        $this->pdf->set_paper($paper_size, $orientation);
        //Convert to PDF
        $this->pdf->filename = "laporan_data_buku.pdf";
        // nama file pdf yang di hasilkan
        $this->pdf->load_view('buku/laporan_pdf_buku', $data);
    }

	public function export_excel(){
		
		$data = array(
			'title'=>'Laporan Buku',
			'buku'=>$this->ModelBuku->getBuku()->result_array()
		);
		// $data['buku'] = $this->ModelBuku->getBuku()->result_array();
		$this->load->view('buku/export_excel_buku', $data);
		// $this->load->model("excel_export_model");

      // $this->load->library("excel");

      // $object = new PHPExcel();

      // $object->setActiveSheetIndex(0);

      // $table_columns = array("No", "Judul","Pengarang","Penerbit","Tahun Terbit","ISBN","Stok");

      // $column = 0;

      // foreach($table_columns as $field){

      //   $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);

      //   $column++;

      // }

      // $buku = $this->ModelBuku->getBuku()->result_array();

      // $excel_row = 2;

      // 	$no = 1;
      // foreach($buku as $row){
      //   $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $no);

      //   $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row['judul_buku']);

      //   $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row['pengarang']);

      //   $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row['penerbit']);

      //   $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row['tahun_terbit']);

      //   $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $row['isbn']);

      //   $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $row['stok']);

      //   $excel_row++;
      //   $no++;

      // }

      // $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');

      // header('Content-Type: application/vnd.ms-excel');

      // header('Content-Disposition: attachment;filename="Data-Buku.xls"');

      // $object_writer->save('php://output');

    }

    public function laporan_anggota()
    {
        $data['judul'] = 'Data Anggota';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $this->db->where('role_id', 1);
        $data['anggota'] = $this->db->get('user')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/laporan_anggota', $data);
        $this->load->view('templates/footer');
    }

    public function cetak_laporan_anggota()
    {
        $this->db->where('role_id', 1);
        $data['anggota'] = $this->db->get('user')->result_array();
        
        $this->load->view('user/laporan_print_anggota', $data);
    }

    public function laporan_anggota_pdf()
    {
        $data['anggota'] = $this->db->get('user')->result_array();

        $this->load->library('pdf');
        $this->db->where('role_id', 1);

        $paper_size = 'A4'; // ukuran kertas
        $orientation = 'landscape'; //tipe format kertas potrait atau landscape

        $this->pdf->set_paper($paper_size, $orientation);
        //Convert to PDF
        $this->pdf->filename = "laporan_data_anggota.pdf";
        // nama file pdf yang di hasilkan
        $this->pdf->load_view('user/laporan_pdf_anggota', $data);
    }

    public function export_excel_anggota(){
		
		$data = array(
			'title'=>'Laporan Anggota',
            'anggota'=>$this->db->get('user')->result_array()
		);
		// $data['anggota'] = $this->db->get('user')->result_array();
        $this->load->view('user/export_excel_anggota', $data);
		// $this->load->model("excel_export_model");

      // $this->load->library("excel");

      // $object = new PHPExcel();

      // $object->setActiveSheetIndex(0);

      // $table_columns = array("No", "Nama","Email","Member Sejak","Image");

      // $column = 0;

      // foreach($table_columns as $field){

      //   $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);

      //   $column++;

      // }

      // $anggota = $this->db->get('user')->result_array();

      // $excel_row = 2;

      // 	$no = 1;
      // foreach($buku as $row){
      //   $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $no);

      //   $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row['nama']);

      //   $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row['email']);

      //   $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row['member_sejak']);

      //   $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row['image']);

      //   $excel_row++;
      //   $no++;

      // }

      // $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');

      // header('Content-Type: application/vnd.ms-excel');

      // header('Content-Disposition: attachment;filename="Data-anggota.xls"');

      // $object_writer->save('php://output');

    }

    public function laporan_pinjam()
    {
        $data['judul'] = 'Laporan Data Peminjaman';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['laporan'] = $this->db->query("select * from pinjam p,detail_pinjam d,buku b,user u where d.id_buku=b.id and p.id_user=u.id and p.no_pinjam=d.no_pinjam")->result_array();
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar', $data);
        $this->load->view('pinjam/laporan-pinjam', $data);
        $this->load->view('templates/footer');
    }

    public function cetak_laporan_pinjam()
    {
        $data['laporan'] = $this->db->query("select * from pinjam p,detail_pinjam d,buku b,user u where d.id_buku=b.id and p.id_user=u.id and p.no_pinjam=d.no_pinjam")->result_array();
        
        $this->load->view('pinjam/laporan-print-pinjam', $data);
    }

    public function laporan_pinjam_pdf()
    {
        {
            $data['laporan'] = $this->db->query("select * from pinjam p,detail_pinjam d,buku b,user u where d.id_buku=b.id and p.id_user=u.id and p.no_pinjam=d.no_pinjam")->result_array();

            $this->load->library('pdf');

            $paper_size = 'A4'; // ukuran kertas
            $orientation = 'landscape'; //tipe format kertas potrait atau landscape
    
            $this->pdf->set_paper($paper_size, $orientation);

            //Convert to PDF
            $this->pdf->filename = "laporan_data_pinjam.pdf";
            // nama file pdf yang di hasilkan
            $this->pdf->load_view('pinjam/laporan_pdf_pinjam', $data);
        }
    }

    public function export_excel_pinjam()
    {
		
		$data = array(
			'title'=>'Laporan Pinjam',
			'laporan'=>$this->db->query("select * from pinjam p,detail_pinjam d,buku b,user u where d.id_buku=b.id and p.id_user=u.id and p.no_pinjam=d.no_pinjam")->result_array()
		);
		// $data['laporan'] = $this->db->query("select * from pinjam p,detail_pinjam d,buku b,user u where d.id_buku=b.id and p.id_user=u.id and p.no_pinjam=d.no_pinjam")->result_array();
		$this->load->view('pinjam/export_excel_pinjam', $data);
		// $this->load->model("excel_export_model");

      // $this->load->library("excel");

      // $object = new PHPExcel();

      // $object->setActiveSheetIndex(0);

      // $table_columns = array("No", "Nama Anggota","Judul Buku","Tanggal Pinjam","Tanggal Kembali","Tanggal Pengembalian","Total Denda","Status");

      // $column = 0;

      // foreach($table_columns as $field){

      //   $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);

      //   $column++;

      // }

      // $buku = $this->ModelBuku->getBuku()->result_array();

      // $excel_row = 2;

      // 	$no = 1;
      // foreach($buku as $row){
      //   $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $no);

      //   $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row['nama']);

      //   $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row['judul_buku']);

      //   $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row['tgl_pinjam']);

      //   $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row['tgl_kembali']);

      //   $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row['tgl_pengembalian']);

      //   $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $row['total_denda']);

      //   $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $row['status']);

      //   $excel_row++;
      //   $no++;

      // }

      // $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');

      // header('Content-Type: application/vnd.ms-excel');

      // header('Content-Disposition: attachment;filename="Data-Pinjam.xls"');

      // $object_writer->save('php://output');

    }
}