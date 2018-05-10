<?php
use PHPUnit\Framework\TestCase;
use EtoileFilante\Wikipediaravel\Wikipediaravel;

class WikipediaravelTest extends TestCase
{
    private $wki;

    public function __construct()
    {
        parent::__construct();

        $this->wki = new Wikipediaravel('json','fr');
    }

    public function testGetPage()
    {
        $this->assertSame(json_decode($this->wki->getPage('Médaille_Herschel'),true)['parse']['title'],'Médaille Herschel');
    }

    public function testGetSubCategories()
    {
        $this->assertNotNull(json_decode($this->wki->getSubCategories('Astronomie'),true)['categorytree']);
    }
}