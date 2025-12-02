<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:output method="html" encoding="UTF-8" version="4.0"/>

<xsl:template match="/">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<title><xsl:value-of select="Topic/Title"/></title>
</head>

<body bgcolor="#f8f8f0" style="margin:10px;">
	<p align="left">
		<br/>
      	<xsl:element name="img">
			<xsl:attribute name="src">/images/logo/fenglinonline.gif</xsl:attribute>
		</xsl:element>
	</p>
	<p align="center">
		<font size="5" color="red"><b><xsl:value-of select="Topic/Title"/></b></font><br/>
		（<xsl:value-of select="Topic/Date"/> 修订）
	</p>

	<xsl:apply-templates select="Topic/Content" /> 

	<p align="right">
		<font size="2"><i>
			枫林在线<br/>
			<xsl:value-of select="Topic/Date"/>
		</i></font>
	</p>
</body>
</html>

</xsl:template>

<xsl:template match="Topic/Content">
	<xsl:for-each select="Section"> 
		<p>
			<font size="4" color="green"><b><xsl:value-of select="Name"/></b></font>
		</p>
		<p style="margin-left:30px;">
			<xsl:for-each select="Item">
				<xsl:for-each select="Text">
					<xsl:value-of select="."/><br/>
				</xsl:for-each>
				<xsl:for-each select="SubItem">
					<span style="margin-left:30px;"><xsl:value-of select="."/></span><br/>
				</xsl:for-each>
			</xsl:for-each>
		</p>
	</xsl:for-each>
</xsl:template>

<xsl:template match="br">
	<br /> 
</xsl:template>

</xsl:stylesheet>
