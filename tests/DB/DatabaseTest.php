<?php
use PHPUnit\Framework\TestCase;
require_once "service/DBApi.php";
require_once "classes/Employee.php";

class DatabaseTest extends TestCase
{
    private DBConfig $db;

    protected function setUp(): void
    {
        $this->db = new DBConfig;
    }

    /**
     * @throws Exception
     */
    public function testGetConnection(): void
    {
        $result = $this->db::connect();
        $this->assertInstanceOf(mysqli::class, $result);
    }
}