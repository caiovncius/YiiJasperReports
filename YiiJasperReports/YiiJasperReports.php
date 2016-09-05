<?php 
/**
 * YJasperReport
 * Simples extension of Yii Framework for execute and exports JasperReports.
 * 
 * @author Caio Vncius <caio@vncius.com>
 * @version 1.0.0
 */

class YiiJasperReports extends CComponent
{
	// define jasoer server uri - example: http://localhost:8080/jasperserver
	protected $jasperUri = 'http://localhost:8080/jasperserver';

	// define username to login
	protected $username = 'jusername';

	// define password to login
	protected $password = 'jpassword';

	/**
	 * Define default params of execute report;
	 * @var string
	 */
	protected $format = 'pdf';
	protected $pages;
	protected $params;
	protected $download = false;
	protected $reportUri;
	protected $filename = null;

	public function __construct($reportUri, $params = null, $format = null , $pages = null)
	{
		$this->reportUri = $reportUri;
		$this->download = $download;

		if($fileName != null)
			$this->filename = $fileName;

		if($format != null)
			$this->format = $format;

		if($params != null)
			$this->params = self::formatParams($params);

		if($pages != null)
			$this->pages = $pages;

		
	}

	public static function formatParams($params)
	{
		$reportParams = '';
		if(!empty($params))
		{
			foreach($params as $param => $value) {
				$reportParams .= $param . '=' . $value . '&';
			}
		}
		
		return $reportParams;
	}

	public function executeReport()
	{
		if($this->download == false) 
			$reportUri = $this->jasperUri . '/rest_v2/reports/'. $this->reportUri . '.' . $this->format . '?' . rtrim($this->params, "&");

		$curl = curl_init($reportUri);
        curl_setopt($curl, CURLOPT_URL, $reportUri);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_USERPWD, "$this->username:$this->password");
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($curl, CURLOPT_HEADER, 0);
        
        $report = curl_exec($curl);
        self::getHeader($this->format);
        echo $report;
	}

	public static function getHeader($output)
	{
		switch ($output) {
			case 'pdf':
				return header('Content-type: application/pdf');
				break;
			
			default:
				return header('Content-type: text/html');
				break;
		}
	}
}
?>