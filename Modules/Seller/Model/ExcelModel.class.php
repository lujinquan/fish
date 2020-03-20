<?php
/**
 * lionfish 商城系统
 *
 * ==========================================================================
 * @link      http://www.liofis.com/
 * @copyright Copyright (c) 2015 liofis.com. 
 * @license   http://www.liofis.com/license.html License
 * ==========================================================================
 *
 * @author    fish
 *
 */
namespace Seller\Model;

class ExcelModel{
	
	
	protected function column_str($key)
	{
		$array = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ', 'BA', 'BB', 'BC', 'BD', 'BE', 'BF', 'BG', 'BH', 'BI', 'BJ', 'BK', 'BL', 'BM', 'BN', 'BO', 'BP', 'BQ', 'BR', 'BS', 'BT', 'BU', 'BV', 'BW', 'BX', 'BY', 'BZ', 'CA', 'CB', 'CC', 'CD', 'CE', 'CF', 'CG', 'CH', 'CI', 'CJ', 'CK', 'CL', 'CM', 'CN', 'CO', 'CP', 'CQ', 'CR', 'CS', 'CT', 'CU', 'CV', 'CW', 'CX', 'CY', 'CZ', 'DA', 'DB', 'DC', 'DD', 'DE', 'DF', 'DG', 'DH', 'DI', 'DJ', 'DK', 'DL', 'DM', 'DN', 'DO', 'DP', 'DQ', 'DR', 'DS', 'DT', 'DU', 'DV', 'DW', 'DX', 'DY', 'DZ', 'EA', 'EB', 'EC', 'ED', 'EE', 'EF', 'EG', 'EH', 'EI', 'EJ', 'EK', 'EL', 'EM', 'EN', 'EO', 'EP', 'EQ', 'ER', 'ES', 'ET', 'EU', 'EV', 'EW', 'EX', 'EY', 'EZ');
		return $array[$key];
	}

	protected function column($key, $columnnum = 1)
	{
		return $this->column_str($key) . $columnnum;
	}

	
	public function export_delivery_goodslist( $list, $params = array() )
	{
		if (PHP_SAPI == 'cli') {
			exit('This example should only be run from a Web Browser');
		}
		
		require_once ROOT_PATH . '/ThinkPHP/Library/Vendor/phpexcel/PHPExcel.php';
		$excel = new \PHPExcel();
		
		$excel->getProperties()->setCreator('狮子鱼商城')->setLastModifiedBy('狮子鱼商城')->setTitle('Office 2007 XLSX Test Document')->setSubject('Office 2007 XLSX Test Document')->setDescription('Test document for Office 2007 XLSX, generated using PHP classes.')->setKeywords('office 2007 openxml php')->setCategory('report file');
		$sheet = $excel->setActiveSheetIndex(0);
		$rownum = 1;
		
		$list_info = $params['list_info'];
		
		
		$sheet->setCellValue('A1', $list_info['line1']); 
		
		//$sheet->mergeCells('A1:C1');
		$rownum++;
		
		$sheet->setCellValue('A2', $list_info['line2']); 
		//$sheet->mergeCells('A2:C2');
		$rownum++;
		
		
		foreach ($params['columns'] as $key => $column ) {
			$sheet->setCellValue($this->column($key, $rownum), $column['title']);

			if (!(empty($column['width']))) {
				$sheet->getColumnDimension($this->column_str($key))->setWidth($column['width']);
			}

		}

		++$rownum;
		$len = count($params['columns']);

		foreach ($list as $row ) {
			$i = 0;

			while ($i < $len) {
				$value = ((isset($row[$params['columns'][$i]['field']]) ? $row[$params['columns'][$i]['field']] : ''));
				$sheet->setCellValue($this->column($i, $rownum), $value);
				++$i;
			}

			++$rownum;
		}
		
		
		
		$excel->getActiveSheet()->setTitle($params['title']);
		$filename = ($params['title'] . '-' . date('Y-m-d H:i', time()));
		
		
		$excel->getActiveSheet()->setTitle($params['title']);
		$filename = ($params['title'] . '-' . date('Y-m-d H:i', time()));
		
		header('pragma:public');
		header('Content-type:application/vnd.ms-excel;charset=utf-8;name="'.$params['title'].'.xls"');
		header("Content-Disposition:attachment;filename=".$filename.".xls");//attachment新窗口打印inline本窗口打印
		$objWriter = \PHPExcel_IOFactory::createWriter($excel, 'Excel5');
		$objWriter->save('php://output');
		exit;
		
	}
	
