<?php
   function sendMail($to, $subject, $message) {
      $headers = array(
         'MIME-Version' => '1.0',
         'Content-type' => 'text/html;charset=UTF-8',
         'From' => 'biuro@mbsrent.pl',
         'Reply-To' => 'biuro@mbsrent.pl'
      );

      $name = "biuro@mbsrent.pl";

      mail($to, $subject, $message, $headers);
   }
?>