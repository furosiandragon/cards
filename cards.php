<?php
session_start();
require_once 'cards.class.php';

$cards = new cards();
if (!empty($_POST['build'])) {
    $_SESSION['deck'] = $cards->buildDeck();
    $_SESSION['hand'] = [];
}

if (!empty($_POST['shuffle'])) {
    $_SESSION['deck'] = $cards->shuffle($_SESSION['deck']);
}

if (!empty($_POST['deal'])) {
    list($card, $deck) = $cards->dealOneCard($_SESSION['deck']);
    if (!empty($_SESSION['deck'])) {
        $_SESSION['hand'][] = $card;
    }
    $_SESSION['deck'] = $deck;
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <title>Cards</title>
    </head>
    <body>
        <div class="container-xl text-center">
            <h1>Draw A Card</h1>
            <br />
            <div class="col-xl-12">
                <div class="col-xl-12 row">
                    <div class="col-xl-6">
                        <h6>Current Deck</h6>
                        <div class="border border-primary text-start" style="min-height: 266px;">
                            <?php if (empty($_SESSION['deck'])) {
                                echo "No cards remain in your deck. Please build a new deck below.";
                            } else {
                                $i = 1;
                                foreach ($_SESSION['deck'] as $card) {
                                    echo $card['rank'] . " of " . $card['suit'] . ($i == count($_SESSION['deck']) ? "" : ", ");
                                    if ($i % 5 == 0) {
                                        echo "<br />";
                                    }
                                    $i++;
                                }
                            } ?>
                        </div>
                        <?php if (!empty($_SESSION['deck'])) {
                            echo "<div>Cards In Deck: " . count($_SESSION['deck']) . "</div>";
                        } ?>
                    </div>
                    <div class="col-xl-6">
                        <h6>Current Hand</h6>
                        <div class="border border-secondary text-end" style="min-height: 266px;">
                            <?php if (!empty($_SESSION['hand'])) {
                                $i2 = 1;
                                foreach ($_SESSION['hand'] as $card) {
                                    echo $card['rank'] . " of " . $card['suit'] . ($i2 == count($_SESSION['hand']) ? "" : ", ");
                                    if ($i2 % 5 == 0) {
                                        echo "<br />";
                                    }
                                    $i2++;
                                }
                            } ?>
                        </div>
                        <?php if (!empty($_SESSION['hand'])) {
                            echo "<div>Cards In Hand: " . count($_SESSION['hand']) . "</div>";
                        } ?>
                    </div>
                </div>
                <br />
                <div class="col-xl-12 row">
                    <form action="" class="row" method="POST">
                    <?php if (isset($_SESSION['deck'])) { ?>
                        <div class="col-xl-4"><input class="btn btn-success" type="submit" name="build" value="Rebuild Deck" /></div>
                        <div class="col-xl-4"><input class="btn btn-warning" type="submit" name="shuffle" value="Shuffle Deck" /></div>
                        <div class="col-xl-4"><input class="btn btn-primary" type="submit" name="deal" value="Deal A Card" /></div>
                    <?php } else { ?>
                        <div class="col-xl-12"><input class="btn btn-success" type="submit" name="build" value="Build Deck" /></div>
                    <?php } ?>
                    </form>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    </body>
</html>