	/**
		批量导出团长配送清单
	**/
	public function export_delivery_list_pi( $params_list, $list = array() )
	{
		if (PHP_SAPI == 'cli') {
			exit('This example should only be run from a Web Browser');
		}
		
		require_once ROOT_PATH . '/ThinkPHP/Library/Vendor/phpexcel/PHPExcel.php';
		$excel = new \PHPExcel();
		
		$excel->getProperties()->setCreator('狮子鱼商城')->setLastModifiedBy('狮子鱼商城')->setTitle('Office 2007 XLSX Test Document')->setSubject('Office 2007 XLSX Test Document')->setDescription('Test document for Office 2007 XLSX, generated using PHP classes.')->setKeywords('office 2007 openxml php')->setCategory('report file');
		$sheet = $excel->setActiveSheetIndex(0);
		
		$rownum = 1;
		foreach( $params_list as  $params )
		{
			
			$list_info = $params['list_info'];
			
			$line1 = $list_info['head_name'];
			$line2 = '团长：'.$list_info['head_name'].'     提货地址：'.$list_info['head_address'].'     联系电话：'.$list_info['head_mobile'];
			$line3 = $list_info['list_sn'].'     时间：'.date('Y-m-d H:i:s', $list_info['create_time']);
			$line4 = '配送路线：'.$list_info['line_name'].'     配送员：'.$list_info['clerk_name'];
		
			$sheet->setCellValue('A'.$rownum, $line1); 
			
		
			$rownum++;
			
			$sheet->setCellValue('A'.$rownum, $line2); 
			$rownum++;
			
			$sheet->setCellValue('A'.$rownum, $line3); 
			
			$rownum++;
			
			$sheet->setCellValue('A'.$rownum, $line4); 
			
			$rownum++;
			$rownum++;
			
			 
			foreach ($list['columns'] as $key => $column ) {
				$sheet->setCellValue($this->column($key, $rownum), $column['title']);

				if (!(empty($column['width']))) {
					$sheet->getColumnDimension($this->column_str($key))->setWidth($column['width']);
				}

			}

			++$rownum;
			$len = count($list['columns']);

			
			
			foreach ($params['data'] as $row ) {
				$i = 0;

				
				while ($i < $len) {
					
					$value = ((isset($row[$list['columns'][$i]['field']]) ? $row[$list['columns'][$i]['field']] : ''));
					
					
					$sheet->setCellValue($this->column($i, $rownum), $value);
					++$i;
				}

				++$rownum;
			}
			
			$rownum++;
			$rownum++;
			
		}
		
		
		
		$excel->getActiveSheet()->setTitle($list['title']);
		
		
		$filename = ($list['title'] . '-' . date('Y-m-d H:i', time()));
		
		header('pragma:public');
		header('Content-type:application/vnd.ms-excel;charset=utf-8;name="'.$params['title'].'.xls"');
		header("Content-Disposition:attachment;filename=".$filename.".xls");//attachment新窗口打印inline本窗口打印
		$objWriter = \PHPExcel_IOFactory::createWriter($excel, 'Excel5');
		$objWriter->save('php://output');
		exit;
		
	}
	
	
	public function export_delivery_list($list, $params = array())
	{
		if (PHP_SAPI == 'cli') {
			exit('This example should only be run from a Web Browser');
		}
		
		require_once ROOT_PATH . '/ThinkPHP/Library/Vendor/phpexcel/PHPExcel.php';
		$excel = new \PHPExcel();
		
		$excel->getProperties()->setCreator('狮子鱼商城')->setLastModifiedBy('狮子鱼商城')->setTitle('Office 2007 XLSX Test Document')->setSubject('Office 2007 XLSX Test Document')->setDescription('Test document for Office 2007 XLSX, generated using PHP classes.')->setKeywords('office 2007 openxml php')->setCategory('report file');
		$sheet = $excel->setActiveSheetIndex(0);
		$rownum = 1;
		
		$list_info = $params['list_info'];
		
		$sheet->setCellValue('A1', $list_info['line1']); 
		
	
		//$sheet->mergeCells('A1:D1');
		$rownum++;
		
		$sheet->setCellValue('A2', $list_info['line2']); 
		//$sheet->mergeCells('A2:D2');
		$rownum++;
		
		$sheet->setCellValue('A3', $list_info['line3']); 
		//$sheet->mergeCells('A3:D3');
		$rownum++;
		
		$sheet->setCellValue('A4', $list_info['line4']); 
		//$sheet->mergeCells('A4:D4');
		$rownum++;
		
		 
		foreach ($params['columns'] as $key => $column ) {
			$sheet->setCellValue($this->column($key, $rownum), $column['title']);

			if (!(empty($column['width']))) {
				$sheet->getColumnDimension($this->column_str($key))->setWidth($column['width']);
			}

		}

		++$rownum;
		$len = count($params['columns']);

		foreach ($list as $row ) {
			$i = 0;

			while ($i < $len) {
				$value = ((isset($row[$params['columns'][$i]['field']]) ? $row[$params['columns'][$i]['field']] : ''));
				$sheet->setCellValue($this->column($i, $rownum), $value);
				++$i;
			}

			++$rownum;
		}
		 
		
		
		$excel->getActiveSheet()->setTitle($params['title']);
		$filename = ($params['title'] . '-' . date('Y-m-d H:i', time()));
		
		
		header('pragma:public');
		header('Content-type:application/vnd.ms-excel;charset=utf-8;name="'.$params['title'].'.xls"');
		header("Content-Disposition:attachment;filename=".$filename.".xls");//attachment新窗口打印inline本窗口打印
		$objWriter = \PHPExcel_IOFactory::createWriter($excel, 'Excel5');
		$objWriter->save('php://output');
		exit;
		
	}

