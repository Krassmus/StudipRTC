<li class="user user_<?= htmlReady($user['user_id']) ?>" data-user_id="<?= htmlReady($user['user_id']) ?>">
    <div class="avatar"><?= Avatar::getAvatar($user['user_id'])->getImageTag(Avatar::SMALL) ?></div>
    <div class="name"><?= htmlReady(get_fullname($user['user_id'])) ?></div>
</li>