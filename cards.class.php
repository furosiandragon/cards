<?php

class cards
{

    public function __construct()
    {
    }

    public function buildDeck()
    {
        $suits = ['Hearts', 'Diamonds', 'Clubs', 'Spades'];
        foreach ($suits as $suit) {
            for ($i = 1; $i < 14; $i++) {
                switch ($i) {
                    case 1:
                        $deck[] = ['suit' => $suit, 'rank' => 'Ace'];
                        break;
                    case 11:
                        $deck[] = ['suit' => $suit, 'rank' => 'Jack'];
                        break;
                    case 12:
                        $deck[] = ['suit' => $suit, 'rank' => 'Queen'];
                        break;
                    case 13:
                        $deck[] = ['suit' => $suit, 'rank' => 'King'];
                        break;
                    default:
                        $deck[] = ['suit' => $suit, 'rank' => $i];
                        break;
                }
            }
        }

        return $this->shuffle($deck);
    }

    public function shuffle($deck)
    {
        $tot = count($deck) - 1;

        for ($i = $tot; $i > -1; $i--) {
            $random = mt_rand(0, $tot);

            if ($tot != $random) {
                $holding = $deck[$random];
                $deck[$random] = $deck[$tot];
                $deck[$tot] = $holding;
            }
        }

        return $deck;
    }

    public function dealOneCard($deck)
    {
        // print_r($deck);
        $card_key = array_rand($deck);
        // echo "<br />Card Key: " . $card_key . "</ br>";
        $card = $deck[$card_key];
        // echo "Card: " . print_r($card) . "</ br>";
        unset($deck[$card_key]);
        $deck = array_values($deck);
        // echo "New Deck: </ br>";
        // print_r($deck);

        return [$card, $deck];
    }
}