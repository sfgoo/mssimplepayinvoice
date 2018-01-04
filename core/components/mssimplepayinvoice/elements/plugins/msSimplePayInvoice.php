<?php
switch ($modx->event->name) {
    
    case 'msOnCreateOrder':
        
        error_reporting(E_ALL);
        
        $year               = date('Y');
        $month              = date('m');
        $day                = date('d');
        $time               = time();
        
        $payment_ids        = $modx->getOption('mssimplepayinvoice.payment', null, 1); 
        $tplWrapper         = $modx->getOption('mssimplepayinvoice.tplWrapper', null, 'tpl.mssimplepayinvoiceWrapper');
        $tplRow             = $modx->getOption('mssimplepayinvoice.tplRow', null, 'tpl.mssimplepayinvoiceRow');
        $pdfPath            = $modx->getOption('mssimplepayinvoice.pdfPath', null, MODX_ASSETS_PATH.'pdf/'.$year.'/'.$month.'/');
        $emailFrom          = $modx->getOption('mssimplepayinvoice.emailFrom', null, $modx->getOption('emailsender'));
        $nameFrom           = $modx->getOption('mssimplepayinvoice.nameFrom', null, $modx->getOption('site_name'));
        $mailSubject        = $modx->getOption('mssimplepayinvoice.mailSubject', null, 'Pay Invoice');
        $mailBody           = $modx->getOption('mssimplepayinvoice.mailBody', null, 'Pay Invoice');
        
        $products           = array();
        $wrapper            = array();
        $rows               = ''; 
        $pdoTools           = $modx->getService('pdoTools'); // for using fenom style
        
        $payment_ids_arr    = explode(',', $payment_ids);
        $mspPayment         = $msOrder->get('payment');
        
        if (!in_array($mspPayment, $payment_ids_arr)) return ; 
  
        // get user profile
        $user_id = $msOrder->get('user_id');
        $profile = $modx->getObject('modUserProfile', array('internalKey' => $user_id));
        
        if ($profile) { 
           $wrapper['mspEmail']     = $profile->get('email');  
        }else{
            return;
        }
        
        
        $mspId                      = $msOrder->get('id'); 
        
        $wrapper['mspCreatedon']    = $msOrder->get('createdon');
        $wrapper['mspCost']         = $msOrder->get('cost');
        $wrapper['mspNum']          = $msOrder->get('num');
        $wrapper['mspCart_cost']    = $msOrder->get('cart_cost');
        $wrapper['mspDelivery_cost']= $msOrder->get('delivery_cost'); 
        
        
        // user address fields
        $msAddress                  = $msOrder->getOne('Address');
        $wrapper['mspName']         = $msAddress->get('receiver');
        $wrapper['mspPhone']        = $msAddress->get('phone');
        $wrapper['mspIndex']        = $msAddress->get('index');
        $wrapper['mspCountry']      = $msAddress->get('country');
        $wrapper['mspRegion']       = $msAddress->get('region');
        $wrapper['mspCity']         = $msAddress->get('city');
        $wrapper['mspMetro']        = $msAddress->get('metro');
        $wrapper['mspStreet']       = $msAddress->get('street');
        $wrapper['mspBuilding']     = $msAddress->get('building');
        $wrapper['mspRoom']         = $msAddress->get('room');
        $wrapper['mspComment']      = $msAddress->get('comment');
        
     
        
        // get order products
        foreach ($msOrder->getMany('Products') as $orderProduct) { 
            
            $products['product_id'] =  $orderProduct->get('product_id');
            $products['name']       =  $orderProduct->get('name');
            $products['price']      =  $orderProduct->get('price');
            $products['cost']       =  $orderProduct->get('cost');
            $products['article']    =  $orderProduct->get('article');
            $products['weight']     =  $orderProduct->get('weight');
            $products['thumb']      =  $orderProduct->get('thumb'); 
            $products['count']      =  $orderProduct->get('count');
            
            $rows                  .= $pdoTools->getChunk($tplRow,$products); 
        }
        
        
        $wrapper['rows']            = $rows;
        $output                    .= $pdoTools->getChunk($tplWrapper,$wrapper); 
        
        
        // make path and pdf file
        if(!@mkdir($pdfPath, 0755, true)){
            $modx->log(modX::LOG_LEVEL_ERROR,'Cant create folder, check permision and full path: '.$pdfPath);
        }
        
        
        
        $pdfTitle                   =  $day.'.'.$month.'.'.$year.'-'.str_replace('/','_',$wrapper['mspNum']); 
        $pdfFile                    = $pdfPath.$pdfTitle.'.pdf';
        
        
        require_once  MODX_ASSETS_PATH.'components/mssimplepayinvoice/mpdf/vendor/autoload.php';
        $mpdf                       = new mPDF('utf-8','A4','','','10','10','10','5'); 
        
        
        $mpdf->SetHTMLHeader('');
        $mpdf->SetHTMLFooter('');
        
        
        $mpdf->WriteHTML($output);
        $mpdf->Output($pdfFile, 'F'); 
        
        // send mail
        $modx->getService('mail', 'mail.modPHPMailer');
        $modx->mail->mailer->AddAttachment($pdfFile); 
        
        $modx->mail->set(modMail::MAIL_BODY, $mailBody);
        $modx->mail->set(modMail::MAIL_FROM, $emailFrom);
        $modx->mail->set(modMail::MAIL_FROM_NAME, $nameFrom);
        $modx->mail->set(modMail::MAIL_SUBJECT, $mailSubject);
        $modx->mail->address('to', $wrapper['mspEmail']);
        $modx->mail->setHTML(true);
        
        if (!$modx->mail->send()) {
            $modx->log(modX::LOG_LEVEL_ERROR,'An error occurred while trying to send the email (plugin msSimplePayInvoice): '.$modx->mail->mailer->ErrorInfo);
        } 
        
        break;
 
}