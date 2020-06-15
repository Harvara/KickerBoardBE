<?php 
class cityClassTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    
    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    public function testGetCityByAttribute()
    {
        $city = City::withID(1);
        $this->assertTrue($city->getDBID()==='1');
        $city = City::withDBName("Jena");
        $this->assertTrue($city->getCityName()==="Jena");

        $city = City::withID("test");
        $this->assertNull($city);
        $city = City::withID(null);
        $this->assertNull($city);
        $city = City::withDBName("");
        $this->assertNull($city);
        $city = City::withDBName(1);
        $this->assertNull($city);
        $city = City::withDBName(null);
        $this->assertNull($city);
    }

    public  function testValidation(){
        $this->assertTrue(City::validateName("Jena"));
        $this->assertTrue(City::validateName("Straßburg"));
        //$this->assertTrue(City::validateName("Ährenfelß"));
        //$this->assertTrue(City::validateName("Öäüß"));

        $this->assertFalse(City::validateName("jena"));
        $this->assertFalse(City::validateName("AAchen"));
        $this->assertFalse(City::validateName("123"));
        $this->assertFalse(City::validateName(123));
        $this->assertFalse(City::validateName(null));
    }
}