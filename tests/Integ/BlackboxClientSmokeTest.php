<?php
namespace Vws\Test\Integ;

use Vws\Exception\VwsException;
use GuzzleHttp\Event\BeforeEvent;

class BlackboxClientSmokeTest extends \PHPUnit_Framework_TestCase
{
    use IntegUtils;

    /**
     *
     */
    public function testGetCatalogs_HasEntityList_EmptyMessages_Local()
    {
        $options = [];
        $client = $this->getVdk()->getBlackbox($options);
        $result = $client->getCatalogs();

        // Herren catalog exists
        $this->assertSame(117697, $result->search('EntityList[0].Id'));
        // Damen -> Snowboard -> Snowboardjacken exists
        $this->assertSame(117702, $result->search('EntityList[1].ChildCatalogs[0].ChildCatalogs[0].Id'));
        // empty message collection
        $this->assertEmpty($result->search('Messages'));
    }

    /**
     *
     *
     */
    public function testGetCatalogById_HasEntityList_EmptyMessages_Local()
    {
        $options = [];
        $client = $this->getVdk()->getBlackbox($options);
        $result = $client->getCatalogById(['Id' => 117702]);

        // Herren catalog exists
        $this->assertSame(117702, $result->search('EntityList[0].Id'));
        // empty message collection
        $this->assertEmpty($result->search('Messages'));
    }

    /**
     *
     *
     */
    public function testgetCatalogById_EmptyEntityList_HasMessages_Error3000_Local()
    {
        $options = [];
        $client = $this->getVdk()->getBlackbox($options);
        $result = $client->getCatalogById(['Id' => 4711]);

        // error message exists
        $this->assertSame('3000', $result->search('Messages[0].Code'));
        // empty entotylist collection
        $this->assertEmpty($result->search('EntityList'));
    }

    /**
     *
     */
    public function testPostCatalog_HasMessages_Error3001_Local ()
    {

    }

    /**
     *
     */
    public function testPostCatalog_HasMessages_Error3002_Local ()
    {

    }
}
