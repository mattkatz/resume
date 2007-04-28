<?php
$style = $_GET['style'];
$stringOut = 'try choosing a query style';
$xml_doc = new DOMDocument;
$xml_doc->load('./Matt.Katz.Resume.xml');
$xp = new XsltProcessor();
// create a DOM document and load the XSL stylesheet
$xsl = new DomDocument;

//if(0 == $style){
	//send xml
//	header('Content-Type: text/xml');
//	$stringOut = $xml_doc->saveXML();
//}

if($style == 'html')
{
		//send html
		$xsl->load('./xsl/output/us-html.xsl');
}
elseif('text' == $style)
{
	//send text
	header('Content-Type: text/plain');
	$xsl->load('./xsl/output/us-text.xsl');
}
elseif('xml' == $style)
{
	//send xml
	header('Content-Type: text/xml');
	//$stringOut = $xml_doc->saveXML();
	$xsl->load('./xsl/output/identity.xsl');
}




// import the XSL styelsheet into the XSLT process
$xp->importStylesheet($xsl);
$stringOut = $xp->transformToXML($xml_doc);

//$stringOut = $style;
echo $stringOut;
?>