<?php
/**
 * Created by PhpStorm.
 * User: Team
 * Date: 10/12/2016
 * Time: 1:29 PM
 */

namespace common\utils\helpers;

use Yii;
use yii\base\Exception;

/**
 * Class Mail
 * @property string $content
 * @property string $subject
 * @property string $mailTo
 * @package common\utils\model
 */
class Mail
{
    private $content;
    private $subject;
    private $mailTo;

    /**
     * SendMail constructor.
     *
     * @param array $params
     */
    public function __construct(array $params = [])
    {
        $this->content = ArrayHelper::getValue($params, 'content', '');
        $this->subject = ArrayHelper::getValue($params, 'subject', '');
        $this->mailTo  = ArrayHelper::getValue($params, 'mailTo', '');
    }

    /**
     * Hàm gửi single mail
     *
     * @param string $layout
     * @param array $params
     *
     * @return bool|string
     */
    public function send($layout = '', array $params = array())
    {
        try {
            if ($layout == '') {
                return Yii::$app->mailer->compose()
                                        ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name])
                                        ->setTo($this->mailTo)
                                        ->setSubject($this->subject)
                                        ->setTextBody($this->content)
                                        ->send();
            }

            return Yii::$app->mailer->compose($layout, $params)
                                    ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name])
                                    ->setTo($this->mailTo)
                                    ->setSubject($this->subject)
                                    ->send();
        } catch (Exception $e) {
            Yii::warning("Không thể gửi mail tới {$this->mailTo}", 'system');

            return $e->getMessage();
        }
    }

    /**
     * Hàm gửi mail cho nhiều người 1 lúc
     *
     * @param string $layout
     * @param array $params
     * @param array $emails
     *
     * @return int|string
     */
    public function sendMultiple($layout = '', array $params = array(), array $emails = array())
    {
        $mails = [];
        foreach ($emails as $email) {
            if ($layout == '') {
                $mails[] = Yii::$app->mailer->compose()
                                            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name])
                                            ->setTo($email)
                                            ->setSubject($this->subject)
                                            ->setTextBody($this->content)
                                            ->send();
            } else {
                $mails[] = Yii::$app->mailer->compose($layout, $params)
                                            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name])
                                            ->setTo($email)
                                            ->setSubject($this->subject)
                                            ->send();
            }
        }
        try {
            return Yii::$app->mailer->sendMultiple($mails);
        } catch (Exception $e) {
            $email = implode(',', $emails);
            Yii::warning("Không thể gửi mail tới {$email}", 'system');

            return $e->getMessage();
        }
    }

    /**
     * Chức năng gửi OTP qua mail, truyền vào ['mailTo' => $mail]
     * @throws Exception
     */
    public function sendOtp()
    {
        $otp           = Yii::$app->security->generateOtp();
        $this->subject = Yii::t('yii', 'Verification code');
        $this->send('otp', ['otp' => $otp, 'lang' => Yii::$app->language]);
    }
}