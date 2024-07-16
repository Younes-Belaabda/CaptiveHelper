<?php

    declare(strict_types=1);

    use PHPUnit\Framework\TestCase;

    final class RecapOfTheDayTest extends TestCase
    {
        public function testContractsExtracted(): void
        {   
            $text = file_get_contents(__DIR__ . '/contracts_text.txt');
            $rotd = new \App\Tools\RecapOfTheDay($text);
            $contracts = $rotd->contracts;

            $this->assertEqualsIgnoringCase($contracts , [[
                    '[13:33, 08/07/2024] Omaima: CT-2407087218259',
                    'CM-240708237713875',
                    'Fait le 08/07/2024',
                    'SAUVEUR et Delphine DE RUL',
                    '25 rue SCHEURER KESTNER 68100 MULHOUSE',
                    '0613013836//03 89 66 19 84',
                    'cookie.68@hotmail.fr',
                    'Offre gaz fix 1 an zone 2 classe B1',
                    'To Victor',
            ]]);
        }
    }