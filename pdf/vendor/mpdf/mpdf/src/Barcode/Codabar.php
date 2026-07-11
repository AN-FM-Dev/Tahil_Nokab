<?php

namespace Mpdf\Barcode;

/**
 * CODABAR barcodes.
 * Older code often used in library systems, sometimes in blood banks
 */
class Codabar extends \Mpdf\Barcode\AbstractBarcode implements \Mpdf\Barcode\BarcodeInterface
{

	/**
	 * @param string $code
	 * @param float $printRatio
	 */
	public function __construct($code, $printRatio, $quiet_zone_left = null, $quiet_zone_right = null)
	{
		$this->init($code, $printRatio);

		$this->data['nom-X'] = 0.381; // Nominal value for X-dim (bar width) in mm (2 X min. spec.)
		$this->data['nom-H'] = 10; // Nominal value for Height of Full bar in mm (non-spec.)
		$this->data['lightmL'] = ($quiet_zone_left !== null ? $quiet_zone_left : 10); // LEFT light margin =  x X-dim (spec.)
		$this->data['lightmR'] = ($quiet_zone_right !== null ? $quiet_zone_right : 10); // RIGHT light margin =  x X-dim (spec.)
		$this->data['lightTB'] = 0; // TOP/BOTTOM light margin =  x X-dim (non-spec.)
	}

	/**
	 * @param string $code
	 * @param float $printRatio
	 */
	private function init($code, $printRatio)
	{
		$chr = [
			'0' => '11_111221',
			'1' => '11_112211',
			'2' => '11121121',
			'3' => '2211_1111',
			'4' => '11211211',
			'5' => '211_11211',
			'6' => '1211_1121',
			'7' => '12112111',
			'8' => '12211_111',
			'9' => '211211_11',
			'-' => '11122111',
			'$' => '112211_11',
			':' => '21112_121',
			'/' => '21211121',
			'.' => '212_12111',
			'+' => '11222221',
			'A' => '11221211',
			'B' => '12_121121',
			'C' => '1112_1221',
			'D' => '11122211'
		];

		$bararray = ['code' => $code, 'maxw' => 0, 'maxh' => 1, 'bcode' => []];
		$k = 0;

		$code = strtoupper($code);
		$len = strlen($code);

		for ($i = 0; $i < $len; ++$i) {

			if (!isset($chr[$code[$i]])) {
				throw new \Mpdf\Barcode\BarcodeException(sprintf('Invalid character "%s" in CODABAR barcode value "%s"', $code[$i], $code));
			}

			$seq = $chr[$code[$i]];

			for ($j = 0; $j < 8; ++$j) {
				if (($j % 2) == 0) {
					$t = true; // bar
				} else {
					$t = false; // space
				}
				$x = $seq[$j];
				if ($x == 2) {
					$w = $printRatio;
				} else {
					$w = 1;
				}
				$bararray['bcode'][$k] = ['t' => $t, 'w' => $w, 'h' => 1, 'p' => 0];
				$bararray['maxw'] += $w;
				++$k;
			}
		}

		$this->data = $bararray;
	}

	public function getType()
	{
		return 'CODABAR';
	}

}
