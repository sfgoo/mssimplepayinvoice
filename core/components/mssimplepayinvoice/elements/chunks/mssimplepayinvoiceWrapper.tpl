<table width="100%"  style="font-family: Arial;">
    <tr>
        <td width="30%" valign="top">
            <!-- place for logo -->    
        </td>
        <td width="50%" valign="top"  style="font-size: 12px;">
            <p  style="font-size: 18px;">Company name Ltd.</p>
            <p>Company address data</p> 
            <p>Phone: +11 11 111 111 11</p>
            <p>Email: info@site.com</p>
        </td>
        <td width="20%" valign="top" align="right" style="text:align: right; font-family: Arial;">
            <h2>Invoice</h2>
        </td>
    </tr>
</table>

<br>
<hr>
<br>
<br>

<table width="100%" style="font-size: 12px; font-family: Arial;">
    <tr>
        <td width="50%" valign="top" >   
            <table width="100%">
                <tr>
                    <td width="100px"  valign="top" > 
                        <strong>Bill to</strong>
                    </td>
                    <td>
                        <table>
                            <tr>
                                <td>Name:</td>          
                                <td>[[+mspName]]</td>
                            </tr>
                            <tr>
                                <td>Email:</td>         
                                <td>[[+mspEmail]]</td>
                            </tr>
                            <tr>
                                <td>Phone:</td>         
                                <td>[[+mspPhone]]</td>
                            </tr>
                            <tr>
                                <td>Index:</td>         
                                <td>[[+mspIndex]]</td>
                            </tr>
                            <tr>
                                <td>Country:</td>       
                                <td>[[+mspCountry]]</td>
                            </tr>
                            <tr>
                                <td>City:</td>          
                                <td>[[+mspCity]]</td> 
                            </tr>
                            <tr>
                                <td>Region:</td>        
                                <td>[[+mspRegion]]</td>
                            </tr>
                            <tr>
                                <td>Metro:</td>         
                                <td>[[+mspMetro]]</td>
                            </tr>
                            <tr>
                                <td>Street:</td>        
                                <td>[[+mspStreet]]</td>
                            </tr>
                            <tr>
                                <td>Building:</td>      
                                <td>[[+mspBuilding]]</td>
                            </tr>
                            <tr>
                                <td>Room:</td>          
                                <td[[+mspRoom]]></td>
                            </tr>
                            <tr>
                                <td>Comment:</td>       
                                <td>[[+mspComment]]</td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
  
        
        <td width="50%" valign="top" > 
            <table width="100%" style="text-align: right">
                <tr>
                    <td width="150px" valign="top" > 
                        <strong>Invoice Number</strong>
                    </td>
                    <td>
                        [[+mspNum]]
                    </td>
                </tr>
                <tr>
                    <td width="50px"> 
                        <strong>Date</strong>
                    </td>
                    <td>
                        [[+mspCreatedon]]
                    </td>
                </tr>
            </table> 
        </td>
         
    </tr>
</table>



<br>
<br>
<br>


<table  width="100%" border="1" style="border-collapse: collapse; border: 1px solid #dddddd; padding: 10px; width: 100%; font-size: 13px; font-family: Arial;" cellpadding="10">
    <thead>
        <tr>
            <th align="left" width="50%">Name</th>
            <th align="left" width="15%">Unit price</th>
            <th align="left" width="10%">Weight</th>
            <th align="left" width="10%">Quantity</th>
            <th align="left" width="15%">Amount</th>
        </tr>
    </thead>
    
    <tbody> 
        [[+rows]]
    </tbody> 
</table>

<table style="width: 100%;" width="100%" cellpadding="10" cellspacing="0">  
        
    <tr>
        <td colspan="2" width="55%"></td> 
        <td width="20%"  style="border-bottom: 1px solid #000;">Subtotal</td>
        <td width="20%"  style="border-bottom: 1px solid #000;">[[+mspCart_cost]] [[%ms2_frontend_currency]]</td>
    </tr>
    
    <tr>
        <td colspan="2" width="55%"></td> 
        <td width="20%"  style="border-bottom: 1px solid #000;">Shipping</td>
        <td width="20%"  style="border-bottom: 1px solid #000;">[[+mspDelivery_cost]] [[%ms2_frontend_currency]]</td>
    </tr>
    
    <tr>
        <td colspan="2" width="55%"></td> 
        <td width="20%"><b>Total</b></td>
        <td width="20%"><b>[[+mspCost]]</b> [[%ms2_frontend_currency]]</td>
    </tr>
         
</table>