	public function export_delivery_all_list($list, $params = array())
	{
		if (PHP_SAPI == 'cli') {
			exit('This example should only be run from a Web Browser');
		}
		
		require_once ROOT_PATH . '/ThinkPHP/Library/Vendor/phpexcel/PHPExcel.php';
		$excel = new \PHPExcel();
		
		$excel->getProperties()->setCreator('狮子鱼商城')->setLastModifiedBy('狮子鱼商城')->setTitle('Office 2007 XLSX Test Document')->setSubject('Office 2007 XLSX Test Document')->setDescription('Test document for Office 2007 XLSX, generated using PHP classes.')->setKeywords('office 2007 openxml php')->setCategory('report file');
		$sheet = $excel->setActiveSheetIndex(0);
		$rownum = 1;
		
		$list_info = $params['list_info'];
		
		$sheet->setCellValue('A1', $list_info['line1']); 
		
	
		//$sheet->mergeCells('A1:D1');
		$rownum++;
		
		$sheet->setCellValue('A2', $list_info['line2']); 
		//$sheet->mergeCells('A2:D2');
		$rownum++;
		
		$sheet->setCellValue('A3', $list_info['line3']); 
		//$sheet->mergeCells('A3:D3');
		$rownum++;
		
		$sheet->setCellValue('A4', $list_info['line4']); 
		//$sheet->mergeCells('A4:D4');
		$rownum++;
		
		 
		foreach ($params['columns'] as $key => $column ) {
			$sheet->setCellValue($this->column($key, $rownum), $column['title']);

			if (!(empty($column['width']))) {
				$sheet->getColumnDimension($this->column_str($key))->setWidth($column['width']);
			}

		}

		++$rownum;
		$len = count($params['columns']);

		foreach ($list as $row ) {
			$i = 0;

			while ($i < $len) {
				$value = ((isset($row[$params['columns'][$i]['field']]) ? $row[$params['columns'][$i]['field']] : ''));
				$sheet->setCellValue($this->column($i, $rownum), $value);
				++$i;
			}

			++$rownum;
		}
		 
		
		
		$excel->getActiveSheet()->setTitle($params['title']);
		$filename = ($params['title'] . '-' . date('Y-m-d H:i', time()));
		
		
		header('pragma:public');
		header('Content-type:application/vnd.ms-excel;charset=utf-8;name="'.$params['title'].'.xls"');
		header("Content-Disposition:attachment;filename=".$filename.".xls");//attachment新窗口打印inline本窗口打印
		$objWriter = \PHPExcel_IOFactory::createWriter($excel, 'Excel5');
		$objWriter->save('php://output');
		exit;
		
	}
	
	
	/**
     * 导出Excel
     * @param type $list
     * @param type $params
     */
	public function export($list, $params = array())
	{
		if (PHP_SAPI == 'cli') {
			exit('This example should only be run from a Web Browser');
		}
		
//ThinkPHP\Library\Vendor\ROOT_PATH

		require_once ROOT_PATH . '/ThinkPHP/Library/Vendor/phpexcel/PHPExcel.php';
		$excel = new \PHPExcel();
		
		$excel->getProperties()->setCreator('狮子鱼商城')->setLastModifiedBy('狮子鱼商城')->setTitle('Office 2007 XLSX Test Document')->setSubject('Office 2007 XLSX Test Document')->setDescription('Test document for Office 2007 XLSX, generated using PHP classes.')->setKeywords('office 2007 openxml php')->setCategory('report file');
		$sheet = $excel->setActiveSheetIndex(0);
		$rownum = 1;

		foreach ($params['columns'] as $key => $column ) {
			$sheet->setCellValue($this->column($key, $rownum), $column['title']);

			if (!(empty($column['width']))) {
				$sheet->getColumnDimension($this->column_str($key))->setWidth($column['width']);
			}

		}

		++$rownum;
		$len = count($params['columns']);

		foreach ($list as $row ) {
			$i = 0;

			while ($i < $len) {
				$value = ((isset($row[$params['columns'][$i]['field']]) ? $row[$params['columns'][$i]['field']] : ''));
				$sheet->setCellValue($this->column($i, $rownum), $value);
				++$i;
			}

			++$rownum;
		}

		$excel->getActiveSheet()->setTitle($params['title']);
		$filename = ($params['title'] . '-' . date('Y-m-d H:i', time()));
		
		
		
		header('pragma:public');
		header('Content-type:application/vnd.ms-excel;charset=utf-8;name="'.$params['title'].'.xls"');
		header("Content-Disposition:attachment;filename=".$filename.".xls");//attachment新窗口打印inline本窗口打印
		$objWriter = \PHPExcel_IOFactory::createWriter($excel, 'Excel5');
		$objWriter->save('php://output');
		exit;
	}

