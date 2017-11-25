<?php
/* @var $this yii\web\View */
/* @var $otp string */
/* @var $lang string */
?>
<html>
<head>
    <title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
</head>
<body>
<?php if ($lang == 'vi'): ?>
    Cám ơn Quý khách đã đặt phòng tại website http://ov.cocobay.vn. Mã OTP của Quý khách là: <span style='color: red; font-weight: bold'> <?= $otp ?> </span>.
    Quý khách hãy nhập mã vào trang web để hoàn tất giao dịch. Mã này chỉ có giá trị trong 10 phút.
<?php else: ?>
    Thanks for booking room at http://ov.cocobay.vn. Your OTP code is: <span style='color: red; font-weight: bold'> <?= $otp ?> </span>.
    OTP only valid for 10 minutes
<?php endif ?>
</body>