<?php
//what style is passed on the querystring?
$style = $_GET['style'];
//load up the resume
$xml_doc = new DOMDocument;
$xml_doc->load('http://svn.morelightmorelight.com/trunk/personal/Resume//Matt.Katz.Resume.xml');
$xp = new XsltProcessor();

// create a DOM document for   the XSL stylesheet
$xsl = new DomDocument;

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
	//this is an identity stylesheet just to keep the code clean
	//if you were going for speed you'd just output xml and skip this transform step
	$xsl->load('./xsl/output/identity.xsl');
}
elseif('doc' == $style)
{
	//send html as a doc header
	header('Content-Type: text/doc');
	// It will be called resume.doc
	header('Content-Disposition: attachment; filename="Matt.Katz.Resume.doc"');
	//send html
	$xsl->load('./xsl/output/us-html.xsl');

}
else
{
	//send xml, but without a content type
	$xsl->load('./xsl/output/identity.xsl');
}

// import the XSL styelsheet into the XSLT process
$xp->importStylesheet($xsl);
$formattedString = $xp->transformToXML($xml_doc);

//send the formatted string to the buffer!
echo $formattedString;
?>
