<?php namespace CodeIgniter\Format;

class XMLFormatterTest extends \CodeIgniter\Test\CIUnitTestCase
{
	protected $xmlFormatter;

	protected function setUp(): void
	{
		parent::setUp();
		$this->xmlFormatter = new XMLFormatter();
	}

	public function testBasicXML()
	{
		$data = [
			'foo' => 'bar',
		];

		$expected = <<<EOH
<?xml version="1.0"?>
<response><foo>bar</foo></response>

EOH;

		$this->assertEquals($expected, $this->xmlFormatter->format($data));
	}

	public function testFormatXMLWithMultilevelArray()
	{
		$data = [
			'foo' => ['bar'],
		];

		$expected = <<<EOH
<?xml version="1.0"?>
<response><foo><item0>bar</item0></foo></response>

EOH;

		$this->assertEquals($expected, $this->xmlFormatter->format($data));
	}

	public function testFormatXMLWithMultilevelArrayAndNumericKey()
	{
		$data = [
			['foo'],
		];

		$expected = <<<EOH
<?xml version="1.0"?>
<response><item0><item0>foo</item0></item0></response>

EOH;

		$this->assertEquals($expected, $this->xmlFormatter->format($data));
	}

	public function testStringFormatting()
	{
		$data     = ['Something'];
		$expected = <<<EOH
<?xml version="1.0"?>
<response><item0>Something</item0></response>

EOH;

		$this->assertEquals($expected, $this->xmlFormatter->format($data));
	}
}