	/**
     * @param $objWriter PHPExcel_Writer_IWriter
     */
	public function SaveViaTempFile($objWriter)
	{
		$filePath = '' . rand(0, getrandmax()) . rand(0, getrandmax()) . '.tmp';
		$objWriter->save($filePath);
		readfile($filePath);
		unlink($filePath);
	}

	/**
     * 生成模板文件Excel
     * @param type $list
     * @param type $params
     */
	public function temp($title, $columns = array())
	{
		if (PHP_SAPI == 'cli') {
			exit('This example should only be run from a Web Browser');
		}

		require_once ROOT_PATH . '/ThinkPHP/Library/Vendor/phpexcel/PHPExcel.php';
		$excel = new \PHPExcel();
		$excel->getProperties()->setCreator('狮子鱼商城')->setLastModifiedBy('狮子鱼商城')->setTitle('Office 2007 XLSX Test Document')->setSubject('Office 2007 XLSX Test Document')->setDescription('Test document for Office 2007 XLSX, generated using PHP classes.')->setKeywords('office 2007 openxml php')->setCategory('report file');
		$sheet = $excel->setActiveSheetIndex(0);
		$rownum = 1;

		foreach ($columns as $key => $column ) {
			$sheet->setCellValue($this->column($key, $rownum), $column['title']);

			if (!(empty($column['width']))) {
				$sheet->getColumnDimension($this->column_str($key))->setWidth($column['width']);
			}

		}

		++$rownum;
		$len = count($columns);
		$k = 1;

		while ($k <= 5000) {
			$i = 0;

			while ($i < $len) {
				$sheet->setCellValue($this->column($i, $rownum), '');
				++$i;
			}

			++$rownum;
			++$k;
		}

		$excel->getActiveSheet()->setTitle($title);
		$filename = ($title);
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment;filename="' . $filename . '.xls"');
		header('Cache-Control: max-age=0');
		$writer = \PHPExcel_IOFactory::createWriter($excel, 'Excel5');
		$writer->save('php://output');
		exit();
	}

	public function import($excefile)
	{
	
		require_once ROOT_PATH . '/ThinkPHP/Library/Vendor/phpexcel/PHPExcel.php';
		require_once ROOT_PATH . '/ThinkPHP/Library/Vendor/phpexcel/PHPExcel/IOFactory.php';
		require_once ROOT_PATH . '/ThinkPHP/Library/Vendor/phpexcel/PHPExcel/Reader/Excel5.php';
		$path = ROOT_PATH . '/Uploads/image/'.date('Y-m-d').'/';

		if (!(is_dir($path))) {
			RecursiveMkdir($path);
		}


		$filename = $_FILES[$excefile]['name'];
		$tmpname = $_FILES[$excefile]['tmp_name'];

		if (empty($tmpname)) {
			message('请选择要上传的Excel文件!', '', 'error');
		}


		$ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

		if (($ext != 'xlsx') && ($ext != 'xls')) {
			//message('请上传 xls 或 xlsx 格式的Excel文件!', '', 'error');
		}


		$file = time() . 1 . '.' . $ext;
		$uploadfile = $path . $file;
		$result = move_uploaded_file($tmpname, $uploadfile);

		if (!($result)) {
			//message('上传Excel 文件失败, 请重新上传!', '', 'error');
		}


		$reader = \PHPExcel_IOFactory::createReader(($ext == 'xls' ? 'Excel5' : 'Excel2007'));
		$excel = $reader->load($uploadfile);
		$sheet = $excel->getActiveSheet();
		$highestRow = $sheet->getHighestRow();
		$highestColumn = $sheet->getHighestColumn();
		$highestColumnCount = \PHPExcel_Cell::columnIndexFromString($highestColumn);
		$values = array();
		$row = 1;

		while ($row <= $highestRow) {
			$rowValue = array();
			$col = 0;

			while ($col < $highestColumnCount) {
				$rowValue[] = (string) $sheet->getCellByColumnAndRow($col, $row)->getValue();
				++$col;
			}

			$values[] = $rowValue;
			++$row;
		}

		return $values;
	}
	
	
}
?>