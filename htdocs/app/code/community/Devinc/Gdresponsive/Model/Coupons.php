<?php

class Devinc_Gdresponsive_Model_Coupons extends Devinc_Groupdeals_Model_Coupons
{		

	//generate coupon html
	public function getCouponHtml($_groupdeal, $_storeId, $_coupon = null, $_orderItem = null, $_customerName = 'JOHN DOE')
	{
		$html = parent::getCouponHtml($_groupdeal, $_storeId, $_coupon, $_orderItem, $_customerName);
		$html = str_replace('</body>', '', $html);
		$html = str_replace('</html>', '', $html);
		if (Mage::getStoreConfig('groupdeals/configuration/responsive')) {
			$html .= '<style type="text/css">
						@media only screen and (max-width: 480px) {
							#couponTable { background:none !important; }
							#couponTable * {
								-moz-box-sizing: border-box;
							  	-webkit-box-sizing: border-box;
							  	box-sizing: border-box;
							}
							.gd-logo { padding:15px 17px; }
							.gd-logo img { width:100px; }
							.gd-main { padding:5px 0px 0px; }
							.gd-title { font-size:14px; }
							#gd-image { width: 100%; }
							#gd-info { width: 100%; }			     	
					    }
					  </style>';
		}
		$html .= '</body></html>';
			
		return $html;
	}
}