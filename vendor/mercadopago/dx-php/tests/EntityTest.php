<?php
namespace MercadoPago;
/**
 * EntityTest Class Doc Comment
 *
 * @package MercadoPago
 */
class EntityTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var
     */
    protected $config;
    protected $_entity;
    /**
     *
     */
    protected function setUp()
    {
        $restClient = new RestClient();
        $config = new Config(null, $restClient);
        $manager = new Manager($restClient, $config);
        Entity::setManager($manager);
        $this->_entity = new DummyEntity();
    }
    
    /**
     */
    public function testSetVariables()
    {
        $this->_entity->title = 'Title';
        $this->_entity->desc = 'Description';
        $this->_entity->price = 100.5;
        $this->_entity->quantity = 3;
        $this->_entity->registered_at = '02/14/2015';
        $object = new \stdClass();
        $this->_entity->object = $object;
        $this->_entity->other = 'other';
        $this->_entity->email = 'other@test.com';
        $expectedValues = [
            "title"              => "Title",
            "desc"               => "Description",
            "price"              => 100.5,
            "quantity"           => 3,
            "registered_at"      => "2015-02-14T00:00:00.000+00:00",
            "object"             => $object,
            "other"              => 'other',
            "email"              => 'other@test.com'
        ];
 
        $this->assertEquals($expectedValues, $this->_entity->toArray());
    }
    /**
     */
    public function testGetVariables()
    {
        $this->_entity->title = 'Title';
        $this->_entity->desc = 'Description';
        $this->_entity->price = 100.5;
        $this->_entity->quantity = 3;
        $this->_entity->registered_at = '02/14/2015';
        $object = new \stdClass();
        $this->_entity->object = $object;
        $this->_entity->other = 'other';
        $expectedValues = [
            "id"            => null,
            "title"         => "Title",
            "desc"          => "Description",
            "price"         => 100.5,
            "quantity"      => "3",
            "registered_at" => "2015-02-14T00:00:00.000+00:00",
            "object"        => $object,
            "other"         => 'other'
        ];
        $actualValues = [
            "id"            => $this->_entity->id,
            "title"         => $this->_entity->title,
            "desc"          => $this->_entity->desc,
            "price"         => $this->_entity->price,
            "quantity"      => $this->_entity->quantity,
            "registered_at" => $this->_entity->registered_at,
            "object"        => $this->_entity->object,
            "other"         => $this->_entity->other,
        ];
        $this->assertEquals($expectedValues, $actualValues);
    }
    /**
     * @expectedException        \Exception
     * @expectedExceptionMessage Wrong type object. It should be int for property quantity
     */
    public function testInvalidType()
    {
        $this->_entity->quantity = new \stdClass();
    }
    /**
     */
    public function testAll()
    {
        $hub = new FakeApiHub();
        $request = $this->getMockBuilder('MercadoPago\Http\CurlRequest')->getMock();
        $request->expects($this->once())
            ->method('execute')
            ->will($this->returnValue($hub->getJson('GET', '/dummies')));

        $request->expects($this->once())
            ->method('getInfo')->withAnyParameters()
            ->will($this->returnValue('200'));

        $restClient = new RestClient();
        $restClient->setHttpRequest($request);
        $config = new Config(null, $restClient);
        $manager = new Manager($restClient, $config);
        Entity::setManager($manager);
        $this->_entity = new DummyEntity();
        $this->assertEquals('MercadoPago\DummyEntity', get_class($this->_entity->All()[0]));
    }
    /**
     */
    public function testSave()
    {
        $this->_mockRequest('/v1/payments');
        $this->_entity = new DummyEntity();
        $this->_entity->save();
        $this->assertEquals('1340404', $this->_entity->id);
    }
    /**
     */
    public function testRead()
    {
        $this->_mockRequest('/dummy/:id');
        $this->_entity = DummyEntity::find_by_id('1340404');
        $this->assertEquals('1340404', $this->_entity->id);
    }
    /**
     */
    public function testObjectCreation()
    {
        $this->_mockRequest('/v1/payments');
        $this->_entity = new DummyEntity();
        $this->_entity->save();
        $this->assertInstanceOf(Payer::class, $this->_entity->payer);
    }
    /**
     */
    public function testDynamicAttributes()
    {
        $this->_entity->dynamicAttribute = 100;
        $this->assertEquals(100, $this->_entity->dynamicAttribute);
    }
    /**
     * @expectedException        \Exception
     * @expectedExceptionMessage Error readOnly in attribute readOnlyAttribute
     */
    public function testReadOnlyAttributes()
    {
        $this->_entity->readOnlyAttribute = 100;
    }
    /**
     * @expectedException        \Exception
     * @expectedExceptionMessage Error maxLength in attribute maxLengthAttribute
     */
    public function testMaxLengthAttributes()
    {
        $this->_entity->maxLengthAttribute = 'xxxxxxxxxxxxxxxxxxxxx';
    }
    /**
     */
    public function testSearch()
    {
        $this->_mockRequest('/v1/dummies/search');
        $filters = array(
            "email" =>"test_user_99529216@testuser.com"
        ); 
        $this->_entities = DummyEntity::search($filters);
        $this->assertEquals('227166260-QeyHHDJ8TZ4L3R', $this->_entities[0]->id);
    }
    /**
     */
    public function _mockRequest($endpoint)
    {
        $hub = new FakeApiHub();
        $request = $this->getMockBuilder('MercadoPago\Http\CurlRequest')->getMock();

        $request->expects($this->once())
            ->method('execute')
            ->will($this->returnValue($hub->getJson('POST', $endpoint)));

        $request->expects($this->once())
            ->method('getInfo')->withAnyParameters()
            ->will($this->returnValue('200'));
            
        $restClient = new RestClient();
        $restClient->setHttpRequest($request);
        $config = new Config(null, $restClient);
        $manager = new Manager($restClient, $config);
        Entity::setManager($manager);
    }
}