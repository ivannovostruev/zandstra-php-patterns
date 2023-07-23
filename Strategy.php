<?php
// Strategy

use patterns\Strategy\{
    MarkLogicMarker,
    MatchMarker,
    RegexMarker,
    TextQuestion
};

require_once 'autoload.php';


$markers = [
    new RegexMarker('/П.ть/u'),
    new MatchMarker('Пять'),
    new MarkLogicMarker('$input equals "Пять"')
];

foreach ($markers as $marker) {
    $question = new TextQuestion('Сколько лучей у кремлевской звезды?', $marker);

    echo '<br>' . get_class($marker) . '<br>';
    foreach (['Пять', 'Четыре', 'Три'] as $response) {
        echo 'Ответ: ' . $response . ': '
            . ($question->mark($response) ? 'Правильно<br>' : 'Неправильно<br>');
    }
}
