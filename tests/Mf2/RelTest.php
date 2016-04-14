<?php
/**
 * Tests of the parsing methods within mf2\Parser
 */

namespace Mf2\Parser\Test;

use Mf2;
use Mf2\Parser;
use PHPUnit_Framework_TestCase;

class RelTest extends PHPUnit_Framework_TestCase {
  public function setUp() {
    date_default_timezone_set('Europe/London');
  }

  public function testRelValueOnLinkTag() {
    $input = '<link rel="webmention" href="http://example.com/webmention">';
    $parser = new Parser($input);
    $output = $parser->parse();

    $this->assertArrayHasKey('webmention', $output['rels']);
    $this->assertEquals('http://example.com/webmention', $output['rels']['webmention'][0]);
  }

  public function testRelValueOnATag() {
    $input = '<a rel="webmention" href="http://example.com/webmention">webmention me</a>';
    $parser = new Parser($input);
    $output = $parser->parse();

    $this->assertArrayHasKey('webmention', $output['rels']);
    $this->assertEquals('http://example.com/webmention', $output['rels']['webmention'][0]);
  }

  public function testRelValueOnAreaTag() {
    $input = '<map><area rel="webmention" href="http://example.com/webmention"/></map>';
    $parser = new Parser($input);
    $output = $parser->parse();

    $this->assertArrayHasKey('webmention', $output['rels']);
    $this->assertEquals('http://example.com/webmention', $output['rels']['webmention'][0]);
  }

  public function testRelValueOnBTag() {
    $input = '<b rel="webmention" href="http://example.com/webmention">this makes no sense</b>';
    $parser = new Parser($input);
    $output = $parser->parse();

    $this->assertArrayNotHasKey('webmention', $output['rels']);
  }

}
