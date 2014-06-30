<?php
class PollVote extends AppModel {
        var $name = 'PollVote';

        var $belongsTo = array(
                'Poll' => array(
                        'className' => 'Poll',
                        'foreignKey' => 'poll_id'
                )
        );
}
?>
