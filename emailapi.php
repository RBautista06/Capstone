<?php
        use PHPMailer\PHPMailer\PHPMailer;
          $mail->isSMTP();
                        $mail->Host       = 'smtp.gmail.com';
                        $mail->SMTPAuth   = true;
                        $mail->Username   = 'railleynickoleivincebautista@gmail.com'; // Your Gmail address
                        $mail->Password   = 'zbcn thtx qsbs ldfv'; // Your Gmail password or app-specific password
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                        $mail->Port       = 465;
?>
