<?php


define("ROOT_PATH", '/home/henry/Documents/Intern/KickerBoardBE/');
require ROOT_PATH . "vendor/autoload.php";



class playerClassTest extends \Codeception\Test\Unit
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
    public function testGetPlayerWithID()
    {
        $player = Player::withPlayerID("1");
        $this->assertTrue($player->dbID==='1');
        $player = Player::withPlayerID("testcase");
        $this->assertNull($player);
    }

    public function testGetPlayerWithName()
    {
        $player = Player::withPlayername("HPBaxxter");
        $this->assertTrue($player->playerName==='HPBaxxter');
        $player = Player::withPlayername("testcase");
        $this->assertNull($player);
    }

    public function  testValidation(){
        $this->assertTrue(Player::validatePlayerName("PlayerName1234"));
        $this->assertTrue(Player::validatePlayerName("alllowercase"));
        $this->assertTrue(Player::validatePlayerName("ALLUPPERCASE"));
        $this->assertTrue(Player::validatePlayerName("12346789"));
        $this->assertTrue(Player::validatePlayerName("ßöäüÖÄÜ"));
        $this->assertFalse(Player::validatePlayerName("Player-1234"));
        $this->assertFalse(Player::validatePlayerName(""));
        $this->assertFalse(Player::validatePlayerName(null));

        $this->assertTrue(Player::validateName("Firstname"));
        $this->assertTrue(Player::validateName("F"));
        $this->assertFalse(Player::validateName("FirstName"));
        $this->assertFalse(Player::validateName("firstname"));
        $this->assertFalse(Player::validateName("123"));
        $this->assertFalse(Player::validateName(123));
        $this->assertFalse(Player::validateName(""));
        $this->assertFalse(Player::validateName(null));
    }
}