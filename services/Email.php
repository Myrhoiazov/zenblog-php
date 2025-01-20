<?php 

namespace Service;

class Email {


	public function send_mail(array $to, string $subject, string $tpl, array $data = [], array $attachments = []): bool
	{
		$mail = new \PHPMailer\PHPMailer\PHPMailer(true);
		
		try {
			//Server settings
			$mail->SMTPDebug = EMAIL['debug'];
			$mail->isSMTP();
			$mail->Host = EMAIL['host'];
			$mail->SMTPAuth = EMAIL['auth'];
			$mail->Username = EMAIL['username'];
			$mail->Password = EMAIL['password'];
			$mail->SMTPSecure = EMAIL['secure'];
			$mail->Port = EMAIL['port'];

			//Recipients
			$mail->setFrom(EMAIL['from_email']);
			foreach ($to as $email) {
				$mail->addAddress($email);
			}

			//Attachments
			if ($attachments) {
				foreach ($attachments as $attachment) {
					$mail->addAttachment($attachment);
				}
			}

			//Content
			$mail->isHTML(EMAIL['is_html']);
			$mail->Subject = $subject;
			$mail->Body = viewEmail($tpl, $data, false);

			$mail->CharSet = EMAIL['charset'];

			return $mail->send();

		} catch (\PHPMailer\PHPMailer\Exception $e) {
			error_log("[" . date('Y-m-d H:i:s') . "] Mail Error: {$mail->ErrorInfo}" . PHP_EOL, 3, ERROR_LOG_FILE);
			return false;
		}
	}

}