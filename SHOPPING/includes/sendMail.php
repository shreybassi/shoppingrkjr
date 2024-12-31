<?php

function sendmail( $Sender, $Recipient, $Subject, $Body, $Type )
{
    switch ( $Type )
    {
        case "TEXT":
            $Header  = "From: $Sender\n";
            break;
        case "HTML":
            $Header  = "From: $Sender\n";
            $Header .= "MIME-Version: 1.0\n";
            $Header .= "Content-type: text/html; charset=iso-8859-1\n";
            break;
    }
    return mail( $Recipient, $Subject, $Body, $Header );
}

?>