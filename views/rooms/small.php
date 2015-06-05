<ul class="clean rtc_room small rtc_room_<?= $room->getId() ?>" data-room_id="<?= $room->getId() ?>">
    <? foreach ($room->users as $user) : ?>
        <? if ($user['user_id'] !== $GLOBALS['user']->id) : ?>
            <?= $this->render_partial("rooms/_user.php", compact("user")) ?>
        <? endif ?>
    <? endforeach ?>
</ul>