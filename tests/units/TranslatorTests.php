<?php

declare(strict_types=1);

namespace units;

use Exception;
use PHPUnit\Framework\TestCase;
use Fcmartins\Utils\Translator;

/**
 *
 * @author Francisco Martins
 * @version 1.000.000, 2022-01-20 20:56
 */
class TranslatorTests extends TestCase
{

    private const TEST_CASE = "This is a test phrase example!";

    public function testGetMessage(): void
    {
        try {
            $translator = new Translator();
            $message = $translator->getMessage(self::TEST_CASE);
            $this->assertEquals("500 Internal Server Error", $message);
        } catch (Exception $e) {
            $this->fail($e->getMessage());
        }
    }


}