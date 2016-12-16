<?php
/** .-------------------------------------------------------------------
 * |  Software: [HDCMS framework]
 * |      Site: www.hdcms.com
 * |-------------------------------------------------------------------
 * |    Author: 向军 <2300071698@qq.com>
 * |    WeChat: aihoudun
 * | Copyright (c) 2012-2019, www.houdunwang.com. All Rights Reserved.
 * '-------------------------------------------------------------------*/
namespace houdunwang\alipay;

require_once( __DIR__."/lib/alipay_core.function.php" );
require_once( __DIR__."/lib/alipay_md5.function.php" );

use houdunwang\alipay\lib\AlipaySubmit;

/**
 * 支付宝
 * Class Alipay
 * @package Hdphp\Alipay
 * @author 向军
 */
class AliPay {
	protected $config = [ ];

	public function config( $config ) {
		$this->config = $config;
	}

	public function pay( $data ) {
		//构造要请求的参数数组，无需改动
		$parameter = [
			"service"           => "create_direct_pay_by_user",
			"partner"           => $this->config['partner'],
			"seller_email"      => $this->config['seller_email'],
			"payment_type"      => $this->config['payment_type'],
			"notify_url"        => $this->config['notify_url'],
			"return_url"        => $this->config['return_url'],
			"out_trade_no"      => $data['out_trade_no'],
			"subject"           => $data['subject'],
			"total_fee"         => $data['total_fee'],
			"body"              => $data['body'],
			"show_url"          => $data['show_url'],
			"anti_phishing_key" => '',
			"exter_invoke_ip"   => '',
			"_input_charset"    => $this->config['input_charset']
		];
		//建立请求
		$alipaySubmit = new AlipaySubmit( $this->config );
		echo $alipaySubmit->buildRequestForm( $parameter, "get", "确认" );
	}
}