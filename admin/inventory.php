<!-- write a php code for razorpay integration  -->
<?php
include('config.php');

$razorpay = new Razorpay\Api\Api($key_id, $key_secret);

$razorpay->setBaseUrl('https://api.razorpay.com');

$razorpay->setKey($key_id);

$razorpay->setSecret($key_secret);

$razorpay->setVersion('2.9.0');

$data = $razorpay->customer->create(array('name' => 'Razorpay User 21', 'email' => 'customer21@razorpay.com','fail_existing'=>'0'));
