<?php

/** @var $this yii\web\View */
/** @var Meetup $meetup */
/** @var float|null $rating */
/** @var app\models\databaseModels\Vote $vote */

use app\models\databaseModels\Meetup;
use yii\helpers\Html;

$this->title = $meetup->title;

?>

<h1><?= Html::encode($this->title) ?></h1>
<span><?= Html::encode($meetup->description) ?></span>

<p>Rating : <span id="rating"><?= is_null($rating) ? '-' : $rating ?></span> (<span id="rates"><?= count($meetup->votes) ?></span> rates)</p>
<div id="your-vote-container">
    <?php
    if(Yii::$app->user->isGuest) {
        ?>
        <span>You must <a href="/login">login</a> to rate this conference</span>
        <?php
    } else {
        ?>
        <span>Your vote:</span>
        <div class='starrr'></div>
        <?php
    }
    ?>
</div>

<?php
if(!Yii::$app->user->isGuest) {
    ?>
    <script type="text/javascript" src="/starrr/starrr.js"></script>
    <script type="text/javascript">
        $('.starrr').starrr({
            <?php
                if(!is_null($vote)) {
                ?>rating: <?= $vote->value ?>, <?php
            }
            ?>
            max: 5,
            emptyClass: 'far fa-star',
            fullClass: 'fas fa-star',
            change: function(e, value) {
                ajaxUpdateSignature(value)
            }
        });

        function ajaxUpdateSignature(newValue) {
            $.ajax({
                url: '/meetups/update-rating',
                method: 'post',
                data: {
                    value: newValue,
                    meetupId: <?= $meetup->id ?>
                },
                success: function(data) {
                    console.log(data);
                    updatePageAfterRateUpdate(data.newRating, data.newRates)
                },
                error: function(error) {
                    console.error(error);
                },
            });
        }

        function updatePageAfterRateUpdate(newRating, newRates) {
            if(newRating === null) {
                newRating = '-';
            }
            $('#rating').html(newRating);
            $('#rates').html(newRates);
        }
    </script>
    <?php
}
