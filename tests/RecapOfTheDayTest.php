<?php

    declare(strict_types=1);

    use PHPUnit\Framework\TestCase;

    final class RecapOfTheDayTest extends TestCase
    {
        public function testAddType(): void {
            $text   = file_get_contents(__DIR__ . '/contracts_text.txt');

            $type1   = 'OHM';
            $type2   = 'RDV';
            $type3   = 'OHM';
            $center = 'Captive';

            $rotd = new \App\Tools\RecapOfTheDay($text , $type1 , $center);
            $rotd = new \App\Tools\RecapOfTheDay($text , $type2 , $center);
            $rotd = new \App\Tools\RecapOfTheDay($text , $type3 , $center);

            $this->assertEqualsIgnoringCase($rotd->getTypes() , ['OHM' , 'RDV']);
        }

        public function testContractsExtracted(): void
        {   
            $text   = file_get_contents(__DIR__ . '/contracts_text.txt');
            $type   = 'OHM';
            $center = 'Captive';

            $rotd = new \App\Tools\RecapOfTheDay($text , $type , $center);
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
            ],[
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

        public function testContractsNames(): void
        {
            $text = file_get_contents(__DIR__ . '/contracts_text.txt');
            $type = 'OHM';
            $center = 'Captive';

            $rotd = new \App\Tools\RecapOfTheDay($text , $type , $center);
            $contracts = $rotd->get_names();

            $this->assertEqualsIgnoringCase($contracts , ['Victor' , 'Victor']);
        }

        public function testContractsCalculated(): void
        {
            $text = file_get_contents(__DIR__ . '/contracts_text.txt');
            $type = 'OHM';
            $center = 'Captive';

            $rotd = new \App\Tools\RecapOfTheDay($text , $type , $center);
            $contracts = $rotd->calculate();

            $this->assertEqualsIgnoringCase($contracts , [
                'VICTOR' => 2
            ]);
        }

        public function testContractsTypes(): void
        {
            $text = file_get_contents(__DIR__ . '/contracts_text.txt');
            $type = 'RDV';
            $center = 'Saisons';

            $rotd = new \App\Tools\RecapOfTheDay($text , $type , $center);
            $rotd::$types = [];
            $rotd = new \App\Tools\RecapOfTheDay($text , $type , $center);
            $types = $rotd->getTypes();

            $this->assertEqualsIgnoringCase($types , [
                'RDV'
            ]);
        }

        public function testSave(): void
        {
            $text = file_get_contents(__DIR__ . '/contracts_text.txt');
            $type = 'OHM';
            $center = 'CAPTIVE';

            $rotd = new \App\Tools\RecapOfTheDay($text , $type , $center);
            $contracts = $rotd->save();

            $this->assertEqualsIgnoringCase($contracts , [
                [
                    'name' => 'VICTOR',
                    'center' => 'CAPTIVE',
                    'types' => [
                        'OHM' => 2
                    ]
                ]
            ]);
        }
    }