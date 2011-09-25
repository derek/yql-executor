<?php
    header("content-type: application/json");

    $js = stripslashes($_POST['text']);
    
    $keys = explode(",", $_POST['keys']);
    $keys = array_filter($keys);
    $xml = '<?xml version="1.0" encoding="UTF-8"?>
    <table xmlns="http://query.yahooapis.com/v1/schema/table.xsd">
      <meta>
        <author></author>
        <documentationURL></documentationURL>
        <sampleQuery></sampleQuery>
      </meta>
      <bindings>
        <select itemPath="" produces="XML">
          <inputs>';
          
          if (count($keys)){
              
                  foreach ($keys as $k) {
                      $xml .= '<key id="' . $k . '" type="xs:string" paramType="variable" required="true" />';
                  }
          }
          
          $xml .='
          </inputs>
          <execute><![CDATA[';
    
    $xml .= $js;

    $xml .= ']]></execute>
        </select>
      </bindings>
    </table>';
    
    $filename = "tables/" . md5($xml) . ".xml";
    
    file_put_contents($filename, $xml);

    echo json_encode(array(
        "filename" => "http://derek.io/~/executor/" . $filename
    ))
?>